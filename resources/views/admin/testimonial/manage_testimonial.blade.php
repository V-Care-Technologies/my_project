
@extends('admin.layouts.app')
@section('page_title','Manage Testimonial')
@section('testimonial_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('testimonial.manage-testimonial-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Testimonial</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Title<span class="text-danger small">*</span></h5> 
                                     <input type="text" value="{{$title}}" placeholder="Title" name="title" data-validate="required" required  data-message-required="Enter Title">              
                                 </div>
                            </div>
                            
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Rating<span class="text-danger small">*</span></h5> 
                                        <select name="rate" id="rate" class="form-control home3 select2 col mySelect2" data-validate="required" required  data-message-required="Select Rating">
                                            <option value="">Select Rating</option>
                                            <option value="1" @if($rate=='1') selected @endif>1</option>
                                            <option value="2" @if($rate=='2') selected @endif>2</option>
                                            <option value="3" @if($rate=='3') selected @endif>3</option>
                                            <option value="4" @if($rate=='4') selected @endif>4</option>
                                            <option value="5" @if($rate=='5') selected @endif>5</option> 
                                        </select>
                                    </div>
                               </div>
                               <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Description<span class="text-danger small">*</span></h5> 
                                     <input type="text" value="{{$desc}}" placeholder="Description" name="desc" data-validate="required" required  data-message-required="Enter Description">              
                                 </div>
                            </div>
                                
                               
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Image</h5> 
                                     <input type="file" placeholder="Image" name="image">              
                                 </div>
                                 @if($image!='')
                                 <a href="{{asset('public/storage/media/testimonial/'.$image)}}" target="_blank"><img width="100px" src="{{asset('public/storage/media/testimonial/'.$image)}}"/></a>
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
                        <a href="{{route('admin.testimonial')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection