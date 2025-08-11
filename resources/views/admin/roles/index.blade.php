@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="card-title">Roles</h4>
                <!-- Tombol buka modal Create -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    Tambah Role Baru
                </button>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif



            @if ($roles->count())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Role</th>
                            <th width='30%'>Permission</th>
                            <th width='20%'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td><a href="{{ route('roles.menus.edit', $role->id) }}"
                                        class="btn btn-success btn-sm text-white">Menu
                                        Permissions</a>
                                    <a href="{{ route('roles.permissions.edit', $role->id) }}"
                                        class="btn btn-info btn-sm text-white">Edit
                                        Permissions</a>
                                </td>
                                <td>

                                    <!-- Tombol Edit modal -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal" data-id="{{ $role->id }}"
                                        data-name="{{ $role->name }}">Edit</button>

                                    <!-- Form Hapus -->
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Yakin ingin hapus role ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $roles->links() }}
            @else
                <p>Tidak ada data role.</p>
            @endif
        </div>



    </div>

    <!-- Modal Create Role -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('roles.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createRoleName" class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="createRoleName" name="name" required
                            value="{{ old('name') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editRoleForm" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editRoleName" class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="editRoleName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    <script>
        var editRoleModal = document.getElementById('editRoleModal');
        editRoleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            // Ambil data dari button edit
            var roleId = button.getAttribute('data-id');
            var roleName = button.getAttribute('data-name');

            // Set value ke input modal
            var inputName = editRoleModal.querySelector('#editRoleName');
            inputName.value = roleName;

            // Update action form edit sesuai id role
            var form = document.getElementById('editRoleForm');
            form.action = '/roles/' + roleId; // pastikan route prefix /roles sesuai route resource-mu
        });
    </script>
@endPushOnce
