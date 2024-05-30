
@extends('admin.layouts.app')
@section('page_title','Manage Customer Review')
@section('reviews_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('reviews.manage-reviews-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Testimonial</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                         <h5 class="form_heading">Name<span class="text-danger small">*</span></h5> 
                                         <input type="text" value="{{$name}}" placeholder="Name" name="name" data-validate="required" required  data-message-required="Enter Name">              
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Product<span class="text-danger small">*</span></h5> 
                                        <select name="product_id" id="product_id" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Select Product">
                                            <option value="">Select Product</option>
                                            @foreach($products as $list)
                                              @if($product_id==$list->id)
                                              <option selected value="{{$list->id}}">
                                                  @else
                                              <option value="{{$list->id}}">
                                              @endif
                                                  {{$list->title}}
                                              </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Rating<span class="text-danger small">*</span></h5> 
                                        <input type="number" value="{{$rating}}" placeholder="Rating" name="rating" data-validate="required,minlength[0],maxlength[5]" required  data-message-required="Enter Rating" min=0 max=5>  
                                    </div>
                               </div>
                               <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Description<span class="text-danger small">*</span></h5> 
                                     <input type="text" value="{{$description}}" placeholder="Description" name="description" data-validate="required" required  data-message-required="Enter Description">              
                                 </div>
                            </div>
                                
                               
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Image</h5> 
                                     <input type="file" placeholder="Image" name="image">              
                                 </div>
                                 @if($image!='')
                                 <a href="{{asset('public/storage/media/product_reviews/'.$image)}}" target="_blank"><img width="100px" src="{{asset('public/storage/media/product_reviews/'.$image)}}"/></a>
                             @endif
                            </div>  
                           
                            <input type="hidden" name="id" value="{{$id}}"/>  
                            </div>
                        </div>
                    </div>  
                    <div class="button_row mt-4"> 
                        <a href="{{route('admin.reviews')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection