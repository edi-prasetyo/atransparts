@extends('layouts.admin')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h3 class="mb-4">Daftar Garansi</h3>

        <!-- Tombol Create -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createWarrantyModal">
            + Buat Garansi
        </button>

        <!-- Table List -->
        <div class="card">


            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Nomor Part</th>
                            <th>Kode</th>
                            <th>QR Code</th>
                            {{-- <th>Customer</th> --}}
                            <th>Status</th>
                            <th>Klaim</th>
                            <th>Aktif Sampai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warranties as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->productNumber->product->name ?? '-' }}</td>
                                <td>
                                    {{ $item->productNumber->number ?? '-' }}<br>
                                    OEM : {{ $item->productNumber->number ?? '-' }}
                                </td>
                                <td>{{ $item->code }}</td>
                                <td>
                                    @if ($item->qr_image)
                                        <img src="{{ asset($item->qr_image) }}" alt="QR" width="80">
                                    @endif
                                </td>
                                {{-- <td>{{ $item->customer_name ?? '-' }}</td> --}}
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($item->status === 0)
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->claim == 1)
                                        <span class="badge bg-danger badge-pill">Ya</span>
                                    @else
                                        <span class="bagde text-bg-secondary">Tida ada Claim</span>
                                    @endif
                                </td>
                                <td> {{ $item->active_until ? \Carbon\Carbon::parse($item->active_until)->format('d-m-Y') : '-' }}
                                </td>
                                <td>
                                    <a href="{{ route('warranties.show', $item->id) }}">lihat detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createWarrantyModal" tabindex="-1" aria-labelledby="createWarrantyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('warranties.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createWarrantyModalLabel">Buat Garansi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Pilih Produk</label>
                            <select name="product_number_id" id="product_number_id" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($productNumbers as $pn)
                                    <option value="{{ $pn->id }}">{{ $pn->product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
