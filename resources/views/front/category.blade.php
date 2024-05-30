@extends('front.layouts.app')
@section('page_title','Category')

@section('content')
    <section class="breadcrub_section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $pagetitle->category_name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="category_section list-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-12">
                    <div class="sidebar d-lg-block d-none">
                        <div class="main-menu ">
                            <h4 class="filter_heading">Filters</h4>
                            <nav>
                                <ul class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="item">
                                        <h2 class="accordion-header">
                                            <a href="javascript:void(0)" class="link">
                                                <span class="inner_heading">Category</span>
                                            </a>
                                        </h2>
                                        <div  class="show accordin_show">
                                            <div class="accordion1" id="accordionExample1"> 
                                                @foreach($categories_left as $cat_left)
                                                    @if($cat_left->parent_category_id == 0)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading{{$cat_left->id}}">
                                                                <a href="{{url('category/'.$cat_left->category_slug)}}" class="collapsed"  data-bs-toggle="collapse" data-bs-target="#collapse{{$cat_left->id}}" aria-expanded="false" aria-controls="collapse{{$cat_left->id}}">
                                                                    <i class="fa-solid fa-chevron-right"></i> {{ $cat_left->category_name }}
                                                                </a>
                                                            </h2>
                                                            <div id="collapse{{$cat_left->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$cat_left->id}}" data-bs-parent="#accordionExample1">
                                                                <div class="accordion-body">
                                                                    @foreach($categories_left as $subcategory)
                                                                        @if($subcategory->parent_category_id == $cat_left->id)
                                                                            <a href="{{url('category/'.$subcategory->category_slug)}}">{{ $subcategory->category_name }}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <!--<div class="accordion-body"> -->
                                                
                                            <!--    <div>-->
                                            <!--        @foreach($categories_left as $cat_left)-->
                                            <!--        @if($cat_left->parent_category_id == 0)-->
                                            <!--                <div><a href="{{url('category/'.$cat_left->category_slug)}}" class="left_cat_active cat_link"><i class="fa-solid fa-chevron-right"></i>{{ $cat_left->category_name }}</a></div> -->
                                            <!--            @foreach($categories_left as $subcategory)-->
                                            <!--            @if($subcategory->parent_category_id == $cat_left->id)-->
                                            <!--                <div class="ps-4">-->
                                            <!--                    <li><a href="{{url('category/'.$subcategory->category_slug)}}">{{ $subcategory->category_name }}</a></li>-->
                                            <!--                </div>-->
                                            <!--            @endif-->
                                            <!--            @endforeach-->
                                            <!--        @endif-->
                                            <!--        @endforeach-->
                                            <!--    </div>  -->
                                                    
                                               
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <!--<div class="item">-->
                                    <!--    <h2 class="accordion-header">-->
                                    <!--        <a href="javascript:void(0)" class="link">-->
                                    <!--            <span class="inner_heading">Brand</span>-->
                                    <!--        </a>-->
                                    <!--    </h2>-->
                                    <!--    <div  class="show">-->
                                    <!--        <div class="accordion-body"> -->
                                    <!--            <form>-->
                                    <!--                <div class="form-group">-->
                                    <!--                  <input type="checkbox" id="filter11">-->
                                    <!--                  <label for="filter11">BMW</label>-->
                                    <!--                </div>-->
                                    <!--                <div class="form-group">-->
                                    <!--                  <input type="checkbox" id="filter22">-->
                                    <!--                  <label for="filter22">Mercedes</label>-->
                                    <!--                </div>-->
                                    <!--                <div class="form-group">-->
                                    <!--                  <input type="checkbox" id="filter33">-->
                                    <!--                  <label for="filter33">Audi</label>-->
                                    <!--                </div>-->
                                    <!--                <div class="form-group">-->
                                    <!--                  <input type="checkbox" id="filter44">-->
                                    <!--                  <label for="filter44">Range-rover</label>-->
                                    <!--                </div> -->
                                    <!--            </form> -->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="item">
                                        <form method="get" action="{{ route('category', $slug) }}">
                                            <div class="price-input">
                                                <div class="field">
                                                    <span>Min</span>
                                                    <input type="number" name="filter_price_start" class="input-min" value="{{ $filter_price_start }}" id="skip-value-lower">
                                                </div>
                                                <div class="separator">-</div>
                                                <div class="field">
                                                    <span>Max</span>
                                                    <input type="number" name="filter_price_end" class="input-max" value="{{ $filter_price_end }}" id="skip-value-upper">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="main-btn border-0">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--<div class="item">-->
                                    <!--    <h2 class="accordion-header" id="panelsStayOpen-headingFour">-->
                                    <!--        <a href="#" class="link" type="button" data-bs-toggle="collapse"-->
                                    <!--            data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true"-->
                                    <!--            aria-controls="panelsStayOpen-collapseFour">-->
                                    <!--            <span class="inner_heading">Colors</span>-->
                                    <!--        </a>-->
                                    <!--    </h2>-->
                                    <!--    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show"-->
                                    <!--        aria-labelledby="panelsStayOpen-headingFour">-->
                                    <!--        <div class="accordion-body">-->
                                    <!--            <ul class="d-flex align-items-center justify-content-center">-->
                                    <!--                @foreach ($colors as $color)-->
                                    <!--                    @if (in_array($color->id, $colorFilterArr))-->
                                    <!--                        <div class="form-check color_filter">-->

                                    <!--                            <input class="form-radio " type="radio" name="radio"-->
                                    <!--                                id="{{ $color->color }}" value="{{ $color->color }}"-->
                                    <!--                                onclick="setColor('{{ $color->id }}','1')" />-->
                                    <!--                            <label class="product_color "-->
                                    <!--                                for="{{ strtolower($color->color) }}"-->
                                    <!--                                style="background-color:{{ strtolower($color->color) }}"></label>-->
                                    <!--                        </div>-->
                                    <!--                    @else-->
                                    <!--                        <div class="form-check color_filter">-->
                                    <!--                            <input class="form-radio " type="radio" name="radio"-->
                                    <!--                                id="{{ $color->color }}" value="{{ $color->color }}"-->
                                    <!--                                onclick="setColor('{{ $color->id }}','0')" />-->
                                    <!--                            <label class="product_color "-->
                                    <!--                                for="{{ strtolower($color->color) }}"-->
                                    <!--                                style="background-color:{{ strtolower($color->color) }}"></label>-->
                                    <!--                        </div>-->
                                    <!--                    @endif-->
                                    <!--                @endforeach-->

                                    <!--            </ul>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="mobile_filter" style="display:none;">
                        <img src="images/close_icon.svg" class="close_icon">
                        <div class="main-menu ">
                            <h4 class="filter_heading">Filters</h4>
                            <nav>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <!--<h2 class="accordion-header" id="headingOne">-->
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Filters Material
                                            </button>
                                        <!--</h2>-->
                                        <!--<div id="collapseOne" class="accordion-collapse collapse show"-->
                                            <!--aria-labelledby="headingOne" data-bs-parent="#accordionExample">-->
                                            <div class="accordion-body">
                                                <ul class="">
                                                    @foreach ($categories_left as $cat_left)
                                                        @if ($slug == $cat_left->category_slug)
                                                            <li><a href="{{ url('category/' . $cat_left->category_slug) }}"
                                                                    class="left_cat_active">{{ $cat_left->category_name }}</a>
                                                            </li>
                                                        @else
                                                            <li><a
                                                                    href="{{ url('category/' . $cat_left->category_slug) }}">{{ $cat_left->category_name }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        <!--</div>-->
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Filters by Price
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="">
                                                    <input id="myinput" min="0" max="60" type="range"
                                                        value="30">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                Colors
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul class="">
                                                    @foreach ($colors as $color)
                                                        @if (in_array($color->id, $colorFilterArr))
                                                            <div class="form-check">

                                                                <input class="form-radio " type="radio" name="radio"
                                                                    id="{{ $color->color }}" value="{{ $color->color }}"
                                                                    onclick="setColor('{{ $color->id }}','1')" />
                                                                <label class="product_color "
                                                                    for="{{ strtolower($color->color) }}"
                                                                    style="background-color:{{ strtolower($color->color) }}"></label>
                                                            </div>
                                                        @else
                                                            <div class="form-check">


                                                                <input class="form-radio " type="radio" name="radio"
                                                                    id="{{ $color->color }}" value="{{ $color->color }}"
                                                                    onclick="setColor('{{ $color->id }}','0')" />
                                                                <label class="product_color "
                                                                    for="{{ strtolower($color->color) }}"
                                                                    style="background-color:{{ strtolower($color->color) }}"></label>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </nav>
                            {{-- <div class="filter_row text-center mt-5">
                                <a href="" class="main-btn">Filter</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="btn_row">
                        <span class="d-xl-inline d-none"></span>
                        <a href="javascript:void()" class="d-xl-none d-inline main-btn filter_toggle">Filter</a>
                        <div>
                            {{-- <select class="main-btn">
                          <option>Sort By Price</option>
                        </select> --}}

                            <form action="" class="aa-sort-form position-relative">

                                <select class="main-btn" name="" onchange="sort_by()" id="sort_by_value">
                                    <option value="" selected="Default">Sort By</option>
                                    <option value="name" <?php if($sort_txt=='Product Name'){echo "selected";}?>>New First</option>
                                    <option value="price_asc" <?php if($sort_txt=='Price - ASC'){echo "selected";}?>>Price Low - High</option>
                                    <option value="price_desc" <?php if($sort_txt=='Price - DESC'){echo "selected";}?>>Price High - Low</option>
                                    <!--<option value="date">Date</option>-->
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                                <!--<span class="d-none">{{ $sort_txt }}</span>-->
                            </form>

                        </div>
                    </div>
                    <div class="list-item">
                        <div class="row">
                            
                            @if (isset($product[0]))
                                @foreach ($product as $productArr)
                                    <div class="col-xl-3 col-md-6 col-6">
                                        <div class="product_box">
                                            <a href="{{ url('product/' . $productArr->alias) }}" class="d-flex justify-content-center">
                                                <div class="discount_text">
                                                    <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                     @php
                                                        $percentageDiscount = ($product_attr[$productArr->id][0]->mrp - $product_attr[$productArr->id][0]->price) / $product_attr[$productArr->id][0]->mrp * 100;
                                                    @endphp
                                                    <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                                </div>
                                                <div class="part_img">
                                                    <img src="{{ asset('storage/app/public/media/' . $productArr->image) }}"
                                                        class="featured_product"  />
                                                </div>
                                            </a>
                                            <div class="part_text">
                                                <a href="{{ url('product/' . $productArr->alias) }}">
                                                    <h5 class="product_name">{{ $productArr->title }}</h5>
                                                     <div class="product_rating_row">
                                                        <div class="rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if (floor(@$productArr->rating) - $i >= 1)
                                                                    {{--Full Start--}}
                                                                    <i class="fas fa-star text-warning"> </i>
                                                                @elseif (@$productArr->rating - $i > 0)
                                                                    {{--Half Start--}}
                                                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                                                @else
                                                                    {{--Empty Start--}}
                                                                    <i class="far fa-star text-warning"> </i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <!--<span>@if(@$productArr->rating)({{@$productArr->rating}})@endif</span>-->
                                                    </div>
                            
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex flex-column">
                                                            <div class="final_price">AED
                                                                @if(isset($product_attr[$productArr->id][0]))
                                                                    <span class="final_price ps-0">{{ number_format($product_attr[$productArr->id][0]->price, 2) }}</span>
                                                                @endif
                                                            </div>
                                                             @if(isset($product_attr[$productArr->id][0]) && $product_attr[$productArr->id][0]->price != $product_attr[$productArr->id][0]->mrp)
                                                                <p class="deleted_price">AED {{ number_format($product_attr[$productArr->id][0]->mrp, 2) }}</p>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <a href="{{ url('product/' . $productArr->alias) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                                                    <path d="M7.20717 18.259C5.98402 18.259 5.0044 19.2497 5.0044 20.4728C5.0044 21.696 5.98402 22.6866 7.20717 22.6866C8.43031 22.6866 9.421 21.696 9.421 20.4728C9.421 19.2497 8.43031 18.259 7.20717 18.259ZM0.565674 0.54834V2.76217H2.7795L6.75886 11.1581L5.26453 13.8701C5.09296 14.1911 4.99333 14.5508 4.99333 14.9382C4.99333 16.1614 5.98402 17.1521 7.20717 17.1521H20.4901V14.9382H7.6776C7.52264 14.9382 7.40088 14.8165 7.40088 14.6615C7.40088 14.6117 7.41194 14.5674 7.43408 14.5287L8.42477 12.7244H16.6713C17.5015 12.7244 18.2265 12.265 18.6084 11.5843L22.5656 4.4004C22.6542 4.24544 22.704 4.0628 22.704 3.86909C22.704 3.25475 22.2059 2.76217 21.5971 2.76217H5.23132L4.17975 0.54834H0.565674ZM18.2763 18.259C17.0532 18.259 16.0736 19.2497 16.0736 20.4728C16.0736 21.696 17.0532 22.6866 18.2763 22.6866C19.4995 22.6866 20.4901 21.696 20.4901 20.4728C20.4901 19.2497 19.4995 18.259 18.2763 18.259Z" fill="#B23632"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="product_footer">
                                                    
                                                </div>
                                               <div class="changable_div"> 
                                               
                                                
                                                @foreach($product_attr[$productArr->id] as $productAttr)
                            
                                                    @if ($productAttr != '')
                                                  
                                                        <div class="color_radio" title="red">
                                                            <input class="form-radio d-none" type="radio" name="radio" id="red" value="red" disabled="">
                                                           <img src="{{ asset('storage/app/public/media/' . $productAttr->color_image) }}" alt="Color Image">
                                                        </div> 
                                                    @endif
                                                @endforeach
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <figure>
                                    No data found
                                    <figure>
                            @endif
                        </div>
                    </div>
                    <div class="list-item" style="display: none;">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="product_box"><a href="#">
                                        <div class="part_img">
                                            <img src="images/featured_product1.png" class="featured_product">
                                        </div>
                                    </a>
                                    <div class="part_text"><a href="#">
                                            <h5 class="product_name">Intex Sunset Glow Pool</h5>
                                            <p class="deleted_price">AED 90</p>
                                            <p class="final_price">AED 299</p>
                                        </a>
                                        <div class="product_footer"><a href="#">
                                            </a><a href="product_detail.html" class="bordered_btn">Buy Now</a>
                                            <a href="#" class="cart_box"><img src="images/bag.svg"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--<div id="pagination-container" class="pagination-container light-theme simple-pagination">-->
                   
                    <!--</div>-->
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="category_section arrivals_products">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-3">
                <h4>Chosen by our experts</h4>
            </div>
            <div class="row">
                <div class="offer-product-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-aos="fade-up">
                            <a href="#">
                                <div class="product_box">
                                    <div class="part_img">
                                        <img src="images/featured_product1.png" class="featured_product" />
                                        <div class="discount_text">
                                            <img src="images/offer_bg.svg" class="offer_bg" />
                                            <span class="main_span">10%<span class="off_text">OFF</span></span>
                                        </div>
                                    </div>
                                    <div class="part_text">
                                        <h5 class="product_name">Intex Sunset Glow Pool</h5>
                                        <p class="deleted_price">AED 90</p>
                                        <p class="final_price">AED 299</p>
                                        <div class="product_footer">
                                            <a href="product_detail.html" class="bordered_btn">Buy Now</a>
                                            <a href="#" class="cart_box"><img src="images/bag.svg" /></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
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
    </section> --}}
    <input type="hidden" id="qty" value="1" />
    <form id="frmAddToCart">
        <!--<input type="hidden" id="size_id" name="size_id" />-->
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="pqty" name="pqty" />
        <input type="hidden" id="product_id" name="product_id" />
        @csrf
    </form>
    <form id="categoryFilter">
        <input type="hidden" id="sort" name="sort" value="{{ $sort }}" />
        <input type="hidden" id="filter_price_start" name="filter_price_start" value="{{ $filter_price_start }}" />
        <input type="hidden" id="filter_price_end" name="filter_price_end" value="{{ $filter_price_end }}" />
        <input type="hidden" id="color_filter" name="color_filter" value="{{ $color_filter }}" />
    </form>
@endsection
@section('scripts')
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


                            }
                            
                        }
                    }
                });
            }
        }
        
    </script>
@endsection
