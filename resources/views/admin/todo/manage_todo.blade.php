@extends('admin.layouts.app')
@section('page_title', 'To-Do')
@section('project_select', 'active')
@section('content')

    <div class="inner-main-content">
        <form id="save-form" action="{{ route('todo.manage-todo-process') }}" class="validate" method="post"
            enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="add_price_section">
                <div class="card_heading">
                    <h2>To-Do</h2>
                </div>
                <div class="card_body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Project Name</h5>
                                <select name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach ($project as $list)
                                        <option value="{{ $list->id }}"
                                            @if ($project_id == $list->id) selected @endif>{{ $list->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Assign To</h5>
                                <select name="user_id">
                                    <option value="">Select Team</option>
                                    @foreach ($user as $list)
                                        <option value="{{ $list->id }}"
                                            @if ($user_id == $list->id) selected @endif>{{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Priority</h5>
                                <select name="priority">
                                    <option value="1" @if ($priority == '1') selected @endif>Low</option>
                                    <option value="2" @if ($priority == '2') selected @endif>Medium</option>
                                    <option value="3" @if ($priority == '3') selected @endif>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Date<span class="text-danger small">*</span></h5>
                                <input type="date" value="{{ $date }}" placeholder="Date" name="date"
                                    data-validate="required" required data-message-required="Please Enter Date">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Title<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $title }}" placeholder="Title" name="title"
                                    data-validate="required" required data-message-required="Please Enter Title">
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
                                <h5 class="form_heading">Status</h5>
                                <select name="status">
                                    <option value="1" @if ($status == '1') selected @endif>TO-DO</option>
                                    <option value="2" @if ($status == '2') selected @endif>Done
                                    </option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}" />
                    </div>
                </div>
            </div>
            <div class="button_row mt-4">
                <a href="{{ route('admin.todo') }}" class="main-btn" name="cancel">Cancel</a>
                <button type="submit" class="main-btn" name="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
