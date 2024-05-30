@extends('admin.layouts.app')
@section('page_title','Order')
@section('order_select','active')
@section('content')

<div class="inner-main-content"> 
   <div class="row">
      <div class="col-xl-6 col-md-6 col-12 left_box">
         <div class="searchBar position-relative">
               <img src="{{asset('public/admin/images/search.svg')}}">
               <input type="text" class="search_input" placeholder="Search" id="customSearch">   
         </div> 
      </div> 
      <div class="col-xl-6 col-md-6 col-12 right_box">
        <a href="javascript:void(0)" class="main-btn export_btn btn-excel">Export <img src="{{asset('public/admin/images/download.svg')}}" class="ps-2"></a>
        
      </div>
   </div> 
    
   <div class="renewal_table">
      <div class="table-responsive" style="min-height:auto">
         <table class="table" id="example">
            <thead>
            <tr>
                  <th scope="col" class="first_radius small_name">#</th>
                  
                            <th>Customer Details</th>
                            <th>Amt</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Order Date</th>
                     
                  <th scope="col" class="last_radius text-center">Action</th>
            </tr>
            </thead>
            <tbody>
               <?php $i=1 ?>
               @foreach($orders as $list)
                  <tr>
                     <td class="small_td"><span class="small_name">{{$i}}</span></td>
                     
                      <td>
                        {{$list->name}}<br/>
                        {{$list->email}}<br/>
                        {{$list->mobile}}<br/>
                        {{$list->address}},{{$list->area}},{{$list->city}},{{$list->country}}
                        </td>
                        <td>{{$list->total_amt}}</td>
                        <td>{{$list->orders_status}}</td>
                        <td>{{$list->payment_status}}</td>
                        <td>{{$list->payment_type}}</td>
                        <td>{{date('d M, Y',strtotime($list->added_on))}}</td>
                     
                        <td class="small_td">
                           <span class="name small_name">
                              <a href="{{url('/admin/order-detail')}}/{{$list->id}}">View</a>
                             
                          </span>
                      </td> 
                     
                  </tr> 
                  <?php $i++; ?>
                  @endforeach
            </tbody>   
         </table>   
      </div>
   </div>
</div>


@endsection


