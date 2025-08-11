@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow-none" id="invoice-card">
            <div class="card-body p-4">
                <div class="row d-flex justify-content-between align-items-start">
                    <div class="col-md-6">
                        <img src="{{ asset('uploads/logo/' . $site->logo) }}">
                        <p>{{ $order->shop->address }}</p>
                        <p>{{ $order->shop->phone }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h1 class="mb-0">Invoice</h1>
                        <span class="fw-bold">#{{ $order->invoice_number }}</span>
                    </div>
                </div>
                <div class="border-bottom border-1 mb-2"></div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="">


                        <h5 class="mb-2">Kepada Yth:</h5>
                        <p class="mb-1"><strong>{{ $order->customer->full_name }}</strong></p>
                        <p class="mb-1">{{ $order->customer->phone }}</p>
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-2">Detail Pesanan</h6>
                        <p class="mb-1">Order #: <strong>{{ $order->order_number }}</strong></p>
                        <p class="mb-1">Tanggal Order: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                        </p>
                        <p class="mb-1">Status Pembayaran:
                            <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                        <p class="mb-1">Metode Pembayaran: {{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>



                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Nomor Produk</th>
                                <th>Kuantitas</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->product->name ?? '-' }}</td>
                                    <td>{{ $item->productNumber->number ?? '-' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-start">
                    <div class="col-md-8">
                        <b>Note :</b><br>
                        <ul>
                            <li>Periksa barang yang dibeli</li>
                            <li>Barang yang sudah di beli tidak dapat di kembalikan dengan alasan apapun</li>
                        </ul>

                    </div>
                    <div class="col-md-4">
                        <table class="table table-borderless">
                            <tr>
                                <th>Total Harga:</th>
                                <td class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Diskon:</th>
                                <td class="text-end">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Ongkir:</th>
                                <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-top">
                                <th class="fs-5">Grand Total:</th>
                                <td class="text-end fs-5 fw-bold">Rp
                                    {{ number_format($order->grand_total, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-5 text-end">
                    <button class="btn btn-outline-secondary" onclick="window.print()">
                        <i class="bi bi-printer"></i> Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushOnce('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice-card,
            #invoice-card * {
                visibility: visible;
            }

            #invoice-card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
@endpushOnce
