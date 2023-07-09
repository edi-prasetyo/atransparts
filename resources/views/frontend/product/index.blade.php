@extends('layouts.app')
@section('content')
<div class="container my-5">

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="fw-bold text-body-emphasis">{{__('homepage.our_product')}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-5"> <span class="text text-center">
            {{__('homepage.product_desc')}}
        </span>
    </div>

    <div class="row">
        @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
        @endif
        @forelse($products as $product)
        <div class="col-md-3">
            <div class="card-product mb-3">
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

        </div>
        @empty
        <div class="h-100">
            <div class="col-md-8 mx-auto my-auto">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="my-auto">No Products Available</div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection