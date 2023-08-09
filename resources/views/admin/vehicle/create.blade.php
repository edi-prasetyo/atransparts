@extends('layouts.admin')

@section('content')
@if(session('message'))
<div class="alert alert-danger">
    {{session('message')}}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Create Vehicle</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/vehicles')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Brand</label>
                            <select class="form-select" name="brand_id" id="single-select-field"
                                data-placeholder="Pilih Brand">
                                @foreach($brands as $key => $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label">Status</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="status" checked>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>
@endsection