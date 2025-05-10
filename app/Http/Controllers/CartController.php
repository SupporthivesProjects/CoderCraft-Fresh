<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Color;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('frontend.view_cart', compact('categories'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $data = [
            'id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $this->calculatePrice($product),
            'tax' => $this->calculateTax($product),
            'shipping' => $product->shipping_cost
        ];

        // Make sure $cart is always a collection
        $cart = collect($request->session()->get('cart', []));

        $existingItem = $cart->where('id', $request->id)->first();
        if ($existingItem) {
            $cart = $cart->map(function ($item) use ($request, $data) {
                if ($item['id'] == $request->id) {
                    $item['quantity'] += $request->quantity;
                }
                return $item;
            });
        } else {
            $cart->push($data);
        }

        $request->session()->put('cart', $cart);

        return response()->json([
            'status' => 1,
            'success' => true,
            'product' => $product,
            'cart_count' => $cart->count()
        ]);
    }

    public function removeFromCart(Request $request)
    {
        if ($request->session()->has('cart')) {
            $cart = collect($request->session()->get('cart'));
            $cart = $cart->except([$request->key]);
            $request->session()->put('cart', $cart->all());

            return response()->json([
                'success' => true,
                'cart_count' => $cart->count()
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('cart', collect([]));
        $cart = $cart->map(function ($item, $key) use ($request) {
            if ($key == $request->key) {
                $item['quantity'] = $request->quantity;
            }
            return $item;
        });

        $request->session()->put('cart', $cart);
        return response()->json([
            'success' => true,
            'cart_count' => $cart->count()
        ]);
    }

    private function calculatePrice($product)
    {
        $price = $product->unit_price;
        if ($product->discount_type == 'percent') {
            $price -= ($price * $product->discount) / 100;
        } elseif ($product->discount_type == 'amount') {
            $price -= $product->discount;
        }
        return $price;
    }

    private function calculateTax($product)
    {
        $price = $this->calculatePrice($product);
        if ($product->tax_type == 'percent') {
            return ($price * $product->tax) / 100;
        }
        return $product->tax;
    }

    public function addToCart1Step(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $data = array();
            $data['id'] = $product->id;
            $data['owner_id'] = $product->user_id;
            $data['quantity'] = 1;
            $data['price'] = $product->unit_price;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = $product->cash_on_delivery;
            $data['digital'] = $product->digital;

            if (Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
                $data['product_referral_code'] = Cookie::get('product_referral_code');
            }

            if ($request->session()->has('cart')) {
                $foundInCart = false;
                $cart = collect();

                foreach ($request->session()->get('cart') as $key => $cartItem) {
                    if ($cartItem['id'] == $product->id) {
                        $foundInCart = true;
                        $cartItem['quantity'] += 1;
                    }
                    $cart->push($cartItem);
                }

                if (!$foundInCart) {
                    $cart->push($data);
                }
                $request->session()->put('cart', $cart);
            } else {
                $cart = collect([$data]);
                $request->session()->put('cart', $cart);
            }

            return response()->json([
                'status' => 1,
                'message' => 'Product added to cart successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Add to cart error: ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'message' => 'Error adding product to cart'
            ]);
        }
    }

    public function updateNavCart()
    {
        $cart = session()->get('cart', collect([]));
        $count = $cart->count();

        $cartView = view('partials.cart_items', compact('cart'))->render();

        return response()->json([
            'cart_view' => $cartView,
            'count' => $count
        ]);
    }
}
