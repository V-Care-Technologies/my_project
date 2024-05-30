<?php $settings = App\Models\SiteSettings::where('id', '=', '1')->get(); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/calender.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/sweetalert2.min.css') }}">
    <title>{{ $settings[0]->title }}</title>

</head>

<body class="dash_body">


    <main>
        <section class="login_section position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10 col-12 login_part">
                        <div class="">
                            <div class="logo text-center mb-5">
                                {{-- <img src="{{asset('public/admin/images/'.$settings[0]->logo)}}"> --}}
                            </div>
                            <div class="login-form">
                                <div class="login-part">
                                    <h2 class="welcome text-center">WHO</h2>
                                    <form action="{{ route('admin.auth') }}" method="post" id="save-form"
                                        class="validate" enctype="multipart/form-data" accept-charset="utf-8">
                                        @csrf
                                        <div class="form-group input_box mb-4">
                                            <label for="Email">E-mail</label>
                                            <input type="email" name="email" placeholder="E-mail" required
                                                data-validate="required" data-message-required="Please Enter Email">
                                        </div>
                                        <div class="form-group input_box position-relative">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="password"
                                                placeholder="Password" required data-validate="required"
                                                data-message-required="Please Enter Password">
                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="main-btn mt-5">Login</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/sweetalert2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/moment.js') }}"></script>
    <script src="{{ asset('public/admin/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/dataTables.bootstrap5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.multi-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/js/toastr.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/validation.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/admin/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/admin/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}" type="text/javascript"></script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
