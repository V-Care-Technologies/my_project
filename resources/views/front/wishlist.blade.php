@extends('front.layouts.app')
@section('page_title','My wishlist')
@section('wishlist_active','active')

@section('content')
    <section class="breadcrub_section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="page_heading wishlist_heading">
        <div class="container">
            <h2><i class="fa-solid fa-heart fa-beat"></i>My wishlist</h2>
        </div>
    </section>
    <section class="wishlist_section">
        @if (isset($list[0]))
            <div class="container">
                <div class="row header_row">
                    <div class="col-lg-4 col-12 ">
                        <span>Product Name</span>
                    </div>
                    <div class="col-lg-3 col-12">
                        <span>Unit Price</span>
                    </div>
                    {{-- <div class="col-lg-2 col-12">
                    <span>Stock Status</span>
                </div> --}}
                    <div class="col-lg-2 col-12"></div>
                    <div class="col-lg-1 col-12"></div>
                </div>
                {{-- {{dd($list)}} --}}
                @foreach ($list as $data)
                    <div class="row content_row" id="wishlist_box{{ $data->attr_id }}">
                        <div class="col-lg-4 col-12">
                            <div class="row">
                                <span class="product_box col-auto">
                                    <img src="{{ asset('public/storage/media/' . $data->image) }}" class="cart_product">
                                </span>
                                <span class="col">{{ $data->title }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div>
                                <span class="deleted_price text-decoration-line-through">{{ $data->mrp }}AED</span><span
                                    class="extra_span" style="font-size:24px;padding-right:5px"> AED</span><span
                                    class="extra_span">{{ $data->price }}</span>
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 col-12">
                    <span class="normal_text text-success">In Stock</span>
                </div> --}}
                        <div class="col-lg-2 col-12">
                            <!--<a href="javascript:void(0)" class="main-btn"-->
                            <!--    onclick="home_add_to_cart('{{ $data->pid }}','{{ $data->size }}','{{ $data->color }}')"><img-->
                            <!--        src="{{ asset('public/front/images/white_cart_icon.svg') }}">Add To Cart</a>-->
                                    <a href="javascript:void(0)" class="main-btn"
                                onclick="home_add_to_cart('{{ $data->pid }}','{{ $data->color }}')"><img
                                    src="{{ asset('public/front/images/white_cart_icon.svg') }}">Add To Cart</a>
                            {{-- <p class="added_text">Added No: May 5,2019</p> --}}
                        </div>
                        <div class="col-lg-1 col-12">
                            <!--<a class="remove" href="javascript:void(0)"-->
                            <!--    onclick="deleteWishlistProduct('{{ $data->pid }}','{{ $data->size }}','{{ $data->color }}','{{ $data->attr_id }}')">-->
                            <!--    <img src="{{ asset('public/front/images/delete_icon.svg') }}" class="delete_icon1"></a>-->
                                
                            <a class="remove" href="javascript:void(0)"
                                onclick="deleteWishlistProduct('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}')">
                                <img src="{{ asset('public/front/images/delete_icon.svg') }}" class="delete_icon1"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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

        // function add_to_wishlist(id) {


        //     var csrfToken = "{{ csrf_token() }}"; // Get the CSRF token value from Laravel

        //     var data = {
        //         _token: csrfToken,
        //         id: id
        //     };
        //     // jQuery('#pqty').val(jQuery('#qty').val());
        //     jQuery.ajax({
        //         url: "{{ url('add_to_wishlist') }}",
        //         method: 'POST',
        //         data: data,
        //         success: function(result) {

        //             if (result.status == 'error') {
        //                 window.location.href = "../login-register";

        //             } else {
        //                 var totalPrice = 0;

        //                 if (result.msg == 'not_avaliable') {
        //                     alert(result.data);
        //                 } else {
        //                     alert("Product " + result.msg);
        //                     if (result.totalItem == 0) {
        //                         jQuery('.aa-cart-notify2').html('0');
        //                         jQuery('.aa-cartbox-summary').remove();
        //                     } else {

        //                         jQuery('.aa-cart-notify2').html(result.totalItem);
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
        //             //    / if(result.status=="error"){
        //             //         console.log('yes');
        //             //     }
        //         }
        //     });
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
                            alert(result.data);
                        } else {
                            if(result.msg == 'removed'){
                                Command: toastr["error"]("Product " + result.msg);
                            }
                            else{
                                 Command: toastr["success"]("Product " + result.msg);
                            }
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

                    if (result.status == 'error') {
                        window.location.href = "../login-register";

                    } else {
                        var totalPrice = 0;

                        if (result.msg == 'not_avaliable') {
                            alert(result.data);
                        } else {
                            if(result.msg == 'removed'){
                                Command: toastr["error"]("Product " + result.msg);
                            }
                            else{
                                 Command: toastr["success"]("Product " + result.msg);
                            }
                            if (result.totalItem == 0) {
                                jQuery('.aa-cart-notify2').html('0');
                                jQuery('.aa-cartbox-summary').remove();
                            } else {

                                jQuery('.aa-cart-notify2').html(result.totalItem);
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
                    //    / if(result.status=="error"){
                    //         console.log('yes');
                    //     }
                }
            });
        }
        
    </script>
@endsection
