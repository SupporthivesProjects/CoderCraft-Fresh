@extends('frontend.layouts.app')

@section('content')

<section class="register_page">
    <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_top_right.png') }}" alt=""
        class="img-fluid mobile_none cutter_top_right">
    <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_bottom_left.png') }}" alt=""
        class="img-fluid mobile_none cutter_bottom_left">
    <div class="contact_main_div">
        <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_pattern.png') }}" alt=""
            class="img-fluid desktop_none cutter_pattern">
        <div class="cutter_main_div_inner">
            <form class="cutter_main_div_inner_right_login" id="loginform" role="form" action="{{ route('login') }}"
                method="POST">
                @csrf
                <h1 class="register_title">Welcome Back to <span>brand Sparkz!</span></h1>

                <div class="contact_input_div">
                    <p class="register_input_title">Email</p>
                    <input type="text" name="email" id="email" class="form-control input_global" required>
                </div>

                <div class="contact_input_div">
                    <p class="register_input_title">Password (at least 8 characters)</p>
                    <input type="password" id="password" name="password" class="form-control input_global" required>
                </div>


                <div class="contact_input_div">
                    <div class="c-checkbox mb-3">
                        <div class="c-div">
                            <label class="d-flex justify-content-center justify-content-lg-start">
                                <input type="checkbox" id="terms" name="terms">
                                <label for="terms"></label>
                            </label>
                        </div>
                        <div class="c-text">
                            <p class="login_strong">Remember me</p>
                        </div>
                    </div>
                </div>

                <div class="contact_input_div">
                    <button class="btn btn_global2 mx-auto" type="submit" form="loginform">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                            class="img-fluid btn_global_pattern2">
                        <div class="btn_global_inner2">
                            <p class="cart_text">Login to your account</p>
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt=""
                                class="img-fluid cart_logo">
                        </div>
                    </button>
                </div>
                <div class="w-100">
                    <button class="btn btn_forgot_pass_link" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                       >Forgot Password?</button>
                </div>
            </form>
            <div class="cutter_main_div_inner_left mobile_none">
                <img src="{{ asset('frontend/BrandSparkz/assets/img/login_cutter_one.png') }}" alt=""
                    class="img-fluid mobile_none contact_cutter_one">
                <div class="login_right_bg">
                    <h1 class="register_left_title">
                        <span>New here?</span><br> Let's fix that.
                    </h1>

                    <button class="btn btn_global mx-auto"
                        onclick="window.location.href='{{ route('user.registration') }}'">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt=""
                            class="img-fluid btn_global_pattern">
                        <div class="btn_global_inner">
                            <p class="cart_text">Join Us</p>
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt=""
                                class="img-fluid cart_logo">
                        </div>
                    </button>
                </div>
            </div>
            <div class="cutter_main_div_inner_bottom_mobo_login desktop_none">
                <h1 class="register_left_title">
                    <span>New here?</span><br> Let's fix that.
                </h1>

                <button class="btn btn_global mx-auto"
                    onclick="window.location.href='{{ route('user.registration') }}'">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt=""
                        class="img-fluid btn_global_pattern">
                    <div class="btn_global_inner">
                        <p class="cart_text">Join Us</p>
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt=""
                            class="img-fluid cart_logo">
                    </div>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width2">
      <div class="modal-content custom_modal">
        <h1 class="modal_tt">
           Forget password
        </h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
        <div class="contact_input_div">
            <p class="register_input_title">Email</p>
            <input type="email" id="email" class="form-control input_global @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="buttons_wala">
            <button class="btn btn_global2 on_phone" type="submit">
                <img src="./assets/img/btn_primary_pattern2.png" alt="" class="img-fluid btn_global_pattern2">
                <div class="btn_global_inner2 on_phone">
                    <p class="cart_text">continue shopping</p>
                </div>
            </button>
        </div>
        </form>
       
      </div>
    </div>
  </div>


@endsection

@section('scripts')

<script>
    function check_agree(form) {


        if (form.terms.checked) {
            return true;
        } else if (!form.terms.checked) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please accept terms and conditions'
            })
        }
        return false;
    }

</script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

</script>
@endsection
