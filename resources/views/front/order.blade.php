@extends('front.layouts.app')
@section('page_title', 'Order')
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
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">

                                <div class="table-responsive main_table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order Number</th>
                                                <th>Order Status</th>
                                                <th>Payment Status</th>
                                                <th>Total Amt</th>
                                                <th>Payment Type</th>
                                                <th>Placed At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $list)
                                                <tr>
                                                    <td class="order_id_btn"><a
                                                            href="{{ url('order_detail') }}/{{ $list->id }}">{{ $list->order_number }}</a>
                                                    </td>
                                                    <td>{{ $list->orders_status }}</td>
                                                    <td>{{ $list->payment_status }}</td>
                                                    <td>{{ number_format($list->total_amt, 2) }}</td>
                                                    <td>{{ $list->payment_type }}</td>
                                                    <td>{{ $list->added_on }}</td>
                                                    <td>
                                                        <div class="dropdown1">
                                                            <a href="javascript:void()" id="dropdownMenuButton1"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ url('order_detail') }}/{{ $list->id }}">View</a></li>
                                                                <!--<li><a class="dropdown-item" href="#">Cancel</a></li>-->
                                                                <li><a class="dropdown-item" href="{{url('order_pdf')}}/{{$list->id}}">Print</a></li>
                                                                <li><a class="dropdown-item" href="{{url('order_return')}}/{{$list->id}}">Return</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
