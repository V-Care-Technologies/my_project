@extends('front.layouts.app')
@section('page_title', 'Order Return')
@section('order_active','active')

@section('content')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <div class="aa-catg-head-banner-area">
            <div class="container">

            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form id="frmReturn" class="validate" data-route="{{ route('front.sentreturn') }}" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                                 @csrf
                                 <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input_box">
                                            <h5>Type</h5>
                                            <select name="type" class="form-control home3 select2 col mySelect2">
                                                <option value="1">Return</option>
                                                <option value="2">Exchange</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input_box">
                                            <h5>Photo<span class="text-danger">*</span></h5>
                                            <input type="file" name="image" data-validate="required" required  data-message-required="Select Image">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input_box">
                                            <h5>Reason<span class="text-danger">*</span></h5>
                                            <input type="text" name="reason" value="" class="appointment_input"  placeholder="Reason" data-validate="required" required  data-message-required="Enter Reason">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input_box">
                                            <h5>Phone Number</h5>
                                            <input type="text" name="phone" value="{{$orders->mobile}}" class="appointment_input"  placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <input type="hidden" name="orders_id" value="{{$orders->id}}">
                                    <div class="col-lg-12 submit_row">
                                        <button type="submit" class="main-btn border-0">Save</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
