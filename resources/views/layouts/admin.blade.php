<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Link -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/icons/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/icons/feather-icons/feather.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{('admin/vendor/autocomplete/jquery-ui.css')}}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendor/fonts/poppins/styles.css')}}">

    <!-- Select 2 -->
    {{-- Select 2 Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


</head>

<body>
    <div class="d-flex" id="wrapper">

        @include('layouts.inc.admin.sidebar')

        <div id="page-content-wrapper">
            @include('layouts.inc.admin.navbar')
            <div class="container-fluid my-3 me-3">

                <div class="row">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    {{-- Select 2 Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- End Select 2 --}}

    {{-- <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script> --}}
    {{-- <script src="{{asset('admin/vendor/autocomplete/jquery-ui.js')}}"></script> --}}

    <link href="{{asset('admin/vendor/summernote/summernote-lite.min.css')}}" rel="stylesheet">
    <script src="{{asset('admin/vendor/summernote/summernote-lite.min.js')}}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });
        $('#summernote2').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });
        $('#summernote3').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });
        $('#summernote4').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });
        $('#summernote5').summernote({
            tabsize: 2
            , height: 130,

            tooltip: false
        });

    </script>
    <!--Menu Toggle Script-->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    </script>
    @yield('scripts')

</body>

</html>