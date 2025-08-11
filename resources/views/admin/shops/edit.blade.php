@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Edit Shop</h1>
        <form action="{{ route('shops.update', $shop->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $shop->name) }}">
            </div>

            <div class="mb-3">
                <label>Province</label>
                <select name="province_id" id="province" class="form-select">
                    <option value="">-- Select Province --</option>
                    @foreach ($provinces as $prov)
                        <option value="{{ $prov->id }}"
                            {{ old('province_id', $shop->province_id) == $prov->id ? 'selected' : '' }}>
                            {{ $prov->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>City</label>
                <select name="city_id" id="city" class="form-select">
                    <option value="">-- Select City --</option>
                    @foreach ($cities as $city)
                        @if (old('province_id', $shop->province_id) == $city->province_id)
                            <option value="{{ $city->id }}"
                                {{ old('city_id', $shop->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ old('address', $shop->address) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $shop->phone) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $shop->email) }}">
            </div>

            <div class="mb-3">
                <label>Map</label>
                <textarea name="map" class="form-control">{{ old('map', $shop->map) }}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
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
