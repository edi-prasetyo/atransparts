@extends('layouts.admin')
@section('title', 'About')
@section('content')
<div class="col-md-12">
    <div class="card mb-3">
        <div class="card-header bg-white">
            About
        </div>
        <div class="card-body">
            @if(session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            </div>
            @endif
            <form action="{{url('admin/abouts')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        ID : <b>{{$about->id}}</b><br>
                        Change Image : <input type="file" name="image" class="form-control mb-3">
                    </div>
                    <div class="col-md-6">
                        @if($about->image == null)

                        @else
                        <img src="{{asset('uploads/posts/' .$about->image)}}" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    About Translate
                </div>
                <div class="card-body">
                    <form action="{{url('admin/abouts/add_translate')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Locale</label>
                                <input type="hidden" value="{{$about->id}}" name="about_id">
                                <select name="locale" class="form-select form-select">
                                    <option value="">--Select Locale--</option>
                                    @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                                    <option value="{{$locale}}">
                                        {{strtoupper($locale)}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Content</label>
                                <textarea name="content" id="summernote" class="form-control">
                        </textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary my-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    Translations
                </div>
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
                            @foreach ($aboutTranslate as $about_trans)
                            <tr>
                                <td>{{$about_trans->id}}</td>
                                <td>{{$about_trans->locale}} </td>
                                <td>{{$about_trans->title}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection