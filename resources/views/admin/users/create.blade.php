@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h4>{{ isset($user) ? 'Edit' : 'Add' }} User</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
                    @csrf
                    @if (isset($user))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Password {{ isset($user) ? '(Kosongkan jika tidak diganti)' : '' }}</label>
                            <input type="password" name="password" class="form-control"
                                {{ isset($user) ? '' : 'required' }}>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Role</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{-- {{ old('role_id', optional($user->roles->first())->id) == $role->id ? 'selected' : '' }} --}}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Shop</label>
                            <select name="shop_id" class="form-control" required>
                                <option value="">-- Pilih Shop --</option>
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}"
                                        {{ old('shop_id', $user?->shop->first()?->id) == $shop->id ? 'selected' : '' }}>
                                        {{ $shop->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-success">Simpan</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
