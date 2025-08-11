@extends('layouts.admin')

@section('content')
    <div class="container">
        <h4>Assign Menus to Role: {{ $role->name }}</h4>
        <form action="{{ route('roles.menus.update', $role->id) }}" method="POST">
            @csrf
            <div class="col-md-5">
                @foreach ($menus->groupBy('group') as $group => $groupMenus)
                    <div class="card mb-2">
                        <div class="card-header rounded-top-3 bg-white">
                            <h5>{{ $group }}</h5>
                        </div>
                        <div class="card-body p-2">
                            <ul>
                                @foreach ($groupMenus as $menu)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
                                                {{ $role->menus->contains($menu->id) ? 'checked' : '' }}>
                                            {{ $menu->title }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

    </div>
@endsection
