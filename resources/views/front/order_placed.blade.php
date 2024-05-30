@extends('front.layouts.app')
@section('page_title','Order Placed')

@section('content')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row" style="text-align:center;">
        <br/><br/><br/>
            <h2>Your order has been placed</h2>
            <h2>Order Number:- {{ $order->order_number }}</h2>
            <div class="text-center">
                <a href="{{url('/')}}" class="main-btn mt-5 w-auto">Back to Home</a>
            </div>
        <br/><br/><br/>
      </div>
   </div>
</section>
@endsection