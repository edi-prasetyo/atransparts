@extends('layouts.admin')
@section('content')
    <div class="container">



        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h1>Create Shop</h1>
                <a href="{{ route('shops.index') }}" class="btn btn-secondary">Back to Shops</a>
            </div>
            <div class="card-body">

                <form action="{{ route('shops.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label>Province</label>
                            <select name="province_id" id="province" class="form-select">
                                <option value="">-- Select Province --</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov->id }}"
                                        {{ old('province_id') == $prov->id ? 'selected' : '' }}>
                                        {{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label>City</label>
                            <select name="city_id" id="city" class="form-select">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>

                        <!-- field lainnya: address, phone, email, map -->
                        <div class="mb-3 col-md-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Map</label>
                            <textarea name="map" class="form-control">{{ old('map') }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@pushOnce('scripts')
    <script>
        const getCitiesUrl = "{{ url('admin/provinces/get-cities/') }}/__PROV_ID__";
        $('#province').change(function() {
            var provId = $(this).val();
            $('#city').html('<option value="">Loading...</option>');
            if (provId) {
                let url = getCitiesUrl.replace('__PROV_ID__', provId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        var html = '<option value="">-- Select City --</option>';
                        $.each(data, function(id, name) {
                            html += '<option value="' + id + '">' + name + '</option>';
                        });
                        $('#city').html(html);
                    }
                });
            } else {
                $('#city').html('<option value="">-- Select City --</option>');
            }
        });
    </script>
@endPushOnce
