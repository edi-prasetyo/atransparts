<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Link -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/icons/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/icons/feather-icons/feather.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/vendor/autocomplete/jquery-ui.css') }}">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendor/fonts/poppins/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <!-- Select 2 -->
    {{-- Select 2 Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @stack('styles')


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
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    {{-- End Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    {{-- <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script> --}}
    {{-- <script src="{{asset('admin/vendor/autocomplete/jquery-ui.js')}}"></script> --}}

    <link href="{{ asset('admin/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/vendor/summernote/summernote-lite.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
        $('#summernote2').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
        $('#summernote3').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
        $('#summernote4').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
        $('#summernote5').summernote({
            tabsize: 2,
            height: 130,

            tooltip: false
        });
    </script>
    <!--Menu Toggle Script-->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        // Sweet Alert

        function showAlert(icon, title, text = '') {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                position: 'center',
                background: '#fff',
                width: '400px',
                customClass: {
                    popup: 'minimal-modal'
                }
            });
        }

        @if (session('success'))
            showAlert('success', {!! json_encode(session('success')) !!});
        @elseif (session('error'))
            showAlert('error', {!! json_encode(session('error')) !!});
        @elseif (session('warning'))
            showAlert('warning', {!! json_encode(session('warning')) !!});
        @elseif (session('info'))
            showAlert('info', {!! json_encode(session('info')) !!});
        @endif

        @if ($errors->any())
            showAlert('error', 'Validation Error', {!! json_encode(implode(' ', $errors->all())) !!});
        @endif

        // Setelah alert tampil, hilangkan history state supaya tidak muncul lagi saat reload/back
        history.replaceState(null, null, location.pathname);
    </script>

    <style>
        .swal2-popup.minimal-modal {
            font-size: 14px;
            padding: 1.5em;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .swal2-title {
            font-size: 16px !important;
        }
    </style>
    @stack('scripts')


</body>

</html>
