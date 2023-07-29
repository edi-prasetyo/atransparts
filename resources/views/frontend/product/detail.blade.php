@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="container my-5">

    <div class="row">

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-7">
                    <div class="white-box text-center">
                        <img src="{{asset($product->productImages[0]->image)}}" class="img-fluid rounded-4">
                    </div>
                </div>

                <div class="col-md-5">
                    <h3 class="card-title">{{$product->name}}</h3>
                    <p>{{$product->short_description}}</p>

                    <h2 class="mt-3 mb-3">
                        {{$product->productTranslations->first()->name}}
                    </h2>


                    <div class="d-flex">
                        <div class="text-center me-2">
                            <div class="bg-warning p-1 text-white">
                                <span class="display-5 fw-bold">4.8</span><br>
                                <p class="">out of 5</p>
                            </div>
                            <div>
                                <span class="bx bxs-star text-warning mx-1"></span>
                                <span class="bx bxs-star text-warning mx-1"></span>
                                <span class="bx bxs-star text-warning mx-1"></span>
                                <span class="bx bxs-star text-warning mx-1"></span>
                                <span class="bx bxs-star-half text-warning mx-1"></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="row align-items-center">
                                <div class="col-4 text-end">

                                    Excellent
                                </div>
                                <div class="col-8">
                                    <div class="progress" role="progressbar" aria-label="Warning example"
                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                                        <div class="progress-bar bg-warning" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4 text-end">
                                    Good
                                </div>
                                <div class="col-8">
                                    <div class="progress" role="progressbar" aria-label="Warning example"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4 text-end">
                                    Average
                                </div>
                                <div class="col-8">
                                    <div class="progress" role="progressbar" aria-label="Warning example"
                                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                                        <div class="progress-bar bg-warning" style="width: 10%"></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <a href="https://wa.me/{{$option_nav->whatsapp}}?text=Halo%20Saya%20Ingin%20Informasi%20Tentang%20Produk%20**{{$product->productTranslations->first()->name}}**%20yang%20saya%20lihat%20di%20{{url(LaravelLocalization::getCurrentLocale().'/product/'.$product->slug)}}"
                        class="btn btn-primary btn-rounded mt-3">{{__('general.buy')}}</a>

                </div>
            </div>
            <p>{!!$product->productTranslations->first()->description!!}</p>
        </div>

        <div class="col-md-3">
            @include('frontend.product.sidebar')
        </div>

    </div>

</div>













@endsection