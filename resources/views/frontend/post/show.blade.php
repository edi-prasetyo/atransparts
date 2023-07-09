@extends('layouts.app')
@section('title', 'PT. Atrans Autoparts Indonesia')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb my-5 pb-3">
        <ol class="breadcrumb visually-hidden">
            <li class="breadcrumb-item"><a href="{{url(LaravelLocalization::getCurrentLocale() .'/')}}"
                    class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->postTranslations->first()->title}}</li>
        </ol>
    </nav>
    <div class="col-md-9 mx-auto my-5">
        <div class="text-center"> <span class="badge bg-success-subtle text-success">Success</span> </div>
        <h1 class="my-3 text-center fw-bold">{{$post->postTranslations->first()->title}}</h1>
        <div class="text-center my-5 text-muted">
            <span class="me-3"> <i class='bx bx-calendar'></i> <small>{{date('j M Y',
                    strtotime($post->created_at))}}</small></span>
            <span class="ps-3 border-start"> <i class='bx bx-show'></i> <small>{{$post->views}} View </small></span>

        </div>
        <img src="{{asset('uploads/posts/' .$post->image)}}" class="img-fluid w-100 rounded">

        <div class="col-md-9 mx-auto my-5">
            <div class="post-content lh-lg">
                {!!$post->postTranslations->first()->content!!}
            </div>
        </div>
    </div>
</div>
@endsection