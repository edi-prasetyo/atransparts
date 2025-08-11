@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Edit Permission</h3>
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Route Name</label>
                <input type="text" name="route_name" class="form-control" value="{{ $permission->route_name }}" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="{{ $permission->description }}">
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
