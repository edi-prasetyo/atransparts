@extends('layouts.app')
@section('title', 'PT. Atrans Autoparts Indonesia')
@section('content')


{{-- <section class=" mt-3">
    <div class="container">
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="{{url('uploads/products/banner.jpg')}}" width="100%" height="auto">

                </div>
                <div class="carousel-item">
                    <img src="{{url('uploads/products/banner.jpg')}}" width="100%" height="auto">

                </div>
                <div class="carousel-item">
                    <img src="{{url('uploads/products/banner.jpg')}}" width="100%" height="auto">

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</section> --}}

<section class="mb-3 bg-dark bg-gradient p-3">
    <div class="container px-4 px-lg-0 ">
        <!-- Hero Section -->
        <div class="row align-items-center">
            <div class=" col-xl-6 col-md-12 py-6 py-xl-0">
                <div class="mb-4 text-center text-xl-start px-md-8 px-lg-19 px-xl-0 text-white">
                    <!-- Caption -->
                    <h1 class="display-3 fw-bold mb-3 ls-sm ">
                        {{__('homepage.hero_title')}}
                    </h1>
                    <p class="mb-6 lead pe-lg-6">
                        {{__('homepage.hero_desc')}}
                    </p>
                    <!-- List -->
                    <a href="{{url(LaravelLocalization::getCurrentLocale() . '/products')}}" class="btn btn-warning"
                        target="_blank" title="Buy Geeks"><i
                            class="bi bi-cart-check-fill me-2"></i>{{__('homepage.hero_button')}}</a>


                </div>
            </div>
            <div class="offset-xl-1 col-xl-5 col-md-12  d-flex justify-content-end">
                <div class="">
                    <a href="{{url(LaravelLocalization::getCurrentLocale() . '/products')}}" target="_blank"
                        title="Geeks Education Website Template"><img src="{{asset('uploads/slider/bg-product.png')}}"
                            alt="Geeks UI Academy bootstrap 5 Templates"
                            class="img-fluid rounded-3 smooth-shadow-md"></a>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-2">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center">
            <h1 class="fw-bold text-body-emphasis">{{__('homepage.our_product')}}</h1>
        </div>
        <div class="d-flex justify-content-center mb-5"> <span class="text text-center">
                {{__('homepage.product_desc')}}
            </span>
        </div>

        <div class="row">

            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card">

                    <a href="{{url('product/'.$product->slug)}}" class="text-muted text-decoration-none">
                        <div class="card-img-cover">
                            <div class="card-img-frame">
                                <img src="{{asset($product->productImages[0]->image)}}" class="card-img-top mb-3"
                                    alt="{{$product->slug}}">
                            </div>
                        </div>
                    </a>
                    <div class="card-body">

                        {{$product->category_name}}
                        <h5 class="card-title fw-bold">
                            {{$product->productTranslations->first()->name}}
                        </h5>
                        <p>{{Str::limit(strip_tags($product->productTranslations->first()->description),80)}}</p>

                    </div>

                    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">

                        <a href="{{url(LaravelLocalization::getCurrentLocale() . '/product/'.$product->slug)}}"
                            class="btn btn-success btn-sm text-center">
                            <i class='bx bx-plus'></i> {{__('general.read_more')}}</a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

</section>


<section class="my-5">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="fw-bold text-body-emphasis">{{__('homepage.latest_news')}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-5"> <span class="text text-center">
            {{__('homepage.news_desc')}}
        </span>
    </div>
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card border-0 p-3">
                    <div class="post-img-cover rounded">
                        <div class="post-img-frame">
                            <img src="{{asset('uploads/posts/' .$post->image)}}" class="rounded" alt="...">
                        </div>
                    </div>

                    <h4 class="card-title my-3">
                        <a class="link-dark text-decoration-none"
                            href="{{url(LaravelLocalization::getCurrentLocale() .'/news/'. $post->slug)}}">
                            {{$post->postTranslations->first()->title}}
                        </a>
                    </h4>
                    <p class="card-text text-muted">
                        {{Str::limit(strip_tags($post->postTranslations->first()->content),80)}}</p>
                    <div class="d-flex justify-content-between align-items-start text-muted">
                        <div class="date">
                            <i class='bx bx-calendar'></i> <small>{{date('j M Y',
                                strtotime($post->created_at))}}</small>
                        </div>
                        <div class="view">
                            <i class='bx bx-show'></i> <small>{{$post->views}} View </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- <section>
    <div class="container px-4 py-5">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col-md-7 d-flex flex-column align-items-start gap-2">
                <h1 class="fw-bold text-body-emphasis">Kompatibel dengan berbagai merek Kendaraan</h1>
                <p class="text-body-secondary">Produk Kami bisa di gunakan untuk berbagai merek kendaraan ternama yang
                    ada di
                    Indonesia. Kualitas produk yang kami berikan sudah tersertifikasi dan sudah teruji. Pastikan kode
                    produk sesuai dengan merek atau type mobil. </p>
                <a href="#" class="btn btn-primary btn-lg">Primary button</a>
            </div>

            <div class="col-md-5">
                <div class="row ">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://www.toyota.astra.co.id/sites/default/files/2019-11/fit-tc-logo.jpeg">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://seeklogo.com/images/N/Nissan-logo-4B3C580C8A-seeklogo.com.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://cdn.pixabay.com/photo/2016/08/15/18/18/mitsubishi-1596079_640.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://cdn.iconscout.com/icon/free/png-256/free-suzuki-282144.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://i.pinimg.com/736x/8a/07/95/8a07951e3b485d74996cb21fadae18a0.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuPq6k18jU-XE3YWQ5i6JTuKmavp90VIEFCw&usqp=CAU">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section> --}}

{{-- <section>
    <div class="container">
        <div class="card bg-primary mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hero">
                        <img class="img-fluid" src="{{url('uploads/slider/montir.png')}}">
                    </div>
                </div>
                <div class="col-md-8 text-white">
                    <h1 class="ps-5 pe-5 pt-5 fw-bold">Solusi Suku cadang kendaraan Bermotor Terbaik dan Berkualitas!
                    </h1>
                    <p class="ps-5 pe-5 mb-5 mt-3"> Cek kondisi mobil kesayangan Anda agar terhindar dari kerusakan
                        parah dan
                        membuat
                        biaya
                        perbaikannya makin mahal. Periksa kondisi komponen mobil Anda hingga di 32 titik dengan General
                        Checkup di Dokter Mobil, GRATIS per hari hanya untuk 15 mobil saja!
                    </p>
                    <button class="btn btn-warning btn-lg ms-5 mb-3 ps-5 pe-5 pt-3 pb-3"> Chat Sekarang </button>
                </div>
            </div>
        </div>
    </div>
</section> --}}


@endsection