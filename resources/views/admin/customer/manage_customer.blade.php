@extends('admin.layouts.app')
@section('page_title', 'Team')
@section('customer_select', 'active')
@section('content')

    <div class="inner-main-content">
        <form id="save-form" action="{{ route('customer.manage-customer-process') }}" class="validate" method="post"
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
                                <h5 class="form_heading">Name<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $name }}" placeholder=" Name" name="name"
                                    data-validate="required" required data-message-required="Please Enter Name">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Mobile No.<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $mobile }}" placeholder="Mobile No." name="mobile"
                                    data-validate="required" required data-message-required="Please Enter Mobile">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Email Id<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $email }}" placeholder="Email Id" name="email"
                                    data-validate="required" required data-message-required="Please Enter Email Id">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Designation<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $designation }}" placeholder="Designation"
                                    name="designation" data-validate="required" required
                                    data-message-required="Please Enter Designation">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Address<span class="text-danger small">*</span></h5>
                                <input type="text" value="{{ $address }}" placeholder="Address" name="address"
                                    data-validate="required" required data-message-required="Please Enter Address">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Password<span class="text-danger small">*</span></h5>
                                <input type="password" placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Confirm Password<span class="text-danger small">*</span></h5>
                                <input type="password" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-6 col-sm-6 col-12">
                            <div class="input_box">
                                <h5 class="form_heading">Status</h5>
                                <select name="status">
                                    <option value="0" @if ($status == '0') selected @endif>Active</option>
                                    <option value="1" @if ($status == '1') selected @endif>Deactive
                                    </option>
                                </select>
                            </div>
                        </div>
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
