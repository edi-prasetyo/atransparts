<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Toko</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>{{ $order->customer->full_name ?? '-' }}</td>
                <td>{{ $order->shop->name ?? '-' }}</td>
                <td>{{ ucfirst($order->payment_status) }}</td>
                <td>{{ $order->grand_total }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: right;"><strong>Grand Total</strong></td>
            <td><strong>{{ $totalGrand }}</strong></td>
        </tr>
    </tbody>
</table>
