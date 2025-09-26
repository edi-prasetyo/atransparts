<nav class="navbar bg-white navbar-expand-lg shadow-sm">
    <div class="container col-md-9 mx-auto">
        <a class="navbar-brand d-block d-sm-block me-5" href="{{ url(LaravelLocalization::getCurrentLocale()) }}">
            <img width="200" src="{{ asset('uploads/logo/' . $option_nav->logo) }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end text-muted text-bg-light" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img
                        src="{{ asset('uploads/logo/' . $option_nav->logo) }}"></h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav flex-grow-1 pe-3">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ url(LaravelLocalization::getCurrentLocale()) }}">{{ __('general.menu_home') }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('general.menu_product') }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($product_nav as $product)
                                <li><a class="dropdown-item"
                                        href="{{ url(LaravelLocalization::getCurrentLocale() . '/product/' . $product->slug) }}">{{ $product->name }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </li>

                    @foreach ($menu_nav as $menu)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ url(LaravelLocalization::getCurrentLocale() . '/' . $menu->link) }}">{{ $menu->name ?? '-' }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
                    </li>

                </ul>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('uploads/logo/' . LaravelLocalization::getCurrentLocale() . '.svg') }}">
                            {{ strtoupper(LaravelLocalization::getCurrentLocale()) }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ LaravelLocalization::getLocalizedUrl($locale, null, [], true) }}">
                                        <img src="{{ asset('uploads/logo/' . $locale . '.svg') }}">
                                        {{ strtoupper($locale) }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>





                    @guest
                        @if (Route::has('register'))
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" href="{{ route('register') }}"><i
                                        class='bx bx-user'></i>
                                    {{ __('Register') }}</a>
                            </li>
                        @endif

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-primary text-white px-3" href="{{ route('login') }}"><i
                                        class='bx bx-log-in'></i> {{ __('Login') }}
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


                                @if (Auth::user()->roles()->whereIn('name', ['superadmin', 'admin', 'shop', 'finance'])->exists())
                                    <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                        Dashboard
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
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
