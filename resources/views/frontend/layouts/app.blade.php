<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BrandSparkz</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/Lingosphere/img/Fav.png') }}') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Essential CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/dist/bootstrap/css/bootstrap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/dist/owl-carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/css/m_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/css/sk_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/BrandSparkz/assets/css/t_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body>
    @php
        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code');
        } else {
            $currency_code = $currency_code = \App\Models\Currency::getDefaultCurrency();
        }
        Session::put('currency_code', $currency_code);
    @endphp



    {{-- new header code --}}

    <header class="fixed-top">
        <div class="header_top">
            <div class="container desktop_header p-0">
                <div class="header_main_container">
                    <div class="header_left">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/header_bg_trans_logo_.svg') }}"
                                alt="" class="img-fluid header_logo">
                        </a>
                    </div>
                    <div class="header_center">
                        <button class="btn btn_header_link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
                            onclick="window.location.href='{{ route('aboutus') }}'">
                            About
                        </button>
                        <div class="header_center_bar"></div>
                        <div class="service_drop_container">
                            <button class="btn btn_header_drop" onclick=window.location.href='{{ route('products') }}'
                                id="service_drop_btn">
                                Products
                            </button>
                        </div>
                        <div class="header_center_bar"></div>
                        <button class="btn btn_header_link {{ request()->routeIs('faqs') ? 'active' : '' }}"
                            onclick="window.location.href='{{ route('faqs') }}'">
                            FAQ's
                        </button>
                        <div class="header_center_bar"></div>
                        <button class="btn btn_header_link {{ request()->routeIs('contactus') ? 'active' : '' }}"
                            onclick="window.location.href='{{ route('contactus') }}'">
                            Contact Us
                        </button>
                        <div class="header_center_bar"></div>
                        @auth
                            <button class="btn btn_header_link" onclick="window.location.href='{{ route('dashboard') }}'">
                                My Accont
                            </button>
                        @else
                            <button class="btn btn_header_link {{ request()->routeIs('user.login') ? 'active' : '' }}"
                                onclick="window.location.href='{{ route('user.login') }}'">
                                Login
                            </button>
                            <div class="header_center_bar"></div>
                            <button
                                class="btn btn_header_link {{ request()->routeIs('user.registration') ? 'active' : '' }}"
                                onclick="window.location.href='{{ route('user.registration') }}'">
                                Sign Up
                            </button>
                        @endauth
                        <div class="header_center_bar"></div>
                        <div class="currency_drop_container">
                            <button class="btn btn_header_drop" onclick="justDrop('currency_drop', 'roter2', this)">
                                {{ $currency_code }}
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/drop.svg') }}" alt=""
                                    class="img-fluid" id="roter2">
                            </button>
                            <div class="dropped_div d-none" id="currency_drop">
                                @foreach (\App\Models\Currency::getActiveCurrencies() as $key => $currency)
                                    <button
                                        class="btn btn_orange_header dropdown-item {{ $currency_code == $currency->code ? 'active' : '' }}"
                                        data-currency="{{ $currency->code }}">
                                        {{ $currency->code }} ({{ $currency->symbol }})
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="header_right">
                        <div class="cart_drop_container">
                            <button class="btn btn_global" onclick="justDrop('cart_drop', 'roter5', this)">
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}"
                                    alt="" class="img-fluid btn_global_pattern">
                                <div class="btn_global_inner">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/cart_logo.svg') }}"
                                        alt="" class="img-fluid cart_logo">
                                    <p class="cart_text">View Cart</p>
                                    <span>
                                        {{ Session::has('cart') ? count(Session::get('cart')) : '0' }}
                                    </span>
                                </div>
                            </button>
                            <div class="cart_dropper_div d-none" id="cart_drop">
                                @if (Session::has('cart') && count(Session::get('cart')) > 0)
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach (Session::get('cart') as $key => $cartItem)
                                        @php
                                            $product = \App\Models\Product::find($cartItem['id']);
                                            $total =
                                                $total +
                                                round(convert_price($cartItem['price'] * $cartItem['quantity']), 2);
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
                                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/bin.svg') }}"
                                                        alt="" class="img-fluid"
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
                                            <button class="btn btn_orange_transparent"
                                                onclick="justDrop('cart_drop', 'roter5', this)">Close</button>
                                            <button class="btn btn_orange"
                                                onclick="window.location.href='{{ route('checkout.shipping_info') }}'">Checkout</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-cart">
                                        <p>Your cart is empty</p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mobile_header p-0">
                <div class="header_mobo_main">
                    <div class="header_mobo_left">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/header_mobo_bg_trans_logo_.svg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="header_mobo_right">
                        <div class="hamburger_menu">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/hamburger_logo.png') }}"
                                alt="" class="img-fluid">
                        </div>
                        <div class="hamburger_menu_close" style="display: none;">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/hamburger_close.svg') }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_mobo_main_slide" style="display: none;">
            <div class="header_main_mobo">
                <button class="btn btn_header_link" onclick="window.location.href='{{ route('aboutus') }}'">
                    About
                </button>
                <div class="service_drop_container">
                    <button class="btn btn_header_drop" onclick="justDrop('service_drop_mob', 'roter3', this)">
                        Services
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" id="roter3">
                            <path d="M18 9L12 15L6 9" stroke="#3C3C3C" stroke-width="2" />
                        </svg>
                    </button>
                    <div class="dropped_div d-none" id="service_drop_mob">
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('seo') }}'">SEO</button>
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('ppc') }}'">PPC</button>
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('orm') }}'">ORM</button>
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('wdd') }}'">UX/UI</button>
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('em') }}'">Email</button>
                        <button class="btn btn_orange_header"
                            onclick="window.location.href='{{ route('social') }}'">Social Media</button>
                    </div>
                </div>
                <button class="btn btn_header_link" onclick="window.location.href='{{ route(name: 'faqs') }}'">
                    FAQs
                </button>
                <button class="btn btn_header_link" onclick="window.location.href='{{ route('contactus') }}'">
                    Contact Us
                </button>
                @auth
                    <button class="btn btn_header_link" onclick="window.location.href='{{ route('dashboard') }}'">
                        My Account
                    </button>
                @else
                    <button class="btn btn_header_link" onclick="window.location.href='{{ route('user.login') }}'">
                        Login
                    </button>
                    <button class="btn btn_header_link"
                        onclick="window.location.href='{{ route('user.registration') }}'">
                        Sign up
                    </button>
                @endauth
                <div class="currency_drop_container">
                    <button class="btn btn_header_drop" onclick="justDrop('currency_drop_mobo', 'roter4', this)">
                        {{ $currency_code }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" id="roter4">
                            <path d="M18 9L12 15L6 9" stroke="#3C3C3C" stroke-width="2" />
                        </svg>
                    </button>
                    <div class="dropped_div d-none" id="currency_drop_mobo">
                        @foreach (\App\Models\Currency::getActiveCurrencies() as $key => $currency)
                            <button
                                class="btn btn_orange_header dropdown-item {{ $currency_code == $currency->code ? 'active' : '' }}"
                                data-currency="{{ $currency->code }}">
                                {{ $currency->code }} ({{ $currency->symbol }})
                            </button>
                        @endforeach
                    </div>
                </div>
                <button class="btn btn_global cart_menu">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt=""
                        class="img-fluid btn_global_pattern">
                    <div class="btn_global_inner w-100">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/cart_logo.svg') }}" alt=""
                            class="img-fluid cart_logo">
                        <p class="cart_text">View Cart</p>
                        <span id="cart_items_sidenav">

                            {{ Session::has('cart') ? (count($cart = Session::get('cart')) > 0 ? count($cart) : 0) : 0 }}

                        </span>
                    </div>
                </button>
            </div>
        </div>
        <div class="header_cart_mobo_main_slide" style="display: none;">
            <div class="header_cart_main_mobo">
                @if (Session::has('cart') && count(Session::get('cart')) > 0)
                    @php
                        $total1 = 0;
                    @endphp
                    @foreach (Session::get('cart') as $key => $cartItem)
                        @php
                            $product = \App\Models\Product::find($cartItem['id']);
                            $total1 = $total1 + round(convert_price($cartItem['price'] * $cartItem['quantity']), 2);
                        @endphp
                        <div class="cart_item">
                            <div class="cart_item_left">
                                <p class="cart_item_title">
                                    {{ $product->name }}
                                </p>
                                <div class="cart_item_values_div">
                                    <p class="cart_item_values">x{{ $cartItem['quantity'] }}</p>
                                    <p class="cart_item_values">{{ $product->subscription }}</p>
                                    <p class="cart_item_values_bold">
                                        {{ single_price($cartItem['price'] * $cartItem['quantity']) }}</p>
                                </div>
                            </div>
                            <div class="cart_item_right">
                                <button class="btn">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/bin.svg') }}" alt=""
                                        class="img-fluid" onclick="removeFromCart({{ $key }})">
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <div class="cart_footer">
                        <div class="cart_footer_top">
                            <p class="cart_item_values_bold">Subtotal</p>
                            <p class="cart_item_values_bold">{{ currency_symbol() }}{{ number_format($total1, 2) }}
                            </p>
                        </div>
                        <div class="cart_footer_bottom">
                            <button class="btn btn_orange_transparent" onclick="closeMobileCart()">Back to
                                menu</button>
                            <button class="btn btn_orange"
                                onclick="window.location.href='{{ route('checkout.shipping_info') }}'">Checkout</button>
                        </div>
                    </div>
                @else
                    <div class="empty-cart">
                        <p>Your cart is empty</p>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Success Modal -->


    <div class="modal fade" id="customModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width2">
            <div class="modal-content custom_modal">

                <h1 class="modal_tt">
                    Added to Cart
                </h1>

                <p class="modal_pp">
                    Your chosen service has successfully been added to the cart.
                </p>
                <div class="buttons_wala">
                    <button class="btn btn_global2 on_phone" onClick="window.location.reload();">
                        <img src="./assets/img/btn_primary_pattern2.png" alt=""
                            class="img-fluid btn_global_pattern2">
                        <div class="btn_global_inner2 on_phone">
                            <p class="cart_text">continue shopping</p>
                        </div>
                    </button>

                    <button class="btn btn_global width_for_checkoutbtn" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop2"
                        onclick="window.location.href='{{ route('checkout.shipping_info') }}'">
                        <img src="./assets/img/btn_primary_pattern.png" alt=""
                            class="img-fluid btn_global_pattern">
                        <div class="btn_global_inner w-100">

                            <p class="cart_text">Checkout</p>
                        </div>
                    </button>
                </div>

            </div>
        </div>
    </div>




    <main>
        @yield('content')
    </main>
    @include('frontend.inc.footer')
    <!-- Essential JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>





    <script src="{{ asset('frontend/BrandSparkz/assets/dist/bootstrap/js/bootstrap.popper.min.js') }}"></script>
    <script src="{{ asset('frontend/BrandSparkz/assets/dist/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Owl Carousel JS Links -->
    <script src="{{ asset('frontend/BrandSparkz/assets/dist/owl-carousel/js/owl.carousel.js') }}"></script>

    <!-- JS Link -->
    <script src="{{ asset('frontend/BrandSparkz/assets/js/main.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>


    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>

    <!-- Custom Scripts -->
    <script>
        $(function() {
            // Header scroll effect
            $(document).scroll(function() {
                var $nav = $(".fixed-top");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".hamburger_menu").click(function() {
                $(".header_mobo_main_slide").fadeIn("slow");
                $(".hamburger_menu").fadeOut("slow");
                $(".hamburger_menu_close").fadeIn("slow");
                $(".header_cart_mobo_main_slide").fadeOut("slow");
            });
            $(".hamburger_menu_close").click(function() {
                $(".header_mobo_main_slide").fadeOut("slow");
                $(".hamburger_menu").fadeIn("slow");
                $(".hamburger_menu_close").fadeOut("slow");
            });
            $(".cart_menu").click(function() {
                $(".header_cart_mobo_main_slide").fadeIn("slow");
                $(".cart_menu").fadeOut("slow");
                $(".cart_menu_close").fadeIn("slow");
                $(".header_mobo_main_slide").fadeOut("slow");
            });
            $(".cart_menu_close").click(function() {
                $(".header_cart_mobo_main_slide").fadeOut("slow");
                $(".cart_menu").fadeIn("slow");
                $(".cart_menu_close").fadeOut("slow");
            });
        });

        function justDrop(droperId, roterId) {
            const theId = document.getElementById(droperId);
            const theId2 = document.getElementById(roterId);
            if (theId.classList.contains('d-none')) {
                theId.classList.remove('d-none');
                theId2.style.rotate = '180deg';
            } else {
                theId.classList.add('d-none');
                theId2.style.rotate = '0deg';
            }
        }

        function counterMinus(indexPosition) {
            const myId = 'cart_product_units' + indexPosition;
            const inputElement = document.getElementById(myId);
            let currentValue = parseInt(inputElement.value, 10);

            if (isNaN(currentValue)) {
                currentValue = 0;
            }

            if (currentValue > 1) {
                const newValue = currentValue - 1;
                inputElement.value = newValue;
            } else {
                inputElement.value = currentValue;
            }
        }


        function counterPlus(indexPosition) {
            const myId = 'cart_product_units' + indexPosition;
            const inputElement = document.getElementById(myId);
            let currentValue = parseInt(inputElement.value, 10);

            if (isNaN(currentValue)) {
                currentValue = 0;
            }

            if (currentValue < 10) {
                const newValue = currentValue + 1;
                inputElement.value = newValue;
            } else {
                inputElement.value = currentValue;
            }
        }


        //Change Currency
        $(document).ready(function() {
            $('#currency_drop button').on('click', function() {
                let currency_code = $(this).data('currency');

                $.ajax({
                    url: '/currency',
                    type: 'POST',
                    data: {
                        currency_code: currency_code,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            location.reload();
                        }
                    }
                });
            });
        });

        // mobile currency change 
        $(document).ready(function() {
            $('#currency_drop_mobo button').on('click', function() {
                let currency_code = $(this).data('currency');

                $.ajax({
                    url: '/currency',
                    type: 'POST',
                    data: {
                        currency_code: currency_code,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function showFrontendAlert(type, message) {
            let icon = type;
            if (type == 'danger') {
                icon = 'error';
            }

            Swal.fire({
                position: 'center',
                icon: icon,
                title: '<h1 class="text-blue">' + message + '</h1>',
                html: '<p class="body-large text-grey">Please wait while page refreshes</p>',
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                width: 'auto'
            });
        }
    </script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
        <script>
            showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
        </script>
    @endforeach

    {{-- cart section --}}
    <script>
        function updateNavCart() {
            $.post('{{ route('cart.nav_cart') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#cart_items_sidenav').html(data.count);
                $('#cart_drop1').html(data.cart_view);
            });
        }

        function updateCartSummary(data) {
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Cart updated successfully');
        }

        function removeFromCart(key) {
            $.post('{{ route('cart.removeFromCart') }}', {
                _token: '{{ csrf_token() }}',
                key: key
            }, function(data) {
                updateNavCart();
                updateCartSummary(data);
                if (data.success) {
                    location.reload();
                }
            });
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: element.value
            }, function(data) {
                updateNavCart();
                updateCartSummary(data);
            });
        }

        function changeMainImage(imageSrc, element) {
            document.getElementById('main-product-image').src = imageSrc;

            // Remove active class from all thumbnails
            document.querySelectorAll('.product-thumbnail').forEach(thumbnail => {
                thumbnail.classList.remove('active');
            });

            // Add active class to clicked thumbnail
            element.classList.add('active');
        }

        // Quantity selector functionality
        document.addEventListener('DOMContentLoaded', function() {
            const minusBtn = document.getElementById('minus');
            const plusBtn = document.getElementById('plus');
            const quantityInput = document.getElementById('quantity');

            minusBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            plusBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < 10) {
                    quantityInput.value = currentValue + 1;
                }
            });

            quantityInput.addEventListener('change', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < 1) {
                    quantityInput.value = 1;
                } else if (currentValue > 10) {
                    quantityInput.value = 10;
                }
            });
        });

        // Add to cart function
        function addToCart() {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.addToCart') }}',
                data: $('#option-choice-form').serialize(),
                success: function(response) {
                    if (response.status == 1) {
                        // Update cart count in navbar
                        updateNavCart();

                        // Show success message
                        $('#customModal').modal('show');
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Check for authentication error
                    if (xhr.status === 401) {
                        // Redirect to login page or show login modal
                        Swal.fire({
                            icon: 'error',
                            title: 'Authentication Required',
                            text: 'Please log in to add items to your cart',
                            showCancelButton: true,
                            confirmButtonText: 'Login',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('user.login') }}';
                            }
                        });
                    } else {
                        // Show general error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                }
            });
        }

        // Initialize cart functionality
        cartQuantityInitialize();

        // Update variant price when options change
        $('#option-choice-form input').on('change', function() {
            getVariantPrice();
        });

        // Add to cart in one step (for related products)
        function addToCart1Step(id) {
            // First show confirmation dialog
            Swal.fire({
                title: 'Add to Cart',
                text: 'Are you sure you want to add this product to your cart?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, add it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with adding to cart
                    $.ajax({
                        type: "POST",
                        url: '{{ route('cart.addToCart') }}',
                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: id, 
                            quantity: 1
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                // Update cart count in navbar
                                updateNavCart();
                                
                                // Update the view cart button count directly
                                let currentCount = parseInt($('.cart_drop_container span').text()) || 0;
                                $('.cart_drop_container span').text(currentCount + 1);
                                
                                // Show success message
                                $('#customModal').modal('show');
                            } else {
                                // Show error message
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message || 'Something went wrong!'
                                });
                            }
                        }
                    });
                }
            });
        }
        
        // Show add to cart modal (if needed)
        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal('show');
            $('.c-preloader').show();
            
            $.post('{{ route('cart.showCartModal') }}', {
                _token: '{{ csrf_token() }}',
                id: id
            }, function(data) {
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                getVariantPrice();
            });
        }

    </script>

    <script>
        function show_purchase_history_details(order_id) {
            $('#order-details-modal-body').html(null);

            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('purchase_history.details') }}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: order_id
                },
                success: function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal("show");
                    $('.c-preloader').hide();
                },
                error: function(xhr) {
                    console.error('Error loading purchase details:', xhr.responseText);
                }
            });
        }
    </script>






    @yield('scripts')
</body>

</html>
