@extends('front.layouts.app')
@section('page_title','My Shopping Bag')


@section('content')
    <section class="breadcrub_section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                       Shopping Bag
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="cart_details">
        <div class="container">
            <form action="">
                <div class="row">
                    @if (isset($list[0]))
                        <div class="col-lg-12 col-12">
                            <div class="table-responsive1">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="inner_cart_box">
                                            <div class="heading_cart">
                                                <p>{{ count($list) }} Item</p>
                                            </div>
                                            <div class="all_cart_box">
                                                <?php $subtotal=0;
                                                      $vattotal=0;
                                                      $mrptotal=0;
                                                 ?>
                                                @foreach ($list as $data)
                                                <div class="main_cart_box row" id="cart_box{{$data->attr_id}}">
                                                    <div class="d-flex col-lg-8">
                                                        <div class="image_box">
                                                            <img src="{{ asset('storage/app/public/media/' . $data->image) }}">
                                                        </div>
                                                        <div class="name_box">
                                                            <p>{{ $data->title }}</p>
                                                            <input type="number" id="qty{{ $data->attr_id }}" name="qty"
                                                            value="{{ $data->qty }}" class="qty_cart d-lg-block d-none input-qty qty{{ $data->attr_id }}"
                                                            oninput="validateQty(this)"
                                                            onchange="updateQty('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}','{{ $data->price }}')" />
                                                        </div>
                                                    </div>
                                                    <div class="d-lg-none d-block mobile_cart">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="price real_price">{{ number_format($data->price, 2) }} <span class="aed_text">AED</span></p>
                                                                <p class="price deleted_price"><del>{{ number_format($data->mrp, 2) }} <span class="aed_text">AED</span></del></p>
                                                            </div>
                                                            <div>
                                                                <input type="number" id="qty{{ $data->attr_id }}" name="qty"
                                                                value="{{ $data->qty }}" class="qty_cart input-qty qtyy{{ $data->attr_id }}"
                                                                oninput="validateQty(this)"
                                                                onchange="updateQtyy('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}','{{ $data->price }}')" />
                                                                
                                                                <p class="mb-0"><a href="javascript:void(0)" class="remove remove_href" href="javascript:void(0)" onclick="deleteCartsProducts('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}')">Remove<img src="{{ asset('public/front/images/delete_icon.svg') }}" /></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right_box col-lg-4 d-lg-block d-none">
                                                        <p class="price real_price">{{ number_format($data->price, 2) }} <span class="aed_text">AED</span></p>
                                                        <p class="price deleted_price"><del>{{ number_format($data->mrp, 2) }} <span class="aed_text">AED</span></del></p>
                                                        <p><a class="remove_href" href="javascript:void(0)"
                                                            onclick="deleteCartsProducts('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}')">Remove
                                                            <img src="{{ asset('public/front/images/delete_icon.svg') }}" /></a></p>
                                                        
                                                    </div>
                                                </div>
                                                 <?php 
                                                 $subtotal = $subtotal + ($data->price * $data->qty);
                                                 $mrptotal = $mrptotal + ($data->mrp * $data->qty);
                                                 //$total = $total + ($data->mrp * $data->qty);
                                                 $vattotal = $vattotal + ($data->price * $data->qty * 0.05);
                                                 ?>
                                                @endforeach
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="order_cart_box">
                                            <h4 class="summary_title">Order summary</h4>
                                            <div class="checkout_items">
                                                <div class="item_row item_subtotal">
                                                    <p>Item subtotal</p>
                                                    <p>AED <?= number_format($subtotal - $vattotal, 2);?></p>
                                                </div>
                                                 <div class="item_row item_vat">
                                                    <p>VAT Standard</p>
                                                    <p>AED <?= number_format($vattotal, 2);?></p>
                                                </div>
                                                <div class="item_total_row item_total">
                                                    <p>Order total</p>
                                                    <p>AED <?= number_format($subtotal, 2);?></p>
                                                </div>
                                                <p class="saved_text">🎉Congrats! You are saving AED <?= number_format($mrptotal - $subtotal, 2);?></p>
                                            </div>
                                            <div class="aa-cartbox-summary1">
                                                <a href="{{ url('/checkout') }}" class="main-btn w-100 text-center"><img src="{{ asset('public/front/images/checkout.svg') }}" class="pe-3" />Checkout</a>
                                            </div>
                                            <div class="coupon_code_div">
                                                <h5 class="coupon_heading">Coupon Code</h5>
                                                <div class="d-flex">
                                                    <input type="text" placeholder="Enter Coupon Code">
                                                    <button type="button" class="main-btn">Apply Coupon</button>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                               
                    @else
                        <h3>Shopping Bag is empty</h3>
                    @endif
                </div>
                 
            </form>
        </div>
    </section>
    <input type="hidden" id="qty" class="qty" value="1" />
    <form id="frmAddToCart">
        <!--<input type="hidden" id="size_id" name="size_id" />-->
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="pqty" name="pqty" />
        <input type="hidden" id="product_id" name="product_id" />
        @csrf
    </form>
@endsection
@section('scripts')
    <script>
        var totalItems = 0;
        function validateQty(input) {
            // Remove any non-numeric characters and leading zeros
            input.value = input.value.replace(/[^0-9]/g, '').replace(/^0+/, '');
        }

        // function updateQty(pid, size, color, attr_id, price) {
        //     jQuery('#color_id').val(color);
        //     jQuery('#size_id').val(size);
        //     var qty = jQuery('#qty' + attr_id).val();
        //     jQuery('#qty').val(qty)
        //     add_to_cart(pid, size, color);
        //     jQuery('#total_price_' + attr_id).html('Rs ' + qty * price);
        // }
        
        function updateQty(pid, color, attr_id, price) {
            jQuery('#color_id').val(color);
            var qty = jQuery('.qty' + attr_id).val();
            jQuery('.qty').val(qty);
            updateTotalAndSubtotal();
            add_to_cart(pid, color);
            //jQuery('.total_price_' + attr_id).html(qty * price + '<span class="aed_text">AED</span>');
            
        }
        
        function updateQtyy(pid, color, attr_id, price) {
            jQuery('#color_id').val(color);
            var qtyy = jQuery('.qtyy' + attr_id).val();
            jQuery('.qty').val(qtyy);
             updateTotalAndSubtotal();
            add_to_cart(pid, color);
            //jQuery('.total_price_' + attr_id).html('<span class="aed_text">AED</span> ' + qtyy * price);
           
        }
        
        function deleteCartsProducts(pid, color, attr_id) {
            jQuery('#color_id').val(color);
            jQuery('#qty').val(0);
            add_to_cart(pid, color);
            jQuery('#cart_box' + attr_id).hide();

        }
        
        function updateTotalAndSubtotal() {
            var total = 0;
            var subtotal = 0;
            var mrptotal = 0;
            var totalVAT = 0;
            // Reset totalItems to 0 before the loop
            totalItems = 0;
        
            // Iterate through each cart item and calculate total
            jQuery('.main_cart_box').each(function () {
                var qty = parseInt(jQuery(this).find('.qty_cart').val());
                
                var price = parseFloat(jQuery(this).find('.real_price').text().replace(/[^0-9.]/g, ''));
                
                if (!isNaN(price)) {
                    total += qty * price;
        
                    // Increment the totalItems count for each cart item
                    totalItems++;
                    
                    var itemSubtotal = qty * price;
                    var vatAmount = itemSubtotal * 0.05;
                    totalVAT += vatAmount;
                    
                }
                
                var mrp = parseFloat(jQuery(this).find('.deleted_price').text().replace(/[^0-9.]/g, ''));
                if (!isNaN(mrp)) {
                    mrptotal += qty * mrp
                }
            });
        
            // Update subtotal and total in the UI
            jQuery('.item_subtotal p:last-child').text('AED ' + (total-totalVAT).toFixed(2));
            jQuery('.item_total p:last-child').text('AED ' + total.toFixed(2));
            jQuery('.item_vat p:last-child').text('AED ' + totalVAT.toFixed(2));
            jQuery('.saved_text').text('🎉Congrats! You are saving AED ' + (mrptotal-total).toFixed(2));
        
            // Check if there's more than one item and update visibility of order_cart_box
            if (totalItems > 0) {
                jQuery('.heading_cart p').text(totalItems + ' Item');
                jQuery('.order_cart_box').show();
            } else {
                jQuery('.order_cart_box').hide();
            }
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
        //                         jQuery('.aa-cartbox-summary1').remove();
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
                            jQuery('.aa-cartbox-summary1').hide();
                        } else {
                            if(result.msg == 'removed'){
                                Command: toastr["error"]("Product " + result.msg);
                                updateTotalAndSubtotal();
                                window.location.href = window.location.href;
                            }
                            else{
                                 Command: toastr["success"]("Product " + result.msg);
                                 jQuery('.aa-cartbox-summary1').show();
                            }
                            if (result.totalItem == 0) {
                                jQuery('.aa-cart-notify').html('0');
                                jQuery('.aa-cartbox-summary1').remove();
                            } else {
                               
                                // jQuery('.aa-cart-notify').html(result.totalItem);
                                // var html = '<ul>';
                                // jQuery.each(result.data, function(arrKey, arrVal) {
                                //     totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) *
                                //         parseInt(arrVal.price));
                                //     html += '<li><a class="aa-cartbox-img" href="#"><img src="' +
                                //         PRODUCT_IMAGE + '/' + arrVal.image +
                                //         '" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">' +
                                //         arrVal.name + '</a></h4><p> ' + arrVal.qty + ' * AED  ' + arrVal
                                //         .price + '</p></div></li>';
                                // });

                            }
                            
                            // html +=
                            //     '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price"> ' +
                            //     totalPrice + '<span class="aed_text">AED</span></span></li>';
                            // html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="cart">Cart</a>';

                            // jQuery('.aa-cartbox-summary').html(html);
                        }
                    }
                });
            }
        }
        
    </script>

@endsection
