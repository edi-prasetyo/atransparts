@extends('layouts.admin')
@section('content')
    <div class="container mt-3">
        <h4>Tambah Log Stok: {{ $stock->product->name }} ({{ $stock->productNumber->number }})</h4>
        <form action="{{ route('stocks.store_stock', $stock->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="type">Tipe Perubahan</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Pilih Tipe</option>
                    <option value="in">Tambah Stok</option>
                    {{-- <option value="out">Kurangi Stok</option> --}}
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity">Jumlah</label>
                <input type="number" name="quantity" class="form-control" required min="1">
            </div>

            <div class="mb-3">
                <label for="note">Catatan (opsional)</label>
                <input type="text" name="note" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>

        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5>Riwayat Log Stok</h5>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipe</th>
                        <th width="10%">User</th>
                        <th width="10%">Jumlah Barang</th>
                        <th>Keterangan</th>
                        <th width="15%">Tanggal Masuk Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($log as $item)
                        <tr>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->created_at->format('d M Y') }} {{ $item->created_at->format('H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada log stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $log->links() }}
        </div>

    </div>
@endsection
