@if (Session::has('cart') && count(Session::get('cart')) > 0)
    @php
        $total = 0;
    @endphp
    @foreach (Session::get('cart') as $key => $cartItem)
        @php
            $product = \App\Models\Product::find($cartItem['id']);
            $total = $total + round(convert_price($cartItem['price'] * $cartItem['quantity']), 2);
        @endphp
        <div class="cart_item">

            <div class="cart_item_left">
                <p class="cart_item_title">
                    {{ $product->name }}
                </p>
                <div class="cart_item_values_div">
                    <p class="cart_item_values">x{{ $cartItem['quantity'] }}</p>
                    <p class="cart_item_values"> {{ $product->subscription }}</p>
                    <p class="cart_item_values_bold">
                        {{ single_price($cartItem['price'] * $cartItem['quantity']) }}
                    </p>
                </div>
            </div>
            <div class="cart_item_right">
                <button class="btn">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/bin.svg') }}" alt="" class="img-fluid"
                        onclick="removeFromCart({{ $key }})">
                </button>
            </div>
        </div>
    @endforeach

    <div class="cart_footer">
        <div class="cart_footer_top">
            <p class="cart_item_values_bold">Subtotal</p>
            <p class="cart_item_values_bold">
                {{ currency_symbol() }}{{ number_format($total, 2) }}</p>
        </div>
        <div class="cart_footer_bottom">
            <button class="btn btn_orange_transparent" onclick="justDrop('cart_drop', 'roter5', this)">Close</button>
            <button class="btn btn_orange"
                onclick="window.location.href='{{ route('checkout.shipping_info') }}'">Checkout</button>
        </div>
    </div>
@else
    <div class="empty-cart">
        <p>Your cart is empty</p>
    </div>
@endif
