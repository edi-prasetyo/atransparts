@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="col-md-12 mb-3">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        <div class="card mt-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="card-title">Daftar Stok Produk</h4>
                <div class="search">
                    <form method="GET" id="filterForm" class="d-flex align-items-center gap-2">
                        <label for="shop_id" class="mb-0">Filter Toko:</label>
                        <select name="shop_id" id="shop_id" class="form-select form-select-sm" style="width: 180px;">
                            <option value="">Semua Toko</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}" {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                    {{ $shop->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" name="keyword" class="form-control form-control-sm"
                            placeholder="Cari produk, nomor, OEM" value="{{ request('keyword') }}" style="width: 220px;" />

                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                        <a href="{{ route('stocks.index') }}" class="btn btn-sm btn-secondary">Reset</a>
                    </form>
                </div>
                {{-- <form method="GET" id="filterForm" class="d-flex align-items-center">
                    <label for="shop_id" class="me-2 mb-0">Filter Toko:</label>
                    <select name="shop_id" id="shop_id" class="form-select form-select-sm" style="width: 200px;">
                        <option value="">Semua Toko</option>
                        @foreach ($shops as $shop)
                            <option value="{{ $shop->id }}" {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                {{ $shop->name }}
                            </option>
                        @endforeach
                    </select>
                </form> --}}
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Toko</th>
                        <th>Nama Produk</th>
                        <th>Nomor Produk</th>
                        <th>OEM Number</th>
                        <th>Brand</th>
                        <th>Kendaraan</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $item)
                        <tr>
                            <td>{{ $products->firstItem() + $index }}</td>
                            <td>{{ $item->shop->name ?? '-' }}</td>
                            <td>{{ $item->product->name ?? '-' }}</td>
                            <td>{{ $item->productNumber->number }}</td>
                            <td>{{ $item->productNumber->model_number }}</td>
                            <td>{{ $item->productNumber->brand }}</td>
                            <td>{{ $item->productNumber->vehicle }}</td>

                            <td>Rp {{ number_format($item->productNumber->sell_price) }}</td>
                            <td>
                                @if ($item->quantity !== null)
                                    {{-- Display stock quantity with color coding --}}
                                    <span
                                        class="badge {{ $item->quantity == 0 ? 'bg-danger' : ($item->quantity < 2 ? 'bg-warning text-dark' : 'bg-success') }}">
                                        {{ $item->quantity }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('stocks.add_stock', $item->id) }}"
                                    class="btn btn-sm btn-primary text-white">Tambah
                                    Stok</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="card-footer bg-white px-3 pt-3">
                {{ $products->links() }}
            </div>
            {{-- <div class="d-flex justify-content-center">

            </div> --}}

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('shop_id').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
@endpush
