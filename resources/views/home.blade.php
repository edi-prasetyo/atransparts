@extends('layouts.app')

@section('content')
@include('layouts.inc.frontend.header')
<div class="container">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="col-md-5">
            <div class="card rounded-4 mb-3 bg-primary border-0 bg-opacity-75 text-white">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="media-body text-start">
                                <span>Deposit</span>
                                <h3 class="">IDR. 0</h3>
                                <small style="font-size: 10px">Deposit digunakan untuk membeli produk digital di Graha
                                    Studio
                                </small>

                            </div>
                            <div class="align-self-center">
                                <i class="bx bx-wallet text-primary-emphasis text-opacity-0 display-2 float-end"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-4 mb-3 bg-danger border-0 bg-opacity-75 text-white">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="media-body text-start">
                                <span>Total Pesanan</span>
                                <h3 class="">0</h3>
                                <small> </small>

                            </div>
                            <div class="align-self-center">
                                <i
                                    class="bx bx-shopping-bag text-primary-emphasis text-opacity-0 display-2 float-end"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection