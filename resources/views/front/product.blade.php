@extends('front.layouts.app')
@section('page_title','Product')

@section('content')
    <section class="breadcrub_section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">

                        {{ $product[0]->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="product_detail_section">
        <div class="container">
            <div class="row">
                <!--<div  class="row">-->
                    
                <!--</div>-->
                <div class="col-lg-6 col-12 order_1" id="colorChangeDiv">
                    <div class="row">
                        <div class="col-lg-2 col-12 order_1">
                            <div class="image_box">
                                <div class="changable_image_row nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <div class="mini_img_box nav-item" role="presentation">
                                        <img src="{{ asset('storage/app/public/media/' . $product[0]->image) }}" class="active" id="green_first-tab" data-bs-toggle="pill" data-bs-target="#green_first" type="button" role="tab" aria-controls="green_first" aria-selected="true" onclick="changeImage('green_first')"/>
                                    </div>
                                    @if($product[0]->multiple_images !== null)
                                        @php
                                            $i=1;
                                            $multiple_imagesArray = json_decode($product[0]->multiple_images);
                                        @endphp
                                
                                        @if(is_array($multiple_imagesArray))
                                            @foreach($multiple_imagesArray as $image1)
                                            <div class="mini_img_box nav-item" role="presentation">
                                            
                                                <img src="{{ asset('storage/app/public/media/'.$image1) }}" class="" id="{{ $i }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $i }}" type="button" role="tab" aria-controls="{{ $i }}" aria-selected="true" onclick="changeImage('{{ $i }}')"/>
                                            </div>
                                            @php $i++; @endphp
                                             @endforeach
                                        @endif
                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-12 order_0">
                            <div class="green_section">
                                <div class="image_box">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="inner_box_image">
                                              <!--<div class="discount_text">-->
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                              <!--  <div class="main_span">25%<span class="off_text">OFF</span></div>                            -->
                                              <!--</div>-->
                                            <img src="{{ asset('storage/app/public/media/' . $product[0]->image) }}" class="tab-pane fade show active image-tab" id="green_first" role="tabpanel" />
                                       
                                            @if($product[0]->multiple_images !== null)
                                                @php
                                                    $i=1;
                                                    $multiple_imagesArray = json_decode($product[0]->multiple_images);
                                                @endphp
                                        
                                                @if(is_array($multiple_imagesArray))
                                                    @foreach($multiple_imagesArray as $image1)
                                                   
                                                            <img src="{{ asset('storage/app/public/media/'.$image1) }}" class="tab-pane fade image-tab" id="{{ $i }}" role="tabpanel"/>
                                                   
                                                    @php $i++; @endphp
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 order_2">
                    <div class="product_detail_box">
                        <div class="discount_badge">
                            {{-- <p>5% off</p> --}}
                        </div>
                        <div class="product_name">
                            <h2>{{ $product[0]->title }}</h2>
                            <div class="product_rating_row">
                                <div class="d-flex">
                                    <div class="rating">
                                         @for ($i = 0; $i < 5; $i++)
                                            @if (floor(@$product[0]->rating) - $i >= 1)
                                                {{--Full Start--}}
                                                <i class="fas fa-star text-warning"> </i>
                                            @elseif (@$product[0]->rating - $i > 0)
                                                {{--Half Start--}}
                                                <i class="fas fa-star-half-alt text-warning"> </i>
                                            @else
                                                {{--Empty Start--}}
                                                <i class="far fa-star text-warning"> </i>
                                            @endif
                                        @endfor 
                                    </div>
                                    <!--<span>({{$product[0]->rating}})</span>-->
                                </div>
                                <div>
                                    <p class="free_delivery">Free Delivery</p>
                                </div>
                            </div>
                            <h3 class="sixty_kg_price">
                                AED <span id="price_display">{{ number_format($product_attr[$product[0]->id][0]->price, 2) }}</span>
                                
                                                <span class="vat_text">VAT Inclusive</span><br/>
                                @if($product_attr[$product[0]->id][0]->price != $product_attr[$product[0]->id][0]->mrp)
                                <span class="sixty_kg_price disable_price">AED
                                    <span id="mrp">{{ number_format($product_attr[$product[0]->id][0]->mrp, 2) }}</span></span>
                                @endif
                            </h2> 
                        </div>
                        <div class="product_notice_row">
                            <p>or 4 payments of AED 149.75 . No interest, no fees.<span  data-bs-toggle="modal" data-bs-target="#exampleModal">Learn more</span></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 50 20" fill="none">
                              <g clip-path="url(#clip0_922_4401)">
                                <path d="M46.1262 0H3.87379C1.73435 0 0 1.74173 0 3.89027V16.1098C0 18.2583 1.73435 20 3.87379 20H46.1262C48.2657 20 50 18.2583 50 16.1098V3.89027C50 1.74173 48.2657 0 46.1262 0Z" fill="url(#paint0_linear_922_4401)"/>
                                <path d="M43.4556 6.34473L40.7697 16.5987L40.7637 16.6218H42.8553L45.5508 6.34473H43.4556Z" fill="#292929"/>
                                <path d="M10.2221 12.1788C9.90827 12.3326 9.56317 12.4117 9.21372 12.4099C8.46007 12.4099 8.03252 12.2898 7.98632 11.6804V11.6397C7.98632 11.6151 7.98327 11.5894 7.98327 11.5653V9.79733L7.98632 9.58828V8.34028H7.98327V7.80368L7.98632 7.59318V6.38733L6.11827 6.63453C7.38342 6.38938 8.10842 5.38903 8.10842 4.39323V3.78027H6.00727V6.65163L5.88867 6.68478V12.0009C5.95802 13.4946 6.94377 14.3824 8.55707 14.3824C9.13517 14.381 9.70707 14.2626 10.2382 14.0342L10.2487 14.0297V12.1647L10.2221 12.1788Z" fill="#292929"/>
                                <path d="M10.5536 5.95801L4.66211 6.86636V8.36056L10.5536 7.45221V5.95801Z" fill="#292929"/>
                                <path d="M10.5536 8.14404L4.66211 9.05244V10.4793L10.5536 9.57144V8.14404Z" fill="#292929"/>
                                <path d="M17.1652 8.83123C17.0818 7.17323 16.0447 6.18848 14.3546 6.18848C13.3834 6.18848 12.5825 6.56378 12.0389 7.27418C11.4953 7.98463 11.2109 9.02313 11.2109 10.2852C11.2109 11.5473 11.4973 12.5893 12.0389 13.2998C12.5805 14.0102 13.3834 14.385 14.3546 14.385C16.0447 14.385 17.0818 13.3967 17.1652 11.7282V14.2288H19.2643V6.36333L17.1652 6.68688V8.83123ZM17.2742 10.2852C17.2742 11.7553 16.5025 12.7049 15.3082 12.7049C14.0768 12.7049 13.3417 11.8005 13.3417 10.2852C13.3417 8.76088 14.0768 7.85048 15.3082 7.85048C15.9071 7.85048 16.4075 8.08363 16.7547 8.52523C17.0948 8.95683 17.2742 9.56578 17.2742 10.2852Z" fill="#292929"/>
                                <path d="M25.3863 6.18842C23.6956 6.18842 22.6586 7.17267 22.5762 8.83372V4.07373L20.4766 4.3978V14.2262H22.5762V11.7226C22.6586 13.3932 23.6956 14.3825 25.3863 14.3825C27.3648 14.3825 28.546 12.8511 28.546 10.2852C28.546 7.71932 27.3648 6.18842 25.3863 6.18842ZM24.4317 12.7049C23.2369 12.7049 22.4652 11.7553 22.4652 10.2852C22.4652 9.56572 22.645 8.95677 22.9852 8.52672C23.3324 8.08507 23.8328 7.85197 24.4317 7.85197C25.6631 7.85197 26.3982 8.76237 26.3982 10.2867C26.3997 11.8005 25.6646 12.7049 24.4332 12.7049H24.4317Z" fill="#292929"/>
                                <path d="M33.9097 6.11469C32.219 6.11469 31.1815 7.09894 31.0991 8.75999V4L29 4.32407V14.1525H31.0961V11.6489C31.1785 13.3195 32.216 14.3087 33.9066 14.3087C35.8847 14.3087 37.0659 12.7773 37.0659 10.2115C37.0659 7.64559 35.8852 6.11469 33.9097 6.11469ZM32.955 12.6311C31.7603 12.6311 30.9886 11.6816 30.9886 10.2115C30.9886 9.49199 31.168 8.88304 31.5081 8.45299C31.8558 8.01134 32.3562 7.77824 32.955 7.77824C34.186 7.77824 34.921 8.68864 34.921 10.213C34.92 11.7268 34.185 12.6311 32.955 12.6311Z" fill="#292929"/>
                                <path d="M37.4258 6.34473H39.6676L41.4889 14.2117H39.4792L37.4258 6.34473Z" fill="#292929"/>
                              </g>
                              <defs>
                                <linearGradient id="paint0_linear_922_4401" x1="0" y1="9.99975" x2="50" y2="9.99975" gradientUnits="userSpaceOnUse">
                                  <stop stop-color="#3BFF9D"/>
                                  <stop offset="1" stop-color="#3BFFC8"/>
                                </linearGradient>
                                <clipPath id="clip0_922_4401">
                                  <rect width="50" height="20" fill="white"/>
                                </clipPath>
                              </defs>
                            </svg>
                        </div>
                        <div class="row product_radio">
                            <div class="col-lg-12">
                                <label class="custom-radio">
                                    <input type="radio" name="radio-group" checked>
                                     Order Now and get it by <span class="fw-bold ps-2"> {{ date('M d', strtotime('+3days')) }}</span>
                                </label>
                            </div>
                            <!--<div class="col-lg-4 col-6">-->
                            <!--    <label class="custom-radio">-->
                            <!--        <input type="radio" name="radio-group">-->
                            <!--        <span class="radio-button"></span>-->
                            <!--        No Installation Required-->
                            <!--    </label>-->
                            <!--</div>-->
                            <!--<div class="col-lg-4 col-6">-->
                            <!--    <label class="custom-radio">-->
                            <!--        <input type="radio" name="radio-group">-->
                            <!--        <span class="radio-button"></span>-->
                            <!--        Sharjah +105-->
                            <!--    </label>-->
                            <!--</div>-->
                            <!--<div class="col-lg-4 col-6">-->
                            <!--    <label class="custom-radio">-->
                            <!--        <input type="radio" name="radio-group">-->
                            <!--        <span class="radio-button"></span>-->
                            <!--        Dubai +78.75-->
                            <!--    </label>-->
                            <!--</div>-->
                            <!--<div class="col-lg-4 col-6">-->
                            <!--    <label class="custom-radio">-->
                            <!--        <input type="radio" name="radio-group">-->
                            <!--        <span class="radio-button"></span>-->
                            <!--        Other Emirates +178.5-->
                            <!--    </label>-->
                            <!--</div>-->
                        </div>
                        <!--<div class="product_description">-->
                        <!--    <p>-->
                        <!--        {{ $product[0]->desc }}-->
                        <!--    </p>-->
                        <!--</div>-->
                        
                        <div class="price_panel d-none">
                            <div class="radio_container row">
                                <span class="col-auto weight_border">Weight : </span>
                                <div class="changable_div col">
                                    <div class="row">

                                        @if ($product_attr[$product[0]->id][0]->size_id > 0)
                                            @php
                                                $arrSize = [];
                                                foreach ($product_attr[$product[0]->id] as $attr) {
                                                     
                                                    $arrSize[] = $attr->size;
                                                    $arrId[] = $attr->id;
                                                }
                                                
                                                $arrSize = array_unique($arrSize);
                                                
                                            
                                            @endphp
                                            @foreach ($arrSize as $index => $attr)
                                                @if ($attr != '')
                                                    <label class="price_box col" for="{{ str_replace(' ', '', $attr) }}">
                                                        <input class="form-radio1 size_link" type="radio" name="radio1"
                                                            id="{{ str_replace(' ', '', $attr) }}"
                                                            value="{{ $attr }}"
                                                            onclick="showColor('{{ str_replace(' ', '', $attr) }}','{{ $arrId[$index] }}')" />
                                                        <div class="inner_price_box">
                                                            <span>{{ $attr }}</span>
                                                        </div>
                                                    </label>
                                                @endif
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="color_panel">
                            <div class="radio_container">
                                <span>Color : </span>
                                <div class="changable_div">
                                    
                                     
                                    @if ($product_attr[$product[0]->id][0]->color_id > 0)
                                    
                                        @php
                                            
                                                $arrColor = [];
                                                foreach ($product_attr[$product[0]->id] as $attr) {
                                                
                                                     
                                                    $arrColor[] = $attr->color;
                                                    
                                                    $arrId[] = $attr->id;
                                                }
                                                
                                                $arrColor = array_unique($arrColor);
                                                
                                                $users = App\Models\Colors::select("*")

                                                ->whereNotIn('color', $arrColor)
                            
                                                ->get();
                                                
                                            @endphp
                                            
                                        @foreach ($product_attr[$product[0]->id] as $index => $attr)
                                        
                                      
                                            @if ($attr != '')
                                            <div class="color_radio">
                                                <input class="form-radio " type="radio" name="radio"
                                                    id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"
                                                    onClick="change_product_color_image('{{ $attr->id }}','{{ $attr->color }}');change_price('{{ $attr->color }}','{{ $attr->id }}')" />
                                                <label class="product_color size_{{ str_replace(' ', '', $attr->size) }}"
                                                    for="{{ strtolower($attr->color) }}"
                                                    style="background-image:url('{{asset('storage/app/public/media/'.$attr->color_image)}}');background-size: cover;"></label>
                                            </div>
                                            <!--<input class="form-radio " type="radio" name="radio"-->
                                            <!--        id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"-->
                                            <!--        onClick="change_product_color_image('{{ asset('public/media/' . $attr->color_image) }}','{{ $attr->color }}');change_price('{{ $attr->color }}','{{ $attr->id }}')" />-->
                                            <!--<div class="color_radio">-->
                                            <!--    <input class="form-radio " type="radio" name="radio"-->
                                            <!--        id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"-->
                                            <!--        onClick="change_product_color_image('{{ asset('storage/app/public/media/' . $attr->color_image) }}','{{ $attr->color }}')" />-->
                                            <!--    <label class="product_color size_{{ str_replace(' ', '', $attr->size) }}"-->
                                            <!--        for="{{ strtolower($attr->color) }}"-->
                                            <!--        style="background-image:url(https://dbi.resel.co.in/myts/public/front/images/color2.png);background-size: cover;"></label>-->
                                            <!--</div>-->
                                            <!--<div class="color_radio">-->
                                            <!--    <input class="form-radio " type="radio" name="radio"-->
                                            <!--        id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"-->
                                            <!--        onClick="change_product_color_image('{{ asset('storage/app/public/media/' . $attr->color_image) }}','{{ $attr->color }}')" />-->
                                            <!--    <label class="product_color size_{{ str_replace(' ', '', $attr->size) }}"-->
                                            <!--        for="{{ strtolower($attr->color) }}"-->
                                            <!--        style="background-image:url(https://dbi.resel.co.in/myts/public/front/images/color3.png);background-size: cover;"></label>-->
                                            <!--</div>-->
                                            <!--<div class="color_radio">-->
                                            <!--    <input class="form-radio " type="radio" name="radio"-->
                                            <!--        id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"-->
                                            <!--        onClick="change_product_color_image('{{ asset('storage/app/public/media/' . $attr->color_image) }}','{{ $attr->color }}')" />-->
                                            <!--    <label class="product_color size_{{ str_replace(' ', '', $attr->size) }}"-->
                                            <!--        for="{{ strtolower($attr->color) }}"-->
                                            <!--        style="background-image:url(https://dbi.resel.co.in/myts/public/front/images/color4.png);background-size: cover;"></label>-->
                                            <!--</div>-->
                                            <!--<div class="color_radio">-->
                                            <!--    <input class="form-radio " type="radio" name="radio"-->
                                            <!--        id="{{ strtolower($attr->color) }}" value="{{ strtolower($attr->color) }}"-->
                                            <!--        onClick="change_product_color_image('{{ asset('storage/app/public/media/' . $attr->color_image) }}','{{ $attr->color }}')" />-->
                                            <!--    <label class="product_color size_{{ str_replace(' ', '', $attr->size) }}"-->
                                            <!--        for="{{ strtolower($attr->color) }}"-->
                                            <!--        style="background-image:url(https://dbi.resel.co.in/myts/public/front/images/color5.png);background-size: cover;"></label>-->
                                            <!--</div>-->
                                           @endif     
                                        @endforeach
                                        
                                         @foreach ($users as $user)
                                           <!--<div class="color_radio">-->
                                           <!--     <input class="form-radio " type="radio" name="radio"-->
                                           <!--         id="{{ strtolower($user->color) }}" value="{{ strtolower($user->color) }}"-->
                                           <!--         onClick="" disabled/>-->
                                           <!--     <label class=""-->
                                           <!--         for="{{ strtolower($user->color) }}"-->
                                           <!--         style="background-image:url({{asset('storage/app/public/media/color/'.$user->color_image)}});background-size: cover;"></label>-->
                                           <!-- </div>-->
                                         @endforeach
                                        
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="buy_row">
                            <a herf="#" class="outline_btn">
                                <div class="qty-container">
                                    <i class="fa fa-minus qty-btn-minus"></i>
                                    <input type="number" id="qty" name="qty" value="1" class="input-qty" oninput="validateQty(this)" min="1"/>
                                    <i class="fa fa-plus qty-btn-plus"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0)"
                                onclick="add_to_cart('{{ $product[0]->id }}','{{ $product_attr[$product[0]->id][0]->color_id }}')"
                                class="outline_btn add_to_cart_btn">
                                Add To Cart<svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                  <path d="M8.1 21.6C6.60825 21.6 5.4135 22.8082 5.4135 24.3C5.4135 25.7917 6.60825 27 8.1 27C9.59175 27 10.8 25.7917 10.8 24.3C10.8 22.8082 9.59175 21.6 8.1 21.6ZM0 0V2.7H2.7L7.55325 12.9397L5.73075 16.2472C5.5215 16.6387 5.4 17.0775 5.4 17.55C5.4 19.0417 6.60825 20.25 8.1 20.25H24.3V17.55H8.67375C8.48475 17.55 8.33625 17.4015 8.33625 17.2125C8.33625 17.1517 8.34975 17.0977 8.37675 17.0505L9.585 14.85H19.6425C20.655 14.85 21.5392 14.2897 22.005 13.4595L26.8312 4.698C26.9392 4.509 27 4.28625 27 4.05C27 3.30075 26.3925 2.7 25.65 2.7H5.69025L4.40775 0H0ZM21.6 21.6C20.1082 21.6 18.9135 22.8082 18.9135 24.3C18.9135 25.7917 20.1082 27 21.6 27C23.0917 27 24.3 25.7917 24.3 24.3C24.3 22.8082 23.0917 21.6 21.6 21.6Z" fill="white"/>
                                </svg>
                            </a>
                            <!--<a href="javascript:void(0)" class="outline_btn add_to_cart_btn"-->
                            <!--    onclick="add_to_wishlist('{{ $product[0]->id }}')">-->
                            <!--    <img src="{{ asset('public/front/images/like.svg') }}" class="pe-0" />-->
                            <!--</a>-->
                            {{-- <button type="button" class="main-btn border-0">
                                Buy Now
                            </button> --}}
                        </div>
                        <div id="add_to_cart_msg"></div>
                        <div class="product_service_row">
                            <!--<p>Cannot be returned or exchanged</p>-->
                            <div class="three_box">
                                <div class="service_box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                        <path d="M10.055 10.2678L7.84041 11.8693L1 8.09759L10.8262 1L17.6666 4.77176L14.6311 6.9642M10.0195 11.6708L7.84041 13.2463L1 9.4746M17.6666 6.14873L14.6311 8.34117M10.0195 13.0474L7.84041 14.623L1 10.8513M17.6666 7.52554L14.6311 9.71802M10.0195 14.4243L7.84041 16L1 12.2301M17.6666 8.90235L14.6311 11.0948M4.57976 5.52437L10.9627 9.42618L10.906 13.7851L13.5673 11.8694V7.65736L7.20032 3.61992" stroke="#777777" stroke-width="0.705126" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Cash on Delivery</span>
                                </div>
                                <div class="service_box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none">
                                        <path d="M6.65128 10.6872C7.39432 10.6872 7.99672 10.0848 7.99672 9.34177C7.99672 8.59873 7.39432 7.99633 6.65128 7.99633C5.90823 7.99633 5.30582 8.59873 5.30582 9.34177C5.30582 10.0848 5.90823 10.6872 6.65128 10.6872ZM6.65128 10.6872V12.3018M4.49816 5.84361V3.42181C4.49816 2.7795 4.75332 2.16351 5.20749 1.70933C5.66166 1.25515 6.27767 1 6.91994 1C7.56229 1 8.17829 1.25515 8.63241 1.70933C9.08661 2.16351 9.34175 2.7795 9.34175 3.42181V5.84361M1.53818 5.84361H12.3017C12.599 5.84361 12.8399 6.08456 12.8399 6.38179V13.9163C12.8399 14.2135 12.599 14.4545 12.3017 14.4545H1.53818C1.24095 14.4545 1 14.2135 1 13.9163V6.38179C1 6.08456 1.24095 5.84361 1.53818 5.84361Z" stroke="#777777" stroke-width="1.27585" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Secure Payments</span>
                                </div>
                                <div class="service_box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                        <path d="M0.558594 9.53125V1.6875C0.558594 1.50516 0.631024 1.3303 0.759954 1.20136C0.888884 1.07243 1.06375 1 1.24609 1H14.3085C14.4909 1 14.6658 1.07243 14.7947 1.20136C14.9236 1.3303 14.996 1.50516 14.996 1.6875V14.75C14.996 14.9324 14.9236 15.1073 14.7947 15.2362C14.6658 15.3651 14.4909 15.4375 14.3085 15.4375H8.43354" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.80859 10.2812L3.30859 15.7812L0.558594 13.0312" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>100% Authentic</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product_main_desc_section">
        <div class="container"> 
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Description</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Specifications</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Reviews</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="product_description">
                        <!--<p>About This Item</p>-->
                        <!--<p>Bestway Power Steel Rectangular Frame Pool 4.88mx2.44mx1.22m</p>-->
                        <!--<p>Product Features</p>-->
                        <!--<p>Size: 488 x 244 x 122 cm</p>-->
                        <!--<p>Max. Assembly dimensions : 527 x 284 cm • Water capacity 90% filled: 11,532 liters</p>-->
                        <!--<p>Pool liner made of robust, 3-layer TriTech ™ material</p>-->
                        <!--<p>Color: rattan look (gray)</p>-->
                        <!--<p>Easier Can be set up without tools</p>-->
                        <!--<p>Extremely rigid frame construction with corrosion protection for increased strength and durability</p>-->
                        <!--<p>Seal & Lock ™ steel frame connection system to protect against water ingress into the rods</p>-->
                        <!--<p>Increased resistance thanks to flexible C-connectors on the pool corners</p>-->
                        <!--<p>Integrated drain valve with garden hose adapter</p>-->
                        <!--<p>Product Included</p>-->
                        <!--<p>Flowclear ™ filter pump # 58386 3,028 l / h, GS-certified (TÜV Rheinland)</p>-->
                        <!--<p>Flowclear ™ filter cartridge # 58094 Gr. II (10.6 x 13.6 cm)</p>-->
                        <!--<p>Flowclear ™ safety ladder # 58331 122 cm</p>-->
                        <!--<p>Flowclear ™ PVC tarpaulin # 58472</p>-->
                        <!--<p>ChemConnect ™ chemical dispenser # 5850</p>-->
                        <!--<p>Recommended Age: Suitable for 9 years & above</p>-->
                        <p>{{ $product[0]->desc }}</p>
                    </div>
                </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <div class="product_description">
                      @if ($product_attr[$product[0]->id][0])
                      @if ($product[0]->specification)
                      <div class="product_table_row">
                          {!! $product[0]->specification !!}
                        </div>
                      
                        <!--<div class="product_table_row">-->
                        <!--    <div class="row">-->
                        <!--    <div class="col-lg-6 col-12">-->
                        <!--        <div class="product_detail row">-->
                        <!--            <span class="title_td col-auto">Product Dimensions :</span>-->
                        <!--            <div class="col">-->
                        <!--                <span-->
                        <!--                    class="sixty_kg_price" id="product_dimension">{{ $product_attr[$product[0]->id][0]->product_dimension }}</span>-->
        
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-6 col-12">-->
                        <!--        <div class="product_detail row">-->
                        <!--            <span class="title_td col-auto">Cautions :</span>-->
                        <!--            <div class="col">-->
                        <!--                <span class="sixty_kg_price" id="cautions">{{ $product_attr[$product[0]->id][0]->cautions }}</span>-->
        
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-lg-6 col-12">-->
                        <!--            <div class="product_detail row">-->
                        <!--                <span class="title_td col-auto">Package Dimensions :</span>-->
                        <!--                <div class="col">-->
                        <!--                    <span-->
                        <!--                        class="sixty_kg_price" id="package_dimension">{{ $product_attr[$product[0]->id][0]->package_dimension }}</span>-->
            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-lg-6 col-12">-->
                        <!--            <div class="product_detail row">-->
                        <!--                <span class="title_td col-auto">Material : </span>-->
                        <!--                <div class="col">-->
                        <!--                    <span class="sixty_kg_price" id="material">{{ $product_attr[$product[0]->id][0]->material }}</span>-->
            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-lg-6 col-12">-->
                        <!--            <div class="product_detail row">-->
                        <!--                <span class="title_td col-auto">Weight : </span>-->
                        <!--                <div class="col">-->
                        <!--                    <span class="sixty_kg_price" id="weight">{{ $product_attr[$product[0]->id][0]->weight }}</span>-->
            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-lg-6 col-12">-->
                        <!--            <div class="product_detail row">-->
                        <!--                <span class="title_td col-auto">Recommended Age :</span>-->
                        <!--                <div class="col">-->
                        <!--                    <span class="sixty_kg_price" id="recommended_age">{{ $product_attr[$product[0]->id][0]->recommended_age }}</span>-->
            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-lg-6 col-12">-->
                        <!--            <div class="product_detail row">-->
                        <!--                <span class="title_td col-auto" id="shipping_weight">Shipping Weight :</span>-->
                        <!--                <div class="col">-->
                        <!--                    <span-->
                        <!--                        class="sixty_kg_price">{{ $product_attr[$product[0]->id][0]->shipping_weight }}</span>-->
            
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        @endif
                      @endif
                  </div>
              </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                     <div class="reviews">
                         @if($product_review)
                         @foreach($product_review as $product_rev)
                        <div class="review_box">
                            <div class="user_pic">
                                <img src="{{asset('storage/app/public/media/product_reviews/'.$product_rev->image)}}">
                            </div>
                            <div class="user_desc">
                                <div class="user_stars"> 
                                    @for ($i = 0; $i < 5; $i++)
                                        @if (floor($product_rev->rating) - $i >= 1)
                                            {{--Full Start--}}
                                            <i class="fas fa-star text-warning"> </i>
                                        @elseif ($product_rev->rating - $i > 0)
                                            {{--Half Start--}}
                                            <i class="fas fa-star-half-alt text-warning"> </i>
                                        @else
                                            {{--Empty Start--}}
                                            <i class="far fa-star text-warning"> </i>
                                        @endif
                                    @endfor 
                                </div>
                                <div class="user_review">
                                    <p></p>
                                </div>
                                <div class="user_name">
                                    <p>{{ $product_rev->name }}</p>
                                </div>
                                <div class="review_date">
                                    <p>{{ date('d M,Y',strtotime($product_rev->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                         @endforeach
                         @else
                         <p>
                             <figure>
                                No Reviews
                            <figure>
                         </p>
                         @endif
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <section class="product_desc_section d-none">
        <div class="container">

            {{-- @if ($product_attr[$product[0]->id][0] > 0) --}}

            <div class="product_table_row">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Product Dimensions :</span>
                            <div class="col">
                                <span
                                    class="sixty_kg_price" id="product_dimension">{{ $product_attr[$product[0]->id][0]->product_dimension }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Cautions :</span>
                            <div class="col">
                                <span class="sixty_kg_price" id="cautions">{{ $product_attr[$product[0]->id][0]->cautions }}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Package Dimensions :</span>
                            <div class="col">
                                <span
                                    class="sixty_kg_price" id="package_dimension">{{ $product_attr[$product[0]->id][0]->package_dimension }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Material : </span>
                            <div class="col">
                                <span class="sixty_kg_price" id="material">{{ $product_attr[$product[0]->id][0]->material }}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Weight : </span>
                            <div class="col">
                                <span class="sixty_kg_price" id="weight">{{ $product_attr[$product[0]->id][0]->weight }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto">Recommended Age :</span>
                            <div class="col">
                                <span
                                    class="sixty_kg_price" id="recommended_age">{{ $product_attr[$product[0]->id][0]->recommended_age }}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="product_detail row">
                            <span class="title_td col-auto" id="shipping_weight">Shipping Weight :</span>
                            <div class="col">
                                <span
                                    class="sixty_kg_price">{{ $product_attr[$product[0]->id][0]->shipping_weight }}</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @endif --}}
        </div>
    </section>
    {{-- <section class="product_deacription">
        <div class="container">
            <div class="product_desc_header">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-first-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-first" type="button" role="tab" aria-controls="pills-first"
                            aria-selected="true">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-second-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-second" type="button" role="tab" aria-controls="pills-second"
                            aria-selected="false">
                            Name
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-third-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-third" type="button" role="tab" aria-controls="pills-third"
                            aria-selected="false">
                            Name
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-forth-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-forth" type="button" role="tab" aria-controls="pills-forth"
                            aria-selected="false">
                            Name
                        </button>
                    </li>
                </ul>
            </div>
            <div class="product_desc_body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-first" role="tabpanel"
                        aria-labelledby="pills-first-tab">
                        <div class="desc_box">
                            <p class="mb-5">
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                            <p>
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape Kids
                                Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
                        <div class="desc_box">
                            <p class="mb-5">
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                            <p>
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape Kids
                                Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
                        <div class="desc_box">
                            <p class="mb-5">
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                            <p>
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape Kids
                                Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-forth" role="tabpanel" aria-labelledby="pills-forth-tab">
                        <div class="desc_box">
                            <p class="mb-5">
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                            <p>
                                Kids Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape Kids
                                Flippy Floppy Spring rocker Cum Glider By is an outdoor
                                Dream Come True. Your Kids would love rocking on it! . Its
                                made with High quality plastic & strong iron base at the
                                bottom with heavy duty spring and its tweaks your kids
                                sensory stimulation. The spring movement helps to develop
                                coordination and balance. This rocking seesaw enhances kids
                                muscle strength.& develops strength of the upper and lower
                                parts of the body and supports motor planning and vestibular
                                activities. An ideal tool for kids who wants to develop
                                their Motor skills. Perfect Playset for Amusement parks,
                                Gardens, Outdoors, Schools, Shopping Malls & Landscape
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="category_section">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-3">
                <h4>You May Also Like</h4>
            </div>
            <div class="row">
                <div class="featured-swiper">
                    <div class="swiper-wrapper">
                        @if (isset($related_product[0]))
                            @foreach ($related_product as $productArr)
                                <div class="swiper-slide" data-aos="fade-up">
                                    <a href="{{ url('product/' . $productArr->alias) }}">
                                        <div class="product_box">
                                            <div class="discount_text">
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                @php
                                                    $percentageDiscount = ($related_product_attr[$productArr->id][0]->mrp - $related_product_attr[$productArr->id][0]->price) / $related_product_attr[$productArr->id][0]->mrp * 100;
                                                @endphp
                                                <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                            </div>
                                            <div class="part_img">
                                                <img src="{{ asset('storage/app/public/media/' . $productArr->image) }}"
                                                    class="featured_product" />
                                                
                                            </div>
                                            <div class="part_text">
                                                <h5 class="product_name">{{ $productArr->title }}</h5>
                                                @if(isset($related_product_attr[$productArr->id][0]) && $related_product_attr[$productArr->id][0]->price != $related_product_attr[$productArr->id][0]->mrp)
                                                    <p class="deleted_price">AED {{ number_format($related_product_attr[$productArr->id][0]->mrp, 2) }}</p>
                                                @endif
                                                                                               @if(isset($related_product_attr[$productArr->id][0]))
                                                    <p class="final_price">AED {{ number_format($related_product_attr[$productArr->id][0]->price, 2) }}</p>
                                                @endif
                                                <div class="product_footer">
                                                    <a href="{{ url('product/' . $productArr->alias) }}"
                                                        class="bordered_btn">Buy Now
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                                            <path d="M7.20717 18.259C5.98402 18.259 5.0044 19.2497 5.0044 20.4728C5.0044 21.696 5.98402 22.6866 7.20717 22.6866C8.43031 22.6866 9.421 21.696 9.421 20.4728C9.421 19.2497 8.43031 18.259 7.20717 18.259ZM0.565674 0.54834V2.76217H2.7795L6.75886 11.1581L5.26453 13.8701C5.09296 14.1911 4.99333 14.5508 4.99333 14.9382C4.99333 16.1614 5.98402 17.1521 7.20717 17.1521H20.4901V14.9382H7.6776C7.52264 14.9382 7.40088 14.8165 7.40088 14.6615C7.40088 14.6117 7.41194 14.5674 7.43408 14.5287L8.42477 12.7244H16.6713C17.5015 12.7244 18.2265 12.265 18.6084 11.5843L22.5656 4.4004C22.6542 4.24544 22.704 4.0628 22.704 3.86909C22.704 3.25475 22.2059 2.76217 21.5971 2.76217H5.23132L4.17975 0.54834H0.565674ZM18.2763 18.259C17.0532 18.259 16.0736 19.2497 16.0736 20.4728C16.0736 21.696 17.0532 22.6866 18.2763 22.6866C19.4995 22.6866 20.4901 21.696 20.4901 20.4728C20.4901 19.2497 19.4995 18.259 18.2763 18.259Z" fill="#B23632"></path>
                                                        </svg>
                                                        </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>
                            <figure>
                                No related data found
                                <figure>
                                    </p>
                        @endif

                    </div>
                    <div class="swiper-button-prev1">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next1">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    <input type="hidden" name="product_id" value="{{ $product[0]->id }}" />
    <form id="frmAddToCart">
        <!--<input type="hidden" id="size_id" name="size_id" />-->
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="pqty" name="pqty" />
        <input type="hidden" id="product_id" name="product_id" />
        @csrf
    </form>

    <form id="frmAddToWishList">
        {{-- <input type="hidden" id="size_id" name="size_id" />
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="pqty" name="pqty" /> --}}
        <input type="hidden" id="product_id" name="product_id" />
        @csrf
    </form>
@endsection
    @section('scripts')
    <script>
    
        function validateQty(input) {
            // Remove any non-numeric characters and leading zeros
            input.value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
        }
        
        function home_add_to_cart(id, color_str_id) {

            jQuery('#color_id').val(color_str_id);
           // jQuery('#size_id').val(size_str_id);
            //add_to_cart(id, color_str_id);
            add_to_cart(id, size_str_id, color_str_id);
        }



        function add_to_cart(id, color_str_id) {
            // alert(size_str_id);
            jQuery('#add_to_cart_msg').html('');
            var color_id = jQuery('#color_id').val();
            //var size_id = jQuery('#size_id').val();

            // alert(size_str_id);
            // if (size_str_id == 0) {
            //     size_id = 'no';
            // }
            if (color_str_id == 0) {
                color_id = 'no';
            }
            // if (size_id == '' && size_id != 'no') {
            //     jQuery('#add_to_cart_msg').html(
            //         '<p style="color:red;">Please select size</p>'
            //     );
            //} else
            if (color_id == '' && color_id != 'no') {
                jQuery('#add_to_cart_msg').html(
                    '<p style="color:red;">Please select color</p>'
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
                            jQuery('.aa-cartbox-summary1').remove()
                        }
                        else {
                            Command: toastr["success"]("Product " + result.msg);
                            if (result.totalItem == 0) {
                                jQuery('.aa-cart-notify').html('0');
                                jQuery('.aa-cartbox-summary').remove();
                            } else {

                                jQuery('.aa-cart-notify').html(result.totalItem);
                                
                            }
                            
                        }
                    }
                });
            }
        }

        function add_to_wishlist(id) {


            var csrfToken = "{{ csrf_token() }}"; // Get the CSRF token value from Laravel

            var data = {
                _token: csrfToken,
                id: id
            };
            // jQuery('#pqty').val(jQuery('#qty').val());
            jQuery.ajax({
                url: "{{ url('add_to_wishlist') }}",
                method: 'POST',
                data: data,
                success: function(result) {
                    // console.log(result.status);
                    if (result.status == 'error') {
                        window.location.href = "../login-register";

                    } else {
                        var totalPrice = 0;

                        if (result.msg == 'not_avaliable') {
                            alert(result.data);
                        } else {
                            Command: toastr["success"]("Product " + result.msg);
                            if (result.totalItem == 0) {
                                jQuery('.aa-cart-notify2').html('0');
                                jQuery('.aa-cartbox-summary').remove();
                            } else {

                                jQuery('.aa-cart-notify2').html(result.totalItem);
                                

                            }
                            
                        }
                    }
                    //    / if(result.status=="error"){
                    //         console.log('yes');
                    //     }
                }
            });
        }


// function showColor(size,id){

//   //jQuery('#size_id').val(size);

//   jQuery('.product_color').hide();
//   //jQuery('.size_'+size).show();
//   //jQuery('.size_link').css('border','1px solid #ddd');
//   //jQuery('#'+size).css('border','1px solid black');
//   var csrfToken = jQuery('meta[name="csrf-token"]').attr('content');
//   jQuery.ajax({
//     url: '../get-price-data', // Replace with the appropriate URL to your controller action
//     type: 'post',
//     data: {
//       _token: '{{ csrf_token() }}',
//         id: id
//     },
//     success: function(response) {
//         console.log(response.price);
//         var price = response.price;
//         var mrp = response.mrp;
//         var product_dimension = response.product_dimension;
//         var package_dimension = response.package_dimension;
//         var weight = response.weight;
//         var shipping_weight = response.shipping_weight;
//         var cautions = response.cautions;
//         var material = response.material;
//         var recommended_age = response.recommended_age;


//         // Update the price on your page
//         jQuery('#price_display').text(price);
//         jQuery('#mrp').text(mrp);
//         jQuery('#product_dimension').text(product_dimension);
//         jQuery('#package_dimension').text(package_dimension);
//         jQuery('#weight').text(weight);
//         jQuery('#shipping_weight').text(shipping_weight);
//         jQuery('#cautions').text(cautions);
//         jQuery('#material').text(material);
//         jQuery('#recommended_age').text(recommended_age);
//     },
//     error: function(xhr, status, error) {
//         // Handle error, if any
//         console.log(error);
//     }
// });
 
// }

function change_price(color,id){

  var csrfToken = jQuery('meta[name="csrf-token"]').attr('content');
  jQuery.ajax({
    url: '../get-price-data', // Replace with the appropriate URL to your controller action
    type: 'post',
    data: {
      _token: '{{ csrf_token() }}',
        id: id,color: color
    },
    success: function(response) {
          var attrImageArray = JSON.parse(response.color_image);
            
            // Log the decoded color_image to the console
            
        var price = response.price;
        var mrp = response.mrp;
        var product_dimension = response.product_dimension;
        var package_dimension = response.package_dimension;
        var weight = response.weight;
        var shipping_weight = response.shipping_weight;
        var cautions = response.cautions;
        var material = response.material;
        var recommended_age = response.recommended_age;
        var color_image = attrImageArray;


        // Update the price on your page
        jQuery('#price_display').text(price);
        jQuery('#mrp').text(mrp);
        jQuery('#product_dimension').text(product_dimension);
        jQuery('#package_dimension').text(package_dimension);
        jQuery('#weight').text(weight);
        jQuery('#shipping_weight').text(shipping_weight);
        jQuery('#cautions').text(cautions);
        jQuery('#material').text(material);
        jQuery('#recommended_age').text(recommended_age);
        
         // Update the HTML of the changable_image_row
            var imageRow = jQuery('.changable_image_row');
            imageRow.empty(); // Clear existing images

            // Append the first image (main image)
            imageRow.append('<div class="mini_img_box nav-item" role="presentation">' +
                '<img src="{{ asset('storage/app/public/media/' . $product[0]->image) }}" class="active" id="green_first-tab" data-bs-toggle="pill" data-bs-target="#green_first" type="button" role="tab" aria-controls="green_first" aria-selected="true" />' +
                '</div>');

            // Append additional images from attrImageArray
            for (var i = 0; i < attrImageArray.length; i++) {
                imageRow.append('<div class="mini_img_box nav-item" role="presentation">' +
                    '<img src="{{asset('public/media/')}}/' + attrImageArray[i] + '" class="active" id="green_first-tab" data-bs-toggle="pill" data-bs-target="#green_first" type="button" role="tab" aria-controls="green_first" aria-selected="true" />' +
                    '</div>');
            }
    },
    error: function(xhr, status, error) {
        // Handle error, if any
        console.log(error);
    }
});
 
}

    </script>
 <script>
    $(document).ready(function () {
        // Initialize the first image as active on page load
        $('.image-tab:first').addClass('active show');
    });

    function changeImage(index) {
        // Hide all images
        $('.inner_box_image img').removeClass('active show');

        // Show the selected image
        $('.inner_box_image img[id="' + index + '"]').addClass('active show');
    }
</script>

@endsection
