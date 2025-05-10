@extends('frontend.layouts.app')

@section('content')
    <section class="contact_page">
        <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_top_right.png') }}" alt=""
            class="img-fluid mobile_none cutter_top_right">
        <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_bottom_left.png') }}" alt=""
            class="img-fluid mobile_none cutter_bottom_left">
        <div class="contact_main_div">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/cutter_pattern.png') }}" alt=""
                class="img-fluid desktop_none cutter_pattern">
            <div class="cutter_main_div_inner">
                <div class="cutter_main_div_inner_left">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/contact_cutter_one.png') }}" alt=""
                        class="img-fluid mobile_none contact_cutter_one">
                    <div class="contact_women_mask_div">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/contact_women_mask.png') }}" alt=""
                            class="img-fluid mobile_none contact_women_mask">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/contact_women_mask_mobo.png') }}" alt=""
                            class="img-fluid desktop_none contact_women_mask">
                        <div class="women_mask_text_div wmtd1">
                            <div class="disc_div">
                                <div class="outer_disc">
                                    <div class="inner_disc"></div>
                                </div>
                            </div>
                            <div class="wm_text_div">
                                <p class="wm_text">Friendly support Team</p>
                            </div>
                        </div>
                        <div class="women_mask_text_div wmtd2">
                            <div class="wm_text_div">
                                <p class="wm_text">Real People, Real Solutions</p>
                            </div>
                            <div class="disc_div">
                                <div class="outer_disc">
                                    <div class="inner_disc"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact_info">
                        <div class="boxting">
                            <p class="contact_info_title">Our Contacts</p>
                            <div class="contact_boxting_bar"></div>
                        </div>

                        <div class="c_box_element">
                            <div class="circ_radial">
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/ci1.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <p class="c_box_text">+44 (0)123 456 7890</p>
                        </div>
                        <div class="c_box_element">
                            <div class="circ_radial">
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/ci2.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <p class="c_box_text">info@Brandsparkz.com.com</p>
                        </div>
                        <div class="c_box_element">
                            <div class="circ_radial">
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/ci3.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                            <p class="c_box_text">
                                <span>Brand Sparkz Innovations FZ LLC</span>
                                Creative Business Zone, New Metro District, United Arab Emirates.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- form starts here -->
                <form class="cutter_main_div_inner_right" id="contactform" role="form"
                    action="{{ route('contactus.store') }}" method="post" onsubmit="return check_agree(this);">
                    @csrf
                    <input type="hidden" name="from_page" value="contactus">
                    <h1 class="contact_title">let's chat!</h1>
                    <p class="contact_subtitle">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi diam fermentum aliquam porttitor rutrum
                    </p>

                    <div class="contact_input_div">
                        <p class="contact_input_title">Full Name</p>
                        <input type="text" class="form-control input_global" id="fullname" name="fullname" required>
                    </div>

                    <div class="contact_input_div">
                        <p class="contact_input_title">Email</p>
                        <input type="email" class="form-control input_global" id="email" name="email" required>
                    </div>

                    <div class="contact_input_div">
                        <p class="contact_input_title">Phone</p>
                        <input type="tel" class="form-control input_global" id="phone" name="phone" required>
                    </div>

                    <div class="contact_input_div">
                        <p class="contact_input_title">Your Message</p>
                        <textarea class="form-control input_global" id="message" name="message" required></textarea>
                    </div>

                    <div class="contact_input_div">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="c-checkbox mb-3">
                                    <div class="c-div">
                                        <label class="d-flex justify-content-center justify-content-lg-start">
                                            <input type="checkbox" id="terms" name="terms">
                                            <label for="terms"></label>
                                        </label>
                                    </div>
                                    <div class="c-text">
                                        <p class="login_strong">By ticking this box, you agree to the
                                            <a href="{{ route('termsandconditions') }}">Terms & Conditions</a> & <a
                                                href="{{ route('privacypolicy') }}">Privacy Policy</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="h-captcha mx-auto my_mob_24" data-sitekey="{{ env('H_CAPTCHA_SITE_KEY') }}"
                                    form="contactform"></div>
                            </div>
                        </div>
                    </div>

                    <div class="contact_submit_div">
                        <button class="btn btn_global mx-auto" type="submit">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}"
                                alt="" class="img-fluid btn_global_pattern">
                            <div class="btn_global_inner">
                                <p class="cart_text">Submit Message</p>
                                <img src="{{ asset('frontend/BrandSparkz/assets/img/arrow_logo.svg') }}" alt=""
                                    class="img-fluid cart_logo">
                            </div>
                        </button>
                    </div>
                </form>
                <!-- form ends here -->
            </div>
        </div>
    </section>

    <script>
        function check_agree(form) {
            console.log(form.email.valid);
            if (form.fullname && form.email && form.phone && form.message && form.terms.checked) {

                $('#submit-btn').attr('disabled', true);
                return true;
            } else if (!form.fullname.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Fullname'
                })
                return false;
            } else if (!form.email.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Email'
                })
                return false;
            } else if (!form.phone.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Phone'
                })
                return false;
            } else if (!form.message.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Comments'
                })
                return false;
            } else if (!form.terms.checked) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Accept T&C'
                })
                return false;
            }
            return false;
        }
    </script>
@endsection
