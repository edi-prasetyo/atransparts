@extends('layouts.admin')
@section('title', 'About')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            About Translate
        </div>
        <div class="card-body">
            <form action="{{url('admin/abouts/update_translate/' .$about_translate->id)}}" method="POST">
                @csrf
                <div class="row">

                    Locale : {{$about_translate->locale}}

                    <div class="col-md-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{$about_translate->title}}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Content</label>
                        <textarea name="content" id="summernote" class="form-control">{{$about_translate->content}}
                </textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary my-5">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection