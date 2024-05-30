
@extends('admin.layouts.app')
@section('page_title','Show Customer Details')
@section('customer_select','active')
@section('content')

{{-- <h1 class="mb10">Customer Details</h1> --}}
    
<div class="inner-main-content"> 
  <div class="add_price_section p-3">
    <h5 class="form_heading">Customer Details</h5>
            <table class="table table-borderless table-data3">
                
                <tbody>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{$customer_list->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{$customer_list->email}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile</strong></td>
                        <td>{{$customer_list->mobile}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>{{$customer_list->address}}</td>
                    </tr>
                    <tr>
                        <td><strong>Area</strong></td>
                        <td>{{$customer_list->area}}</td>
                    </tr>
                    
                   
                    <tr>
                        <td><strong>City</strong></td>
                        <td>{{$customer_list->city}}</td>
                    </tr>
                    
                    <tr>
                        <td><strong>Country</strong></td>
                        <td>{{$customer_list->country}}</td>
                    </tr>
                    <!--<tr>-->
                    <!--    <td><strong>Company</strong></td>-->
                    <!--    <td>{{$customer_list->company}}</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td><strong>Created On</strong></td>-->
                    <!--    <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i:s')}}</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td><strong>Updated On</strong></td>-->
                    <!--    <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y h:i:s')}}</td>-->
                    <!--</tr>-->

                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>

@endsection