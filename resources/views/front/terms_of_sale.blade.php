@extends('front.layouts.app')
@section('page_title','Terms of Sale')

@section('content')
 <section class="breadcrub_section">
          <div class="container">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms of Sale</li>
              </ol>
            </nav>
          </div>
        </section>
        <section class="page_heading">
            <div class="container">
            
                     
                    <h5>Terms of Sale:</h5>
                    <p class="normal_text">Please read these Terms and Conditions carefully as you must acknowledge that you accept the terms of sale before making any purchases via Myts Store. Myts Store (from here on referred to as ‘we’, ‘us’ and ‘our’) is committed to providing our customers with clear information regarding their sale.</p>
                    <div class="ps-2">
                        <p class="normal_text">1. By confirming that you wish to purchase any item on Myts Store, you are confirming that you agree with our full user Terms & Conditions. These are accessible on our site and should be read through in their entirety before you make a purchase on Myts Store.</p>
                        <p class="normal_text">2. We cannot guarantee that every item displayed on Myts Store is in fact available at the stated price. We will make every effort to contact our customers if they have agreed to purchase a product and it is not available at the stated price. We will NOT charge you if you do not acknowledge that you agree to continue with the purchase at the revised price if it exceeds the price displayed when you agreed to the sale.</p>
                        <p class="normal_text">3. We cannot guarantee that every item displayed on Myts Store is in stock and available for delivery. We will contact customers who have ordered products that are out of stock and customers will NOT be charged for these items.</p>
                        <p class="normal_text">4. We make every effort to provide clear and accurate product details. Where the product is available in various colors or patterns, we cannot guarantee that your preferred color will be delivered unless the product color is stated in the product title. We are not liable for the accuracy or completeness of our product descriptions or the photographs of products and/or our featured product reviews. If you realize that the product does not match the stated description, photograph or reviews once receiving it, your sole remedy is to return it within 7 working days of receiving it, in an unused condition.</p>
                        <p class="normal_text">5. Customers agree to the terms of sale, subject to the stated price for all selected items, and complete their order for their selected items by pressing the ‘confirm’ button at the end of the checkout process.</p>
                        <p class="normal_text">6. We will send all customers an acknowledgement email detailing the products that they have ordered. This is not an acceptance of the sale on the behalf of Myts Store.</p>
                        <p class="normal_text">7. We will send all customers a dispatch confirmation email once their products have been shipped. This confirms that we have accepted to sell the selected items to you at the price specified at checkout unless we have subsequently notified you otherwise.</p>
                        <p class="normal_text">8. We will notify you if we do not accept sale before we dispatch your items. Customers must notify us if they wish to cancel their order before items are dispatched. We reserve the right to refuse a sale at our sole discretion, however, non acceptance of the sale on behalf of Myts Store will usually take place for one or more of the following reasons:</p>
                        <ul>
                            <li class="normal_text">The product(s) you ordered are out of stock. We will inform you of this by email. You will not be charged for any products that are out of stock. We will inform you once they come back into stock but you must place a new order if you wish to order the item(s) again.</li>
                            <li class="normal_text">We were unable to authorize your payment. We will inform you of this by email. Your order will be canceled and you must place your order again if you wish to purchase the item(s) by another method.</li>
                            <li class="normal_text">We identify that the product you ordered was priced incorrectly or the description contained incorrect details. We will email you to inform this with the revised details and ask you whether you wish to proceed with the order.</li>
                            <li class="normal_text">You have breached the user Terms & Conditions. We will inform you of this and your order will be cancelled and you will not be charged for it.</li> 
                        <ul>
                    </div>
                    <p class="normal_text">1. We are not liable for any delays to our stated delivery times and we cannot guarantee how long it will take to process your payment.</p>
                    <p class="normal_text">2. Please check the list of countries that we deliver to in our Delivery Policy before placing an order. We may change the terms of our delivery policy at any time so please re-read every time you place an order. If you need further assistance, contact us by <a href="{{ route('front.contact-us') }}"> clicking here.</a></p>
                    <p class="normal_text">3. We cannot guarantee an assigned delivery time for your items. If you are not at home when we deliver your order, we will try again at a different time of day. If we still cannot reach you at home, you may have to contact your local postal depot.</p>
                    <p class="normal_text">4. We accept no liability for items once they have been dispatched and are in the possession of our shipment partners. Once orders have been dispatched we consider the sale to have been completed and the risk of loss is passed onto you.</p>
                    <p class="normal_text">5. We accept no responsibility if your card details or Myts Store user name and password are used by another person because you have knowingly or unknowingly shared them outside the Myts Store site. You are responsible for all activities that occur under your user name and password.</p>
                    <p class="normal_text">6. Customers have a right to return products they have not used within 7 working days of receiving them, providing items have incurred no wear or damage since being delivered to the customer and products are returned in their original packaging. If we are satisfied with the condition of returned items we will issue customers with a replacement or store credit for the value of the item(s). In some cases we can also issue refunds to customers. Please see our Returns Policy for more details.</p>
                    <p class="normal_text">7. These conditions of sale are liable to change at any time and are effective at the time of your specific sale. Please read through the terms of sale every time you wish to place an order. As with all our Terms & Conditions, these conditions of sale are governed by Dubai and the U.A.E. law.</p>
                             
            </div>
        </section>
        
@endsection