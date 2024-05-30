@extends('admin.layouts.app')
@section('page_title','Size')
@section('size_select','active')
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
         <a href="{{route('admin.manage-size')}}" class="main-btn bordered_btn export_btn"><img src="{{asset('public/admin/images/plus.svg')}}" class="pe-2">Add</a>
      </div>
   </div> 
    
   <div class="renewal_table">
      <div class="table-responsive" style="min-height:auto">
         <table class="table" id="example">
            <thead>
            <tr>
                  <th scope="col" class="first_radius small_name">#</th>
                  <th scope="col">Size</th>
                     
                  <th scope="col" class="last_radius">Action</th>
            </tr>
            </thead>
            <tbody>
               <?php $i=1 ?>
               @foreach($size as $list)
                  <tr>
                     <td class="small_td"><span class="small_name">{{$i}}</span></td>
                     <td>{{$list->size}}</td> 
                     
                    
                      <td class="small_td">
                         <span class="name small_name">
                           <a href="{{url('admin/size/manage-size/')}}/{{$list->id}}"><img src="{{asset('public/admin/images/edit_icon.svg')}}" class="pe-2"></a>
                           <a href="{{url('admin/size/delete/')}}/{{$list->id}}" class=""><img src="{{asset('public/admin/images/dustbin_icon.svg')}}"></a>
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


