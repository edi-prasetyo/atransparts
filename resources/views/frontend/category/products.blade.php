@extends('layouts.app')

@section('title')
{{$category->meta_title}}
@endsection
@section('meta_keyword')
{{$category->meta_keyword}}
@endsection
@section('meta_description')
{{$category->meta_description}}
@endsection
@section('image')
{{asset($category->image)}}
@endsection

@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-5">
    <div class="row">
        @forelse($products as $item)
        <div class="col-md-3">
            <div class="card-product">
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('item/'.$item->slug)}}" class="text-muted text-decoration-none">
                            <div class="card-img-cover">
                                <div class="card-img-frame">
                                    <img src="{{asset($item->productImages[0]->image)}}" class="card-img-top mb-3"
                                        alt="{{$item->name}}">
                                </div>
                            </div>
                        </a>
                        {{$category->name}}
                        <h5 class="card-title">{{$item->name}}</h5>
                        <div class="card-text d-flex justify-content-between align-items-start">
                            <div class="star-rating text-warning">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star-half'></i>
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="fw-bold">4.5 (25) </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                        IDR {{number_format($item->selling_price,0)}}
                        <a href="{{ url('add-to-cart/'.$item->id) }}" class="btn btn-success btn-sm text-center"
                            role="button">
                            <i class='bx bx-plus'></i> Add</a>
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