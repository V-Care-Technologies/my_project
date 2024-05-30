@extends('admin.layouts.app')
@section('page_title','Product')
@section('product_master_select','active')
@section('product_select','inner_active')
@section('content')


<style>
    .select2-selection__rendered{
        text-align:left!important
    }
</style>
<div class="inner-main-content"> 
   <div class="row">
      <div class="col-xl-6 col-md-6 col-12 left_box">
         <div class="searchBar position-relative">
               <img src="{{asset('public/admin/images/search.svg')}}">
               <input type="text" class="search_input" placeholder="Search" id="customSearch">   
         </div> 
          <form action="{{url('admin/import-product')}}" method="POST" enctype="multipart/form-data" class="import_form">
                 @csrf
                 <input type="file" name="file" accept=".xlsx, .xls">
                 <button type="submit" class="main-btn border-0">Import</button>
          </form>
         
      </div> 
      <div class="col-xl-6 col-md-6 col-12 right_box">
        <a href="javascript:void(0)" class="main-btn export_btn btn-excel">Export <img src="{{asset('public/admin/images/download.svg')}}" class="ps-2"></a>
         <a href="{{route('admin.manage-product')}}" class="main-btn bordered_btn export_btn"><img src="{{asset('public/admin/images/plus.svg')}}" class="pe-2">Add</a>
      </div>
   </div> 
   <div class="row justify-content-between">
        <div class="col-xl-6 col-md-6 col-12 left_box">
           <a href="{{asset('public/admin/sampleexcel/Myts_Excel_Import1.xlsx')}}" class="main-btn">Download Sample Excel<img src="{{asset('public/admin/images/download.svg')}}" class="ps-2"></a>
        </div> 
        <div class="col-xl-4 col-md-4 col-12 right_box">
        <form action="{{route('admin.product-filter')}}" method="POST" enctype="multipart/form-data" class="import_form">
             @csrf
             <select name="category_id" class="form-control home3 select2 col mySelect2 text-start">
                 <option value="0">Select Categories</option>
                   @foreach($category as $list)
                    <option value="{{$list->id}}"  @if($list->id == $categoryid){{"selected";}}@endif>{{$list->category_name}}</option>
                 @endforeach
             </select>
             <button type="submit" class="main-btn border-0 ms-3">Search</button>
        </form>
        </div>
    </div>
   <div class="renewal_table">
      <div class="table-responsive" style="min-height:auto">
         <table class="table" id="example">
            <thead>
            <tr>
                  <th scope="col" class="first_radius small_name">#</th>
                  <th scope="col">Image</th>   
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Status</th>
                  <th scope="col" class="last_radius text-center">Action</th>
            </tr>
            </thead>
            <tbody>
               <?php $i=1 ?>
               @foreach($product as $list)
                  <tr>
                     <td class="small_td"><span class="small_name">{{$i}}</span></td>
                     <td>
                         <div class="sqr_img_box">
                            @if($list->image!='')
                                <img   src="{{asset('storage/app/public/media/'.$list->image)}}"/>
                            @endif
                         </div>
                        </td>
                     <td>{{$list->title}}</td> 
                     <td>{{$list->lowest_price}}</td>
                     <td>@if($list->status==0) Active @else Deactive @endif</td>
                    
                      <td class="small_td">
                         <span class="name small_name">
                           <a href="{{url('admin/product/manage-product/')}}/{{$list->id}}"><img src="{{asset('public/admin/images/edit_icon.svg')}}" class="pe-2"></a>
                           <a href="javascript:void(0)" class="del_popup2" data-id="{{$list->id}}"><img src="{{asset('public/admin/images/dustbin_icon.svg')}}"></a>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready( function() {
//Delete
           
     $(document).on("click",".del_popup2",function(){
        var id = $(this).attr('data-id');
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url:'./product/delete',
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},
                    beforeSend: function(){
             	     $('.overlay-wrapper').show();  
                 	},
                    success(response){
                    setTimeout(function(){    
                    var obj =  JSON.parse(response);
                    if(obj.status=="1"){
                        $('.overlay-wrapper').hide(); 
        	    		Command: toastr["error"]("Deleted Successfully", "Message")
                         window.location.href = window.location.href;
                  
                    }
                    },1000);
                    }
                })
                } else {
                    swal("Your record is safe!");
                }
            });
        })
            
 });
            
 </script>  


