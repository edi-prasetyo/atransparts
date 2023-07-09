@extends('layouts.admin')

@section('content')
@if(session('message'))
<div class="alert alert-danger">
    {{session('message')}}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Create Category</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/menus')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">

                        <label class="form-label">Parent</label>
                        <select name="parent_id"
                            class="form-select form-select mb-3 @error('parent_id') is-invalid @enderror">
                            <option value="">--Select Parent--</option>
                            <option value="0">No Parent</option>
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->slug }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror">
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror">
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
</div>

@endsection