@php
    // pastikan ada fallback kalau controller lupa kirim
    $grand = $totalGrand ?? ($orders->sum('grand_total') ?? 0);
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Orders PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Orders Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>No Invoice</th>
                <th>Toko</th>
                <th>Customer</th>
                <th>Pembayaran</th>

                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at ? $order->created_at->format('d M Y') : '' }}</td>
                    <td>{{ $order->invoice_number }}</td>
                    <td>{{ $order->shop->name }}</td>
                    <td>{{ $order->customer->full_name }}</td>
                    <td>{{ $order->payment_status }}</td>

                    <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="6" style="text-align: right;">Grand Total</td>
                <td>Rp {{ number_format($grand, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
