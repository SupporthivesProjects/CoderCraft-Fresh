@extends('frontend.layouts.app')

@section('content')
    


    <section class="register_page">
        <img src=" {{ asset('frontend/BrandSparkz/assets/img/cutter_top_right.png') }}" alt="" class="img-fluid mobile_none cutter_top_right">
        <img src=" {{ asset('frontend/BrandSparkz/assets/img/cutter_bottom_left.png') }}" alt="" class="img-fluid mobile_none cutter_bottom_left">
        <div class="contact_main_div">
            <img src=" {{ asset('frontend/BrandSparkz/assets/img/cutter_pattern.png') }}" alt="" class="img-fluid desktop_none cutter_pattern">
            <div class="cutter_main_div_inner">
                <div class="cutter_main_div_inner_left mobile_none">
                    <img src=" {{ asset('frontend/BrandSparkz/assets/img/contact_cutter_one.png') }}" alt="" class="img-fluid mobile_none contact_cutter_one">
                    <div class="register_left_bg">
                        <h1 class="register_left_title">
                            <span>We've met before,</span> haven't we?
                        </h1>

                        <button class="btn btn_global mx-auto">
                            <img src=" {{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt="" class="img-fluid btn_global_pattern">
                            <div class="btn_global_inner" >
                                <p class="cart_text"> <a class="cart_text" href="{{ route('user.login') }}">Login </a></p>
                                <img src=" {{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt="" class="img-fluid cart_logo">
                            </div>
                        </button>
                    </div>
                </div>
                <div class="cutter_main_div_inner_right_register">
                    <h1 class="register_title">Join the <span>Sparkz</span> Movement</h1>
                    <form id="registerform" role="form" action="{{ route('register') }}" method="POST"
                            onsubmit="return check_agree(this);">
                        @csrf
                        <div class="contact_input_div">
                            <p class="register_input_title">Full Name</p>
                            <input type="text" class="form-control input_global" form="registerform" name="name"
                                id="name">
                        </div>

                        <div class="contact_input_div">
                            <p class="register_input_title">Email</p>
                            <input type="text" class="form-control input_global" id="email" name="email" form="registerform">
                        </div>

                        <div class="contact_input_div">
                            <p class="register_input_title">Password (at least 8 characters)</p>
                            <input type="password" class="form-control input_global" form="registerform" name="password"
                            id="password">
                        </div>

                        <div class="contact_input_div">
                            <p class="register_input_title">Confirm Password</p>
                            <input type="password" class="form-control input_global"  name="password_confirmation" 
                            id="password_confirmation" form="registerform">
                        </div>


                        <div class="contact_input_div register_page_box">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <img src=" {{ asset('frontend/BrandSparkz/assets/img/reCAPTCHA.png') }}" alt="" class="img-fluid d-flex mx-auto mb-3"> --}}
                                    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
                                        <div class="h-captcha mx-auto my_mob_24" data-sitekey="{{ env('H_CAPTCHA_SITE_KEY') }}">
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="c-checkbox mb-3">
                                        <div class="c-div">
                                        <label class="d-flex justify-content-center justify-content-lg-start">
                                            <input type="checkbox" id="terms" name="terms">
                                            <label for="terms"></label>
                                        </label>
                                        </div>
                                        <div class="c-text">
                                        <p class="login_strong">By ticking this box, you agree to the 
                                            <a href="{{ route('termsandconditions') }}" >Terms & Conditions</a> &
                                            <a href="{{ route('privacypolicy') }}">Privacy Policy</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="contact_submit_div">
                            <button class="btn btn_global2 mx-auto" type="submit" form="registerform">
                                <img src=" {{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt="" class="img-fluid btn_global_pattern2">
                                <div class="btn_global_inner2">
                                    <p class="cart_text">Submit Message</p>
                                    <img src=" {{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt="" class="img-fluid cart_logo">
                                </div>
                            </button>
                        </div>
                    </form>
                </div>


                <div class="cutter_main_div_inner_bottom_mobo_register desktop_none">
                    <h1 class="register_left_title">
                        <span>We've met before,</span> haven't we?
                    </h1>

                    <button class="btn btn_global mx-auto">
                        <img src=" {{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt="" class="img-fluid btn_global_pattern">
                        <div class="btn_global_inner">
                            <p class="cart_text"><a class="cart_text" href="{{ route('user.login') }}">Login</a></p>
                            <img src=" {{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt="" class="img-fluid cart_logo">
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        function check_agree(form) {

            var password1 = form.password.value;
            var password2 = form.password_confirmation.value;

            if (password2 == password1 && form.terms.checked) {
                return true;
            } else if (password1.length < 6) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password is too short, please try again !'
                })
            } else if (password2 != password1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password does not matched, please try again !'
                })
            } else if (!form.terms.checked) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You must agree to the Terms and Conditions and Privacy Policy before continuing.'
                })
                return false;
            }
            return false;
        }
    </script>
@endsection
