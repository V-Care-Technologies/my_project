@extends('front.layouts.app')
@section('page_title','Login Register')

@section('content')
<section class="breadcrub_section">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            <span class="login_breadcrub">LogIn</span>
            <span class="register_breadcrub">Register</span>
          </li>
        </ol>
      </nav>
    </div>
  </section>
  <section class="login_section">
      <div class="container">
          <div class="row inner_login_row">
              <div class="col-lg-6 col-12">
                  <div class="login_shape_bg">
                      <img src="{{ asset('public/front/images/login_shape.svg')}}" class="login_shape">
                  </div>
              </div>
              <div class="col-lg-6 col-12 login_col_box">
                  <div class="inner_login_col_box">
                      <div class="tabs_row"> 
                          <div class="changable_tab">
                            <div class="radio_container">
                              <input class="login_change" type="radio" name="radio" id="login" value="login" checked>
                              <label for="login">Log in</label>
                              <input class="login_change" type="radio" name="radio" id="register" value="register">
                              <label for="register">Register</label> 
                            </div>
                          </div>
                      </div>
                       
                      <form class="login_form main_form validate" id="frmLogin" method="" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate"> 
                        @csrf
                          <div class="row"> 
                              <div class="line_input_box col-12">
                                <label class="form-label" >E-mail</label>
                                <input  type="email" name="str_login_email"  class="appointment_input" placeholder="E-mail" data-validate="required" required  data-message-required="Enter Your Email">
                              </div> 
                              <div class="line_input_box col-12">
                                <label class="form-label" >Password</label>
                                <input  type="password" name="str_login_password"  class="appointment_input" placeholder="Password" data-validate="required,minlength[6]" required  data-message-required="Enter Your Password" data-message-minlength="Enter minimum 6 digits">
                              </div>  
                              <div id="login_msg" style="color:red;"></div>
                              <div class="mb-5 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked readonly>
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                              </div>
                              <!--<div class="text-center">-->
                              <!--  <a href="forgot_password.html" class="forgot_text">Forgot Password ?</a>-->
                              <!--</div>-->
                              <div class="banner_btn_grp main_btn text-center mb-3">
                                <button type="submit" id="btnForgot" class="main-btn border-0">Login</button>
                              </div> 
                              <!--<div class="form_divider">-->
                              <!--  <h4>OR</h4>-->
                              <!--</div>-->
                              <!--<div class="social_login">-->
                              <!--  <a href="#"><img src="{{ asset('public/front/images/facebook.svg')}}"></a>-->
                              <!--  <a href="#"><img src="{{ asset('public/front/images/google.svg')}}"></a>-->
                              <!--</div>-->
                          </div> 
                      </form>
                      <form class="register_form main_form validate" id="frmRegistration"  method="" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
                        @csrf
                            <div class="row"> 
                              <div class="line_input_box col-6">
                                <label class="form-label" >First Name</label>
                                <input  type="text" class="appointment_input" name="name" placeholder="First Name" data-validate="required" required  data-message-required="Enter Your First Name">
                              </div> 
                              <div class="line_input_box col-6">
                                <label class="form-label" >Last Name</label>
                                <input  type="text" class="appointment_input" name="last_name" placeholder="Last Name" data-validate="required" required  data-message-required="Enter Your Last Name">
                              </div>  
                              <div class="line_input_box col-12">
                                <label class="form-label" >Email</label>
                                <input  type="email" class="appointment_input" name="email" placeholder="Email" data-validate="required" required  data-message-required="Enter Your Email">
                              </div>  
                              <div class="line_input_box col-12">
                                <label class="form-label" >Password</label>
                                <input  type="password" class="appointment_input" name="password" placeholder="Password" data-validate="required,minlength[6]" required  data-message-required="Enter Your Password" data-message-minlength="Enter minimum 6 digits">
                              </div>   
                              <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2" checked readonly>
                                <label class="form-check-label" for="exampleCheck2">I agree all statements in Terms Of Service</label>
                              </div> 
                              <div class="banner_btn_grp main_btn text-center mb-3">
                                <button type="submit" id="btnRegistration" class="main-btn border-0">Register</button>
                              </div> 
                              <!--<div class="form_divider">-->
                              <!--  <h4>OR</h4>-->
                              <!--</div>-->
                              <!--<div class="social_login">-->
                              <!--  <a href="#"><img src="{{ asset('public/front/images/facebook.svg')}}"></a>-->
                              <!--  <a href="#"><img src="{{ asset('public/front/images/google.svg')}}"></a>-->
                              <!--</div>-->
                          </div>  
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
   
@endsection