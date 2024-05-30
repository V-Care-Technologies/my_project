<?php $settings=App\Models\SiteSettings::where('id','=','1')
                ->get();   ?>
     
<div class="top_header">
    <div class="container">
        <div class="top_header_text">
            <div class="email d-flex align-items-center">
                <a href="mailto:info@mytsstore.com"><i class="fa-regular fa-envelope ml-3"></i> info@mytsstore.com</a>
            </div>
            <div class="inner_top_header_text">
                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                    <path
                        d="M15.3857 0.272243L15.9115 7.2018C16.2342 11.4408 19.6029 14.8094 23.8383 15.1285L30.7678 15.6543L23.8383 16.1874C19.5993 16.5101 16.2306 19.8788 15.9115 24.1141L15.3857 31.0437L14.8599 24.1141C14.5372 19.8752 11.1685 16.5065 6.93318 16.1874L0 15.658L6.92956 15.1322C11.1685 14.8094 14.5372 11.4408 14.8563 7.20542L15.3857 0.272243Z"
                        fill="white"></path>
                </svg>  
                <p>{{ $settings[0]->top_line }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                    <path
                        d="M15.3857 0.272243L15.9115 7.2018C16.2342 11.4408 19.6029 14.8094 23.8383 15.1285L30.7678 15.6543L23.8383 16.1874C19.5993 16.5101 16.2306 19.8788 15.9115 24.1141L15.3857 31.0437L14.8599 24.1141C14.5372 19.8752 11.1685 16.5065 6.93318 16.1874L0 15.658L6.92956 15.1322C11.1685 14.8094 14.5372 11.4408 14.8563 7.20542L15.3857 0.272243Z"
                        fill="white"></path>
                </svg>
            </div>
            <div id="google_translate_element"></div>
        </div>
    </div>
</div>

 
<div class="second_header">
    <div class="container header_border">
        <div class="row">
            <div class="col-lg-2 d-lg-inline d-none">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('public/front/images/'.$settings[0]->logo)}}">
                    </a>
                </div>
            </div>
            <div class="col-lg-10 position-relative"> 
                <div class="site-mobile-menu site-navbar-target">
                    <div class="site-mobile-menu-header">
                        <a href="javascript:void(0)" class="site-mobile-menu-close mt-3">
                            <span class="icon-close2 js-menu-toggle"><i class="fa-solid fa-xmark"></i></span>
                        </a>
                    </div>
                    <div class="site-mobile-menu-body">
                        
                        <div class="bottom_sidebar">
                            <div class="menus"> 
                                <a href="{{ url('/cart') }}">Cart</a>
                                <a href="{{ route('front.my_account') }}">my Account</a>
                                <a href="{{ url('/logout') }}">logout</a>
                            </div>
                            <div class="sidebar_social_media">
                                <h4 class="mb-3 follow_heading">Follow Us On:</h4>
                                <div class="social">
                                    <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook-f "></i></a>
                                    <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                    <a href="https://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter "></i></a>
                                    <a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube "></i></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                     
                </div>
                <div class="second_header d-lg-block d-none">
                    <div class="container">
                        <div class="right_header d-lg-block d-none ">
                            <div class="d-flex justify-content-between row">
                                <div class="col-lg-8 d-flex   search_form">
                                    <form action="#" class="d-flex search_form col-10">
                                        <input type="search" id="search_str" name="search" value="{{@$search}}" placeholder="Search........." cclass="form-control me-2 input_search" aria-label="Search" onkeypress="return enterPressed(event)">
                                        <button class="light_btn" onclick="funSearch1()" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                    <!--<form class="d-flex search_form col-10">-->
                                    <!--    <input class="form-control me-2 input_search" type="search" id="search_str"-->
                                    <!--        placeholder="Search..................." aria-label="Search">-->
                                    <!--    <button class="light_btn" type="button" onclick="funSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>-->
                                    <!--</form>-->
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <div class="main_top_header">
                                    @php
                                        $getAddToWishListTotalItem = getAddToWishListTotalItem();
                                        
                                        $totalWishListItem = 0;
                                        
                                        if ($getAddToWishListTotalItem !== null) {
                                            $totalWishListItem = count($getAddToWishListTotalItem);
                                            $totalPrice = 0;
                                        }
                                        
                                    @endphp
                                    <div class="right_header">
                                        @if (session()->has('FRONT_USER_LOGIN') != null)
                                            <!--<div class="wishlist">-->
                                            <!--    <a href="{{ url('wishlist') }}">-->
                                            <!--        <i class="fa-regular fa-heart"></i><span-->
                                            <!--            class="badge aa-cart-notify2">{{ $totalWishListItem }}</span>-->
                                            <!--    </a>-->
                                            <!--</div>-->
                                        @endif
                                        @php
                                            $getAddToCartTotalItem = getAddToCartTotalItem();
                                            $totalCartItem = count($getAddToCartTotalItem);
                                            $totalPrice = 0;
                                            
                                        @endphp
                                        <a href="https://api.whatsapp.com/send?phone=<?= @$settings[0]->mobile_no;?>&amp;text=Hi%20there,%20Interested%20in%20your%20services,%20Give%20me%20further%20information" target="_blank" class="cart">
                                            <img src="{{ asset('public/front/images/whatsapp.png') }}">
                                        </a>
                                        <div class="cart">
                                            <a href="{{ url('/cart') }}" class="d-flex"><i class="fa-solid fa-cart-shopping"></i><span
                                                    class="badge aa-cart-notify">{{ $totalCartItem }}</span></a>
                                        </div>
                                        
                                        @if (session()->has('FRONT_USER_LOGIN') != null)
                                            <div class="dropdown">
                                                <a href="javascript:void()" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <img src="{{ asset('public/front/images/login_icon.svg') }}"><span>My Profile</span><i
                                                        class="fa-solid fa-sort-down"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item @yield('account_active')" href="{{ route('front.my_account') }}"><img
                                                                src="{{ asset('public/front/images/my_account.svg') }}">My Account</a></li>
                                                    <li><a class="dropdown-item @yield('order_active')" href="{{ url('/order') }}"><img
                                                                src="{{ asset('public/front/images/my_order.svg') }}">My Order</a></li>
                                                    <li><a class="dropdown-item @yield('cart_active')" href="{{ url('/cart') }}"><img
                                                                src="{{ asset('public/front/images/my_cart.svg') }}">My Cart</a></li>
                                                    <!--<li><a class="dropdown-item @yield('wishlist_active')" href="{{ url('wishlist') }}"><img-->
                                                    <!--            src="{{ asset('public/front/images/my_wishlist.svg') }}">My wishlist</a>-->
                                                    <!--</li>-->
                                                    <li><a class="dropdown-item" href="{{ url('/logout') }}"><img
                                                                src="{{ asset('public/front/images/logout.svg') }}">logout</a></li>
                                                </ul>
                                            </div>
                                        @else
                                        
                                        <div class="cart">
                                            <a href="{{ route('front.loginRegister') }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="25" viewBox="0 0 21 25" fill="none">
                                                <path d="M15.8543 6.62639C15.8543 9.76504 13.31 12.3094 10.1713 12.3094C7.03266 12.3094 4.48828 9.76504 4.48828 6.62639C4.48828 3.48774 7.03266 0.943359 10.1713 0.943359C13.31 0.943359 15.8543 3.48774 15.8543 6.62639Z" fill="#952926"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1717 14.7714C15.7894 14.7714 20.3434 19.3254 20.3434 24.9431H0C0 19.3254 4.55404 14.7714 10.1717 14.7714Z" fill="#952926"/>
                                                </svg>
                                            </a>
                                        </div>
                                            <!--<a href="{{ route('front.loginRegister') }}" class="main-btn">-->
                                            <!--    login <img src="{{ asset('public/front/images/login_icon.svg') }}" class="ps-3">-->
                                            <!--</a>-->
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-between">
                             <a href="{{ url('/') }}" class="scroll_logo">
                                <img src="{{ asset('public/front/images/'.$settings[0]->logo)}}">
                            </a>
                            <div class="menu_icon">
                                <div class="d-none d-lg-block">
                                    <nav class="site-navigation position-relative text-right" role="navigation">
                                        {!! getTopNavCat() !!}
                                    </nav>
                                </div>
                            </div>
                            <div class="scroll_search">
                                <form action="#" class="d-flex search_form col-10 w-100">
                                    <input type="search" id="search_str" name="search" value="{{@$search}}" placeholder="Search........." class="form-control me-2 input_search" aria-label="Search" onkeypress="return enterPressed(event)">
                                    <button class="light_btn" onclick="funSearch1()" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div> 
                            <!--<div class="">-->
                            <!--    <div class="languge_change">  -->
                            <!--        <select class="currancy_select">-->
                            <!--          <option>AED</option> -->
                            <!--        </select>-->
                            <!--        <i class="fa-solid fa-angle-down"></i>-->
                            <!--      </div>-->
                            <!--</div>-->
                            <div class="right_header d-lg-none d-block second_right_header">
                                <div class="mobile_row">
                                    <div class="div mobile_logo">
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('public/front/images/'.$settings[0]->logo)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="close_icon">
                                        @if (session()->has('FRONT_USER_LOGIN') != null)
                                            <!--<div class="wishlist">-->
                                            <!--    <a href="{{ url('wishlist') }}">-->
                                            <!--        <i class="fa-regular fa-heart"></i><span-->
                                            <!--            class="badge aa-cart-notify2">{{ $totalWishListItem }}</span>-->
                                            <!--    </a>-->
                                            <!--</div>-->
                                        @endif
                                        
                                        <a href="javascript:void(0)" class="mobile_search_icon show-search-box"  > 
                                             <img  src="{{ asset('public/front/images/search_icon_menu.svg') }}"> 
                                             
                                        </a>
                                        <a href="{{ url('/cart') }}">
                                            <div class="cart">
                                                <a href="{{ url('/cart') }}"><img
                                                                src="{{ asset('public/front/images/cart_icon_menu.svg') }}"><span
                                                        class="badge">{{ $totalCartItem }}</span></a>
                                            </div>
                                        </a>
                                        @if (session()->has('FRONT_USER_LOGIN') != null)
                                            <div class="dropdown">
                                                <a href="javascript:void()" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <img src="{{ asset('public/front/images/login_icon.svg') }}">
                                                    <!--<span>My-->
                                                    <!--    Profile</span><i class="fa-solid fa-sort-down"></i>-->
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item @yield('account_active')" href="{{ route('front.my_account') }}"><img
                                                                src="{{ asset('public/front/images/my_account.svg') }}">My Account</a>
                                                    </li>
                                                    <li><a class="dropdown-item @yield('order_active')" href="{{ url('/order') }}"><img
                                                                src="{{ asset('public/front/images/my_order.svg') }}">My Order</a>
                                                    </li>
                                                    <li><a class="dropdown-item @yield('cart_active')" href="{{ url('/cart') }}"><img
                                                                src="{{ asset('public/front/images/my_cart.svg') }}">My Cart</a></li>
                                                    <!--<li><a class="dropdown-item @yield('wishlist_active')" href="{{ url('wishlist') }}"><img-->
                                                    <!--            src="{{ asset('public/front/images/my_wishlist.svg') }}">My-->
                                                    <!--        wishlist</a>-->
                                                    <!--</li>-->
                                                    <li><a class="dropdown-item" href="{{ url('/logout') }}"><img
                                                                src="{{ asset('public/front/images/logout.svg') }}">logout</a></li>
                                                </ul>
                                            </div>
                                        @else
                                            <a href="{{ route('front.loginRegister') }}"><img
                                                    src="{{ asset('public/front/images/login_icon.svg') }}"></a>
                                        @endif
                                        <div class="d-inline-block d-xl-none ml-md-0 py-3 text-end"
                                            style="position: relative; top: 3px;">
                                            <a href="javascript:void(0)" class="site-menu-toggle js-menu-toggle float-right"> <i
                                                    class="fa-solid fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </header> 
            </div>
        </div>
    </div> 
        <form action="{{ route('front.search') }}" class="d-flex search_form col-12 d-lg-none d-none mt-3">
            <input type="search" id="search_str" name="search" value="{{@$search}}" placeholder="Search........." cclass="form-control me-2 input_search hidden-search-box search_input" aria-label="Search">
            <button class="light_btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form> 
</div>

<script>
function funSearch1(){
  var search_str=jQuery('#search_str').val();
 
  if(search_str!='' && search_str.length>3){
    window.location.href='/myts/search/'+search_str;
  }
}
</script>
<script>
    function enterPressed(event) {
        var code = event.keyCode || event.which;
        if (code === 13) { // 13 is the key code for Enter
            event.preventDefault(); // Prevent the default form submission
            funSearch1(); // Call your search function
            return false;
        }
        return true;
    }
</script>

