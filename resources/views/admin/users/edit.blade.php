@extends('layouts.admin')

@section('content')
    <h4>{{ isset($user) ? 'Edit' : 'Add' }} User</h4>

    <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control"
                required>
        </div>

        <div class="mb-2">
            <label>Password {{ isset($user) ? '(Kosongkan jika tidak diganti)' : '' }}</label>
            <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
        </div>

        <div class="mb-2">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if (old('role_id', $user->roles->first()->id ?? '') == $role->id) selected @endif>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Shop</label>
            <select name="shop_id" class="form-control" required>
                <option value="">-- Pilih Shop --</option>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}" @if (old('shop_id', $user->shop->first()->id ?? '') == $shop->id) selected @endif>
                        {{ $shop->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection
