@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Add Permission</h3>
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Route Name</label>
                <input type="text" name="route_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description (optional)</label>
                <input type="text" name="description" class="form-control">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
