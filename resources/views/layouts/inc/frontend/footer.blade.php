<div class="footer-area mt-auto">
    <div class="container col-md-9 mx-auto">
        <div class="row">
            <div class="col-md-3">
                <h4 class="footer-heading">About Us</h4>
                <div class="footer-underline"></div>
                <p>
                    {{$about_nav->aboutTranslations->first()->content}}
                </p>
            </div>
            <div class="col-md-2">
                <h4 class="footer-heading">Links</h4>
                <div class="footer-underline"></div>
                <div class="mb-2">
                    <a class="nav-link active" aria-current="page"
                        href="{{url(LaravelLocalization::getCurrentLocale())}}">{{__('general.menu_home')}}</a>
                </div>
                @foreach($menu_nav as $menu)
                <div class="mb-2"> <a class="nav-link"
                        href="{{url(LaravelLocalization::getCurrentLocale() .'/'.$menu->link)}}">{{$menu->menuTranslations->first()->name}}</a>
                </div>
                @endforeach

            </div>

            <div class="col-md-4">
                <h4 class="footer-heading">{{__('general.address')}}</h4>
                <div class="footer-underline"></div>
                <div class="mb-2">
                    <p>
                        <i class='bx bxs-map'></i>
                        {{$option_nav->address}}
                    </p>
                </div>
                <div class="mb-2">
                    <a href="" class="text-white">
                        <i class='bx bx-phone'></i> {{$option_nav->phone}}
                    </a>
                </div>
                <div class="mb-2">
                    <a href="" class="text-white">
                        <i class='bx bxl-whatsapp'></i> {{$option_nav->whatsapp}}
                    </a>
                </div>
                <div class="mb-2">
                    <a href="" class="text-white">
                        <i class='bx bx-envelope'></i> {{$option_nav->email}}
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading">{{__('general.shop_footer')}}</h4>
                <div class="footer-underline"></div>
                <div class="col-md-6">
                    <a href="https://www.tokopedia.com/atrans" target="blank"> <img class="mb-2 img-fluid"
                            src="{{asset('uploads/logo/tokopedia-logo.png')}}"></a>
                    <a href=""> <img class="img-fluid" src="{{asset('uploads/logo/shopee-logo.png')}}"> </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright-area">
    <div class="container col-md-9 mx-auto">
        <div class="row">
            <div class="col-md-8">
                <p class=""> &copy; 2022 - {{date('Y')}} {{$option_nav->tagline}}. All rights reserved.</p>
            </div>
            <div class="col-md-4">
                <div class="social-media">
                    <span class="text-white"> Get Connected :</span>
                    <a href=""><i class='bx bxl-facebook'></i></a>
                    <a href=""><i class='bx bxl-twitter'></i></a>
                    <a href=""><i class='bx bxl-instagram'></i></a>
                    <a href=""><i class='bx bxl-youtube'></i></a>
                </div>
            </div>
        </div>
    </div>
</div>