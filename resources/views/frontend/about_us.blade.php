@extends('frontend.layouts.app')

@section('content')
    
<section>

    <section class="sec1_s">
        <video class="bg-image d-lg-block d-md-block d-none" loop="" muted="" autoplay=""
            style="object-fit: cover;">
            <source src="{{ asset('frontend/BrandSparkz/assets/img/aboutus.mp4') }}" type="video/mp4">
        </video>
        <video class="bg-image d-lg-none d-md-none d-block" loop="" muted="" autoplay="" style="object-fit: cover;">
            <source src="{{ asset('frontend/BrandSparkz/assets/img/aboutus_mob.mp4') }}" type="video/mp4">
        </video>

        <div class="aboutus__sec1">
            <h1 class="main_tt">
                The Brains Behind <br class="mobile_none">the<span class="aboutus_span">
                    Brand Sparkz
                </span>
            </h1>
            <p class="main_pp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum nunc eget molestie
                duis nunc iaculis morbi vestibulum. Massa volutpat nisi, ultrices aenean pellentesque ornare ornare
                vel. Viverra et lobortis a scelerisque vitae. Turpis non venenatis vel sed. Urna id.</p>

        </div>
    </section>


    <section class="for_bgonly">
        <section class="aboutus_2">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/intersect_tt.png') }}" alt="" class="img-fluid intersect_tt mobile_none">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/mobile_intersect.png') }}" alt="" class="img-fluid intersect_tt_mob desktop_none">

            <h1 class="about_tt">
                Our <span class="about_tt_span">Spark</span> by the Numbers
            </h1>
            <p class="about_pp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam leo velit mi diam sed
                viverra aenean. Ut et velit molestie consectetur pharetra, platea convallis. Eleifend porttitor
                viverra sed lectus ipsum vitae ipsum blandit.</p>
            <div class="container p-0">
                <div class="image_section">
                    <div class="img_1_shadow_wrapper">
                        <img class="img_1_shadow" src="{{ asset('frontend/BrandSparkz/assets/img/img_1_shadow.png') }}">
                        <div class="img_1">
                            <p class="image_tt mx-auto">Campaigns That Actually work</p>
                        </div>
                    </div>




                    <div class="img_2">
                        <p class="image_tt mx-auto">Support That Doesn’t Sleep</p>
                    </div>
                    <div class="img_3">
                        <p class="image_tt mx-auto">More Than 20 Digital Creators, One Mission</p>
                    </div>
                    <div class="img_4_shadow_wrapper">
                        <img class="img_4_shadow" src="{{ asset('frontend/BrandSparkz/assets/img/img_4_shadow.png') }}">
                        <div class="img_4">
                            <p class="image_tt mx-auto">Cross-Industry Knowledge</p>
                        </div>
                    </div>


                </div>

            </div>
        </section>

        <section class="aboutus_3">
            <div class="container custom_pad_about">
                <div class="aboutus3_maincrd">

                    <div class="aucrd_contentouter">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/aboutusprop.png') }}" alt="" class="img-fluid aboutusprop mobile_none">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/mobile_au_prop.png') }}" alt=""
                            class="img-fluid mobile_au_prop desktop_none">
                        <div class="aucrd_contentinner">
                            <h1 class="au_tt">
                                the Minds That Make <span class="au_tt_span">the Magic</span>
                            </h1>
                            <p class="au_pp">Lorem ipsum dolor sit amet consectetur. Felis tristique dapibus felis
                                vestibulum vulputate tincidunt. Nunc quis ut aliquet orci bibendum et placerat
                                iaculis pellentesque. Accumsan facilisi duis nullam cursus volutpat et molestie
                                vestibulum. Tellus nullam a egestas elementum ut odio turpis cursus lobortis.
                                <br>
                                Amet dictumst nulla ac at nunc sit in adipiscing volutpat. Vulputate nisl cum diam
                                pulvinar. Ut tellus tellus posuere volutpat tellus aliquam aliquam amet. Ac morbi
                                sed pulvinar sed amet lacinia. Lectus justo vestibulum ipsum cras leo sagittis.
                                <br>
                                Id non sed habitant vel massa. Ipsum leo leo aliquet vel aliquam. Tristique nam
                                turpis dolor et fames ac. Non non est sed dui at enim pharetra. Dapibus nisl
                                dictumst dignissim sit dictumst mi sit fames diam. Ut nunc nulla eu urna bibendum
                                nec penatibus.
                                <br>
                                Cras tincidunt in suspendisse fusce quisque sapien dui mi. Accumsan fringilla
                                gravida venenatis sit consequat commodo quis. Sed massa nec nec turpis.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="desktop_none">

            <div class="only_mob">
                    <h1 class="only_mob_tt">
                        Turn Brand Potential Into <span class="only_mob_tt_span">Brand Power</span>
                    </h1>
                    <div class="per_section">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/icon1.png') }}" alt="" class="img-fluid icon_icon">
                        <div>
                            <h1 class="per_sec_tt">impact Over Noise</h1>
                            <p class="per_sec_pp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Commodo vitae massa integer lorem aliquam turpis fusce. Est arcu mi massa</p>
                        </div>
                    </div>
                    <div class="per_section">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/icon2.png') }}" alt="" class="img-fluid icon_icon">
                        <div>
                            <h1 class="per_sec_tt">impact Over Noise</h1>
                            <p class="per_sec_pp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Commodo vitae massa integer lorem aliquam turpis fusce. Est arcu mi massa</p>
                        </div>
                    </div>
                    <div class="per_section">
                        <img src="{{ asset('frontend/BrandSparkz/assets/img/icon3.png') }}" alt="" class="img-fluid icon_icon">
                        <div>
                            <h1 class="per_sec_tt">Built for Bold Brands</h1>
                            <p class="per_sec_pp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Commodo vitae massa integer lorem aliquam turpis fusce. Est arcu mi massa</p>
                        </div>
                    </div>
            </div>

        </section>

        <section class="aboutus_4">
            <h1 class="au_tt">
                The <span class="au_tt_span">Sparkz</span> Menu

            </h1>
            <p class="au_pp extra_widith">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo, feugiat
                laoreet vel, amet tristique dolor euismod sed diam. Consectetur porttitor diam mattis commodo sed
                elementum, ultricies.</p>
            <div class="container main_div_hoverpadding">

                <div class="in_hover">

                    <div class="serv_rw_1">
                        <div class="serv_c1 js_hv">
                            <a class=" card_btn" href="#">SEO</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive SEO </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route('seo') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="serv_c2 js_hv">
                            <a class=" card_btn" href="#">Pay-per-click</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive Pay-per-click </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route('ppc') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="serv_c3 js_hv">
                            <a class=" card_btn" href="#">ORM</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive ORM </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route('orm') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="serv_rw_1">
                        <div class="serv_c4 js_hv">
                            <a class=" card_btn" href="#">UX/UI</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive UX/UI </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route('wdd') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="serv_c5 js_hv">
                            <a class=" card_btn" href="#">Email Marketing</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive Email Marketing </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route('em') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="serv_c6 js_hv">
                            <a class=" card_btn" href="#">Social Media</a>
                            <div class="serv_gree">
                                <h4 data-aos="fade-up">Progressive Social Media </h4>
                                <p data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare
                                    volutpat blandit scelerisque et cursus tristique <span class="mobile_none">hendrerit hendrerit. Nunc urna at
                                        quis eu enim egestas.</span>
                                </p>
                                <button class="btn btn_global2 mx-auto" onclick="window.location.href='{{ route(name: 'social') }}'">
                                    <img src="{{ asset('frontend/BrandSparkz/assets/img/btn_primary_pattern2.png') }}" alt=""
                                        class="img-fluid btn_global_pattern2">
                                    <div class="btn_global_inner2 on_phone">
                                        <h1 class="cart_text">Explore Service</h1>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer cursus dignissim dictumst
                        leo at fusce euismod ut eleifend. Lectus blandit amet mi in.
                    </p>

                </div>

                <button class="btn btn_global2 on_phone" onclick="window.location.href='{{ route('contactus') }}'">
                    <img src="{{ asset('frontend/Brandsparkz/assets/img/btn_primary_pattern2.png') }}" alt="" class="img-fluid btn_global_pattern2">
                    <div class="btn_global_inner2 on_phone">
                        <p class="cart_text">Get started!</p>
                    </div>
                </button>
            </div>



        </div>

    </section>
</section>

    
@endsection

@section('scripts')

<script>
    const div = document.querySelector('.img_1');
    const img = document.querySelector('.img_1_shadow');

    // Function to sync image size with div's content box size
    function syncSize() {
        const rect = div.getBoundingClientRect();
        img.style.width = rect.width + 'px';
        img.style.height = rect.height + 'px';
    }

    // Set initial size
    syncSize();

    // Use ResizeObserver to track changes
    const observer = new ResizeObserver(() => {
        syncSize();
    });

    observer.observe(div);


    const div4 = document.querySelector('.img_4');
    const img4 = document.querySelector('.img_4_shadow');

    // Function to sync image size with div's content box size
    function syncSize4() {
        const rect = div4.getBoundingClientRect();
        img4.style.width = rect.width + 'px';
        img4.style.height = rect.height + 'px';
    }

    // Set initial size
    syncSize4();

    // Use ResizeObserver to track changes
    const observer4 = new ResizeObserver(() => {
        syncSize4();
    });

    observer4.observe(div4);
</script>

<script>
    function check_agree(form) {
        console.log(form.email.valid);
        if (form.fullname && form.email && form.message && form.terms.checked) {

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