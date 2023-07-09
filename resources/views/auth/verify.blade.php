@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">


                <div class="card-body">
                    <h4>{{ __('Verify Your Email Address') }}</h4>

                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk
                            meminta link verifikasi baru') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection