@extends('layouts.admin')

@section('content')
<div class="col-md-12">

    <div class="card my-3">
        <div class="card-header bg-white">
            <h4>Create Vehicle</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/vehicles')}}" method="POST">
                    @csrf
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
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Vehicle</h4>
            <a href="{{url('admin/vehicles/create')}}" class="btn btn-success text-white">Add Vehicle</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->brand_name}}</td>
                        <td>
                            @if($data->status == 1)
                            <span class="badge bg-light-success text-success">Active</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Inactive</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{url('admin/vehicles/edit/' .$data->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="#" wire:click="deleteBrand({{$data->id}})" class="btn btn-sm btn-danger text-white"
                                data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$vehicles->links()}}
    </div>
</div>
@endsection