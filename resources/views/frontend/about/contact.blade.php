@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="container my-3">
    <nav aria-label="breadcrumb my-5 pb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(LaravelLocalization::getCurrentLocale() .'/')}}"
                    class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            {{$about_nav->aboutTranslations->first()->content}}

            <h4 class="my-3">{{__('general.address')}}</h4>
            <div class="mb-2">
                <p>
                    <i class='bx bxs-map'></i>
                    {{$option_nav->address}}
                </p>
            </div>
            <div class="mb-2">

                <i class='bx bx-phone'></i> {{$option_nav->phone}}

            </div>
            <div class="mb-2">

                <i class='bx bxl-whatsapp'></i> {{$option_nav->whatsapp}}

            </div>
            <div class="mb-2">

                <i class='bx bx-envelope'></i> {{$option_nav->email}}

            </div>


        </div>
        <div class="col-md-6">
            {!!$option_nav->maps!!}
        </div>
    </div>
</div>

@endsection