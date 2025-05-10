@extends('frontend.layouts.app')

@section('content')
<section class="checkout4_page">
    <div class="che_s1">
        <div class="ches1_inner">
            <h1 class="ches1_title mobile_none">Shopping Cart</h1>
            <h1 class="ches1_title desktop_none">Cart</h1>
            <p class="ches1_subtitle">Review your items before proceeding to checkout</p>
        </div>
    </div>

    <div class="che_s2">
        <div class="sec_up_cont">
            <div class="container sec_contain px-0">
                @if (Session::has('cart') && count(Session::get('cart')) > 0)
                    <div class="sec_down_box">
                        <div class="personal_information_b">
                            <div class="cart_product_container">
                                @php
                                    $subtotal = 0;
                                    $tax = 0;
                                @endphp

                                @foreach (Session::get('cart') as $key => $cartItem)
                                    @php
                                        $product = \App\Models\Product::find($cartItem['id']);
                                        $category_name = \App\Models\Category::find($product->category_id)->name;
                                        $subtotal += round(convert_price($cartItem['price'] * $cartItem['quantity']), 2);
                                        $product_name_with_choice = $cartItem['variant'] ? 
                                            $product->name . ' - ' . $cartItem['variant'] : 
                                            $product->name;
                                    @endphp

                                    <div class="cart_product_box">
                                        <div class="cart_product_details">
                                            <h4 class="cart_product_title">{{ $product_name_with_choice }}</h4>
                                            <p class="cart_product_subtitle">Length: {{ $product->subscription }}</p>
                                        </div>
                                        <div class="cart_product_price">
                                            {{ single_price($cartItem['price'] * $cartItem['quantity']) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="summ_ary">
                            <div class="summary_box">
                                <h4 class="suumary_title">Summary</h4>
                                
                                <div class="cart_box">
                                    <div class="left_cart_name">
                                        <h4 class="l_c_t">Subtotal</h4>
                                    </div>
                                    <div class="right_cart_name">
                                        <h4 class="l_c_t">{{ currency_symbol() . $subtotal }}</h4>
                                    </div>
                                </div>

                                @if (Session::has('coupon_discount'))
                                    <div class="cart_box">
                                        <div class="left_cart_name">
                                            <h4 class="l_c_t">Discount</h4>
                                        </div>
                                        <div class="right_cart_name">
                                            <h4 class="l_c_t">{{ Session::get('coupon_discount') }}</h4>
                                        </div>
                                    </div>
                                @endif

                                <hr class="line">

                                <div class="cart_box">
                                    <div class="left_cart_name">
                                        <h4 class="l_c_t">Total</h4>
                                    </div>
                                    <div class="right_cart_name">
                                        <h4 class="l_c_t">{{ currency_symbol() . $subtotal }}</h4>
                                    </div>
                                </div>

                                @if (Auth::check() && optional(\App\Models\BusinessSetting::where('type', 'coupon_system')->first())->value == 1)
                                    @if (Session::has('coupon_discount'))
                                        <form id="cpn_remove" action="{{ route('checkout.remove_coupon_code') }}" method="POST">
                                            @csrf
                                            <div class="name_form_div">
                                                <input type="text" class="form-control inpi_boxx" value="{{ \App\Models\Coupon::find(Session::get('coupon_id'))->code }}" readonly>
                                                <button type="submit" class="btn btn_redd">Remove</button>
                                            </div>
                                        </form>
                                    @else
                                        <form id="cpn_apply" action="{{ route('checkout.apply_coupon_code') }}" method="POST">
                                            @csrf
                                            <div class="name_form_div">
                                                <input type="text" name="code" class="form-control inpi_boxx" placeholder="Enter discount code">
                                                <button type="submit" class="btn btn_redd">Apply</button>
                                            </div>
                                        </form>
                                    @endif
                                @endif

                                <div class="dual_btn">
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn_redd">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty_cart_container">
                        <img src="{{ asset('frontend/Lingosphere/img/empty-cart.svg') }}" alt="Empty Cart" class="img-fluid">
                        <h4 class="empty_cart_title">Your cart is empty</h4>
                        <a href="{{ route('home') }}" class="btn btn_redd">Continue Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
