@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Slider</h4>
            <a href="{{ url('admin/sliders/create') }}" class="btn btn-success text-white">Add Slider</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                    <tr>
                        <td>{{$slider->id}}</td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <td><img width="20%" class="img-fluid" src="{{asset($slider->image)}}"> </td>
                        <td>
                            @if($slider->status == 1)
                            <span class="badge bg-light-success text-success">Active</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/sliders/edit/' .$slider->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            @include('admin.slider.delete')
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Slider Available </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-body">

        </div>
    </div>
</div>
@endsection