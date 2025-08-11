<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="10%">Tgl</th>
                <th width="10%">No Invoice</th>
                <th width="10%">Toko</th>
                <th>Item</th>
                <th>Customer</th>
                <th>No. Whatsapp</th>
                <th>Status</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '' }}</td>
                    <td>{{ $item->invoice_number ?? '' }}</td>
                    <td>{{ $item->shop->name ?? '' }}</td>
                    <td>
                        <!-- Modal button -->
                        <button class="btn btn-sm btn-primary btn-show-items" data-id="{{ $item->id }}">
                            Lihat item
                        </button>
                    </td>
                    <td>{{ $item->customer->full_name ?? '' }}</td>
                    <td>{{ $item->customer->phone ?? '' }}</td>
                    <td>
                        @php
                            $status = strtolower($item->payment_status);
                            $badgeClass = match ($status) {
                                'paid' => 'success',
                                'unpaid' => 'danger',
                                'refunded' => 'secondary',
                                default => 'secondary',
                            };
                        @endphp

                        <span class="badge bg-{{ $badgeClass }}">
                            {{ ucfirst($item->payment_status) }}
                        </span>
                    </td>
                    <td>Rp. {{ number_format($item->grand_total) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No Orders Available</td>
                </tr>
            @endforelse

            {{-- Total halaman ini --}}
            <tr class="fw-bold table-warning">
                <td colspan="8" class="text-end">Grand Total (This Page):</td>
                <td>Rp. {{ number_format($totalGrandThisPage) }}</td>
            </tr>

            {{-- Total semua halaman --}}
            <tr class="fw-bold table-success">
                <td colspan="8" class="text-end">Grand Total (All Pages Filtered):</td>
                <td>Rp. {{ number_format($totalGrandAllPages) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalShowItems" tabindex="-1" aria-labelledby="modalShowItemsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="item-details-content">
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    {{ $orders->links() }}
</div>
