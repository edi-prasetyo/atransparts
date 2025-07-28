@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Customer</h4>
                <a href="{{ url('admin/customers/create') }}" class="btn btn-success text-white">Add Customer</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">phone</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <a href="{{ url('admin/brands/edit/' . $data->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="#" wire:click="deleteBrand({{ $data->id }})"
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
            {{ $customers->links() }}
        </div>
    </div>
@endsection
