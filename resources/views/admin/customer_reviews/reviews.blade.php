@extends('admin.layouts.app')
@section('page_title','Customer Reviews')
@section('reviews_select','active')
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
         <a href="{{route('admin.manage.reviews')}}" class="main-btn bordered_btn export_btn"><img src="{{asset('public/admin/images/plus.svg')}}" class="pe-2">Add</a>
      </div>
   </div> 
    
   <div class="renewal_table">
      <div class="table-responsive" style="min-height:auto">
         <table class="table" id="example">
            <thead>
            <tr>
                  <th scope="col" class="first_radius small_name">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Image</th>   
                  <th scope="col" class="last_radius text-center">Action</th>
            </tr>
            </thead>
            <tbody>
               <?php $i=1 ?>
               @foreach($reviews as $list)
                  <tr>
                     <td class="small_td"><span class="small_name">{{$i}}</span></td>
                     <td><span class="name">{{$list->title}}</span></td> 
                     <td><span class="name">
                       <div class="sqr_img_box">
                            @if($list->image!='')
                                <img src="{{asset('storage/app/public/media/product_reviews/'.$list->image)}}"/>
                            @endif
                       </div>
                     </span></td>
                    
                      <td class="small_td">
                         <span class="name small_name">
                           <a href="{{url('admin/reviews/manage-reviews/')}}/{{$list->id}}"><img src="{{asset('public/admin/images/edit_icon.svg')}}" class="pe-2"></a>
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
                    url:'./reviews/delete',
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


