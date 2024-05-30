
@extends('admin.layouts.app')
@section('page_title','Home Banner')
@section('home_banner_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('admin.home-banner.manage-home-banner-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Home Banner</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Mobile Banner @if($image=='')<span class="text-danger small">*</span> @endif <span class="text-danger small">(450 x 220 px)</span></h5> 
                                     <input type="file" placeholder="Image" id="image" name="image" @if($image=='') data-validate="required" required  data-message-required="Please select image" @endif>              
                                 </div>
                                     @if($image!='')
                                        <a href="{{asset('storage/app/public/media/banner/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/banner/'.$image)}}"/></a>
                                    @endif
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Web Banner @if($image1=='')<span class="text-danger small">*</span> @endif <span class="text-danger small">(1116 x 429 px)</span></h5> 
                                     <input type="file" placeholder="Image1" id="images" name="images" @if($image1=='') data-validate="required" required  data-message-required="Please select image" @endif>              
                                 </div>
                                     @if($image1!='')
                                        <a href="{{asset('storage/app/public/media/banner/'.$image1)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/banner/'.$image1)}}"/></a>
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
                        <a href="{{route('admin.home-banner')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection