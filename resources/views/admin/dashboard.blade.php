@extends('admin.layouts.app')
@section('page_title', 'Dashboard')
@section('dashboard_select', 'active')


@section('content')



    <div class="inner-main-content">
        <div class="orders_box_row row">

            <div class="col-xl-3 col-sm-6 col-12">
                <div class="order_box mb-xl-0 mb-3">
                    <div class="inner_dashboard_box">
                        <!-- <img src="images/dashboard_quotation.svg"> -->
                        <div class="order_text">
                            <h4>Users</h4>
                            <p>{{ $users }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <!--<div class="col-xl-3 col-sm-6 col-12">-->
            <!--   <div class="order_box mb-xl-0 mb-3">-->
            <!--         <div class="inner_dashboard_box">-->
            <!-- <img src="images/dashboard_stock.svg"> -->
            <!--            <div class="order_text">-->
            <!--               <h4>Stock</h4>-->
            <!--               <p>54</p>-->
            <!--            </div>-->
            <!--         </div>-->
            <!--   </div>-->
            <!--</div>-->
        </div>
    </div>


@endsection
