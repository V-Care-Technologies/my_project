@extends('front.layouts.app')
@section('page_title','Contact US')
@section('content')
 <section class="breadcrub_section">
          <div class="container">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact US</li>
              </ol>
            </nav>
          </div>
        </section> 
        <section class="contact_section">
           <div class="container">
              <div class="row contact_row">
                 <div class="col-lg-5">
                    <div class="contact_part">
                       <h5>CONTACT US</h5>
                       <p class="contact_text">We’d love to hear from you! You can get in touch with our friendly team now</p>
                       <div class="contact_box">
                          <div class="icon_box">
                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.30708 1.82619C8.16583 1.70869 8.88749 2.23411 9.22916 2.91702L10.0696 4.59744C10.5358 5.52994 10.2679 6.62411 9.56124 7.31244C9.14374 7.71869 8.72416 8.18286 8.48083 8.59244C8.46471 8.62163 8.45968 8.65567 8.46666 8.68827C8.69166 9.90744 9.51791 11.112 10.255 11.9758C10.2921 12.017 10.3404 12.0463 10.3941 12.0602C10.4477 12.074 10.5043 12.0718 10.5567 12.0537L12.2129 11.5362C12.6591 11.3967 13.1382 11.4039 13.58 11.5565C14.0218 11.7092 14.403 11.9994 14.6679 12.3845L15.8667 14.1279C16.1917 14.6012 16.3562 15.2429 16.1071 15.8599C15.8846 16.4112 15.4542 17.2062 14.6712 17.7349C13.8587 18.2833 12.7458 18.4916 11.2896 17.9924C9.66249 17.4341 8.12541 16.0341 6.85083 14.2437C5.56874 12.442 4.51333 10.1916 3.87333 7.84494C3.26874 5.62911 3.63374 4.13744 4.49291 3.17702C5.32166 2.25036 6.50916 1.93577 7.30708 1.82619ZM8.29749 3.38286C8.10708 3.00244 7.76749 2.81452 7.44874 2.85827C6.73999 2.95577 5.85249 3.21952 5.26958 3.87161C4.71708 4.48952 4.33458 5.57786 4.87791 7.57077C5.48833 9.80744 6.49333 11.9449 7.69958 13.6395C8.91333 15.3449 10.2925 16.5491 11.6275 17.007C12.8171 17.4149 13.5817 17.2133 14.0883 16.8716C14.6242 16.5095 14.9537 15.9341 15.1412 15.4699C15.2271 15.2574 15.19 14.9824 15.0083 14.7183L13.8096 12.9749C13.6709 12.7732 13.4712 12.6212 13.2398 12.5412C13.0084 12.4611 12.7574 12.4574 12.5237 12.5304L10.8675 13.0479C10.3725 13.2024 9.81499 13.0645 9.46291 12.652C8.69583 11.7533 7.71833 10.3749 7.44208 8.87702C7.38927 8.59629 7.44021 8.30594 7.58541 8.05994C7.90124 7.52911 8.40124 6.98786 8.83416 6.56619C9.25708 6.15452 9.37708 5.54202 9.13791 5.06327L8.29749 3.38286Z" fill="#261E05"></path>
                             </svg>
                          </div>
                          <div>
                             <p class="contact_key">GIVE  US  A CALL</p>
                             <a href="tel:{{ $settings->mobile_no }}" class="contact_value">{{ $settings->mobile_no }}</a>
                          </div>
                        </div> 
                        <div class="contact_box">
                            <div class="icon_box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                  <path d="M1.45935 2.9114C1.26292 2.17569 2.01864 1.54712 2.70649 1.87497L18.0615 9.19569C18.7401 9.51854 18.7401 10.4843 18.0615 10.8071L2.70721 18.1285C2.01935 18.4557 1.26364 17.8271 1.46007 17.0914L3.35721 10.0014L1.45935 2.9114ZM4.32221 10.5371L2.59507 16.9943L17.2629 10.0014L2.59507 3.00854L4.32221 9.46569H12.3215C12.4636 9.46569 12.5998 9.52213 12.7003 9.62259C12.8008 9.72306 12.8572 9.85932 12.8572 10.0014C12.8572 10.1435 12.8008 10.2797 12.7003 10.3802C12.5998 10.4807 12.4636 10.5371 12.3215 10.5371H4.32221Z" fill="#261E05"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="contact_key">SEND US AN EMAIL</p>
                                <a href="mailto:{{ $settings->email }}" class="contact_value">{{ $settings->email }}</a>
                            </div>
                       </div>
                       <div class="contact_box">
                          <div class="icon_box">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                  <path d="M9.99944 2.10712C11.8465 2.10712 13.6179 2.84085 14.9239 4.14691C16.23 5.45297 16.9637 7.22436 16.9637 9.0714C16.9637 12.0143 14.8959 15.2214 10.8137 18.7271C10.5867 18.9221 10.2973 19.0292 9.99811 19.0289C9.69887 19.0287 9.40966 18.9211 9.18301 18.7257L8.91301 18.4914C5.01158 15.0771 3.03516 11.9485 3.03516 9.0714C3.03516 7.22436 3.76889 5.45297 5.07495 4.14691C6.38101 2.84085 8.1524 2.10712 9.99944 2.10712ZM9.99944 3.17855C8.43656 3.17855 6.93769 3.7994 5.83256 4.90452C4.72744 6.00965 4.10658 7.50852 4.10658 9.0714C4.10658 11.5728 5.92658 14.455 9.61658 17.6835L9.88301 17.9143C9.91541 17.9421 9.95672 17.9574 9.99944 17.9574C10.0422 17.9574 10.0835 17.9421 10.1159 17.9143C13.9844 14.5914 15.8923 11.6321 15.8923 9.0714C15.8923 8.29754 15.7399 7.53126 15.4437 6.8163C15.1476 6.10135 14.7135 5.45173 14.1663 4.90452C13.6191 4.35732 12.9695 3.92326 12.2545 3.62711C11.5396 3.33097 10.7733 3.17855 9.99944 3.17855ZM9.99944 6.39283C10.7098 6.39283 11.3911 6.67504 11.8935 7.17737C12.3958 7.6797 12.678 8.361 12.678 9.0714C12.678 9.7818 12.3958 10.4631 11.8935 10.9654C11.3911 11.4678 10.7098 11.75 9.99944 11.75C9.28904 11.75 8.60774 11.4678 8.10541 10.9654C7.60308 10.4631 7.32087 9.7818 7.32087 9.0714C7.32087 8.361 7.60308 7.6797 8.10541 7.17737C8.60774 6.67504 9.28904 6.39283 9.99944 6.39283ZM9.99944 7.46426C9.5732 7.46426 9.16442 7.63358 8.86302 7.93498C8.56162 8.23638 8.3923 8.64516 8.3923 9.0714C8.3923 9.49764 8.56162 9.90643 8.86302 10.2078C9.16442 10.5092 9.5732 10.6785 9.99944 10.6785C10.4257 10.6785 10.8345 10.5092 11.1359 10.2078C11.4373 9.90643 11.6066 9.49764 11.6066 9.0714C11.6066 8.64516 11.4373 8.23638 11.1359 7.93498C10.8345 7.63358 10.4257 7.46426 9.99944 7.46426Z" fill="#261E05"></path>
                            </svg>
                          </div>
                          <div>
                             <p class="contact_key">Location</p>
                             <span class="contact_value">{{ $settings->address }}</span>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <form id="frmContact" method="post" class="validate contact_form" enctype="multipart/form-data" accept-charset="utf-8"> 
                         @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input_box">
                                    <p>First Name</p>
                                    <input type="text" placeholder="First Name" name="first_name" required data-validate="required" data-message-required="First Name required">
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="input_box">
                                    <p>Last Name</p>
                                    <input type="text" placeholder="Last Name" name="last_name">
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="input_box">
                                    <p>Email Address</p>
                                    <input type="text" placeholder="Email Address" name="email" required data-validate="required" data-message-required="Email required">
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="input_box">
                                    <p>Phone</p>
                                    <input type="text" placeholder="Phone" name="phone" required data-validate="required" data-message-required="Phone required">
                                </div> 
                            </div>
                            <div class="col-lg-12">
                                <div class="input_box">
                                    <p>Send Message</p>
                                    <textarea placeholder="Send Message" rows="3" name="message" required data-validate="required" data-message-required="Message required"></textarea>
                                </div> 
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="main-btn border-0">Submit</button>
                            </div>
                        </div>
                    </form>
                 </div>
              </div>
           </div>
        </section>
   
@endsection
