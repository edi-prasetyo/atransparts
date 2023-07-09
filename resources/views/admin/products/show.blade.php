@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create Translate</h4>
                </div>
                <div class="card-body">
                    {{$product->slug}}


                    <form action="{{url('admin/products/add_translate')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Locale</label>
                                <input type="hidden" value="{{$product->id}}" name="product_id">
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
                            <div class="col-md-12 mb-3">
                                <label class="form-label">description</label>
                                <textarea name="description" id="summernote" class="form-control">
                        </textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Meta Keyword</label>
                                <input type="text" name="meta_keyword" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Meta Desc</label>
                                <textarea name="meta_description" class="form-control"></textarea>
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
                            @foreach ($productTranslate as $product_trans)
                            <tr>
                                <td>{{$product_trans->id}}</td>
                                <td>{{$product_trans->locale}} </td>
                                <td>{{$product_trans->name}}</td>
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