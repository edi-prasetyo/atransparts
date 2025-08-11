<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Nomor Produk</th>
                <th>Toko</th>
                <th>Tipe</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
                <tr>
                    <td>{{ $stocks->firstItem() + $index }}</td>
                    <td>{{ $stock->created_at->format('Y-m-d') }}</td>
                    <td>{{ $stock->product->name ?? '-' }}</td>
                    <td>{{ $stock->productNumber->number ?? '-' }}</td>
                    <td>{{ $stock->shop->name ?? '-' }}</td>
                    <td>{{ ucfirst($stock->type) }}</td>
                    <td>{{ $stock->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">
    {!! $stocks->links() !!}
</div>
