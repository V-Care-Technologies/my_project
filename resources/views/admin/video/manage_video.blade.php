@extends('admin.layouts.app')
@section('page_title', 'Video')
@section('video_select', 'active')
@section('content')

    <div class="inner-main-content">
        <form id="save-form" action="{{ route('video.manage-video-process') }}" class="validate" method="post"
            enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="add_price_section">
                <div class="card_heading">
                    <h2>Video</h2>
                </div>
                <div class="card_body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Video Title<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $title }}" placeholder="Video Title" name="title"
                                    data-validate="required" required data-message-required="Please Enter Category">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">video Link</h5>
                                <input type="text" value="{{ $video_url }}" placeholder="video Link" name="video_url">
                            </div>
                        </div>



                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Status</h5>
                                <select name="status">
                                    <option value="1" @if ($status == '1') selected @endif>Active</option>
                                    <option value="2" @if ($status == '2') selected @endif>Deactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}" />
                    </div>
                </div>
            </div>
            <div class="button_row mt-4">
                <a href="{{ route('admin.video') }}" class="main-btn" name="cancel">Cancel</a>
                <button type="submit" class="main-btn" name="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
