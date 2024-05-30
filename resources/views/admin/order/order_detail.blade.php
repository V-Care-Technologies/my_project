@extends('admin.layouts.app')
@section('page_title', 'Order Details')
@section('order_select', 'active')
@section('content')

    <div class="inner-main-content">
        {{-- <div class="add_price_section p-3">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Update Order Status</h5>
                                <select class="form-control home3 select2 col mySelect2" id="order_status" onchange="update_order_status({{$orders_details[0]->id}})">
                                    <?php
                                    foreach ($orders_status as $list) {
                                        if ($orders_details[0]->order_status == $list->id) {
                                            echo "<option value='" . $list->id . "' selected>" . $list->orders_status . '</option>';
                                        } else {
                                            echo "<option value='$list->id'>" . $list->orders_status . '</option>';
                                        }
                                    }
                                    ?>
                                 </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Update Payment Status </h5>
                                <select class="form-control home3 select2 col mySelect2" id="payment_status" onchange="update_payemnt_status({{$orders_details[0]->id}})">
                                    <?php
                                    foreach ($payment_status as $list) {
                                        if ($orders_details[0]->payment_status == $list) {
                                            echo "<option value='$list' selected>$list</option>";
                                        } else {
                                            echo "<option value='$list'>$list</option>";
                                        }
                                    }
                                    ?>
                                 </select>
                            </div>
                        </div>
                    </div>
                </div> --}}
        {{-- <div class="add_price_section mt-4 p-3">
                    <div class="row">
                        <div class="input_box">
                            <h5 class="form_heading">Track Details</h5>
                            <form method="post">
                               <textarea name="track_details" class="form-control  m-b-10" required>{{$orders_details[0]->track_details}}</textarea>
                               <button type="submit" class="main-btn mt-3">
                                 Update
                             </button>
                             @csrf
                            </form>
                        </div>
                    </div>
                </div> --}}

        <div class="add_price_section p-3 mt-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3 class="main-heading">Details Address</h3>
                        {{ $orders_details[0]->name }} ({{ $orders_details[0]->mobile }})
                        <br />{{ $orders_details[0]->address }}<br />{{ $orders_details[0]->area }},{{ $orders_details[0]->city }},{{ $orders_details[0]->country }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3 class="main-heading">Order Details</h3>
                        <span class="mini_heaing">Order Status:</span> {{ $orders_details[0]->orders_status }}<br />
                        <span class="mini_heaing"> Payment Status:</span> {{ $orders_details[0]->payment_status }}<br />
                        <span class="mini_heaing">Payment Type:</span> {{ $orders_details[0]->payment_type }}<br />
                        <?php
                        if ($orders_details[0]->payment_id != '') {
                            echo '<span class="mini_heaing">Payment ID:</span>' . $orders_details[0]->payment_id;
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="row m-t-30 whitebg">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">


                        <div class="table-responsive">
                            <table class="table order_detail">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Image</th>

                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmt = 0;
                                    @endphp
                                    @foreach ($orders_details as $list)
                                        @php
                                            $totalAmt = $totalAmt + $list->price * $list->qty;
                                        @endphp
                                        <tr>
                                            <td>{{ $list->pname }}</td>
                                            <td><img src='{{ asset('storage/app/public/media/' . $list->color_image) }}'
                                                    height="100px" width="100px" /></td>

                                            <td>{{ $list->color }}</td>
                                            <td>{{ $list->price }}</td>
                                            <td>{{ $list->qty }}</td>
                                            <td>{{ $list->price * $list->qty }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                        <td><b>Total</b></td>
                                        <td><b>{{ $totalAmt }}</b></td>
                                    </tr>
                                    <?php
                                    if ($orders_details[0]->coupon_value > 0) {
                                        echo '<tr>
                                                                      <td colspan="5">&nbsp;</td>
                                                                      <td><b>Coupon <span class="coupon_apply_txt">(' .
                                            $orders_details[0]->coupon_code .
                                            ')</span></b></td>
                                                                      <td>' .
                                            $orders_details[0]->coupon_value .
                                            '</td>
                                                                    </tr>';
                                        $totalAmt = $totalAmt - $orders_details[0]->coupon_value;
                                        echo '<tr>
                                                                      <td colspan="5">&nbsp;</td>
                                                                      <td><b>Final Total</b></td>
                                                                      <td>' .
                                            $totalAmt .
                                            '</td>
                                                                    </tr>';
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Cart Total view -->

                    </div>
                </div>
            </div>

        </div>
        <div class="row m-auto pt-3 justify-content-center">
            <a href="{{ url('admin/order-pdf/') }}/{{ $orders_details[0]->id }}" class="main-btn w-auto">print</a>
        </div>

    </div>
@endsection
