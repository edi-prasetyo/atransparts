@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Category</h4>
            <a href="{{url('admin/posts/create')}}" class="btn btn-success">Add Post</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="5%">image</th>
                        <th scope="col">title</th>
                        <th scope="col">Status</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img class="img-fluid" src="{{asset('uploads/posts/' .$post->image)}}"> </td>
                        <td>{{$post->slug}}</td>
                        <td>
                            @if($post->status == 1)
                            <span class="badge bg-light-success text-success">Active</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Inactive</span>
                            @endif
                            {{-- {{$category->status == '1' ? 'active':'inactive'}} --}}
                        </td>
                        <td>
                            <a href="{{url('admin/posts/show/' .$post->id)}}" class="btn btn-sm btn-primary text-white">
                                <i class="fa-solid fa-language"></i> Add Translate</a>
                            <a href="{{url('admin/posts/edit/' .$post->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/posts/delete/' .$post->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$posts->links()}}
    </div>
</div>
@endsection