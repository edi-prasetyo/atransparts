@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card my-5">
                <div class="card-header bg-white">
                    <h5>Cek Garansi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('warranty.check') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Kode Garansi</label>
                            <input type="text" name="warranty_code"
                                class="form-control @error('warranty_code') is-invalid @enderror"
                                placeholder="masukan kode garansi" required value="{{ old('warranty_code') }}">

                            @error('warranty_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Cek garansi</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
