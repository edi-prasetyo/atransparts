@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Add Product</h4>
            <a href="{{ url('admin/products') }}" class="btn btn-success text-white"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
            <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Produksi</label>
                        <select name="production_id"
                            class="form-select form-select mb-3 @error('production_id') is-invalid @enderror">
                            <option value="">--Select Production--</option>
                            @foreach ($productions as $production)
                            <option value="{{ $production->id }}">{{ $production->name }} - {{$production->country}}
                            </option>
                            @endforeach
                        </select>
                        @error('production_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <h3 class="my-3 pt-3 border-top">Detail</h3>



                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" checked>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Trending</label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" name="trending">
                            </div>
                        </div>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Images</h3>
                    <div class="col-md-12">
                        <label class="form-label">Product Image</label>
                        <input type="file" multiple name="image[]" class="form-control">
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection