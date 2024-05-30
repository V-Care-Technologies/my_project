@extends('front.layouts.app')
@section('page_title','Search')
@section('content')

<section class="breadcrub_section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Search Result
                </li>
            </ol>
        </nav>
    </div>
</section>
 <section class="category_section arrivals_products second_arrival">
        <div class="container position-relative">
            <div class="main_heading mb-lg-5 mb-3">
                
            </div>
            <div class="row">
                <div class="arrivals-product-swiper">
                    <div class="swiper-wrapper">
                         @if(isset($product[0]))
                       @foreach($product as $productArr)
                                <div class="swiper-slide" data-aos="fade-up">
                                    <a href="{{url('product/'.$productArr->alias)}}">
                                        <div class="product_box">
                                            <div class="discount_text">
                                                <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                                @php
                                                    $percentageDiscount = ($product_attr[$productArr->id][0]->mrp - $product_attr[$productArr->id][0]->price) / $product_attr[$productArr->id][0]->mrp * 100;
                                                @endphp
                                                <div class="main_span">{{ number_format($percentageDiscount, 0) }}%<span class="off_text">OFF</span></div>                            
                                            </div>
                                            <div class="part_img">
                                                <img src="{{asset('storage/app/public/media/'.$productArr->image)}}"
                                                    class="featured_product">
                                            </div>
                                            <div class="part_text">
                                                <h5 class="product_name">{{$productArr->title}}</h5>
                                                    <p class="deleted_price">AED
                                                        {{ number_format($product_attr[$productArr->id][0]->price, 2) }}</p>
                                                    <p class="final_price">AED
                                                        {{ number_format($product_attr[$productArr->id][0]->mrp, 2) }}</p>
                                                <div class="product_footer">
                                                    <a href="{{url('product/'.$productArr->alias)}}"
                                                        class="bordered_btn">Buy
                                                        Now</a>
                                                    <a href="javascript:void(0)"
                                                        onclick="home_add_to_cart('{{$productArr->id}}','{{$product_attr[$productArr->id][0]->size}}','{{$product_attr[$productArr->id][0]->color}}')"
                                                        class="cart_box"><img
                                                            src="{{ asset('public/front/images/bag.svg') }}"></a>
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
<!-- / product category -->

<input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="pqty" name="pqty"/>
    <input type="hidden" id="product_id" name="product_id"/>           
    @csrf
  </form>  
  <script>
        function home_add_to_cart(id, size_str_id, color_str_id) {

            jQuery('#color_id').val(color_str_id);
            jQuery('#size_id').val(size_str_id);
            add_to_cart(id, size_str_id, color_str_id);
        }

        function add_to_cart(id, size_str_id, color_str_id) {

            jQuery('#add_to_cart_msg').html('');
            var color_id = jQuery('#color_id').val();
            var size_id = jQuery('#size_id').val();

            if (size_str_id == 0) {
                size_id = 'no';
            }
            if (color_str_id == 0) {
                color_id = 'no';
            }
            if (size_id == '' && size_id != 'no') {
                jQuery('#add_to_cart_msg').html(
                    '<div class="alert alert-danger fade in alert-dismissible mt10"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>Please select size</div>'
                );
            } else if (color_id == '' && color_id != 'no') {
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
                            alert(result.data);
                        } else {
                            alert("Product " + result.msg);
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
                                        arrVal.name + '</a></h4><p> ' + arrVal.qty + ' * Rs  ' + arrVal
                                        .price + '</p></div></li>';
                                });

                            }
                            html +=
                                '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">Rs ' +
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

