<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order, OrderDetail, Category, BusinessSetting, Coupon, CouponUsage, User, Wallet};
use App\Mail\InvoiceEmailManager;
use App\Services\EmailService;
use Illuminate\Support\Facades\{Auth, Session, Mail, Log, DB};
use Exception;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            $orderController = new OrderController;
            $orderController->store($request);

            $request->session()->put('payment_type', 'cart_payment');
            DB::commit();
            if ($request->session()->get('order_id')) {
                $response = $this->processPaymentOption($request);
                
                return $response;
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Order creation failed');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Checkout process failed');
        }
    }

    private function processPaymentOption(Request $request)
    {
        try {
            
            $request->merge(['payment_option' => 'citigate']);

            switch ($request->payment_option) {
                case 'citigate':
                    return (new CitigateController)->index($request);

                case 'cash_on_delivery':
                    $this->clearSessionData($request);
                    return redirect()->route('order_confirmed')
                        ->with('success', 'Order placed successfully');

                case 'wallet':
                    return $this->processWalletPayment($request);

                default:
                    return $this->processManualPayment($request);
            }
        } catch (Exception $e) {
            dd([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
                'session_data' => Session::all(),
                'payment_option' => $request->payment_option,
                'request_data' => $request->all()
            ]);
        }
    }


    public function store_shipping_info(Request $request)
    {
        try {
            // Prepare shipping data
            
            $data = [
                'name' => $request->name,
                'lname' => $request->lname,
                'user_id' => $request->user_id,
                'email' => $request->email,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'checkout_type' => $request->checkout_type,
                'shipping_type' => 'home_delivery'
            ];

            // Add optional fields
            if ($request->addressL2) {
                $data['addressL2'] = $request->addressL2;
            }

            if ($data['country'] == 'US') {
                $data['stateProvince'] = $request->stateProvince;
            }

            if ($request->dob) {
                $data['dob'] = $request->dob;
            }
            
            // Store shipping info in session
            $request->session()->put('shipping_info', $data);
            // Calculate totals
            $totals = $this->calculateOrderTotals();
            // Process checkout
            return $this->checkout($request);
        } catch (Exception $e) {
            Log::error('Shipping info storage error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to save shipping information');
        }
    }

    private function calculateOrderTotals()
    {
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
       
        foreach (Session::get('cart') as $cartItem) {
            
            $subtotal += $cartItem['price'] ?? 0 * $cartItem['quantity'];
            $tax += $cartItem['tax'] ?? 0 * $cartItem['quantity'];
            $shipping += $cartItem['shipping'] ?? 0 * $cartItem['quantity'];
        }
       
        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total
        ];
    }

    public function get_shipping_info()
    {
        try {
            if (Session::has('cart') && count(Session::get('cart')) > 0) {
                return view('frontend.shipping_info');
            }
            return redirect()->route('home');
        } catch (Exception $e) {
            Log::error('Shipping info error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load shipping information');
        }
    }

    private function processWalletPayment(Request $request)
    {
        try {
            $user = Auth::user();
            $orderId = $request->session()->get('order_id');
            $orderAmount = Order::findOrFail($orderId)->grand_total;

            Wallet::deductBalance($user->id, $orderAmount);

            return $this->checkout_done($orderId, null);
        } catch (Exception $e) {
            Log::error('Wallet payment error: ' . $e->getMessage());
            throw new Exception('Wallet payment failed');
        }
    }


    private function processManualPayment(Request $request)
    {
        try {
            $order = Order::findOrFail($request->session()->get('order_id'));
            $order->manual_payment = 1;
            $order->save();

            return redirect()->route('order_confirmed')
                ->with('success', 'Order placed successfully. Please submit payment information from purchase history');
        } catch (Exception $e) {
            Log::error('Manual payment error: ' . $e->getMessage());
            throw new Exception('Manual payment processing failed');
        }
    }

    public function checkout_done($order_id, $payment)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($order_id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            $this->processOrderDetails($order);
            $this->sendOrderEmail($order);
            $this->clearAllSessionData();

            DB::commit();
            Session::flash('paymentsuccess');
            return redirect()->route('order_confirmed');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Checkout completion error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Order completion failed');
        }
    }

    private function processOrderDetails($order)
    {
        try {
            foreach ($order->orderDetails as $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();

                if ($orderDetail->product->user->user_type == 'seller') {
                    $this->processSellerCommission($orderDetail);
                }
            }

            $order->commission_calculated = 1;
            $order->save();
        } catch (Exception $e) {
            Log::error('Order details processing error: ' . $e->getMessage());
            throw new Exception('Failed to process order details');
        }
    }

    private function processSellerCommission($orderDetail)
    {
        try {
            $commission_percentage = $this->getCommissionPercentage($orderDetail);
            $seller = $orderDetail->product->user->seller;

            $commission = ($orderDetail->price * (100 - $commission_percentage)) / 100;
            $seller->admin_to_pay += $commission;
            $seller->save();
        } catch (Exception $e) {
            Log::error('Seller commission error: ' . $e->getMessage());
            throw new Exception('Failed to process seller commission');
        }
    }

    private function getCommissionPercentage($orderDetail)
    {
        $categoryWiseCommission = BusinessSetting::where('type', 'category_wise_commission')->first();

        return $categoryWiseCommission && $categoryWiseCommission->value == 1
            ? $orderDetail->product->category->commision_rate
            : BusinessSetting::where('type', 'vendor_commission')->first()->value;
    }

    private function sendOrderEmail($order)
    {
        try {
            if (!env('MAIL_USERNAME')) {
                return;
            }

            $emailData = $this->prepareEmailData($order);
            $customerEmail = json_decode($order->shipping_address)->email;
            $adminEmail = User::where('user_type', 'admin')->first()->email;

            $emailService = new EmailService();

            // Send to customer
            $emailService->send(
                'invoice',
                $emailData['order'],
                $customerEmail,
                'Order Placed - ' . $order->code
            );

            // Send to admin
            $emailService->send(
                'invoice',
                $emailData['order'],
                $adminEmail,
                'New Order Received - ' . $order->code
            );
        } catch (Exception $e) {
            Log::error('Order email error: ' . $e->getMessage());
        }
    }


    private function prepareEmailData($order)
    {
        return [
            'view' => 'emails.invoice',
            'subject' => 'Order Placed - ' . $order->code,
            'from' => env('MAIL_USERNAME'),
            'content' => 'Hi. A new order has been placed. Please check the attached invoice.',
            'file' => 'public/invoices/Order#' . $order->code . '.pdf',
            'file_name' => 'Order#' . $order->code . '.pdf',
            'order' => $order
        ];
    }

    private function clearSessionData(Request $request)
    {
        $request->session()->put('cart', collect([]));
        $request->session()->forget(['delivery_info', 'coupon_id', 'coupon_discount']);
    }

    private function clearAllSessionData()
    {
        Session::put('cart', collect([]));
        Session::forget([
            'payment_type',
            'delivery_info',
            'coupon_id',
            'coupon_discount'
        ]);
    }

    public function order_confirmed()
    {
        try {
            $order = OrderDetail::where('order_id', Session::get('order_id'))
                ->with(['product', 'order'])
                ->get();

            return view('frontend.order_confirmed', compact('order'));
        } catch (Exception $e) {
            Log::error('Order confirmation error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load order confirmation');
        }
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        
        if($coupon != null){
            if(strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date){
                // if(CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null){
                if(1==1){
                    $coupon_details = json_decode($coupon->details);
                    
                    if ($coupon->type == 'cart_base')
                    {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach (Session::get('cart') as $key => $cartItem)
                        {
                            $subtotal += $cartItem['price']*$cartItem['quantity'];
                            $tax += $cartItem['tax']*$cartItem['quantity'];
                            $shipping += $cartItem['shipping']*$cartItem['quantity'];
                        }
                        $sum = $subtotal+$tax+$shipping;
                        
                        if ($sum > $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount)/100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            }
                            elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            flash('Coupon has been applied')->success();
                        }
                    }
                    elseif ($coupon->type == 'product_base')
                    {
                        $coupon_discount = 0;
                        foreach (Session::get('cart') as $key => $cartItem){
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if($coupon_detail->product_id == $cartItem['id']){
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price']*$coupon->discount/100;
                                    }
                                    elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        flash('Coupon has been applied')->success();
                    }
                }
                else{
                    flash('You already used this coupon!')->warning();
                }
            }
            else{
                flash('Coupon expired!')->warning();
            }
        }
        else {
            flash('Invalid coupon!')->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request)
    {
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }
}