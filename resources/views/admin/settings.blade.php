
@extends('admin.layouts.app')
@section('page_title','Manage Site Settings')
@section('settings_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('settings.manage-settings-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Category</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Title<span class="text-danger small">*</span></h5> 
                                         <input type="text" value="{{$settings->title}}" placeholder="Title" name="title" data-validate="required" required  data-message-required="Please Enter Title">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Logo @if($settings->logo=='')<span class="text-danger small">*</span>@endif</h5> 
                                         <input type="file" name="logo" @if($settings->logo=='') data-validate="required" required  data-message-required="Please Select Logo" @endif>              
                                     </div>
                                     @if($settings->logo!='')
                                         <a href="{{asset('public/front/images/'.$settings->logo)}}" target="_blank"><img width="100px" src="{{asset('public/front/images/'.$settings->logo)}}"/></a>
                                     @endif
                                </div>
                               
                               <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Mobile No.<span class="text-danger small">*</span></h5> 
                                         <input type="text" value="{{$settings->mobile_no}}" placeholder="Mobile Number" name="mobile_no" data-validate="required" required  data-message-required="Please Enter Mobile Number">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Email</h5> 
                                         <input type="email" value="{{$settings->email}}" placeholder="Email" name="email">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Address</h5> 
                                         <textarea placeholder="Address" name="address">{{$settings->address}}</textarea>            
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Instagram Link</h5> 
                                         <input type="text" value="{{$settings->insta_link}}" placeholder="Instagram Link" name="insta_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Facebook Link</h5> 
                                         <input type="text" value="{{$settings->facebook_link}}" placeholder="Facebook Link" name="facebook_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">LinkedIn Link</h5> 
                                         <input type="text" value="{{$settings->linked_link}}" placeholder="LinkedIn Link" name="linked_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Pinterest Link</h5> 
                                         <input type="text" value="{{$settings->pinterest_link}}" placeholder="Pinterest Link" name="pinterest_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Flipkart Link</h5> 
                                         <input type="text" value="{{$settings->flipkart_link}}" placeholder="Flipkart Link" name="flipkart_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Amazon Link</h5> 
                                         <input type="text" value="{{$settings->amazon_link}}" placeholder="Amazon Link" name="amazon_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Top Line</h5> 
                                         <input type="text" value="{{$settings->top_line}}" placeholder="Top Line" name="top_line">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Shop Now Link</h5> 
                                         <input type="text" value="{{$settings->shopnow_link}}" placeholder="Shop Now Link" name="shopnow_link">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Brand Registry</h5> 
                                         <input type="text" value="{{$settings->brand_registry}}" placeholder="Brand Registry" name="brand_registry">              
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="button_row mt-4"> 
                        <a href="{{route('dashboard')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection