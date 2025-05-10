@extends('frontend.layouts.app')

@section('content')
    <form class="inputSC_main" id="shippingAddress" data-toggle="validator"
        action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST"
        onsubmit="return check_agree(this);">
        @csrf
        @if (Auth::check())
            @php
                $user = Auth::user();
                $lastBillingAddress = \App\Models\LastBillingAddress::getLastBillingAddress($user->id);
            @endphp

            <section class="section_terms">
                <div class="secure_pay1">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/intersect.png') }}" alt="" class="intersect">
                    <div class="container">
                        <div class="terms_div1">
                            <h3 class="terms_heading">Checkout</h3>
                            <p class="para_terms">Lorem ipsum dolor sit amet consectetur. Purus eget arcu non suscipit id.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="term2_main SCmain">
                    <div class="secure_div1">
                        <div class="secure_top">
                            <div class="div_for_ps_inner SCdivTop">
                                <h3 class="heading_of_pS">Billing Details</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="inputSC_main">
                                <input type="hidden" form="shippingAddress" class="form-control" name="user_id"
                                    value="{{ $user->id }}" required />
                                <input type="hidden" class="form-control" form="shippingAddress" name="email"
                                    value="{{ $user->email }}" required />
                                <input type="hidden" form="shippingAddress" name="checkout_type" value="logged">
                                <div class="inputSC_inner">
                                    <div class="inputparaSC">
                                        <p class="paraSC">First Name</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="name"
                                            id="name" value="{{ $lastBillingAddress->name ?? '' }}" required>
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">Phone</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="phone"
                                            id="phone" value="{{ $lastBillingAddress->phone ?? '' }}" required>
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">Address Line 1</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="address"
                                            id="address" value="{{ $lastBillingAddress->address ?? '' }}" required>
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">City</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="city"
                                            id="city" value="{{ $lastBillingAddress->city ?? '' }}" required>
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">Date Of Birth</p>
                                        <input type="date" class="inputSC" value="{{ $lastBillingAddress->dob ?? '' }}"
                                            id="dob" name="dob" form="shippingAddress"
                                            max="{{ date('Y-m-d', strtotime('18 years ago')) }}" required>
                                    </div>
                                </div>
                                <div class="inputSC_inner">
                                    <div class="inputparaSC">
                                        <p class="paraSC">Last Name</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="lname"
                                            id="lname" value="{{ $lastBillingAddress->lname ?? '' }}" required>
                                    </div>

                                    <div class="inputparaSC">
                                        <p class="paraSC">Address Line 2</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="addressL2"
                                            id="addressL2" value="{{ $lastBillingAddress->addressL2 ?? '' }}">
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">StateProvince</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="StateProvince"
                                            id="StateProvince" required placeholder="StateProvince">
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">Country</p>
                                        <select class="inputSC" id="country" name="country"
                                            style="border: 1px solid #BDBDBD;" aria-label="Default select example"
                                            form="shippingAddress" required>
                                            @foreach (\App\Models\Country::all() as $key => $country)
                                                <option value="{{ $country->code ?? '' }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="inputparaSC">
                                        <p class="paraSC">Postcode / Zip</p>
                                        <input type="text" class="inputSC" form="shippingAddress" name="postal_code"
                                            id="postal_code" value="{{ $lastBillingAddress->postal_code ?? '' }}"
                                            required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="secure_middle">

                        </div>
                        <div class="secure_bottom">
                            <div class="bottomSC_main">
                                <div class="term2_main">
                                    <div class="div_for_pS forSC">
                                        <div class="div_for_ps_inner">
                                            <h3 class="heading_of_pS">Order Summary</h3>
                                        </div>
                                        <table class="table table-borderless ">
                                            <thead>
                                                <tr class="table_ps">
                                                    <th scope="col">
                                                        <p class="head_ps">Product</p>
                                                    </th>
                                                    <th scope="col">

                                                        <p class="head_ps">No. Months</p>
                                                    </th>
                                                    <th scope="col">
                                                        <p class="head_ps for_center">Qty</p>
                                                    </th>
                                                    <th scope="col">
                                                        <p class="head_ps for_total1">Subtotal</p>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $tax = 0;
                                                    $shipping = 0;
                                                @endphp
                                                @foreach (Session::get('cart') as $key => $cartItem)
                                                    @php
                                                        $product = \App\Models\Product::find($cartItem['id']);
                                                        $subtotal =
                                                            $subtotal + round(convert_price($cartItem['price']), 2);
                                                    @endphp

                                                    <tr class="table_ps">
                                                        <td scope="row">
                                                            <p class="data_ps"><span>{{ $product->name }}</span></p>
                                                        </td>
                                                        <td>
                                                            <p class="data_ps">{{ $product->subscription }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="data_ps for_center">{{ $cartItem['quantity'] }}</p>
                                                        </td>
                                                        <td>
                                                            <p class=" for_total">{{ single_price($cartItem['price']) }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td scope="row"></td>
                                                    <td></td>
                                                    <td>
                                                        <p class="head_ps for_subtotal for_center">Total</p>
                                                    </td>
                                                    <td>
                                                        <p class="for_total for_bottom">
                                                            {{ currency_symbol() . number_format($subtotal, 2) }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="bottomSCdiv2">
                                    <!-- Replace the coupon section (lines 158-192) with this: -->
                                    @php
                                        $coupon_system = \App\Models\BusinessSetting::where(
                                            'type',
                                            'coupon_system',
                                        )->first();
                                    @endphp
                                    @if (Auth::check() && $coupon_system && $coupon_system->value == 1)
                                        @if (Session::has('coupon_discount'))
                                            <div class="bottomSCbtncp">
                                                <div class="SC_forcoupon">
                                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/cuoponSC.png') }}"
                                                        alt="cuoponSC" class="img_cpSC">
                                                    <div class="SC_forcoupon2">
                                                        <p class="para_bottom_SC">Applied Coupon:
                                                            {{ \App\Models\Coupon::find(Session::get('coupon_id'))->code }}
                                                        </p>
                                                        <div class="line_SC mobile_none"></div>
                                                        <p class="para_bottom_SC">Discount:
                                                            {{ single_price(Session::get('coupon_discount')) }}</p>
                                                    </div>
                                                </div>
                                                <form action="{{ route('checkout.remove_coupon_code') }}"
                                                    id="Couponremove" method="POST">
                                                    @csrf
                                                    <button type="submit" form="Couponremove"
                                                        class="btn btn_button_Sc">Remove Coupon</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="bottomSCbtncp">
                                                <form action="{{ route('checkout.apply_coupon_code') }}" id="applyCoupon"
                                                    method="POST">
                                                    @csrf
                                                    <div class="SC_forcoupon">
                                                        <img src="{{ asset('frontend/BrandSparkz/assets/img/cuoponSC.png') }}"
                                                            alt="cuoponSC" class="img_cpSC">
                                                        <div class="SC_forcoupon2">
                                                            <p class="para_bottom_SC">Have a coupon?</p>
                                                            <div class="line_SC mobile_none"></div>
                                                            <input type="text" form="applyCoupon"
                                                                class="input_bottom_SC" name="code"
                                                                placeholder="Enter your code here" required>
                                                        </div>
                                                    </div>
                                                    <button type="submit" form="applyCoupon"
                                                        class="btn btn_button_Sc">Apply Coupon</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                <div class="bottomSCauth">
                                    <div class="bottomdiv_authe">
                                        <input type="checkbox" class="checkbox_SC" id="terms" name="terms"
                                            form="shippingAddress">
                                        <p class="para_checkboxSC">By ticking this box, you agree to the
                                            <span><a href="{{ route('termsandconditions') }}">Terms & Conditions</a>
                                            </span> &
                                            <span><a href="{{ route('privacypolicy') }}"> Privacy Policy</a></span>
                                        </p>
                                    </div>
                                    <div class="h-captcha mx-auto my_mob_24" data-sitekey="{{ env('H_CAPTCHA_SITE_KEY') }}"
                                            form="shippingAddress">
                                    </div>
                                </div>
                                <button class="btn btn_SC" form="shippingAddress" type="submit">Complete
                                    Checkout</button>
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/SCMastercard.png') }}" alt=""
                                    class="SC_mastercard">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </form>




@endsection

@section('scripts')
    <script type="text/javascript">
        function removeFromCart1(key) {
            $.post('{{ route('cart.removeFromCart') }}', {
                _token: '{{ csrf_token() }}',
                key: key
            }, function(data) {
                //updateNavCart();
                $('#cart-summary').html(data);
                Swal.fire({
                    icon: 'success',
                    title: 'Item Removed',
                    text: 'Item has been removed from cart'
                })

                location.reload();
            });
        }

        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
            //location.reload();
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: element.value
            }, function(data) {
                updateNavCart();
                $('#cart-summary').html(data);
            });
        }

        function showCheckoutModal() {
            $('#GuestCheckout').modal();
        }
    </script>

    <script>
        function field_box_file() {
            console.log('me');
            document.getElementById('document').click();
        }
        $("#document").on("change", function(e) {
            document.getElementById('upload_placeholder').innerHTML = e.target.files[0].name;
        })

        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function showCheckoutModal() {
            $('#GuestCheckout').modal();
        }
    </script>



    <script>
        function check_agree(form) {
            var response = grecaptcha.getResponse();
            return true;
            if (form.terms.checked && response.length > 0) {

                return true;
            } else {

                if (!form.terms.checked) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please accept terms and conditions.'
                    });
                } else if (response.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please complete the reCAPTCHA.'
                    });
                }
                return false;
            }
        }
    </script>
@endsection
