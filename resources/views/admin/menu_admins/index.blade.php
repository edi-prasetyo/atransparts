@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4>Menu Admins</h4>
                <a href="{{ route('menu_admins.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Group</th>
                        <th>Route Name</th>
                        <th>Icon</th>
                        <th>Parent</th>
                        <th>Order</th>
                        {{-- <th>Roles Permission</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->title }}</td>
                            <td>{{ $menu->group }}</td>
                            <td>{{ $menu->route_name }}</td>
                            <td><i class="{{ $menu->icon }}"></i> {{ $menu->icon }}</td>
                            <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                            <td>{{ $menu->order }}</td>
                            {{-- <td>
                                <form method="POST" action="{{ route('menu_admins.assign_permission', $menu) }}">
                                    @csrf
                                    <select name="roles[]" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $menu->roles->contains($role) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success mt-1">Update</button>
                                </form>
                            </td> --}}
                            <td>
                                <a href="{{ route('menu_admins.edit', $menu) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('menu_admins.destroy', $menu) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
