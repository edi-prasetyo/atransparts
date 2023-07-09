<header class="py-3 mb-3 border-bottom bg-white">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        <a href="" class="ms-3 text-muted" id="menu-toggle"><i class="feather-menu fa-2x"></i>
        </a>
        <div class="d-flex align-items-center">
            <div class="w-100 me-3">
            </div>
            <div class="flex-shrink-0 dropdown me-3">
                <a href="#" class="d-block link-dark text-decoration-none text-muted" id="dropdownUser2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('uploads/user/9.png')}}" alt="mdo" width="32" height="32" class="rounded-circle">
                    <b> {{ Auth::user()->name }}</b>
                </a>
                <ul class="dropdown-menu text-small shadow border-0 mt-3" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item p-2 text-muted" href="#"><i class="feather-user"></i> Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="feather-log-out"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>