@extends('admin.layouts.app')
@section('page_title', 'Project')
@section('project_select', 'active')
@section('content')

    <div class="inner-main-content">
        <form id="save-form" action="{{ route('project.manage-project-process') }}" class="validate" method="post"
            enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="add_price_section">
                <div class="card_heading">
                    <h2>Team</h2>
                </div>
                <div class="card_body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Project Name<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $project_name }}" placeholder=" Name" name="project_name"
                                    data-validate="required" required data-message-required="Please Enter Project Name">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Deadline<span class="text-danger small">*</span></h5>
                                <input type="date" value="{{ $deadline }}" placeholder="" name="deadline"
                                    data-validate="required" required data-message-required="Please Enter Deadline">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Description<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $description }}" placeholder="Description"
                                    name="description" data-validate="required" required
                                    data-message-required="Please Enter Description">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Team<span class="text-danger small">*</span></h5>
                                <select name="user_id[]" id="user_id" multiple="multiple"
                                    class="form-control home3 select2 col mySelect2" data-validate="required" required
                                    data-message-required="Please Select Category">
                                    <option value="0">Select Team</option>
                                    @foreach ($user as $list)
                                        <option value="{{ $list->id }}"
                                            @if (!empty($productLableAttrArr)) {{ in_array($list->id, $productLableAttrArr) ? 'selected' : '' }} @endif>
                                            {{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Status</h5>
                                <select name="status">
                                    <option value="0" @if ($status == '0') selected @endif>Active</option>
                                    <option value="1" @if ($status == '1') selected @endif>Deactive
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        <input type="hidden" name="id" value="{{ $id }}" />
                    </div>
                </div>
            </div>
            <div class="button_row mt-4">
                <a href="{{ route('admin.customer') }}" class="main-btn" name="cancel">Cancel</a>
                <button type="submit" class="main-btn" name="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
