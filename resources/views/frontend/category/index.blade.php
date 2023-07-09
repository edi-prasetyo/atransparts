@extends('layouts.app')
@section('title', 'Category')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-5">

    <div class="row">
        @forelse($categories as $category)
        <div class="col-md-4">
            <div class="card text-center text-white bg-dark">
                <div class="card-img-cover">
                    <div class="card-img-frame">
                        <img src="{{asset($category->image)}}" class="card-img-top" alt="{{$category->name}}">
                    </div>
                </div>
                <div class="card-body bg-dark">
                    <h5 class="card-title">{{$category->name}}</h5>
                    <a href="{{url('category/'.$category->slug)}}" class="btn btn-primary">Show Product</a>
                </div>
            </div>
        </div>
        @empty
        <div class="h-100">
            <div class="col-md-8 mx-auto my-auto">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="my-auto">No Categoy Available</div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection