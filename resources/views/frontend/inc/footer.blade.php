
<footer class="footer">
    <img src="{{ asset('frontend/BrandSparkz/assets/img/mobo_footer_top_right.png') }}" alt="" class="img-fluid desktop_none footer_top_right_img">
    <img src="{{ asset('frontend/BrandSparkz/assets/img/mobo_footer_bottom_left.png') }}" alt="" class="img-fluid desktop_none footer_bottom_left_img">
    <div class="container">
        <div class="footer_main_bg">
            <div class="footer_top">
                <div class="footer_top_left">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/footer_logo.svg') }}" alt="" class="img-fluid footer_logo">
                    <img src="{{ asset('frontend/BrandSparkz/assets/img/mastercard.png') }}" alt="" class="img-fluid">
                </div>
                <div class="footer_top_right">
                    <div class="footer_right_element">
                        <p class="footer_element_title">Support Links</p>
                        <div class="footer_link_div">
                            <button class="btn footer_links"  onclick="window.location.href='{{ route('faqs') }}'" >FAQs</button>
                            <button class="btn footer_links"  onclick="window.location.href='{{ route('termsandconditions') }}'">Terms & Conditions</button>
                            <button class="btn footer_links"  onclick="window.location.href='{{ route('privacypolicy') }}'">Privacy Policy</button>
                        </div>
                    </div>
                    <div class="footer_right_element">
                        <p class="footer_element_title">Our Services</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="footer_link_div">
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('seo') }}'">SEO</button>
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('orm') }}'">ORM</button>
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('em') }}'">Email&nbsp;Marketing</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="footer_link_div">
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('ppc') }}'">Pay-Per-Click</button>
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('wdd') }}'">UX/UI</button>
                                    <button class="btn footer_links"  onclick="window.location.href='{{ route('social') }}'">Social Media</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_right_element">
                        <p class="footer_element_title">Got Questions?</p>
                        <div class="footer_link_div">
                            <address class="footer_address">
                                info@Brandsparkz.co <br>
                                123 Main Street, <br>
                                New York, <br>
                                10030
                            </address>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <p class="footer_copyright">Copyright © {{ date('Y') }} Brand Sparkz.</p>
            </div>
        </div>
    </div>
</footer>