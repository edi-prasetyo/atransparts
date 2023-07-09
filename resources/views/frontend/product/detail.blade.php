@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="container my-5">

    <div class="row">
        <div class="col-md-3">
            @include('frontend.product.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-6">
                    <div class="white-box text-center">
                        <img src="{{asset($product->productImages[0]->image)}}" class="img-fluid rounded-4">
                    </div>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-6">
                    <h3 class="card-title">{{$product->name}}</h3>
                    <p>{{$product->short_description}}</p>

                    <h2 class="mt-3 mb-3">
                        {{$product->productTranslations->first()->name}}
                    </h2>

                    {{-- <div class="rating-block">

                        <h2 class="bold padding-bottom-7">4.8 <small>/ 5</small></h2>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="bx bxs-star text-white" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="bx bxs-star text-white" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="bx bxs-star text-white" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="bx bxs-star text-white" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default btn-secondary btn-sm" aria-label="Left Align">
                            <span class="bx bxs-star text-white" aria-hidden="true"></span>
                        </button>
                    </div> --}}






                    {{-- <div class="row justify-content-left d-flex">
                        <div class="col-md-4 d-flex flex-column">
                            <div class="rating-box bg-warning text-center">
                                <h1 class="pt-4">4.8</h1>
                                <p class="">out of 5</p>
                            </div>
                            <div> <span class="bx bxs-star star-active mx-1"></span> <span
                                    class="bx bxs-star star-active mx-1"></span> <span
                                    class="bx bxs-star star-active mx-1"></span> <span
                                    class="bx bxs-star star-active mx-1"></span> <span
                                    class="bx bxs-star star-inactive mx-1"></span> </div>
                        </div>
                        <div class="col-md-8">
                            <div class="rating-bar0 justify-content-center">
                                <table class="text-left mx-auto">
                                    <tr>
                                        <td class="rating-label">Excellent</td>
                                        <td class="">
                                            <div class="progress" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-warning w-75"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">123</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Good</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-4"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">23</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Average</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-3"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">10</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Poor</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-2"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">3</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Terrible</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-1"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div> --}}




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

    </div>

</div>













@endsection