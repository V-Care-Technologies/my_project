
@extends('admin.layouts.app')
@section('page_title','Manage Product')
@section('product_master_select','active')
@section('product_select','inner_active')
@section('content')
@if($id>0)
   @php
      $image_required="";
   @endphp
   @else
   @php
      $image_required="required";
   @endphp
@endif

@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('sku_error')}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@endif 	

@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror
<div class="inner-main-content">
    <form id="save-form" action="{{route('product.manage-product-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
       @csrf
       <div class="add_price_section">
          <div class="card_heading">
             <h2>Product</h2>
          </div>
          <div class="card_body">
             <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Name<span class="text-danger small">*</span></h5>
                      <input type="text" value="{{$title}}" placeholder="Name" name="title" data-validate="required" required  data-message-required="Please Enter Name">              
                   </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Product Label</h5>
                      <select name="label_id[]" id="label_id" multiple="multiple" class="form-control home3 select2 col mySelect2">
                         <option value="0">Select Label</option>
                         @foreach($product_lable as $list)
                         <option value="{{$list->id}}"  @if(!empty($productLableAttrArr)) {{ in_array($list->id, $productLableAttrArr) ? 'selected' : '' }} @endif>{{$list->title}}</option>
                         @endforeach
                      </select>
                   </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                    <div class="input_box">
                       <h5 class="form_heading">Category<span class="text-danger small">*</span></h5>
                       <select name="category_id[]" id="category_id"  multiple="multiple" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Please Select Category">
                          <option value="0">Select Categories</option>
                           @foreach($category as $list)
                         <option value="{{$list->id}}"  @if(!empty($productCatAttrArr)) {{ in_array($list->id, $productCatAttrArr) ? 'selected' : '' }} @endif>{{$list->category_name}}</option>
                         @endforeach
                       </select>
                    </div>
                 </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Product Slug</h5>
                      <input type="text" value="{{$alias}}" placeholder="Product Slug" name="alias">              
                   </div>
                </div>
                 <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Rating<span class="text-danger small">*</span></h5>
                      <input type="number" value="{{$rating}}" placeholder="Rating" name="rating" data-validate="required" required  data-message-required="Please Enter Rating" max="5" min="0">              
                   </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Meta Title<span class="text-danger small">*</span></h5>
                      <input type="text" value="{{$meta_title}}" placeholder="Meta Title" name="meta_title" data-validate="required" required  data-message-required="Please Enter Meta Title">              
                   </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-12 mb-4">
                   <div class="input_box">
                      <h5 class="form_heading required" aria-required="true">Meta Desc</h5>
                      <textarea name="meta_desc" placeholder="Type here..." style="height:100px">{{$meta_desc}}</textarea>
                   </div>
                </div>
                 <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                   <div class="input_box">
                      <h5 class="form_heading">Image @if($image=='')<span class="text-danger small">*</span>@endif <span class="text-danger small">(1000 x 1000 px)</span></h5>
                      <input type="file" placeholder="Image" name="image" @if($image=='') data-validate="required" required  data-message-required="Please Select Image" @endif>              
                   </div>
                   @if($image!='')
                   <a href="{{asset('storage/app/public/media/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/'.$image)}}"/></a>
                @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                     <div class="input_box">
                         <h5 class="form_heading">Status</h5> 
                         <select name="status">  
                             <option value="0" @if($status=='0') selected @endif>Active</option>
                             <option value="1" @if($status=='1') selected @endif>Deactive</option>
                         </select>
                     </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-12 mb-4">
                   <div class="input_box">
                      <h5 class="form_heading required" aria-required="true">Desc</h5>
                      <textarea name="desc" placeholder="Type here..." style="height:100px">{{$desc}}</textarea>
                   </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-12 mb-4">
                   <div class="input_box">
                        <h5 class="form_heading required" aria-required="true">Specification<span class="text-danger small">*</span></h5>
                        <textarea id="specification" name="specification" type="text" class="form-control" aria-required="true" aria-invalid="false" data-validate="required" required  data-message-required="Please Enter Specification">{{$specification}}</textarea>
                     </div>
                </div>
               
             </div>
          </div>
       </div>
       <h2 class="mb10 ml15">Product Images</h2>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row" id="product_images_box">
                        @php 
                        $loop_count_num=1;
                        @endphp
                        @foreach($productImagesArr as $key=>$val)
                        @php 
                        $loop_count_prev=$loop_count_num;
                        $pIArr=(array)$val;
                        @endphp
                        <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                        <div class="col-md-4 product_images_{{$loop_count_num++}}"  >
                              <label for="images" class="control-label mb-1"> Image</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >

                              @if($pIArr['images']!='')
                                 <a href="{{asset('public/media/'.$pIArr['images'])}}" target="_blank"><img width="100px" src="{{asset('public/media/'.$pIArr['images'])}}"/></a>
                              @endif
                           </div>
                           
                           <div class="col-md-2">
                              <label for="images" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a  href="javascript:void(0)" class="del_popup2" data-id="{{$pIArr['id']}},{{$id}}"><button type="button" class="btn btn-danger btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
       <div class="add_price_section mt-2" id="product_attr_box">
           <div class="card_heading">
               <h2>Product Attr</h2>
            </div>
            @php 
               $loop_count_num=1;
               @endphp
               @foreach($productAttrArr as $key=>$val)
               @php 
               $loop_count_prev=$loop_count_num;
               $pAArr=$val;
               
               
               @endphp
               <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
        <div class="card_body" id="product_attr_{{$loop_count_num++}}">
           <div class="row">
            
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                <div class="input_box">
                   <h5 class="form_heading">Color<span class="text-danger small">*</span></h5>
                   <select name="color_id[]" id="color_id" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Select Color">
                      <option value="">Select Color</option>
                      @foreach($colors as $list)
                      @if($pAArr['color_id']==$list->id)
                      <option value="{{$list->id}}" selected>{{$list->color}}</option>
                      @else
                      <option value="{{$list->id}}">{{$list->color}}</option>
                      @endif
                   @endforeach
                   </select>
                </div>
             </div>
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                 <div class="input_box">
                    <h5 class="form_heading">Image</h5>
                    <input type="file" placeholder="Image" name="color_image[]">   
                    
                    @if($pAArr['color_image']!='')
                    <img  src="{{asset('public/media/'.$pAArr['color_image'])}}" height="100px" width="100px"/>
                 @endif
                 </div>
              </div>
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                <div class="input_box">
                   <h5 class="form_heading">SKU<span class="text-danger small">*</span></h5>
                   <input type="text" value="{{$pAArr['sku']}}" placeholder="SKU" name="sku[]" data-validate="required" required  data-message-required="Please Enter Sku">              
                </div>
             </div>
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                <div class="input_box">
                   <h5 class="form_heading">RSP<span class="text-danger small">*</span></h5>
                   <input type="number" value="{{$pAArr['mrp']}}" placeholder="RSP" name="mrp[]" data-validate="required" required  data-message-required="Please Enter RSP">              
                </div>
             </div>
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                <div class="input_box">
                   <h5 class="form_heading">CP<span class="text-danger small">*</span></h5>
                   <input type="number" value="{{$pAArr['price']}}" placeholder="CP" name="price[]" data-validate="required" required  data-message-required="Please Enter CP">              
                </div>
             </div>
             <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                <div class="input_box">
                   <h5 class="form_heading">Qty<span class="text-danger small">*</span></h5>
                   <input type="number" value="{{$pAArr['qty']}}" placeholder="Qty" name="qty[]" data-validate="required" required  data-message-required="Please Enter Qty" min="1">              
                </div>
             </div>
            
              
              
              <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                 <div class="input_box">
                    <h5 class="form_heading">Image</h5>
                    <input type="file" placeholder="Image" name="attr_image[{{ $key }}][]" multiple>              
                 @if($pAArr['attr_image'] !== null)
    @php
        $imageArray = json_decode($pAArr['attr_image']);
    @endphp

    @if(is_array($imageArray))
        @foreach($imageArray as $image)
            <img src="{{ asset('public/media/'.$image) }}" height="100px" width="100px"/>
        @endforeach
    @endif
@endif


                 </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-sm-6 col-12 d-flex align-items-end justify-content-center plus_minus_btn">
                @if($loop_count_num==2)
                <a href="javascript:void(0)" class="main-btn me-3" onclick="add_more()"><i class="fa-solid fa-plus"></i></a>
                @else
                <a href="{{url('admin/product/product-attr-delete')}}/{{$pAArr['id']}}/{{$id}}" class="main-btn"><i class="fa-solid fa-minus"></i></a>
                @endif
             </div>
              
           </div>
        </div>
        @endforeach
     </div>

       <div class="button_row mt-4"> 
          <a href="{{route('admin.product')}}" class="main-btn" name="cancel">Cancel</a> 
          <button type="submit" class="main-btn" name="submit">Submit</button> 
       </div>
       <input type="hidden" name="id" value="{{$id}}"/>
    </form>
 </div>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <script>
    var loop_count=1; 
    function add_more(){
        loop_count++;
        // var html='<input id="paid" type="hidden" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
        var html='<input id="paid" type="hidden" name="paid[]" ><div class="add_price_section mt-2" id="product_attr_'+loop_count+'"><div class="card_heading"><h2>Product Attr</h2></div><div class="card_body"><div class="row">';
        
       
 
        // var size_id_html=jQuery('#size_id').html(); 
        // size_id_html = size_id_html.replace("selected", "");
        
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Size</h5><select name="size_id[]" id="size_id" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Select Size">'+size_id_html+'</select></div></div>';

        var color_id_html=jQuery('#color_id').html(); 
        color_id_html = color_id_html.replace("selected", "");
        
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Color<span class="text-danger small">*</span</h5><select name="color_id[]" id="color_id" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Select Color">'+color_id_html+'</select></div></div>';
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Color Image</h5><input type="file" value="" placeholder="Image" name="color_image[]"></div></div>';
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">SKU<span class="text-danger small">*</span</h5><input type="text" value="" placeholder="SKU" name="sku[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">RSP<span class="text-danger small">*</span</h5><input type="number" value="" placeholder="RSP" name="mrp[]" data-validate="required" required  data-message-required="Please Enter RSP"></div></div>'; 
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">CP<span class="text-danger small">*</span</h5><input type="number" value="" placeholder="CP" name="price[]" data-validate="required" required  data-message-required="Please Enter CP"></div></div>'; 

        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Qty<span class="text-danger small">*</span</h5><input type="number" value="" placeholder="Qty" name="qty[]" data-validate="required" required  data-message-required="Please Enter Qty" min="1"></div></div>'; 
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Product Dimension</h5><input type="text" value="" placeholder="Product Dimension" name="product_dimension[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Package Dimension</h5><input type="text" value="" placeholder="Package Dimension" name="package_dimension[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 

        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Weight</h5><input type="text" value="" placeholder="Weight" name="weight[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Shipping Weight</h5><input type="text" value="" placeholder="Shipping Weight" name="shipping_weight[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Cautions</h5><input type="text" value="" placeholder="Cautions" name="cautions[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 

        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Material</h5><input type="text" value="" placeholder="Material" name="material[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        // html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Recommended Age</h5><input type="text" value="" placeholder="Recommended Age" name="recommended_age[]" data-validate="required" required  data-message-required="Please Enter Sku"></div></div>'; 
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12"><div class="input_box"><h5 class="form_heading">Image</h5><input type="file" value="" placeholder="Image" name="attr_image["'+loop_count+'"][]" multiple></div></div>'; 
        html+='<div class="col-xl-3 col-lg-6 col-sm-6 col-12 d-flex align-items-end justify-content-center plus_minus_btn"><a href="#" class="main-btn"  onclick=remove_more("'+loop_count+'")><i class="fa-solid fa-minus"></i></a></div>'
        html+='</div></div></div>';
 
        jQuery('#product_attr_box').append(html)
    }
    function remove_more(loop_count){
      
         jQuery('#product_attr_'+loop_count).remove();
    }
    
     var loop_image_count=1;
   function add_image_more(){
      loop_image_count++;
      var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
      //product_images_box
       html+='<div class="col-md-2 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
       jQuery('#product_images_box').append(html)
   }

   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
   }
    
    CKEDITOR.replace('specification');

 </script>
 
 <script>
     $(document).ready(function () {
    // Delete
    $(document).on("click", ".del_popup2", function () {
        var id = $(this).attr('data-id');
        var ids = id.split(',');
        var firstId = ids[0];
        var secondId = ids[1];

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
                    url: '{{url("admin/product/product_images_delete")}}',
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: firstId,
                        anotherId: secondId
                    },
                    beforeSend: function () {
                        $('.overlay-wrapper').show();
                    },
                    success(response) {
                        setTimeout(function () {
                            var obj = JSON.parse(response);
                            if (obj.status == "1") {
                                $('.overlay-wrapper').hide();
                                Command: toastr["error"]("Deleted Successfully", "Message")
                                window.location.href = window.location.href;
                            }
                        }, 1000);
                    }
                })
            } else {
                swal("Your record is safe!");
            }
        });
    });
});

 </script>
@endsection