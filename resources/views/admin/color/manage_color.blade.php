
@extends('admin.layouts.app')
@section('page_title','Manage Color')
@section('color_select','inner_active')
@section('product_master_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('color.manage-color-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Color</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Color<span class="text-danger small">*</span></h5> 
                                        <input type="text" value="{{$color}}" placeholder="Color" name="color" data-validate="required" required  data-message-required="Please Enter Color">              
                                    </div>
                               </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                     <div class="input_box">
                                         <h5 class="form_heading">Image</h5> 
                                         <input type="file" placeholder="Image" name="color_image">              
                                     </div>
                                     @if($color_image!='')
                                     <a href="{{asset('storage/app/public/media/color/'.$color_image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/color/'.$color_image)}}"/></a>
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
                        <button type="reset" class="main-btn" name="cancel">Cancel</button> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection