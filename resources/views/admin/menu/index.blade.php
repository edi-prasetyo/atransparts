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
            <h4 class="my-auto">Menu Manajeman</h4>
            <a href="{{url('admin/menus/create')}}" class="btn btn-success">Add Menu</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->slug}}</td>
                        <td>{{$menu->link}}</td>
                        <td>
                            @if($menu->status == 1)
                            <span class="badge bg-light-success text-success">Active</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Inactive</span>
                            @endif
                            {{-- {{$category->status == '1' ? 'active':'inactive'}} --}}
                        </td>
                        <td>
                            <a href="{{url('admin/menus/show/' .$menu->id)}}"
                                class="btn btn-sm btn-info text-white">Translate</a>
                            <a href="{{url('admin/menus/edit/' .$menu->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="#" wire:click="deleteCategory({{$menu->id}})"
                                class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$menus->links()}}
    </div>
</div>
@endsection