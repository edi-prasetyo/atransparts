@extends('layouts.admin')

@section('content')
    <h1>{{ isset($menuAdmin) ? 'Edit Menu' : 'Tambah Menu' }}</h1>

    <form action="{{ isset($menuAdmin) ? route('menu_admins.update', $menuAdmin) : route('menu_admins.store') }}"
        method="POST">
        @csrf
        @if (isset($menuAdmin))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $menuAdmin->title ?? '') }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Group</label>
            <input type="text" name="group" value="{{ old('group', $menuAdmin->group ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Route Name</label>
            <input type="text" name="route_name" value="{{ old('route_name', $menuAdmin->route_name ?? '') }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="text" name="icon" value="{{ old('icon', $menuAdmin->icon ?? '') }}" class="form-control">
            <small>Contoh: feather-home</small>
        </div>

        <div class="mb-3">
            <label>Parent Menu</label>
            <select name="parent_id" class="form-control">
                <option value="">-- None --</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $menuAdmin->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Order</label>
            <input type="number" name="order" value="{{ old('order', $menuAdmin->order ?? 0) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($menuAdmin) ? 'Update' : 'Save' }}</button>
    </form>
@endsection
