@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Create Translate</h4>
        </div>
        <div class="card-body">
            {{$category->slug}}


            <form action="{{url('admin/category/add_translate')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" value="{{$category->id}}" name="category_id">
                        <select name="locale" class="form-select form-select">
                            <option value="">--Select Locale--</option>
                            @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                            <option value="{{$locale}}">

                                {{strtoupper($locale)}}

                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Meta Desc</label>
                        <input type="text" name="meta_description" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Meta Desc</label>
                        <input type="text" name="meta_keyword" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>


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
                        @foreach ($categoryTranslate as $category_trans)
                        <tr>
                            <td>{{$category_trans->id}}</td>
                            <td>{{$category_trans->locale}} </td>
                            <td>{{$category_trans->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>


        </div>
    </div>
</div>

@endsection