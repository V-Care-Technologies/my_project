<script src="{{asset('public/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/js/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/moment.js')}}"></script> 
<script src="{{asset('public/admin/js/metisMenu.min.js')}}"></script>
<script src="{{asset('public/admin/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/dataTables.bootstrap5.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/select2.min.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('public/admin/js/toastr.min.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/validation.js')}}" type="text/javascript"></script>

<script src="{{asset('public/admin/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/pdfmake.min.js')}}"></script>
<script src="{{asset('public/admin/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/admin/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/admin/js/main.js')}}" type="text/javascript"></script> 

<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>