
@extends('admin.layouts.app')
@section('page_title','Manage Blog')
@section('blog_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('blog.manage-blog-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>blog</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Title<span class="text-danger small">*</span></h5> 
                                     <input type="text" value="{{$title}}" placeholder="Title" name="title" data-validate="required" required  data-message-required="Please Enter Title">              
                                 </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                               <div class="input_box">
                                  <h5 class="form_heading">Slug</h5>
                                  <input type="text" value="{{$alias}}" placeholder="Blog Slug" name="alias">              
                               </div>
                            </div>
                             
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Image @if($image=='')<span class="text-danger small">*</span>@endif <span class="text-danger small">(350 x 250 px)</span></h5> 
                                     <input type="file" placeholder="Image" name="image" @if($image=='') data-validate="required" required  data-message-required="Please Select Image" @endif>              
                                 </div>
                                 @if($image!='')
                                     <a href="{{asset('storage/app/public/media/blog/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/blog/'.$image)}}"/></a>
                                 @endif
                            </div> 
                               <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Main Image @if($main_image=='')<span class="text-danger small">*</span>@endif <span class="text-danger small">(1116 x 528 px)</span></h5> 
                                         <input type="file" placeholder="Image" name="main_image" @if($main_image=='') data-validate="required" required  data-message-required="Please Select Main Image" @endif>              
                                     </div>
                                     @if($main_image!='')
                                         <a href="{{asset('storage/app/public/media/blog/'.$main_image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/blog/'.$main_image)}}"/></a>
                                     @endif
                                </div> 
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Short Description<span class="text-danger small">*</span></h5> 
                                         <textarea name="desc" placeholder="Type here..." style="height:100px" data-validate="required" required  data-message-required="Please Enter Description">{{$desc}}</textarea>
                                     </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Long Description</h5> 
                                         <textarea name="long_desc" placeholder="Type here..." style="height:100px">{{$long_desc}}</textarea>
                                     </div>
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
                        <a href="{{route('admin.blog')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection