@extends('front.layouts.app')
@section('page_title','Security Policy')

@section('content')
 <section class="breadcrub_section">
          <div class="container">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Security Policy</li>
              </ol>
            </nav>
          </div>
        </section>
        <section class="page_heading">
            <div class="container">
                <h5>Security Policy</h5>
                        <p class="normal_text">Myts Store (from here on referred to as ‘we’, ‘our’, ‘us’) is committed to maintaining the utmost security for your account details, personal information and payments.  We are always here to answer any questions you might have about security. Just contact us by <a href="{{ route('front.contact-us') }}">clicking here</a> if you have any questions or concerns that haven’t been answered by this document.</p>
                            <h6>Log in Details</h6>
                            <p class="normal_text">Whenever you log in or make a payment on Myts Store, we employ Secure Socket Layers (SSLs), which encrypt data so it cannot be easily accessed by third parties who might have unauthorized access to your computer. We never store any financial details.</p>
                            
                            
                            <h6>Privacy</h6>
                            <p class="normal_text">All the personal information we hold about you is stored on secure servers. For more details, see our Privacy Policy.</p>
                            
                            
                            <h6>Payment Security</h6>
                            <p class="normal_text">Whilst your payment is being authorized, look out for https// in the address line of the page you are directed to. This indicates that your data is being transferred using Secure Socket Layer (SSL) protection. We use industry standard data encryption to make sure no unauthorized parties can access your payment details. We have also introduced secure code services for customers using Visa and Mastercard to shop on Myts Store.</p>
                            
                            
                            <h6>Phishing and Internet Fraud</h6>
                            <p class="normal_text">Phishing refers to the practice of fraudulently contacting people and asking them to provide confidential information, such as bank details, home address and date of birth. From time to time, we will contact our customers asking them to confirm personal details relevant to their order, such as shipping address or telephone number. If you are in any doubt about whether an email you have recieved is in fact from Myts Store, please contact our Customer Service Team by<a href="{{ route('front.contact-us') }}">clicking here</a>before replying, so we can confirm that the email was in fact sent by us. </p>
                   
                            
                            
                            <h6>Cookies</h6>
                            <p class="normal_text">Cookies are small text files which your computer stores when you visit certain web pages. We use cookies to help personalize your experience on Myts Store and to track trends in traffic. Cookies do not collect personally identifiable information about you. You must enable cookies on your computer to purchase any of our products. To find out more about how and why we use Cookies, see our Privacy Policy.</p>
                   
            </div>
        </section>
        
@endsection