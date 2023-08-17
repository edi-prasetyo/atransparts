@extends('layouts.admin')

@section('content')
<div class="col-md-12">

    <div class="card my-3">
        <div class="card-header bg-white">
            <h4>Create Vehicle</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/vehicles/' .$vehicle->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Brand</label>
                            <select class="form-select" name="brand_id" id="single-select-field"
                                data-placeholder="Pilih Brand">
                                @foreach($brands as $key => $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{$vehicle->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label">Status</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="status" checked>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection