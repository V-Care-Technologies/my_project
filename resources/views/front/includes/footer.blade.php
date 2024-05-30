<?php $settings=App\Models\SiteSettings::where('id','=','1')
                ->get();   ?>
   
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="footer_part">
                    <div class="footer_heading">
                        <h4>Get in Touch</h4>
                    </div>
                    <div class="footer_box first_box">
                        <!--<p>Any Questions ? Please Call Us On {{ $settings[0]->mobile_no }}</p>-->
                        <p>Any Questions ? Please Call Us On  <br/>{{ $settings[0]->mobile_no }}</p>
                    </div>
                    <div class="footer_heading">
                        <h4>Newsletter</h4>
                    </div>
                    <form id="frmSubscribe" type="post" class="validate" enctype="multipart/form-data" accept-charset="utf-8"> 
                         @csrf
                        <div class="subscribe_form">
                            <input type="email" name="email" class="form-control" placeholder="Your email here..." required data-validate="required" data-message-required="Email required">
                            <button type="submit" class="bordered_btn col-auto">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="footer_part">
                    <div class="footer_heading">
                        <h4>Category</h4>
                    </div>
                    <ul>
                        <?php $footCat=App\Models\Category::where('status','=','0')
                                ->where('is_home','=','1')
                                ->where('parent_category_id','=','0')
                                ->get();   ?>
                        @foreach($footCat as $list)
                        <li><a href="{{url("/category/".$list->category_slug)}}" class="footer_menu">{{$list->category_name}}</a></li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="footer_part">
                    <div class="footer_heading">
                        <h4>Links</h4>
                    </div>
                     <ul class="">
                        <li><a href="{{route('front.about')}}" class="footer_menu">About
                                Us</a></li>
                        <!--<li><a href="#" class="footer_menu"-->
                        <!--        data-aos-delay="100">FAQ</a></li>-->
                        <li><a href="{{route('front.terms-conditions')}}" class="footer_menu">Terms and Conditions</a></li>
                        <li><a href="{{route('front.terms-of-sale')}}" class="footer_menu">Terms of Sale</a></li>
                        <!--<li><a href="#" class="footer_menu"-->
                        <!--        data-aos-delay="300">Blog</a></li>-->
                        <li><a href="{{route('front.privacy-policy')}}" class="footer_menu">Privacy Policy </a>
                        <li><a href="{{route('front.security-policy')}}" class="footer_menu">Security Policy </a>
                        <li><a href="{{route('front.return-policy')}}" class="footer_menu">Returns Policy </a>
                        </li>
                        <li><a href="{{route('front.contact-us')}}" class="footer_menu">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_part">
                    <div class="footer_heading mt-lg-5">
                        <h4 class="mb-4">Stay Connected</h4>
                    </div>
                    <div class="social">
                        <a href="{{ $settings[0]->facebook_link }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="{{ $settings[0]->insta_link }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="{{ $settings[0]->twitter_link }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="{{ $settings[0]->youtube_link }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div> 
         </div>
    </div>
</footer>
<section class="copyright_section">
    <div class="container">
        <div class="copyright_row">
            <div class="copyright_text">
                <span>Copyrights 2023 © {{ $settings[0]->title }} . All Rights Reserved | Developed by <a
                        href="https://www.vcaretechnologies.net/">V Care Technologies</a></span>
            </div>
            <div class="payment_option">
                <a href="#"><img src="{{ asset('public/front/images/paypal.svg') }}" class="payment_icon"></a>
                <a href="#"><img src="{{ asset('public/front/images/visa.svg') }}" class="payment_icon"></a>
                <a href="#"><img src="{{ asset('public/front/images/mastercard.svg') }}"
                        class="payment_icon"></a>
                <a href="#"><img src="{{ asset('public/front/images/american_express.svg') }}"
                        class="payment_icon"></a>
                <a href="#"><img src="{{ asset('public/front/images/discover.svg') }}"
                        class="payment_icon"></a>
            </div>
        </div>
    </div>
</section>
