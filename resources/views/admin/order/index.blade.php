@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Order</h4>
                <a href="{{ route('orders.create') }}" class="btn btn-success text-white">Add Order</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">No Invoice </th>
                            <th width="10%">Toko </th>
                            <th scope="col">Customer</th>
                            <th scope="col">No. Whatsapp</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Grand total</th>
                            <th scope="col">Pembayaran</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->invoice_number ?? '' }}</td>
                                <td>{{ $item->shop->name }}</td>
                                <td>{{ $item->customer->full_name }}</td>
                                <td>{{ $item->customer->phone ?? '' }}</td>
                                <td>Rp. {{ number_format($item->total_price) }}</td>
                                <td>Rp. {{ number_format($item->discount) }}</td>
                                <td>Rp. {{ number_format($item->grand_total) }}</td>
                                <td>{{ $item->payment_method ?? '' }}</td>
                                <td><a href="{{ route('orders.show', $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Lihat</a> </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Product Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="card-body">
                <div class="col-md-12 mt-5">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
