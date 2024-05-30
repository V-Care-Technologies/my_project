@extends('admin.layouts.app')
@section('page_title','Manage Size')
@section('size_select','active')
@section('content')

            <div class="inner-main-content"> 
                <form id="save-form" action="{{route('size.manage-size-process')}}" class="validate" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  @csrf
                    <div class="add_price_section">
                        <div class="card_heading">
                            <h2>Size</h2>
                        </div>
                        <div class="card_body"> 
                            <div class="row">
                              
                                
                               
                                
                                
                                <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                                    <div class="input_box">
                                        <h5 class="form_heading">Size</h5> 
                                        <input type="text" value="{{$size}}" placeholder="Size" name="size" data-validate="required" required  data-message-required="Please Enter Outfit">              
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