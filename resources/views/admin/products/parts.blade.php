@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Create Translate</h4>
                </div>
                <div class="card-body">
                    {{$product->slug}}


                    <form action="{{url('admin/products/add_part')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Merek Mobil</label>
                                <select class="form-select" name="brand[]" id="multiple-select-field"
                                    data-placeholder="Pilih Brand" multiple>
                                    @foreach($brands as $key => $brand)
                                    <option value="{{$brand->name}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Untuk Mobil</label>
                                <select class="form-select" name="vehicle[]" id="multiple-select-field2"
                                    data-placeholder="Pilih Brand" multiple>
                                    @foreach($vehicles as $key => $vehicle)
                                    <option value="{{$vehicle->name}}">{{$vehicle->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Nomor Parts</label>
                                <input type="text" name="number" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Nomor Dari Pabrik</label>
                                <input type="text" name="vendor_number" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Nomor Asli Part</label>
                                <input type="text" name="model_number" class="form-control">
                            </div>



                            <div class="col-md-3 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="text" name="quantity" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="text" name="buy_price" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="text" name="sell_price" class="form-control">
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


        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    {{$product->slug}}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Nomor</th>
                                <th>Nomor Pabrik</th>
                                <th>Nomor Asli</th>
                                <th>Merek</th>
                                <th>Mobil</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parts as $part)
                            <tr>

                                <td>{{$part->number}} </td>
                                <td>{{$part->vendor_number}}</td>
                                <td>{{$part->model_number}}</td>
                                <td>{{$part->brand}}</td>
                                <td>{{$part->vehicle}}</td>
                                <td>{{$part->quantity}}</td>
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

@section('scripts')
<script>
    $( '#multiple-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
} );

$( '#multiple-select-field2' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
} );
</script>
@endsection