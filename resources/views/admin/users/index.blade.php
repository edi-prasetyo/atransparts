@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5>Users</h5>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Shop</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            <td>{{ $user->shop->first()?->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
