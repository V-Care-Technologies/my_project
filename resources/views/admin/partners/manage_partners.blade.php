
@extends('admin.layouts.app')
@section('page_title','Manage Partners')
@section('partners_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('partners.manage-partners-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>blog</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              
                            <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                 <div class="input_box">
                                     <h5 class="form_heading">Image @if($image=='')<span class="text-danger small">*</span>@endif <span class="text-danger small">(159 x 157 px)</span></h5> 
                                     <input type="file" placeholder="Image" name="image" @if($image=='') data-validate="required" required  data-message-required="Please Select Image" @endif>              
                                 </div>
                                 @if($image!='')
                                     <a href="{{asset('storage/app/public/media/partners/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/app/public/media/partners/'.$image)}}"/></a>
                                 @endif
                            </div> 
                               
                               
                            <input type="hidden" name="id" value="{{$id}}"/>  
                            </div>
                        </div>
                    </div>  
                    <div class="button_row mt-4"> 
                        <a href="{{route('admin.partners')}}" class="main-btn" name="cancel">Cancel</a> 
                        <button type="submit" class="main-btn" name="submit">Submit</button> 
                    </div>
                </form>
            </div>
@endsection