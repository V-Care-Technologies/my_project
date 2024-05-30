
@extends('admin.layouts.app')
@section('page_title','Manage Category')
@section('category_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('category.manage-category-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Category</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Category Name<span class="text-danger small">*</span></h5> 
                                     <input type="text" value="{{$category_name}}" placeholder="Category Name" name="category_name" data-validate="required" required  data-message-required="Please Enter Category">              
                                 </div>
                            </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Parent  Category</h5> 
                                        <select name="parent_category_id" id="parent_category_id" class="form-control home3 select2 col mySelect2">
                                            <option value="0">Select Categories</option> 
                                            @foreach($category as $list)
                                            @if($parent_category_id==$list->id)
                                            <option selected value="{{$list->id}}">
                                                @else
                                            <option value="{{$list->id}}">
                                                @endif
                                                {{$list->category_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                               </div>
                               <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Category Slug</h5> 
                                     <input type="text" value="{{$category_slug}}" placeholder="Category Slug" name="category_slug">              
                                 </div>
                            </div>
                                
                                <div class="col-xl-3 col-lg-3 col-12">
                                    <div class="input_box  form-group">
                                        <h5 class="form_heading">Show in Home Page</h5>  
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" name="is_home" id="is_home" {{$is_home_selected}}>
                                            <label class="form-check-label ms-2" for="flexCheckDefault">
                                             Show in Home Page
                                            </label>
                                          </div>
                                    </div> 
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Image <span class="text-danger small">(82 x 69 px)</span></h5> 
                                     <input type="file" placeholder="Image" name="category_image">              
                                 </div>
                                 @if($category_image!='')
                                 <a href="{{asset('storage/app/public/media/category/'.$category_image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/category/'.$category_image)}}"/></a>
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
                            <input type="hidden" name="id" value="{{$id}}"/>  
                            </div>
                        </div>
                    </div>  
                    <div class="button_row mt-4"> 
                        <a href="{{route('admin.category')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection