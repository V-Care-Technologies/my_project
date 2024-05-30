@extends('front.layouts.app')
@section('page_title','Order Placed')
@section('account_active','active')

@section('content')

  <!-- product category -->
  <section class="my_account">
    <div class="container">
        <div class="row account_row">
            
            <div class="col-lg-12">
                <form id="save-form" class="validate" action="{{url('/my-account/update')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>Full Name</h5>
                                <input id="firstName" type="text" name="name" value="{{$first_name}}" class="appointment_input"  placeholder="Full Name" data-validate="required" required  data-message-required="Enter Full Name">
                            </div>
                        </div>
                        <!--<div class="col-lg-6">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>Last Name</h5>-->
                        <!--        <input id="lastName" type="text" name="last_name" value="{{$last_name}}" placeholder="Last Name" data-validate="required" required  data-message-required="Enter Last Name">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>Email</h5>
                                <input id="email" type="email" placeholder="Email" value="{{$email}}" name="email" data-validate="required" required  data-message-required="Enter Email">
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>Mobile Number</h5>
                                <input id="mobileNumber" type="text" value="{{ ($phone)?$phone:"+971" }}" placeholder="+971 9999999999" name="phone" data-validate="required" required  data-message-required="Enter Mobile Number"> 
                            </div>
                        </div> 
                        <div class="col-lg-12">
                            <div class="input_box">
                                <h5>Address.....</h5>
                                <textarea id="address" type="text" name="address" placeholder="Address....." rows="4" data-validate="required" required  data-message-required="Enter Address">{{$address}}</textarea>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>Area</h5>
                                <input type="text"name="area" required 
                                            value="{{ $area }}" placeholder="Area" data-validate="required" data-message-required="Enter Your Area">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>City</h5>
                               
                                <select class="form-control" name="city" data-validate="required" required="" data-message-required="Select City">
                                    @foreach($cities as $cityy)
                                   
                                    <option value="{{ $cityy->name }}" {{ ($city==$cityy->name)?"selected":"" }}>{{ $cityy->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input_box">
                                <h5>Country</h5>
                                <input type="text"name="country" 
                                            value="{{ $country }}" placeholder="Country" readonly>
                            </div>
                        </div>
                        <!--<div class="col-lg-6">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>State</h5>-->
                        <!--        <input type="text"name="state" required -->
                        <!--                    value="{{ $state }}" placeholder="State" data-validate="required" data-message-required="Enter Your State">-->
                        <!--    </div>-->
                        <!--</div>-->
                         
                        <!--<div class="col-lg-6">-->
                        <!--    <div class="input_box">-->
                        <!--        <h5>PIN code</h5>-->
                        <!--        <input id="zip" type="number" placeholder="PIN code" name="zip" value="{{$zip}}" data-validate="required,maxlength[6],minlength[6]" required data-message-required="Enter PIN code" data-message-minlength="Enter only 6 digits" data-message-maxlength="Enter only 6 digits" aria-required="true"> -->
                        <!--    </div>-->
                        <!--</div> -->
                        
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="col-lg-12 submit_row">
                            <button type="submit" class="main-btn border-0">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection