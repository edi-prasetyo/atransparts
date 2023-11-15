@extends('layouts.app')
@section('title', 'PT. Atrans Autoparts Indonesia')
@section('content')

<section class="mb-3 bg-black p-3">
    <div class="container px-4 px-lg-0 ">
        <!-- Hero Section -->
        <div class="row align-items-center">
            <div class="col-md-6">
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
            <div class="col-md-6 d-flex justify-content-end">




                <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded">

                        @php $i = 1; @endphp

                        @foreach($sliders as $slider)
                        <div class="carousel-item <?php if ($i == 1) {
                            echo 'active';
                        } ?>">
                            <img src="{{$slider->image}}" width="100%" height="auto">

                        </div>
                        @endforeach

                        @php $i++; @endphp


                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>






                {{-- <div class="">
                    <a href="{{url(LaravelLocalization::getCurrentLocale() . '/products')}}" target="_blank"
                        title="Geeks Education Website Template"><img src="{{asset('uploads/slider/bg-product.png')}}"
                            alt="Geeks UI Academy bootstrap 5 Templates" class="img-fluid rounded-3 smooth-shadow-md">
                    </a>
                </div> --}}


            </div>
        </div>
    </div>
</section>


<section class="py-2">
    <div class="container col-md-9 mx-auto">

        <div class="d-flex justify-content-center align-items-center">
            <h1 class="fw-bold text-body-emphasis">{{__('homepage.our_product')}}</h1>
        </div>
        <div class="d-flex justify-content-center mb-5"> <span class="text text-center">
                {{__('homepage.product_desc')}}
            </span>
        </div>

        <div class="row">

            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-3">

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


<section class="my-3">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="fw-bold text-body-emphasis">{{__('homepage.latest_news')}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-5"> <span class="text text-center">
            {{__('homepage.news_desc')}}
        </span>
    </div>
    <div class="container col-md-9 mx-auto">
        <div id="posts" class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section>
    <div class="container px-4 py-3 pb-5 col-md-9 mx-auto">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col-md-7 d-flex flex-column align-items-start gap-2">
                <h1 class="fw-bold text-body-emphasis">{{__('homepage.merek_title')}}</h1>
                <p class="text-body-secondary">{{__('homepage.merek_desc')}} </p>
                <a href="{{url(LaravelLocalization::getCurrentLocale() .'/products')}}"
                    class="btn btn-primary btn-lg">{{__('homepage.hero_button')}}</a>
            </div>

            <div class="col-md-5">
                <div class="row ">
                    @foreach($brands as $key => $brand)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-fluid" src="{{asset('uploads/brand/' . $brand->image)}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>

<section>
    <div class="container">
        <div class="card bg-warning mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hero">
                        <img class="img-fluid" src="{{url('uploads/slider/montir.png')}}">
                    </div>
                </div>
                <div class="col-md-8 text-dark">
                    <h1 class="ps-5 pe-5 pt-5 fw-bold">{{__('homepage.cta_title')}}
                    </h1>
                    <p class="ps-5 pe-5 mb-5 mt-3">{{__('homepage.cta_desc')}}
                    </p>
                    <a href="https://wa.me/{{$option_nav->whatsapp}}"
                        class="btn btn-success btn-lg ms-5 mb-3 ps-5 pe-5 pt-3 pb-3"><i class='bx bxl-whatsapp'></i>
                        {{__('homepage.cta_chat')}} </a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: 'https://atransparts.com/blog/wp-json/wp/v2/posts?per_page=4&orderby=id',

            success: function (data) {
                var posts_html = '';
                $.each(data, function (index, post) {
                    posts_html += '<div class="col-md-3"><div class="card mb-3"><img class="img-fluid" src="' + post.yoast_head_json.og_image[0].url + '">';
                    posts_html += '<div class="card-body"><a class="text-decoration-none text-muted" href="' + post.link + '"><h4>' + post.title.rendered + '</h4></a></div>';
                    posts_html += '<div class="card-footer bg-white text-muted"><p> <i class="bx bx-user me-3"></i>' + post.yoast_head_json.author + '</p></div></div></div>';
                    
                });
                $('#posts').html(posts_html);
            },
            error: function (request, status, error) {
                alert(error);
            }
        });
    });
</script>
@endsection