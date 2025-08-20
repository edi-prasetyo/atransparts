@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Buat Garansi Baru</h3>

        <form action="{{ route('warranties.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="product_id" class="form-label">Pilih Produk</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Generate Garansi</button>
        </form>
    </div>
@endsection
