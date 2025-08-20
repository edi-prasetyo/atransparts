@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Edit Translate ({{ strtoupper($translation->locale) }})</h4>
            </div>
            <div class="card-body">

                <form action="{{ url('admin/products/update_translate/' . $translation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Locale</label>
                            <select name="locale" class="form-select">
                                @foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                                    <option value="{{ $locale }}"
                                        {{ $translation->locale == $locale ? 'selected' : '' }}>
                                        {{ strtoupper($locale) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $translation->name }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control">{{ $translation->short_description }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="summernote" class="form-control">{{ $translation->description }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"
                                value="{{ $translation->meta_title }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Keyword</label>
                            <input type="text" name="meta_keyword" class="form-control"
                                value="{{ $translation->meta_keyword }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{ $translation->meta_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Translate</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
