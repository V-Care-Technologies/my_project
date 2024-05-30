@extends('front.layouts.app')
@section('page_title','Returns Policy')

@section('content')
 <section class="breadcrub_section">
          <div class="container">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Returns Policy</li>
              </ol>
            </nav>
          </div>
        </section>
        <section class="page_heading">
            <div class="container">
                       
                    <h5>How do I return an item(s)?</h5> 
                    <p class="normal_text">We are here to offer you a smooth return process for your purchased item(s). Any order that has been shipped within UAE, falls within a returnable category and is within the 7 days limit from the date of delivery, can be processed for return. Here are very simple steps that you can follow if you want to return item(s).</p> 
                    <p class="normal_text">1. Items may be returned via our free home pick-up service.</p> 
                    <p class="normal_text">2. Through this service, a courier will collect your parcel containing the items you wish to exchange or return.</p> 
                    <p class="normal_text">3. Once your return request has been received, our team will contact you to arrange the pickup of the item(s).</p> 
                    <p class="normal_text">4. The pickup will be arranged within 3 working days for UAE.</p> 
                    <p class="normal_text">5. Kindly note that the items must be unused, must not be broken or damaged and in its original package. Certain items are non-returnable, please refer to the product list in the clause below.</p> 
                    <p class="normal_text">In the event that any damaged product is delivered to you, you have until 24 hours from the time of delivery to file a return request alongside a photo of the damaged product. If you have any questions or require help in submitting a return request, please contact our customer service team for assistance.</p> 
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     <h5>How does it work?</h5> 
                     
                     <p class="normal_text">• Go to "My Account"</p>
                     <p class="normal_text">• Click on “Account Information”, then “My Returns” and choose “New Return / Exchange Request”</p>
                     <p class="normal_text">• Select the order (s) you want to return from the list. Only items that are eligible for return will be shown.</p>
                     <p class="normal_text">• Select the most appropriate return reason.</p>
                     <p class="normal_text">• Attach a photo of the product that describes your return reason appropriately.</p>
                     <p class="normal_text">• Add your comments if you want to let us know anything.</p>
                     <p class="normal_text">• Don’t forget to add your contact telephone number.</p>
                     
                     
                     
                     
                     
                     
                     <h5>Non-returnable Products.</h5> 
                     <p class="normal_text">Below is the list of the items that are not eligible for a return, replacement, or exchange:</p>
                     <p class="normal_text">1.Products that are classified as hazardous materials or contain flammable liquids or gases like batteries.</p>
                     <p class="normal_text">2.Personalized items that you requested to be designed especially for you.</p>
                     <p class="normal_text">3.Products that have been fully assembled or have been requested with installation are not eligible for returns. ( Examples - ride-on toys, playpens, indoor/outdoor playsets).</p>
                     <p class="normal_text">4.Products that have been used or damaged by you, or are not in the same condition as you received them.</p>
                     <p class="normal_text">5.Products with tampered or missing serial numbers.</p>
                     <p class="normal_text">6.Damaged items due to misuse or showing signs of wear and tear, even if they are still under their warranty period.</p>
                     <p class="normal_text">7.Santa delivery orders.</p>
                     <p class="normal_text">8.Orders shipped to international destinations [Outside UAE] *unless found to be faulty. Faulty products will require verification.</p>
                     
                     
                     
                     
                     
                     <h5>Refund Policy:</h5> 
                     <p class="normal_text">You will get a refund if the product(s) are returned, evaluated and found eligible for return.</p>
                     <p class="normal_text">International shipped orders are not eligible for refund *unless found to be faulty. Faulty products will require verification</p>
                     <p class="normal_text">For all prepaid orders, we do offer a refund on debit/credit card, Apple pay and/or PayPal. However, this is not applicable for cash on delivery orders.</p>
                     <p class="normal_text">You can choose whether you want your money refunded as store credit or back to your credit/debit card.</p>
                     <p class="normal_text">Note: You can choose to cancel the store credit and get a refund to your account within 30 days from the day the store credit was created, not applicable on COD orders.</p>
                     <p class="normal_text">All COD orders will be refunded as Myts Store store credit.</p>
                     
                     
                             
                     <h5>Need help?</h5> 
                     <p>You can contact us at: <a href="{{ route('front.contact-us') }}">https://dbi.resel.co.in/myts/contact-us</a></p>
            </div>
        </section>
        
@endsection