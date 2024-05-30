@extends('front.layouts.app')
@section('page_title','Home')

@section('content')
    <section class="banner_section">
        <div class="container">
            <div class="row">
                <div class="banner-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($home_banner as $list)
                            <div class="swiper-slide">
                                
                                <img src="{{ asset('storage/app/public/media/banner/' . $list->image) }}" class="d-lg-none d-block w-100"> 
                                <img src="{{ asset('storage/app/public/media/banner/' . $list->image1) }}" class="d-lg-block d-none w-100"> 
                                <!--<img src="{{ asset('storage/app/public/media/banner/' . $list->image) }}" class="banner_pic">-->
                            </div> 
                            
                        @endforeach
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <section class="category_section second_section">
        <img src="{{ asset('public/front/images/star.svg') }}" class="star_shape">
        <img src="{{ asset('public/front/images/shape2.svg') }}" class="shape2">
        <img src="{{ asset('public/front/images/airplane_shape.svg') }}" class="airplane_shape">
        <div class="container">
            <div class="main_heading text-center">
                <h4 class=" ">category</h4>
            </div>
            <div class="row"> 
                    <div class="category-swiper"> 
                            @foreach($home_cate as $list)  
                                <a href="{{url("/category/".$list->category_slug)}}" class="slider_box">
                                    <div class="category_shape purple"></div>
                                    <div class="category_text" style="background-color: <?= $list->bg_color;?>">
                                        <img src="{{asset('storage/app/public/media/category/'.$list->category_image)}}">
                                    </div>
                                    <p>{{$list->category_name}}</p>
                                </a> 
                            @endforeach
                            <!--<div class="swiper-slide" data-aos="fade-up" data-aos-delay="200">-->
                            <!--    <a href="product_category.html" class="slider_box">-->
                            <!--        <div class="category_shape ryan"></div>-->
                            <!--        <div class="category_text">-->
                            <!--            <img src="{{ asset('public/front/images/ride_ons.svg') }}">-->
                            <!--            <p>Ride Ons</p>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</div>-->
                            <!--<div class="swiper-slide" data-aos="fade-up" data-aos-delay="400">-->
                            <!--    <a href="product_category.html" class="slider_box">-->
                            <!--        <div class="category_shape pink"></div>-->
                            <!--        <div class="category_text">-->
                            <!--            <img src="{{ asset('public/front/images/indoor.svg') }}">-->
                            <!--            <p>Indoor</p>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</div>-->
                            <!--<div class="swiper-slide" data-aos="fade-up" data-aos-delay="600">-->
                            <!--    <a href="product_category.html" class="slider_box">-->
                            <!--        <div class="category_shape suffon"></div>-->
                            <!--        <div class="category_text">-->
                            <!--            <img src="{{ asset('public/front/images/scooters.svg') }}">-->
                            <!--            <p>Scooters</p>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</div>--> 
                    </div> 
            </div>
        </div>
        <img src="{{ asset('public/front/images/sun_shape.svg') }}" class="sun_shape">
        <img src="{{ asset('public/front/images/heart_shape.svg') }}" class="heart_shape">
    </section>
    <section class="category_section">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-3">
                <h4>Best Sellers</h4>
            </div>
            <div class="row"> 
                    <div class="swiper-wrapper row">
                        @if (count($home_featured_product)>0)
                            @foreach ($home_featured_product as $list)
                                <div class="col-lg-3 col-6 mb-4" data-aos="fade-up">
                                    <a href="{{ url('product/' . $list->alias) }}">
                                        <div class="product_box">
                                              <div class="discount_text">
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                 @php
                                                    $percentageDiscount = ($list->mrp - $list->price) / $list->mrp * 100;
                                                @endphp
                                                <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                              </div>
                                            <div class="part_img">
                                                <img src="{{ asset('storage/app/public/media/' . $list->image) }}"  class="featured_product"> 
                                            </div>
                                            <div class="part_text">
                                                <h5 class="product_name">{{ $list->title }}</h5>
                                                <div class="product_rating_row">
                                                    <div class="rating">
                                                           @for ($i = 0; $i < 5; $i++)
                                                                @if (floor($list->rating) - $i >= 1)
                                                                    {{--Full Start--}}
                                                                    <i class="fas fa-star text-warning"> </i>
                                                                @elseif ($list->rating - $i > 0)
                                                                    {{--Half Start--}}
                                                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                                                @else
                                                                    {{--Empty Start--}}
                                                                    <i class="far fa-star text-warning"> </i>
                                                                @endif
                                                            @endfor
                                                    </div>
                                                    <!--<span>@if($list->rating)({{ $list->rating }})@endif</span>-->
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex flex-column">
                                                        <p class="final_price">AED <span class="roboto">{{ number_format($list->price, 2) }}</span>
                                                        @if($list->mrp != $list->price)
                                                        <p class="deleted_price">AED <span class="roboto">
                                                                {{ number_format($list->mrp, 2) }}</span></p>
                                                         @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ url('product/' . $list->alias) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                                                <path d="M7.20717 18.259C5.98402 18.259 5.0044 19.2497 5.0044 20.4728C5.0044 21.696 5.98402 22.6866 7.20717 22.6866C8.43031 22.6866 9.421 21.696 9.421 20.4728C9.421 19.2497 8.43031 18.259 7.20717 18.259ZM0.565674 0.54834V2.76217H2.7795L6.75886 11.1581L5.26453 13.8701C5.09296 14.1911 4.99333 14.5508 4.99333 14.9382C4.99333 16.1614 5.98402 17.1521 7.20717 17.1521H20.4901V14.9382H7.6776C7.52264 14.9382 7.40088 14.8165 7.40088 14.6615C7.40088 14.6117 7.41194 14.5674 7.43408 14.5287L8.42477 12.7244H16.6713C17.5015 12.7244 18.2265 12.265 18.6084 11.5843L22.5656 4.4004C22.6542 4.24544 22.704 4.0628 22.704 3.86909C22.704 3.25475 22.2059 2.76217 21.5971 2.76217H5.23132L4.17975 0.54834H0.565674ZM18.2763 18.259C17.0532 18.259 16.0736 19.2497 16.0736 20.4728C16.0736 21.696 17.0532 22.6866 18.2763 22.6866C19.4995 22.6866 20.4901 21.696 20.4901 20.4728C20.4901 19.2497 19.4995 18.259 18.2763 18.259Z" fill="#B23632"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                </p>
                                                <div class="product_footer">
                                                    <!--<a href="javascript:void(0)" onclick="home_add_to_cart('{{ $list->id }}','{{ $list->size_id }}','{{ $list->color_id }}')" class="cart_box"><img src="{{ asset('public/front/images/bag.svg') }}"></a>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>No Data Found</p>
                        @endif
                    </div>
                <!--    <div class="swiper-button-prev1">-->
                <!--        <i class="fa-solid fa-arrow-left"></i>-->
                <!--    </div>-->
                <!--    <div class="swiper-button-next1">-->
                <!--        <i class="fa-solid fa-arrow-right"></i>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <section class="collection_section">
        <div class="container">
            <div class="row collection_row">
                <div class="main_collection_left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="233" height="148" viewBox="0 0 233 148" fill="none">
 
                        <path class="animated-path round-animation" d="M190.002 101.203L207.688 128.166L175.669 130.088L143.421 131.949L157.755 103.064L172.317 74.2397L190.002 101.203Z" fill="#F4D643"></path>
                        <path class="animated-path translate-animation" d="M32.3715 65.9288L49.3564 81.0265L27.8894 88.3394L6.18652 95.4165L10.6686 73.0059L15.3867 50.8312L32.3715 65.9288Z" fill="#714B9A"></path>
                        <path class="animated-path zoom-animation" d="M128.137 73.1238L79.3818 83.1486L89.4066 131.903L138.161 121.879L128.137 73.1238Z" fill="#F86738"></path>
                        <path class="animated-path opacity-animation" d="M104.594 76.2349L61.3447 56.2258L41.3356 99.4748L84.5846 119.484L104.594 76.2349Z" fill="#0992BA"></path>
                        <path class="animated-path" d="M62.9206 131.903C72.692 131.903 80.6132 123.982 80.6132 114.211C80.6132 104.439 72.692 96.5181 62.9206 96.5181C53.1493 96.5181 45.228 104.439 45.228 114.211C45.228 123.982 53.1493 131.903 62.9206 131.903Z" fill="#714B9A"></path>
                        <path class="animated-path" d="M21.0482 40.9106C32.2527 40.9106 41.3357 31.8276 41.3357 20.6231C41.3357 9.41861 32.2527 0.335571 21.0482 0.335571C9.84377 0.335571 0.760742 9.41861 0.760742 20.6231C0.760742 31.8276 9.84377 40.9106 21.0482 40.9106Z" fill="#F4D643"></path>
                        <path class="animated-path" d="M218.8 130.822C226.618 130.822 232.954 124.485 232.954 116.668C232.954 108.851 226.618 102.514 218.8 102.514C210.983 102.514 204.646 108.851 204.646 116.668C204.646 124.485 210.983 130.822 218.8 130.822Z" fill="#F86738"></path>
                        <path class="animated-path" d="M19.8687 130.822C30.4218 130.822 38.9767 122.267 38.9767 111.714C38.9767 101.161 30.4218 92.6058 19.8687 92.6058C9.31568 92.6058 0.760742 101.161 0.760742 111.714C0.760742 122.267 9.31568 130.822 19.8687 130.822Z" fill="#2F9306"></path>
                        <path class="animated-path" d="M49.3565 73.4649C63.9483 73.4649 75.7774 61.6358 75.7774 47.044C75.7774 32.4521 63.9483 20.623 49.3565 20.623C34.7646 20.623 22.9355 32.4521 22.9355 47.044C22.9355 61.6358 34.7646 73.4649 49.3565 73.4649Z" fill="#A2BF01"></path>
                    </svg>

                <!--<img src="{{ asset('public/front/images/collection_left.svg') }}" class="collection_left">-->
                </div>
                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-4 col-12" data-aos="fade-right">
                    <div class="collection_heading">
                        <h5>Every Day New Collection</h5>
                    </div>
                    <a href="{{ $settings[0]->shopnow_link }}" class="main-btn">Buy Now</a>
                </div>
                <div class="collection_right">
                    <img src="{{ asset('public/front/images/collection_kid.png') }}" class="collection_kid">
                    <img src="{{ asset('public/front/images/collection_right_bg_shape.svg') }}" class="collection_right_bg_shape"> 
              </div>
            </div>
        </div>
    </section>
    <section class="category_section arrivals_products">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-3">
                <h4>Top Offers Products</h4>
            </div>
            <div class="row">
                <div class="offer-product-swiper">
                    <div class="swiper-wrapper">
                        
                        @if (count($top_offers_product) > 0)
                            @foreach ($top_offers_product as $list)
                                <div class="swiper-slide" data-aos="fade-up">
                                    <a href="{{ url('product/' . $list->alias) }}">
                                        <div class="product_box">
                                            <div class="discount_text">
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                 @php
                                                    $percentageDiscount = ($list->mrp - $list->price) / $list->mrp * 100;
                                                @endphp
                                                <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                             </div>
                                            <div class="part_img">
                                                <img src="{{ asset('storage/app/public/media/' . $list->image) }}"
                                                    class="featured_product">
                                                {{-- <div class="discount_text">
                                        <img src="{{ asset('public/front/images/offer_bg.svg')}}" class="offer_bg">
                                        <span class="main_span">10%<span class="off_text">OFF</span></span>
                                    </div> --}}
                                            </div>
                                            <div class="part_text">
                                                <h5 class="product_name">{{ $list->title }}</h5>
                                                <div class="product_rating_row">
                                                    <div class="rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                                @if (floor($list->rating) - $i >= 1)
                                                                    {{--Full Start--}}
                                                                    <i class="fas fa-star text-warning"> </i>
                                                                @elseif ($list->rating - $i > 0)
                                                                    {{--Half Start--}}
                                                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                                                @else
                                                                    {{--Empty Start--}}
                                                                    <i class="far fa-star text-warning"> </i>
                                                                @endif
                                                            @endfor
                                                    </div>
                                                    <!--<span>@if($list->rating)({{ $list->rating }})@endif</span>-->
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex flex-column">
                                                         <p class="final_price">AED <span class="roboto">{{ number_format($list->price, 2) }}</span></p>
                                                             @if ($list->mrp != $list->price)
                                                            <p class="deleted_price">AED <span
                                                                    class="roboto">{{ number_format($list->mrp, 2) }}</span></p>
                                                            @endif 
                                                    </div>
                                                    <div>
                                                         <a href="{{ url('product/' . $list->alias) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                                                <path d="M7.20717 18.259C5.98402 18.259 5.0044 19.2497 5.0044 20.4728C5.0044 21.696 5.98402 22.6866 7.20717 22.6866C8.43031 22.6866 9.421 21.696 9.421 20.4728C9.421 19.2497 8.43031 18.259 7.20717 18.259ZM0.565674 0.54834V2.76217H2.7795L6.75886 11.1581L5.26453 13.8701C5.09296 14.1911 4.99333 14.5508 4.99333 14.9382C4.99333 16.1614 5.98402 17.1521 7.20717 17.1521H20.4901V14.9382H7.6776C7.52264 14.9382 7.40088 14.8165 7.40088 14.6615C7.40088 14.6117 7.41194 14.5674 7.43408 14.5287L8.42477 12.7244H16.6713C17.5015 12.7244 18.2265 12.265 18.6084 11.5843L22.5656 4.4004C22.6542 4.24544 22.704 4.0628 22.704 3.86909C22.704 3.25475 22.2059 2.76217 21.5971 2.76217H5.23132L4.17975 0.54834H0.565674ZM18.2763 18.259C17.0532 18.259 16.0736 19.2497 16.0736 20.4728C16.0736 21.696 17.0532 22.6866 18.2763 22.6866C19.4995 22.6866 20.4901 21.696 20.4901 20.4728C20.4901 19.2497 19.4995 18.259 18.2763 18.259Z" fill="#B23632"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product_footer">
                                                   
                                                    <!--<a href="javascript:void(0)"-->
                                                    <!--   onclick="home_add_to_cart('{{ $list->id }}','{{ $list->size_id }}','{{ $list->color_id }}')"-->
                                                    <!--    class="cart_box"><img-->
                                                    <!--        src="{{ asset('public/front/images/bag.svg') }}"></a>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>No Data Found</p>
                        @endif
                    </div>
                    <div class="swiper-button-prev2">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next2">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12 changable_review" data-aos="fade-right">
                    <img src="{{ asset('public/front/images/quote_left.svg') }}" class="left_quote">
                    <img src="{{ asset('public/front/images/testimonial_review_.svg') }}" class="testimonial_review_img">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-12">
                            <div class="testimonial-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($testimonials as $list)
                                        <div class="swiper-slide">
                                            <div class="user_info">
                                                <!--<div class="user_pic">-->
                                                <!--    <img src="{{ asset('public/storage/media/testimonial/' . $list->image) }}"-->
                                                <!--        class="clint_pic">-->
                                                <!--</div>-->
                                                <div class="user_name">
                                                    <p>{{ $list->title }}</p>
                                                    <div class="reviews">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if (floor($list->rate) - $i >= 1)
                                                                {{--Full Start--}}
                                                                <i class="fas fa-star text-warning"> </i>
                                                            @elseif ($list->rate - $i > 0)
                                                                {{--Half Start--}}
                                                                <i class="fas fa-star-half-alt text-warning"> </i>
                                                            @else
                                                                {{--Empty Start--}}
                                                                <i class="far fa-star text-warning"> </i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user_review">
                                                <p>{{ $list->desc }} </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="swiper-button-prev4">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </div>
                                <div class="swiper-button-next4">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('public/front/images/quote_right.svg') }}" class="right_quote">
                </div>
                <div class="col-lg-5 col-12 testimonial_right" data-aos="fade-left">
                    <img src="{{ asset('public/front/images/testimonial_right_.svg') }}" class="testimonial_right_img">
                    <div class="right_testimonial_section">
                        <div class="registration_box">
                            <div class="testi_detail">
                                <div class="comp_box">
                                    <img src="{{ asset('public/front/images/logo.png') }}"
                                        class="comp_registration" style="width:60px">
                                        <!--<img src="{{ asset('public/front/images/comp_registration.svg') }}"-->
                                        <!--class="comp_registration">-->
                                </div>
                                <div class="right_heading">
                                    <h5>Brand<br />Registry</h5>
                                </div>
                            </div>
                            <div class="testimonial_text">
                                <p>{{ $settings[0]->brand_registry }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="category_section arrivals_products second_arrival mt-5">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-2">
                <h4>New Arrival Products</h4>
            </div>
            <div class="row">
                <div class="arrivals-product-swiper">
                    <div class="swiper-wrapper">
                        @if (count($new_arrivals_product) > 0)
                            @foreach ($new_arrivals_product as $list)
                                <div class="swiper-slide" data-aos="fade-up">
                                    <a href="{{ url('product/' . $list->alias) }}">
                                        <div class="product_box">
                                            <div class="discount_text">
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                 @php
                                                    $percentageDiscount = ($list->mrp - $list->price) / $list->mrp * 100;
                                                @endphp
                                                <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                            </div>
                                            <div class="part_img">
                                                <img src="{{ asset('storage/app/public/media/' . $list->image) }}"
                                                    class="featured_product">
                                            </div>
                                            <div class="part_text">
                                                <h5 class="product_name">{{ $list->title }}</h5>
                                                <div class="product_rating_row">
                                                    <div class="rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if (floor($list->rating) - $i >= 1)
                                                                {{--Full Start--}}
                                                                <i class="fas fa-star text-warning"> </i>
                                                            @elseif ($list->rating - $i > 0)
                                                                {{--Half Start--}}
                                                                <i class="fas fa-star-half-alt text-warning"> </i>
                                                            @else
                                                                {{--Empty Start--}}
                                                                <i class="far fa-star text-warning"> </i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <!--<span>@if($list->rating)({{ $list->rating }})@endif</span>-->
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex flex-column">
                                                        <p class="final_price">AED <span class="roboto">{{ number_format($list->price, 2) }}</span></p>
                                                         @if ($list->mrp != $list->price)
                                                        <p class="deleted_price">AED <span class="roboto">{{ number_format($list->mrp, 2) }}</span></p>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ url('product/' . $list->alias) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                                                <path d="M7.20717 18.259C5.98402 18.259 5.0044 19.2497 5.0044 20.4728C5.0044 21.696 5.98402 22.6866 7.20717 22.6866C8.43031 22.6866 9.421 21.696 9.421 20.4728C9.421 19.2497 8.43031 18.259 7.20717 18.259ZM0.565674 0.54834V2.76217H2.7795L6.75886 11.1581L5.26453 13.8701C5.09296 14.1911 4.99333 14.5508 4.99333 14.9382C4.99333 16.1614 5.98402 17.1521 7.20717 17.1521H20.4901V14.9382H7.6776C7.52264 14.9382 7.40088 14.8165 7.40088 14.6615C7.40088 14.6117 7.41194 14.5674 7.43408 14.5287L8.42477 12.7244H16.6713C17.5015 12.7244 18.2265 12.265 18.6084 11.5843L22.5656 4.4004C22.6542 4.24544 22.704 4.0628 22.704 3.86909C22.704 3.25475 22.2059 2.76217 21.5971 2.76217H5.23132L4.17975 0.54834H0.565674ZM18.2763 18.259C17.0532 18.259 16.0736 19.2497 16.0736 20.4728C16.0736 21.696 17.0532 22.6866 18.2763 22.6866C19.4995 22.6866 20.4901 21.696 20.4901 20.4728C20.4901 19.2497 19.4995 18.259 18.2763 18.259Z" fill="#B23632"></path>
                                                            </svg>
                                                        </a>    
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="align">No Data Found</p>
                        @endif

                    </div>
                    <div class="swiper-button-prev3">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next3">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="partners_section">
        <div class="container">
            <div class="main_heading text-center">
                <h4>Brands We Love</h4>
            </div>
            <div class="row position-relative justify-content-center">
                <div class="col-10">
                    <div class="partners-swiper">
                        <div class="swiper-wrapper">
                            
                            @foreach($partners as $partner)
                            <div class="swiper-slide" data-aos="fade-up">
                                <div class="partner_pic">
                                    <img src="{{ asset('storage/app/public/media/partners/' . $partner->image) }}">
                                    <img src="{{ asset('public/front/images/partner_shape.svg') }}"
                                        class="partner_shape">
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                        <div class="swiper-button-prev5">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="swiper-button-next5">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
        <img src="{{ asset('public/front/images/blog_bg.svg') }}" class="blog_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="blog_heading">
                        <h4>Recent Blogs</h4>
                    </div>
                    <div class="blog_kid_part">
                        <img src="{{ asset('public/front/images/blog_kid.png') }}" class="blog_kid">
                        <img src="{{ asset('public/front/images/kid_shadow.svg') }}" class="kid_shadow">
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="blog-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($blog as $list)
                                <div class="swiper-slide">
                                    <div class="blog_box">
                                        <div class="blog_img">
                                            <img src="{{ asset('storage/app/public/media/blog/' . $list->image) }}"
                                                class="blog_img">
                                        </div>
                                        <div class="blog_text">
                                            <div class="date_row">
                                                <div class="">
                                                    <div class="calender_icon">
                                                        <!--<img src="{{ asset('public/front/images/calender.svg') }}"-->
                                                        <!--    class="calender_img">-->
                                                    </div>
                                                    <span>{{ date('d M,Y',strtotime($list->created_at)) }}</span>
                                                </div>
                                                <div class="">
                                                    <div class="calender_icon">
                                                        <!--<img src="{{ asset('public/front/images/blog_user.svg') }}"-->
                                                        <!--    class="blog_user">-->
                                                    </div>
                                                    <!--<span>Names</span>-->
                                                </div>
                                            </div>
                                            <div class="blog_content">
                                                <h5>{{ $list->title }}</h5>
                                                <p>{{ $list->desc }}</p>
                                            </div>
                                            <div class="read_btn">
                                                <a href="{{ url('blog/'.$list->alias) }}">Read More <i class="fa-solid fa-arrow-right fa-fade"
                                                        style="color: #b23632;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-prev6">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="swiper-button-next6">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="qty" value="1" />
    <form id="frmAddToCart">
        <!--<input type="hidden" id="size_id" name="size_id" />-->
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="pqty" name="pqty" />
        <input type="hidden" id="product_id" name="product_id" />
        @csrf
    </form>
    <script>
        // function home_add_to_cart(id, size_str_id, color_str_id) {

        //     jQuery('#color_id').val(color_str_id);
        //     jQuery('#size_id').val(size_str_id);
        //     add_to_cart(id, size_str_id, color_str_id);
        // }
        
        function home_add_to_cart(id, color_str_id) {

            jQuery('#color_id').val(color_str_id);
            add_to_cart(id, color_str_id);
        }

        // function add_to_cart(id, size_str_id, color_str_id) {

        //     jQuery('#add_to_cart_msg').html('');
        //     var color_id = jQuery('#color_id').val();
        //     var size_id = jQuery('#size_id').val();

        //     if (size_str_id == 0) {
        //         size_id = 'no';
        //     }
        //     if (color_str_id == 0) {
        //         color_id = 'no';
        //     }
        //     if (size_id == '' && size_id != 'no') {
        //         jQuery('#add_to_cart_msg').html(
        //             '<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select size</div>'
        //         );
        //     } else if (color_id == '' && color_id != 'no') {
        //         jQuery('#add_to_cart_msg').html(
        //             '<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select color</div>'
        //         );
        //     } else {
        //         jQuery('#product_id').val(id);
        //         jQuery('#pqty').val(jQuery('#qty').val());
        //         jQuery.ajax({
        //             url: "{{ url('add_to_cart') }}",
        //             method: 'POST',
        //             data: jQuery('#frmAddToCart').serialize(),
        //             success: function(result) {
        //                 var totalPrice = 0;

        //                 if (result.msg == 'not_avaliable') {
        //                     alert(result.data);
        //                 } else {
        //                     alert("Product " + result.msg);
        //                     if (result.totalItem == 0) {
        //                         jQuery('.aa-cart-notify').html('0');
        //                         jQuery('.aa-cartbox-summary').remove();
        //                     } else {

        //                         jQuery('.aa-cart-notify').html(result.totalItem);
        //                         var html = '<ul>';
        //                         jQuery.each(result.data, function(arrKey, arrVal) {
        //                             totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) *
        //                                 parseInt(arrVal.price));
        //                             html += '<li><a class="aa-cartbox-img" href="#"><img src="' +
        //                                 PRODUCT_IMAGE + '/' + arrVal.image +
        //                                 '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">' +
        //                                 arrVal.name + '</a></h4><p> ' + arrVal.qty + ' * Rs  ' + arrVal
        //                                 .price + '</p></div></li>';
        //                         });

        //                     }
        //                     html +=
        //                         '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">Rs ' +
        //                         totalPrice + '</span></li>';
        //                     html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="cart">Cart</a>';
        //                     console.log(html);
        //                     jQuery('.aa-cartbox-summary').html(html);
        //                 }
        //             }
        //         });
        //     }
        // }
        
        function add_to_cart(id, color_str_id) {

            jQuery('#add_to_cart_msg').html('');
            var color_id = jQuery('#color_id').val();
           
            if (color_str_id == 0) {
                color_id = 'no';
            }
           if (color_id == '' && color_id != 'no') {
                jQuery('#add_to_cart_msg').html(
                    '<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select color</div>'
                );
            } else {
                jQuery('#product_id').val(id);
                jQuery('#pqty').val(jQuery('#qty').val());
                jQuery.ajax({
                    url: "{{ url('add_to_cart') }}",
                    method: 'POST',
                    data: jQuery('#frmAddToCart').serialize(),
                    success: function(result) {
                        var totalPrice = 0;

                        if (result.msg == 'not_avaliable') {
                            Command: toastr["error"](result.data);
                        } else {
                            Command: toastr["success"]("Product " + result.msg);
                            if (result.totalItem == 0) {
                                jQuery('.aa-cart-notify').html('0');
                                jQuery('.aa-cartbox-summary').remove();
                            } else {

                                jQuery('.aa-cart-notify').html(result.totalItem);
                                var html = '<ul>';
                                jQuery.each(result.data, function(arrKey, arrVal) {
                                    totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) *
                                        parseInt(arrVal.price));
                                    html += '<li><a class="aa-cartbox-img" href="#"><img src="' +
                                        PRODUCT_IMAGE + '/' + arrVal.image +
                                        '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">' +
                                        arrVal.name + '</a></h4><p> ' + arrVal.qty + ' * AED  ' + arrVal
                                        .price + '</p></div></li>';
                                });

                            }
                            html +=
                                '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">AED ' +
                                totalPrice + '</span></li>';
                            html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="cart">Cart</a>';
                            console.log(html);
                            jQuery('.aa-cartbox-summary').html(html);
                        }
                    }
                });
            }
        }
        
        
function funSearch(){
  var search_str=jQuery('#search_str').val();
  if(search_str!='' && search_str.length>3){
    window.location.href='../myts/search/'+search_str;
  }
}
  
    </script>

@endsection
