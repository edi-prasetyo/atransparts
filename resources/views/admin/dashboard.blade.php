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
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
                    <div class="card-body d-flex w-100 justify-content-between">
                        <div class="col">
                            <h5 class="card-title text-muted mb-0">Total Produk</h5>
                            <span class="h4 font-weight-bold mb-0">{{ count($products) }}</span>
                        </div>
                        <div class="icon icon-shape bg-light-success text-success rounded-circle">
                            <i class="feather-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
                    <div class="card-body d-flex w-100 justify-content-between">
                        <div class="col">
                            <h5 class="card-title text-muted mb-0">Total Product View</h5>
                            <span class="h4 font-weight-bold mb-0">{{ $product_views }}</span>
                        </div>
                        <div class="icon icon-shape bg-light-primary text-primary rounded-circle">
                            <i class="feather-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
                    <div class="card-body d-flex w-100 justify-content-between">
                        <div class="col">
                            <h5 class="card-title text-muted mb-0">Total News View</h5>
                            <span class="h4 font-weight-bold mb-0">{{ $post_views }}</span>
                        </div>
                        <div class="icon icon-shape bg-light-primary text-primary rounded-circle">
                            <i class="feather-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="card-title">Cari Produk</h4>
                <div class="search">
                    <form method="GET" id="filterForm" class="d-flex align-items-center gap-2">
                        <label for="shop_id" class="mb-0">Filter Toko:</label>
                        <select name="shop_id" id="shop_id" class="form-select form-select" style="width: 180px;">
                            <option value="">Semua Toko</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}" {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                    {{ $shop->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" name="keyword" class="form-control form-control"
                            placeholder="Cari produk, nomor, OEM" value="{{ request('keyword') }}" style="width: 220px;" />

                        <button type="submit" class="btn btn-primary">Cari</button>
                        <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
                    </form>
                </div>

            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>

                        <th>Toko</th>
                        <th>Nama Produk</th>
                        <th>Nomor Produk</th>
                        <th>OEM Number</th>
                        <th>Brand</th>
                        <th>Kendaraan</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $index => $item)
                        <tr>

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
                {{ $stocks->links() }}
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

        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById('shop_id').value = '';
            document.querySelector('[name="keyword"]').value = '';
            document.getElementById('filterForm').submit();
        });
    </script>
@endpush
