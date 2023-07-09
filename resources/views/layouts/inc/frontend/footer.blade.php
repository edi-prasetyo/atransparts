<div class="footer-area mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="footer-heading">About Us</h4>
                <div class="footer-underline"></div>
                <p>
                    {{$about_nav->aboutTranslations->first()->content}}
                </p>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading">Quick Links</h4>
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
            <div class="col-md-3">
                <h4 class="footer-heading">{{__('general.shop_footer')}}</h4>
                <div class="footer-underline"></div>

                @foreach($product_nav as $product)
                <div class="mb-2"><a class="dropdown-item"
                        href="{{url(LaravelLocalization::getCurrentLocale(). '/product/' .$product->slug)}}">{{$product->productTranslations->first()->name}}</a>
                </div>
                @endforeach

            </div>
            <div class="col-md-3">
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
        </div>
    </div>
</div>
<div class="copyright-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class=""> &copy; 2022 - {{date('Y')}} {{$option_nav->tagline}}. All rights reserved.</p>
            </div>
            <div class="col-md-4">
                <div class="social-media">
                    Get Connected:
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>