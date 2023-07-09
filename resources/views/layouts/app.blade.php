<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="description" content="@yield('meta_description')">
  <meta name="keywords" content="@yield('meta_keyword')">
  <meta name="author" content="@yield('title')">
  <meta property="og:image" content="@yield('image')">
  <link rel="stylesheet" href="{{asset('assets/vendor/boxicon/css/boxicons.min.css')}}">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/offcanvas/offcanvas-navbar.css')}}" rel="stylesheet">
  {{--
  <link href="{{asset('assets/vendor/fonts/poppins/styles.css')}}" rel="stylesheet"> --}}
</head>

<body class="d-flex flex-column min-vh-100">
  <div id="app">
    @include('layouts.inc.frontend.navbar')

    <main>
      @yield('content')
    </main>
  </div>
  @include('layouts.inc.frontend.footer')
  <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/vendor/offcanvas/offcanvas-navbar.js')}}"></script>
  {{-- <script type="text/javascript">
    var nav = document.querySelector('nav');
  
        window.addEventListener('scroll', function () {
          if (window.pageYOffset > 100) {
            nav.classList.add('bg-white', 'shadow-sm');
          } else {
            nav.classList.remove('bg-white', 'shadow-sm');
          }
        });
  </script> --}}
  @yield('scripts')
</body>

</html>