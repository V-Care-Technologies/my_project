@extends('admin.layouts.app')
@section('page_title', 'Project')
@section('project_select', 'active')
@section('content')

    <div class="inner-main-content">
        <div class="row">
            <div class="col-xl-6 col-md-6 col-12 left_box">
                <div class="searchBar position-relative">
                    <img src="{{ asset('public/admin/images/search.svg') }}">
                    <input type="text" class="search_input" placeholder="Search" id="customSearch">
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12 right_box">
                <a href="javascript:void(0)" class="main-btn export_btn btn-excel">Export <img
                        src="{{ asset('public/admin/images/download.svg') }}" class="ps-2"></a>
                <a href="{{ route('admin.manage.project') }}" class="main-btn bordered_btn export_btn"><img
                        src="{{ asset('public/admin/images/plus.svg') }}" class="pe-2">Add</a>
            </div>
        </div>

        <div class="renewal_table">
            <div class="table-responsive" style="min-height:auto">
                <a href="@filemanager_get_resource(dialog.php)?field_id=imgField&lang=en_EN&akey=@filemanager_get_key()" value="Files">Open
                    RFM</a>
            </div>
        </div>
    </div>



    {{-- <script src="{{ asset('public/vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');
            fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                console.log(fileUrl);
                window.opener.fmSetLink(fileUrl);
                window.close();
            });
        });
    </script> --}}
@endsection
