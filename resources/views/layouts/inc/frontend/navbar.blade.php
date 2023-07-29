<nav class="bg-light-emphasis border-bottom">
    <div class="top-navbar bg-light py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <i class='bx bxl-whatsapp fs-5'></i> {{$option_nav->whatsapp}} <i
                        class='bx bx-envelope ms-5 fs-5'></i>
                    {{$option_nav->email}}
                </div>
                <div class="col-md-6 my-auto">
                    <ul class="nav justify-content-end">

                        {{-- <button type="button" class="btn btn-outline-secondary"><i
                                class='bx bxl-facebook-circle'></i></button>
                        <button type="button" class="btn btn-outline-secondary"> <i
                                class='bx bxl-instagram-alt'></i></i></button>
                        <button type="button" class="btn btn-outline-secondary"><i
                                class='bx bxl-tiktok'></i></i></button> --}}



                        {{-- <li class="nav-item">
                            <a class="nav-link border-end" aria-current="page" href="#">
                                EN</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">ID</a>
                        </li> --}}

                        {{-- @guest
                        @if (Route::has('register'))
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary" href="{{ route('register') }}"><i class='bx bx-user'></i>
                                {{
                                __('Register') }}</a>
                        </li>
                        @endif

                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-primary text-white px-3" href="{{ route('login') }}"><i
                                    class='bx bx-log-in'></i> {{
                                __('Login') }}
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @if(Auth::user()->role_as == 1 || (Auth::user()->role_as == 2))
                                <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                    Dashboard
                                </a>
                                @else

                                @endif
                            </div>
                        </li>
                        @endguest --}}

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar bg-white navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand d-block d-sm-block" href="{{url(LaravelLocalization::getCurrentLocale())}}">
            <img src="{{asset('uploads/logo/' .$option_nav->logo)}}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end text-muted text-bg-light" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img
                        src="{{asset('uploads/logo/' .$option_nav->logo)}}"></h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav flex-grow-1 pe-3">
                    {{-- <li class="nav-item w-75">
                        <form role="search">
                            <div class="input-group">
                                <input type="text" class="form-control pe-5 pe-3" placeholder="Cari Produk"
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="button" id="button-addon2"><i
                                        class='bx bx-search'></i></button>
                            </div>
                        </form>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{url(LaravelLocalization::getCurrentLocale())}}">{{__('general.menu_home')}}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{__('general.menu_product')}}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($product_nav as $product)
                            <li><a class="dropdown-item"
                                    href="{{url(LaravelLocalization::getCurrentLocale(). '/product/' .$product->slug)}}">{{$product->productTranslations->first()->name}}</a>
                            </li>
                            @endforeach


                        </ul>
                    </li>

                    @foreach($menu_nav as $menu)

                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{url(LaravelLocalization::getCurrentLocale() .'/'.$menu->link)}}">{{$menu->menuTranslations->first()->name}}</a>
                    </li>

                    @endforeach


                </ul>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{asset('uploads/logo/'.LaravelLocalization::getCurrentLocale().'.svg')}}">
                            {{strtoupper(LaravelLocalization::getCurrentLocale())}}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                            <li><a class="dropdown-item" href="{{LaravelLocalization::getLocalizedUrl($locale)}}">
                                    <img src="{{asset('uploads/logo/'.$locale.'.svg')}}">
                                    {{strtoupper($locale)}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </li>

                    {{--
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" class="dropdown-item text-dark" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <img src="{{asset('uploads/logo/'.$localeCode.'.svg')}}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul> --}}






                    {{-- <li class="nav-item">
                        <a class="nav-link px-3" href="{{ url('cart') }}"><i class="bx bx-cart fs-4"
                                aria-hidden="true"></i> Cart <span class="badge bg-primary rounded-pill">{{
                                count((array)
                                session('cart')) }}</span></a>
                    </li>
                    @guest
                    @else
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ url('cart') }}"><i class="bx bx-heart fs-4"
                                aria-hidden="true"></i> Wishlist <span class="badge bg-primary rounded-pill">{{
                                count((array)
                                session('cart')) }}</span></a>
                    </li>
                    @endguest --}}



                    @guest
                    @if (Route::has('register'))
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary" href="{{ route('register') }}"><i class='bx bx-user'></i>
                            {{
                            __('Register') }}</a>
                    </li>
                    @endif

                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="btn btn-primary text-white px-3" href="{{ route('login') }}"><i
                                class='bx bx-log-in'></i> {{
                            __('Login') }}
                        </a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                            @if(Auth::user()->role_as == 1 || (Auth::user()->role_as == 2))
                            <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                Dashboard
                            </a>
                            @else

                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest



                </ul>





            </div>
        </div>



    </div>
</nav>