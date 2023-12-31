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
  <link rel="shortcut icon" href="{{asset('uploads/logo/'.$option_nav->favicon)}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/boxicon/css/boxicons.min.css')}}">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/offcanvas/offcanvas-navbar.css')}}" rel="stylesheet">
  {!! ReCaptcha::htmlScriptTagJsApi() !!}

</head>

<body class="d-flex flex-column min-vh-100">
  <div id="app">
    @include('layouts.inc.frontend.navbar')

    <main>
      @yield('content')
      <a href="{{url('contact')}}" class="act-btn-map">
        <img class="img-fluid" src="{{asset('uploads/logo/find.png')}}"> </a>
      <a href="https://www.tokopedia.com/atrans" target="blank" class="act-btn-tokped">
        <img class="img-fluid" src="{{asset('uploads/logo/tokopedia.png')}}"> </a>
      <a href="#" class="act-btn-shopee">
        <img class="img-fluid" src="{{asset('uploads/logo/shopee.png')}}"> </a>
      </a>
    </main>
  </div>
  @include('layouts.inc.frontend.footer')
  <script src="{{asset('assets/vendor/offcanvas/offcanvas-navbar.js')}}"></script>
  <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

  @yield('scripts')
</body>

</html>