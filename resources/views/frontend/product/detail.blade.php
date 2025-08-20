@extends('layouts.app')
@section('title', 'Products')
@section('content')

    <div class="container my-5 pb-5">

        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-7">
                        <div class="white-box text-center">
                            <img src="{{ asset($product->productImages[0]->image ?? '') }}" class="img-fluid rounded-4">
                        </div>
                    </div>

                    <div class="col-md-5">
                        {{-- <h3 class="card-title">{{$product->name}}</h3>
                    <p>{{$product->short_description}}</p> --}}

                        <h2 class="mt-3 mb-3">
                            {{ $product->name }}
                        </h2>


                        <div class="d-flex">
                            <div class="text-center me-2">
                                <div class="bg-warning p-1 text-white">
                                    <span class="display-5 fw-bold">4.9</span><br>
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
                    </div>

                    <p>{!! $product->description !!}</p>

                </div>







                <div class="row">
                    @foreach ($part_number as $key => $part)
                        <div class="col-md-4">
                            <!-- Trigger Modal -->
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#partModal{{ $part->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Brand <b>{{ $part->productBrand->name }}</b></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">
                                            Part Number <b>{{ $part->number }}</b> <br>
                                            OEM Number <b>{{ $part->model_number }}</b>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="partModal{{ $part->id }}" tabindex="-1"
                            aria-labelledby="partModalLabel{{ $part->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="partModalLabel{{ $part->id }}">Detail Part Number
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Brand:</strong> {{ $part->productBrand->name }}</p>
                                        <p><strong>Part Number:</strong> {{ $part->number }}</p>
                                        <p><strong>OEM Number:</strong> {{ $part->model_number }}</p>
                                        <p><strong>Untuk Mobil:</strong> {{ $part->brand ?? '-' }}</p>
                                        <!-- Tambahkan informasi lain sesuai kebutuhan -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="col-md-3">
                @include('frontend.product.sidebar')
            </div>


        </div>

    </div>













@endsection
