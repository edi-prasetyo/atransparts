@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Create Translate</h4>
            </div>
            <div class="card-body">
                {{$menu->slug}}
                <form action="{{url('admin/menus/add_translate')}}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-label">Bahasa</label>
                            <select name="locale" class="form-select form-select">
                                <option value="">--Select Locale--</option>
                                @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                                <option value="{{$locale}}">

                                    {{strtoupper($locale)}}

                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <input type="hidden" value="{{$menu->id}}" name="menu_id">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">Translate Menu</div>
            @if(session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="5%">lang</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menuTranslate as $menu_trans)
                        <tr>
                            <td>{{$menu_trans->id}}</td>
                            <td>{{$menu_trans->locale}} </td>
                            <td>{{$menu_trans->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


@endsection