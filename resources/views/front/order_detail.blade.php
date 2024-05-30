@extends('front.layouts.app')
@section('page_title','Order Detail')
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
     <div class="row justify-content-between">
      <div class="col-md-4 col-12">
        <div class="order_detail">
            <h3 class="order_heading">Details Address</h3>
            <p class="normal_text mb-1">{{$orders_details[0]->name}}({{$orders_details[0]->mobile}}) </p>
            <p class="normal_text">{{$orders_details[0]->address}} , {{$orders_details[0]->area}} , {{$orders_details[0]->city}} ,  {{$orders_details[0]->country}}</p>
          </div> 
      </div>
      <div class="col-md-4 col-12">
          <div class="order_detail">
            <h3 class="order_heading">Order Details</h3>
            <p class="normal_text"><span>Order Status:</span> {{$orders_details[0]->orders_status}}</p>
            <p class="normal_text"><span>Payment Status:</span> {{$orders_details[0]->payment_status}}</p>
            <p class="normal_text"><span>Payment Type:</span> {{$orders_details[0]->payment_type}}</p>
            
             <?php
              if($orders_details[0]->payment_id!=''){
                  echo 'Payment ID: '.$orders_details[0]->payment_id;
              }
             ?>
          </div>
          <b>Track Details</b>
          {{$orders_details[0]->track_details}} 
      </div>
     

       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
             
               <div class="table-responsive main_table mt-5">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Color</th>
                        <th>MRP</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                     @php 
                     $totalAmt=0;
                     @endphp
                     @foreach($orders_details as $list)
                     @php 
                     $totalAmt=$totalAmt+($list->price*$list->qty);
                     @endphp
                     <tr>
                        <td>{{$list->pname}}</td>
                        <td><img src='{{asset('storage/app/public/media/'.$list->color_image)}}' height="100px" width="100px"/></td>
                        <td>{{$list->color}}</td>
                        <td><del>AED {{number_format($list->mrp, 2)}}</del></td>
                        <td>AED {{number_format($list->price, 2)}}</td>
                        <td>{{$list->qty}}</td>
                        <td>AED {{number_format(($list->price*$list->qty), 2)}}</td>
                      </tr>
                     @endforeach
                     <tr>
                        <td colspan="5">&nbsp;</td>
                        <td><b>Total</b></td>
                        <td><b>{{number_format($totalAmt, 2)}}</b></td>
                      </tr>
                      <?php
                      if($orders_details[0]->coupon_value>0){
                        echo '<tr>
                          <td colspan="5">&nbsp;</td>
                          <td><b>Coupon <span class="coupon_apply_txt">('.$orders_details[0]->coupon_code.')</span></b></td>
                          <td>'.$orders_details[0]->coupon_value.'</td>
                        </tr>';
                        $totalAmt=$totalAmt-$orders_details[0]->coupon_value;
                        echo '<tr>
                          <td colspan="5">&nbsp;</td>
                          <td><b>Final Total</b></td>
                          <td>'.$totalAmt.'</td>
                        </tr>';
                      }
                      
                      
                      ?>
                    </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
           
		   </div>
         </div>
       </div>
     </div>
   </div>
 </section> 
@endsection