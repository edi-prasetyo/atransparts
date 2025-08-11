@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h3 class="card-title">Add New Permission</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-5">
                            <label>Route Name</label>
                            <input type="text" name="route_name" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-5">
                            <label>Description (optional)</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="col-md-2 mt-4">
                            <button class="btn btn-primary px-auto">Simpan</button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
        <div class="card">
            <div class="card-header bg-white">
                <h3 class="card-title">Permissions List</h3>
            </div>



            {{-- <h3 class="mb-3">Permission List</h3>
                <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">+ Add Permission</a> --}}

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Route Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $permissions->firstItem() + $key }}</td>
                            <td>{{ $permission->route_name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-3">
                {{ $permissions->links() }}
            </div>

        </div>
    </div>
@endsection
