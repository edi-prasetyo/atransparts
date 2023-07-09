@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif
    <form action="{{url('admin/options')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <h2 class="h3 mb-4 page-title">Settings</h2>
            <div class="col-md-3">
                <hr class="mb-4" />
                <strong class="mb-0">Site Settings</strong>
                <p>Control site title will you need</p>
            </div>
            <div class="col-md-9">
                <div class="card mb-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Site Title</label>
                                <input type="text" name="title" class="form-control" value="{{$option->title}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tagline</label>
                                <input type="text" name="tagline" class="form-control" value="{{$option->tagline}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{$option->description}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Keyword</label>
                                <textarea name="keywords" class="form-control">{{$option->keywords}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <hr class="mb-4" />
                <strong class="mb-0">Meta Settings</strong>
                <p>Site Meta For Analytics google or microsoft</p>
            </div>
            <div class="col-md-9">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>google Meta</label>
                                <input type="text" name="google_meta" class="form-control"
                                    value="{{$option->google_meta}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Bing Meta</label>
                                <input type="text" name="bing_meta" class="form-control" value="{{$option->bing_meta}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Google Analytics</label>
                                <textarea name="google_analytics"
                                    class="form-control">{{$option->google_analytics}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Google Tag</label>
                                <textarea name="google_tag" class="form-control">{{$option->google_tag}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <hr>
                <strong class="mb-0">Logo</strong>
                <p>Update Logo your site</p>
            </div>
            <div class="col-md-9">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control mb-3">
                                @if($option->logo == null)

                                @else
                                <img src="{{asset('uploads/logo/' .$option->logo)}}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Second Logo</label>
                                <input type="file" name="second_logo" class="form-contro mb-3">
                                @if($option->second_logo == null)

                                @else
                                <img src="{{asset('uploads/logo/' .$option->second_logo)}}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Favicon</label>
                                <input type="file" name="favicon" class="form-control mb-3">
                                @if($option->favicon == null)

                                @else
                                <img src="{{asset('uploads/logo/' .$option->favicon)}}" class="img-fluid">
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <hr>
                <strong class="mb-0">Information</strong>
                <p>Information site email, phone address etc.</p>
            </div>
            <div class="col-md-9">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{$option->email}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{$option->phone}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{$option->whatsapp}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" value="{{$option->link}}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control">{{$option->address}}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Maps</label>
                                <textarea name="maps" class="form-control">{{$option->maps}}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <hr>
                <strong class="mb-0">Social Media</strong>
                <p>Information url Social Media</p>
            </div>
            <div class="col-md-9">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{$option->facebook}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="{{$option->instagram}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tiktok</label>
                                <input type="text" name="tiktok" class="form-control" value="{{$option->tiktok}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Twitter</label>
                                <input type="text" name="twitter" class="form-control" value="{{$option->twitter}}">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
            <div class="col-md-9">
                <button type="submit" class="btn btn-primary mb-5 ps-3 pe-3">Save Information</button>
            </div>
        </div>
    </form>
</div>
@endsection