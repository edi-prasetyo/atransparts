@extends('layouts.admin')
@section('content')

<div class="col-md-12 mb-3">
    @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Produk</h5>
                    <span class="h4 font-weight-bold mb-0">{{count($products)}}</span>
                </div>
                <div class="icon icon-shape bg-light-success text-success rounded-circle">
                    <i class="feather-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Product View</h5>
                    <span class="h4 font-weight-bold mb-0">{{$product_views}}</span>
                </div>
                <div class="icon icon-shape bg-light-primary text-primary rounded-circle">
                    <i class="feather-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Total News View</h5>
                    <span class="h4 font-weight-bold mb-0">{{$post_views}}</span>
                </div>
                <div class="icon icon-shape bg-light-primary text-primary rounded-circle">
                    <i class="feather-eye"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection