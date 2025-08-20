@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card my-5">
                <div class="card-header bg-white">
                    <h5>Aktivasi Garansi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('warranty.activate.store', $warranty->code) }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nomor HP</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nopol Kendaraan</label>
                            <input type="text" name="nopol" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>KM Kendaraan</label>
                            <input type="text" name="km" class="form-control">
                        </div>


                        <button type="submit" class="btn btn-primary">Aktifkan</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
