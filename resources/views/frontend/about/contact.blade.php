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
            <hr>
            <h4 class="fw-bold">Kirim Pesan</h4>
            {{-- @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif --}}

            @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <form action="{{url('contact_send')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. HP</label>
                            <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text"
                                value="{{ old('phone') }}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pesan</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                name="message">{{ old('message') }}</textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row my-3">

                        <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                    </div>


                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary ps-5 pe-5">Kirim</button>
                    </div>
                </div>
            </form>


        </div>
        <div class="col-md-6">
            {!!$option_nav->maps!!}
        </div>
    </div>
</div>

@endsection