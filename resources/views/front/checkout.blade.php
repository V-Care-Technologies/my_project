@extends('front.layouts.app')
@section('page_title','Checkout')

@section('content')
    <section class="breadcrub_section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Summary</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="payment_summary">
        <div class="container"> 
         <form id="frmPlaceOrder" class="validate"  enctype="multipart/form-data" accept-charset="utf-8"> 
            <div class="products_row d-none">
                @php
                    $totalPrice = 0;
                    @endphp
                    @foreach ($cart_data as $list)
                        @php
                       
                            $totalPrice = $totalPrice + $list->price * $list->qty;
                        @endphp
                       
                        <div class="row product_row">
                            <div class="col-lg-6">
                                <div class="product_box_main">
                                    <span class="product_box"><img
                                            src="{{ asset('storage/app/public/media/' . $list->color_image) }}"
                                            class="cart_product"></span>
                                    <!--<span class="product_name">{{ $list->title }} ({{ $list->color }},-->
                                    <!--    {{ $list->size }}Kg)</span>-->
                                    <div class="product_name1 d-lg-block d-none">    
                                        <p class="product_title">{{ $list->title }}</p>
                                        <div><span class="heading_span">Color : </span><span class="detail_span">{{ $list->color }}</span></div>
                                    </div>
                                    <div class="d-lg-none d-block mobile_cart">
                                        <div class="name_box">
                                        <span class="product_name">{{ $list->title }}</span> 
                                        
                                        
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Color</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text price">{{ $list->color }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Qty</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text">{{ $list->qty }}</span>
                                            </div>
                                        </div>
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Price</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text">{{ number_format($list->price, 2) }} <span class="aed_text">AED</span></span>
                                            </div>
                                        </div>
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Subtotal</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text">
                                                    <span id="total_price_28" class="price total_price_28">
                                                        {{ number_format(($list->price * $list->qty), 2) }}
                                                        <span class="aed_text">AED</span> 
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                     </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 d-lg-block d-none">
                                <h4 class="product_price">
                                    <div><span class="heading_span">Qty : </span><span class="detail_span">{{ $list->qty }}</span></div> 
                                </h4>
                            </div>
                            <div class="col-lg-2 col-6 d-lg-block d-none">
                                <h4 class="product_price">
                                    <div><span class="heading_span">Price : </span><span class="detail_span">{{ number_format($list->price, 2) }} <span class="aed_text">AED</span></span></div>  
                                </h4>
                            </div>
                            <div class="col-lg-2 col-6  d-lg-block d-none">
                                <h4 class="product_price">
                                    <div><span class="heading_span">Subtotal : </span><span class="detail_span">{{ number_format(($list->price * $list->qty), 2) }} <span class="aed_text">AED</span></span></div> 
                                 </h4>
                            </div>

                        </div>
                    @endforeach 
            </div> 
            <div class="row form_row">
                <div class="col-lg-8 col-12">
                    <div class="">
                         <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="input_box">
                                <h5>Full Name</h5>
                                <input type="text" name="name" value="{{ $customers['name'] }}"
                                    placeholder="Full Name" required data-validate="required" required  data-message-required="Enter Your Full Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12"></div>
                        <!--<div class="col-lg-6">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>Last Name</h5>-->
                        <!--        <input type="text" name="last_name" value="{{ $customers['last_name'] }}"-->
                        <!--            placeholder="Last Name" required data-validate="required" required  data-message-required="Enter Your Last Name">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-lg-6 col-12">
                            <div class="input_box">
                                <h5>Email</h5>
                                <input type="email" name="email" value="{{ $customers['email'] }}"
                                    placeholder="Email" data-validate="required" required  data-message-required="Enter Your Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input_box">
                                <h5>Phone Number</h5>
                                <input type="text"name="mobile" required value="{{ ($customers['mobile'])?$customers['mobile']:"+971" }}"
                                    id="mobile_code" class=" appointment_input" placeholder="+971 9999999999" data-validate="required" required  data-message-required="Enter Your Phone Number">
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="input_box">
                                <h5>Address.....</h5>
                                <textarea placeholder="Address....." name="address" rows="1" data-validate="required" required  data-message-required="Enter Your Address">{{ $customers['address'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input_box">
                                <h5>Area</h5>
                                <input type="text"name="area" required 
                                            value="{{ $customers['area'] }}" placeholder="Area" data-validate="required" data-message-required="Enter Your Area">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="input_box">
                                <h5>City</h5>
                                <select class="form-control" name="city" data-validate="required" required="" data-message-required="Select City">
                                    @foreach($cities as $cityy)
                                   
                                    <option value="{{ $cityy->name }}" {{ ($customers['city']==$cityy->name)?"selected":"" }}>{{ $cityy->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                             <div class="input_box">
                                <h5>Country</h5>
                                <input type="text"name="country" 
                                            value="{{ $customers['country'] }}" placeholder="Country" readonly>
                            </div>
                        </div>
                        <!--<div class="col-lg-6 col-12">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>State</h5>-->
                        <!--        <input type="text"name="state" required -->
                        <!--                    value="{{ $customers['state'] }}" placeholder="State" data-validate="required" data-message-required="Enter Your State">-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--<div class="col-lg-6">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>Enter your PIN code</h5>-->
                        <!--        <input type="number" name="zip" value="{{ $customers['zip'] }}"-->
                        <!--            required class=" appointment_input" placeholder="PIN code" data-validate="required,minlength[6],maxlength[6]" required  data-message-required="Enter Your PIN code" data-message-minlength="Enter only 6 digits" data-message-maxlength="Enter only 6 digits">-->
                        <!--    </div>-->
                        <!--</div>-->
                        {{-- <div class="col-lg-12">
                            <div class="input_box">
                                <h5>Landmark</h5>
                                <input type="text" name="phone" id="mobile_code" class=" appointment_input" placeholder="Phone Number">
                            </div>
                        </div> --}}
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                     <div class="cart_total_box">
                        <div class="items_total">
                            <table class="total_table w-100"> 
                                    @php
                                        $totalPrice = 0;
                                        $itemSubtotal = 0;
                                        $totalVAT = 0;
                                    @endphp
                                    @foreach ($cart_data as $list)
                                        @php
                                            $totalPrice = $totalPrice + $list->price * $list->qty;
                                            $itemSubtotal = $list->price * $list->qty;
                                            $vatAmount = $itemSubtotal * 0.05;
                                            $totalVAT = $totalVAT + $vatAmount;
                                        @endphp
                                    @endforeach    
                                <tfoot>
                                    <tr class="subtotal_row">
                                        <td>SubTotal</td>
                                        <td id="total_price">{{ number_format(($totalPrice - $totalVAT), 2) }}<span class="aed_text">AED</span></td>
                                    </tr>
                                    <tr class="subtotal_row">
                                        <td>Estimated Shipping</td>
                                        <td id="total_price">FREE</td>
                                    </tr>
                                    <tr class="subtotal_row">
                                        <td>VAT Standard(Inclusive)</td>
                                        <td id="total_price">{{ number_format($totalVAT, 2) }}<span class="aed_text">AED</span></td>
                                    </tr>
                                    <tr class="main_row">
                                        <td>Order Total</td>
                                        <td id="total_price">{{ number_format($totalPrice, 2) }}<span class="aed_text">AED</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div> 
                    <h4 class="coupon_heading">Coupon Code</h4>
                        <div class="aa-payment-method coupon_code d-flex justify-content-center">
                            <div class="remove_code">

                            </div>
                            <div class="hide show_coupon_box" id="coupon_box" style="display:none;">
                                <p class="d-flex align-items-center justify-content-center pt-3 mb-3 ">
                                    <span> Coupon Code : <span id="coupon_code_str"></span> <a href="javascript:void(0)"
                                            onclick="remove_coupon_code()" class="remove_coupon_code_link"><i
                                                class="fa-regular fa-trash-can"></i></a></span>
                                </p>
                            </div>
                            <input type="text" placeholder="Coupon Code"
                                class="form-control col-7 w-auto apply_coupon_code_box" name="coupon_code"
                                id="coupon_code">
                            <button type="button" class="main-btn col-5 apply_coupon_code_box border-0"
                                onclick="applyCouponCode()">Apply Coupon</button>
                            <div id="coupon_code_msg"></div>
                        </div>
                        <br />
                        <div class="payment_footer">
                            <p>Safe and secure payments Easy 100% Authenic products</p>
                            <div class="aa-payment-method">
                                <div class="payment_method d-flex align-items-center justify-content-center">
                                    <div class="cod_method">
                                        <input type="radio" id="cod" name="payment_type" value="COD" checked>
                                        <label for="cod" class="bordered_btn w-100">Cash on Delivery </label>
                                    </div>
                                    <div class="cod_method">
                                        <input type="radio" id="online" name="payment_type" value="online"   disabled>
                                        <label for="online" class="bordered_btn w-100 ms-3" style="opacity:0.6">Pay Online</label>
                                    </div>
                                    <!--<div class="online_method">-->
                                    <!--    <input type="radio" id="online" name="payment_type" value="Online" disabled>-->
                                    <!--    <label for="online" class="bordered_btn w-100">Online Payment</label>-->
                                    <!--</div>-->
                                    <!--<div class="instamogo">-->
                                    <!--    <input type="radio" id="instamojo" name="payment_type" value="Gateway">-->
                                    <!--    <label for="instamojo" class="bordered_btn w-100 ms-3">Via Instamojo </label>-->
                                    <!--</div>-->
                                </div>
                                <div class="submit_btn mt-5 m-auto text-center">
                                    <button type="submit" class="aa-browse-btn main-btn border-0"
                                        id="btnPlaceOrder">Place Order</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div> 
           @csrf
        </form>   
            
        </div>
    </section>
    @endsection
    @section('scripts')
    <!--<script src="https://code.jquery.com/jquery-3.7.0.min.js"-->
    <!--    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>-->
    <script>
        function applyCouponCode() {
            jQuery('#coupon_code_msg').html('');
            jQuery('#order_place_msg').html('');
            jQuery('.show_coupon_box').hide();
            var coupon_code = jQuery('#coupon_code').val();
            if (coupon_code != '') {
                jQuery.ajax({
                    type: 'post',
                    url: "{{ url('apply_coupon_code') }}",
                    data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
                    success: function(result) {
                        console.log(result.status);
                        if (result.status == 'success') {
                            jQuery('.show_coupon_box').removeClass('hide');
                            jQuery('#coupon_code_str').html(coupon_code);
                            jQuery('#total_price').html('AED ' + result.totalPrice);
                            jQuery('.apply_coupon_code_box').hide();
                            jQuery('#coupon_box').show();
                        } else {

                        }
                        jQuery('#coupon_code_msg').html(result.msg);
                    }
                });
            } else {
                jQuery('#coupon_code_msg').html('Please enter coupon code');
            }
        }

         $('#frmPlaceOrder').submit(function(e) {
        var submitButton = $('#btnPlaceOrder'); // Replace 'btnPlaceOrder' with the actual ID or class of your submit button
        if (submitButton.prop('disabled')) {
            return false; // If the button is already disabled, ignore the click
        }

        $('#order_place_msg').html("Please wait...");
        e.preventDefault();

        submitButton.prop('disabled', true); // Disable the submit button

        $.ajax({
            url: '{{ url('/place_order') }}',
            data: $('#frmPlaceOrder').serialize(),
            type: 'post',
            beforeSend: function() {
                $('.overlay-wrapper').show();
            },
            success: function(result) {
                if (result.status == 'success') {
                    if (result.payment_url != '') {
                        $('.overlay-wrapper').hide();
                        window.location.href = result.payment_url;
                    } else {
                        $('.overlay-wrapper').hide();
                        toastr.success("Order Placed Successfully");
                        window.location.href = "./order_placed";
                    }
                } else if (result.status == 'error') {
                    $('.overlay-wrapper').hide();
                    toastr.error(result.msg);
                }
                $('#order_place_msg').html(result.msg);
            },
            complete: function() {
                submitButton.prop('disabled', false); // Enable the submit button after completion
            }
        });
    });


        function remove_coupon_code() {
            jQuery('#coupon_code_msg').html('');
            var coupon_code = jQuery('#coupon_code').val();
            jQuery('#coupon_code').val('');
            if (coupon_code != '') {
                jQuery.ajax({
                    type: 'post',
                    url: '{{ url('remove_coupon_code') }}',
                    data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
                    success: function(result) {
                        if (result.status == 'success') {
                            jQuery('.show_coupon_box').addClass('hide');
                            jQuery('#coupon_code_str').html('');
                            jQuery('#total_price').html('AED ' + result.totalPrice);
                            jQuery('.apply_coupon_code_box').show();
                            jQuery('#coupon_box').hide();
                        } else {

                        }
                        jQuery('#coupon_code_msg').html(result.msg);
                    }
                });
            }
        }
    </script>
@endsection
