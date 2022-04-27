<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @yield('title')
    {{-- <link href="{{ asset('public/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('public/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('public/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('public/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/jquery/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/morris/morris.css') }}" rel="stylesheet">




</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin::partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                @include('admin::partials.topbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('admin::partials.footer')

        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('admin::partials.modal')
    
    <script src="{{ asset('public/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/vendor/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('public/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/vendor/raphael-min.js') }}"></script>
    <script src="{{ asset('public/vendor/morris/morris.min.js') }}"></script>

    <script src="{{ asset('public/backend/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/ckeditor.js') }}"></script>
    <script src="{{ asset('public/backend/js/delete.js') }}"></script>
    <script src="{{ asset('public/backend/js/select2_tag.js') }}"></script>


    @yield('js')
     <script>
       $(document).ready( function () {
            $('#dataTable').DataTable();
        } );
    </script>
    {{-- <script>
        var options = {
          filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
          filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token='
        };
      </script> --}}
</body>
</html>
