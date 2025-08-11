@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Permissions untuk Role: {{ $role->name }}</h1>

        <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <div class="row">
                    @foreach ($permissions as $group => $groupPermissions)
                        <div class="col-md-6">
                            <div class="card p-2 mb-3">
                                <h5 class="text-primary text-capitalize">{{ $group }}</h5>
                                @foreach ($groupPermissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}" id="perm{{ $permission->id }}"
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm{{ $permission->id }}">
                                            {{ $permission->route_name }} ({{ $permission->description ?? '-' }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Simpan Permissions</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
