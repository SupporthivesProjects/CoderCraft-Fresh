<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order, Product, OrderDetail, CouponUsage, User, BusinessSetting};
use App\Mail\InvoiceEmailManager;
use App\Services\EmailService;
use Illuminate\Support\Facades\{Auth, Session, DB, Mail, Log};
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Termwind\Components\Dd;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = $this->createOrder($request);
            
            if ($order) {
                $this->processOrderItems($order);
                // $this->generateAndSendInvoice($order, $request);
                $request->session()->put('order_id', $order->id);
                DB::commit();
                return true;
            }
            
            DB::rollBack();
            return false;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            return false;
        }
    }

    private function createOrder(Request $request)
    {
        $order = new Order;

        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->guest_id = mt_rand(100000, 999999);
        }

        $order->shipping_address = json_encode($request->session()->get('shipping_info'));
        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His') . rand(10, 99);
        $order->date = strtotime('now');

        return $order->save() ? $order : null;
    }

    private function processOrderItems($order)
    {
        $subtotal = 0;
        $tax = 0;

        foreach (Session::get('cart') as $cartItem) {
            $product = Product::findOrFail($cartItem['id']);
            
            // $this->updateProductStock($product, $cartItem);
            $this->createOrderDetail($order, $product, $cartItem);
            $subtotal += round($cartItem['price'] ?? 0, 2) * $cartItem['quantity'];
            $tax += round($cartItem['tax'] ?? 0, 2) * $cartItem['quantity'];

            $product->increment('num_of_sale');
        }
        
        $this->updateOrderTotal($order, $subtotal);
        $this->processCouponDiscount($order);
    }

    private function updateProductStock($product, $cartItem)
    {
        if ($cartItem['variant']) {
            $product->stocks()
                ->where('variant', $cartItem['variant'])
                ->decrement('qty', $cartItem['quantity']);
        } else {
            $product->decrement('current_stock', $cartItem['quantity']);
        }
    }

    private function createOrderDetail($order, $product, $cartItem)
    {
        try {
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'variation' => 'Marketing',
                'price' => $cartItem['price'],
                'tax' => $cartItem['tax']?? 0 * $cartItem['quantity'],
                'shipping_type' => 'home_delivery',
                'quantity' => $cartItem['quantity'],
            ]);
            if (!$orderDetail) {
                Log::error('Order detail creation failed for order ID: ' . $order->id);
                flash('Failed to create order detail')->error();
                return false;
            }

            return $orderDetail;
        } catch (Exception $e) {
            Log::error('Order detail creation error: ' . $e->getMessage());
            flash('Error creating order detail: ' . $e->getMessage())->error();
            return false;
        }
    }



    private function updateOrderTotal($order, $subtotal)
    {
        $order->grand_total = $subtotal;
        if (Session::has('coupon_discount')) {
            $order->coupon_discount = Session::get('coupon_discount');
        }
        $order->save();
    }

    private function processCouponDiscount($order)
    {
        if (Session::has('coupon_discount')) {
            CouponUsage::create([
                'user_id' => Auth::id(),
                'coupon_id' => Session::get('coupon_id')
            ]);
        }
    }

    private function generateAndSendInvoice($order, $request)
    {
        try {
            $pdf = $this->generateInvoicePDF($order);
            $this->saveInvoicePDF($pdf, $order);
            $this->sendInvoiceEmails($order);
        } catch (Exception $e) {
            Log::error('Invoice generation failed: ' . $e->getMessage());
        }
    }

    private function generateInvoicePDF($order)
    {
        return Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])->loadView('invoices.customer_invoice', compact('order'));
    }

    private function saveInvoicePDF($pdf, $order)
    {
        $output = $pdf->output();
        $filepath = 'public/invoices/Order#' . $order->code . '.pdf';
        file_put_contents($filepath, $output);
        return $filepath;
    }

    private function sendInvoiceEmails($order)
    {
        $emailData = [
            'view' => 'emails.invoice',
            'subject' => 'Order Placed - ' . $order->code,
            'from' => env('MAIL_USERNAME'),
            'content' => 'Hi. A new order has been placed. Please check the attached invoice.',
            'file' => 'public/invoices/Order#' . $order->code . '.pdf',
            'file_name' => 'Order#' . $order->code . '.pdf',
            'order' => $order
        ];

        $this->sendEmailToSellers($order, $emailData);
    }

    private function sendEmailToSellers($order, $emailData)
    {
        $sellerProducts = $this->groupProductsBySeller($order);
        $emailService = new EmailService();

        foreach ($sellerProducts as $sellerId => $products) {
            try {
                $sellerEmail = User::find($sellerId)->email;
                $emailService->send(
                    'invoice',
                    $emailData['order'],
                    $sellerEmail,
                    'Order Placed - ' . $order->code
                );
            } catch (Exception $e) {
                Log::error('Failed to send email to seller: ' . $e->getMessage());
            }
        }
    }


    private function groupProductsBySeller($order)
    {
        return $order->orderDetails->groupBy('seller_id')->map(function ($items) {
            return $items->pluck('product_id');
        });
    }
}
