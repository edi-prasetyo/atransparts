@extends('layouts.app')
@section('title', 'Products')
@section('content')

<section class="mb-3 bg-dark bg-gradient p-3">
    <div class="container px-4 px-lg-0 ">
        <!-- Hero Section -->
        <div class="row align-items-center">
            <div class=" col-xl-6 col-md-12 py-6 py-xl-0">
                <div class="mb-4 text-center text-xl-start px-md-8 px-lg-19 px-xl-0 text-white">
                    <!-- Caption -->
                    <h1 class="display-3 fw-bold mb-3 ls-sm ">
                        {{$about->aboutTranslations->first()->title}}
                    </h1>
                    <p class="mb-6 lead pe-lg-6">
                        {{$about_nav->aboutTranslations->first()->content}}
                    </p>



                </div>
            </div>
            <div class="offset-xl-1 col-xl-5 col-md-12  d-flex justify-content-end">
                <div class="">
                    <a href="{{url(LaravelLocalization::getCurrentLocale() . '/products')}}" target="_blank"
                        title="Geeks Education Website Template"><img src="{{url('uploads/slider/' .$about->image)}}"
                            alt="Geeks UI Academy bootstrap 5 Templates"
                            class="img-fluid rounded-3 smooth-shadow-md"></a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="col-md-8 mx-auto">
        {!!$about->aboutTranslations->first()->content!!}
    </div>
</div>
@endsection