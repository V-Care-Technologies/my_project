<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('admin.includes.links')
    <title>@yield('page_title')</title>

</head>
<?php $settings = App\Models\SiteSettings::where('id', '=', '1')->get(); ?>

<body class="dash_body">
    <div class="overlay-wrapper">
        <div class="spinner"></div>
    </div>

    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                {{-- <a href="{{route('dashboard')}}" class="mini_sidebar_logo">
                  <img src="{{asset('public/admin/images/'.$settings[0]->logo)}}" alt="mini logo" class="mini_logo">
               </a>
               <a href="{{route('dashboard')}}" class="sidebar_logo"><img src="{{asset('public/admin/images/'.$settings[0]->logo)}}" alt="logo" class="main_logo"></a> --}}
            </div>

            @include('admin.includes.sidebar')
        </div>
        <div class="main-content" style="min-height:225px;">
            <div class="header-area">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-sm-6 col  clearfix dash_heading">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="page_heading ps-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}" target="_blank"><img
                                                src="{{ asset('public/admin/images/home.svg') }}"></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
                                </ol>
                            </nav>
                            <h2 class="heading_header">@yield('page_title')</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col profile_right">
                        <ul class="notification-area pull-right">
                            <li class="profile_icon dropdown">
                                <a href="#" class="profile_area dropdown-toggle" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="round_img">
                                        <img src="{{ asset('public/admin/images/noimage.jpg') }}">
                                    </div>
                                    <div class="name_role">
                                        <p class="username">Administrator</p>
                                        <p class="role">Admin</p>
                                    </div>
                                    <i class="fa-solid fa-chevron-down dropdown_arrow"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <img src="{{ asset('public/admin/images/dropdown.svg') }}" class="dropdown_profile">
                                    <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
                                    <li class="border-top-0"><a class="dropdown-item"
                                            href="{{ url('admin/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>

        @include('admin.includes.footer')
        <a href="#" id="scroll"><i class="fas fa-arrow-up"></i></a>

        @include('admin.includes.bottom-links')
</body>

</html>
