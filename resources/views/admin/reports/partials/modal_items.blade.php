@if ($order->items->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($order->items as $index => $item)
                    @php
                        $total = $item->quantity * $item->price;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp. {{ number_format($item->price) }}</td>
                        <td>Rp. {{ number_format($total) }}</td>
                    </tr>
                @endforeach

                {{-- Grand Total --}}
                <tr class="table-success fw-bold">
                    <td colspan="4" class="text-end">Grand Total</td>
                    <td>Rp. {{ number_format($grandTotal) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <p>Tidak ada item pada pesanan ini.</p>
@endif
