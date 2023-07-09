@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Create Translate</h4>
        </div>
        <div class="card-body">
            {{$post->slug}}


            <form action="{{url('admin/posts/add_translate')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Language</label>
                        <input type="hidden" value="{{$post->id}}" name="post_id">
                        <select name="locale" class="form-select form-select">
                            <option value="">--Select Locale--</option>
                            @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                            <option value="{{$locale}}">

                                {{strtoupper($locale)}}

                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" id="summernote" class="form-control"></textarea>
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
                        @foreach ($postTranslate as $post_trans)
                        <tr>
                            <td>{{$post_trans->id}}</td>
                            <td>{{$post_trans->locale}} </td>
                            <td>{{$post_trans->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>


        </div>
    </div>
</div>

@endsection