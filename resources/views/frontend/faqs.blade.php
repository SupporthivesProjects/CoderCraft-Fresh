@extends('frontend.layouts.app')

@section('content')
    {{-- New Code Start --}}
    <section class="the_main_section">

        <section class="faq_1">

            <h1 class="faq_tt">Find Your Answer</h1>
            <p class="faq_pp">Everything you need to know about out products and billing.</p>

        </section>

        <section class="faq_2">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/intersect_tt.png') }}" alt="" class="img-fluid intersect_tt mobile_none">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/mobile_intersect.png') }}" alt="" class="img-fluid intersect_tt_mob desktop_none">


            <div class="container custom_padding_faq">

                <div class="in_faq">

                    <div class="left_main">
                        <div class="left_faq">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/faq_desktop_prop.png') }}" alt="" class="img-fluid faq_desktop_prop">
                            <div class="white_faq_bg">

                                <img src="{{ asset('frontend/BrandSparkz/assets/img/left_faq_in.png') }}" alt="" class="img-fluid also_img"
                                    style="margin-bottom: 18px;">
                                <h1 class="faq_left_tt">can’t find your answer? <span class="faq_left_tt_span">Let’s fix
                                        that.</span></h1>
                                <p class="faq_left_pp">Everything you need to know about out products and billing.. Cant
                                    find the answer you're looking for? Please submit an enquiry via our contact form.</p>
                                <button class="btn btn_global" onclick="window.location.href='{{ route('contactus') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern.png') }}" alt=""
                                        class="img-fluid btn_global_pattern">
                                    <div class="btn_global_inner w-100">

                                        <p class="cart_text">Drop us a line</p>
                                        <img src="{{ asset('frontend/BrandSparkz/assets/img/up_right.svg') }}" alt="" class="img-fluid cart_logo">
                                    </div>
                                </button>

                            </div>

                        </div>
                    </div>


                    <div class="right_faq">

                        <div class="only_faq_pad">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Can I change my plan later?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Blandit posuere
                                            bibendum vel purus sapien, lacus in tortor. Aliquam non est augue commodo
                                            viverra. Pellentesque imperdiet id euismod varius in scelerisque sagittis urna.
                                            Ac sit integer sed vestibulum ut tincidunt urna.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            What is your cancellation policy?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Blandit posuere
                                            bibendum vel purus sapien, lacus in tortor. Aliquam non est augue commodo
                                            viverra. Pellentesque imperdiet id euismod varius in scelerisque sagittis urna.
                                            Ac sit integer sed vestibulum ut tincidunt urna.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            What is your cancellation policy?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Blandit posuere
                                            bibendum vel purus sapien, lacus in tortor. Aliquam non est augue commodo
                                            viverra. Pellentesque imperdiet id euismod varius in scelerisque sagittis urna.
                                            Ac sit integer sed vestibulum ut tincidunt urna.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            What is your cancellation policy?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Blandit posuere
                                            bibendum vel purus sapien, lacus in tortor. Aliquam non est augue commodo
                                            viverra. Pellentesque imperdiet id euismod varius in scelerisque sagittis urna.
                                            Ac sit integer sed vestibulum ut tincidunt urna.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            What is your cancellation policy?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Blandit posuere
                                            bibendum vel purus sapien, lacus in tortor. Aliquam non est augue commodo
                                            viverra. Pellentesque imperdiet id euismod varius in scelerisque sagittis urna.
                                            Ac sit integer sed vestibulum ut tincidunt urna.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>





                    </div>

                </div>

            </div>

        </section>


        <section class="floater_section">
            <div class="line_div mobile_none">

            </div>
            <div class="grey_div mobile_none">

            </div>

            <div class="floater_div">

                <div class="inner_floater">
                    <div>
                        <h1 class="floater_div_tt">
                            We’re <span class="floater_div_tt_span">All In</span>, Are You?
                        </h1>
                        <p class="floater_div_pp">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer cursus dignissim dictumst leo
                            at fusce euismod ut eleifend. Lectus blandit amet mi in.
                        </p>

                    </div>

                    <button class="btn btn_global2 on_phone" onclick="window.location.href='{{ route('user.login') }}'">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                            class="img-fluid btn_global_pattern2">
                        <div class="btn_global_inner2 on_phone">
                            <p class="cart_text">Get started!</p>
                        </div>
                    </button>
                </div>



            </div>

        </section>

    </section>
@endsection

@section('script')
@endsection
