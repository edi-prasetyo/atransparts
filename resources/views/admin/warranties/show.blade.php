@extends('layouts.admin')

@section('title', 'Detail Garansi')

@section('content')
    <div class="container py-4">

        <div class="row mb-3">
            <div class="col-md-8">
                <h4 class="mb-0">Detail Garansi</h4>
                <small class="text-muted">ID Garansi: #{{ $warranty->id }}</small>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('warranties.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <strong>Kode: {{ $warranty->code }}</strong>
            </div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <img src="{{ asset($warranty->qr_image) }}" alt="QR Code">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Kode Garansi</th>
                                <td>: {{ $warranty->warranty_code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td>: {{ $warranty->customer_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>: {{ $warranty->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No Polisi</th>
                                <td>: {{ $warranty->nopol ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>KM</th>
                                <td>: {{ $warranty->km ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    :
                                    @if ($warranty->claim == 1)
                                        <span class="badge bg-danger">Permintaan Claim</span>
                                    @elseif ($warranty->active_until && \Carbon\Carbon::parse($warranty->active_until)->isPast())
                                        <span class="badge bg-danger">Expired</span>
                                    @elseif ($warranty->status == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($warranty->note == null)
                            @else
                                <tr>
                                    <th>
                                        Alasan Klaim
                                    </th>
                                    <td>
                                        : <span class="alert alert-danger"> {{ $warranty->note ?? '-' }} </span>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Aktif Sampai</th>
                                <td>:
                                    {{ $warranty->active_until ? \Carbon\Carbon::parse($warranty->active_until)->format('d M Y') : '-' }}
                                </td>
                            </tr>
                            @if ($warranty->claim_date == null)
                            @else
                                <tr>
                                    <th>Tanggal Klaim</th>
                                    <td>:
                                        {{ $warranty->claim_date ? \Carbon\Carbon::parse($warranty->claim_date)->format('d M Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @endif

                        </table>

                        @if ($warranty->claim == 1)
                            <form id="claim-form" action="{{ route('warranties.claim', $warranty->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="button" class="btn btn-warning mt-3" id="btn-claim">
                                    <i class="bi bi-check2-circle"></i> Setujui Klaim Garansi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('btn-claim')?.addEventListener('click', function(e) {
            Swal.fire({
                title: 'Yakin klaim garansi ini?',
                text: "Garansi akan ditandai sebagai sudah diklaim.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, klaim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('claim-form').submit();
                }
            });
        });
    </script>
@endpush
