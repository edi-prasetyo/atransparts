@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @php
                    use Carbon\Carbon;
                    $requestClaimed = $warranty->claim == 1;
                    $isClaimed = $warranty->claim_status == 1;
                    $isExpired = Carbon::parse($warranty->active_until)->isPast();
                @endphp

                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            @if ($requestClaimed)
                                <i class="bi bi-check-circle-fill text-primary" style="font-size: 3rem;"></i>
                                <h3 class="mt-2 text-primary">Permintaan Garansi sudah Di kirim</h3>
                                <p class="text-muted">Admin Kami Akan menghubungi anda melalui whatsapp yang di daftarkan
                                    saat aktivasi garansi, jika dalam 3 hari admin tidak menghubungi, konfirmasi ke toko
                                    tempat anda membeli barang
                                </p>
                            @elseif ($isClaimed)
                                <i class="bi bi-check-circle-fill text-primary" style="font-size: 3rem;"></i>
                                <h3 class="mt-2 text-primary">Garansi sudah di klaim</h3>
                                <p class="text-muted">Garansi anda sudah di klaim pada tanggal
                                    {{ \Carbon\Carbon::parse($warranty->claim_date)->format('d M Y') }}
                                </p>
                            @elseif ($isExpired)
                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                                <h3 class="mt-2 text-danger">Garansi Expired</h3>
                                <p class="text-muted">Masa aktif garansi telah berakhir.</p>
                            @else
                                <i class="bi bi-patch-check-fill text-success" style="font-size: 3rem;"></i>
                                <h3 class="mt-2 text-success">Garansi Aktif</h3>
                                <p class="text-muted">Berikut detail garansi Anda:</p>
                            @endif
                        </div>

                        <table class="table table-borderless">
                            <tr>
                                <th class="text-end">Kode Garansi:</th>
                                <td class="text-start"><strong>{{ $warranty->warranty_code }}</strong></td>
                            </tr>
                            <tr>
                                <th class="text-end">Nama Customer:</th>
                                <td class="text-start">{{ $warranty->customer_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-end">No HP:</th>
                                <td class="text-start">{{ $warranty->phone }}</td>
                            </tr>
                            <tr>
                                <th class="text-end">Status:</th>
                                <td class="text-start">
                                    @if ($requestClaimed)
                                        <span class="text-primary"><strong>Permintaan Klaim sudah di kirim</strong></span>
                                    @elseif ($isClaimed)
                                        <span class="text-danger"><strong>Sudah di klaim</strong></span>
                                    @elseif ($isExpired)
                                        <span class="text-danger"><strong>Tidak Aktif</strong></span>
                                    @else
                                        <span class="text-success"><strong>Aktif</strong></span>
                                    @endif
                                </td>
                            </tr>
                            @if (!$isClaimed)
                                <tr>
                                    <th class="text-end">Berlaku Sampai:</th>
                                    <td class="text-start {{ $isExpired ? 'text-danger' : 'text-success' }}">
                                        {{ \Carbon\Carbon::parse($warranty->active_until)->format('d M Y') }}
                                    </td>
                                </tr>
                            @else
                            @endif

                            @if ($isClaimed && $warranty->claim_date)
                                <tr>
                                    <th class="text-end">Tanggal Klaim:</th>
                                    <td class="text-start text-primary">
                                        {{ \Carbon\Carbon::parse($warranty->claim_date)->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @endif
                        </table>

                        {{-- Tombol Klaim Garansi --}}
                        @if (is_null($warranty->claim_date) && $warranty->claim_status == 0)
                            @if ($isClaimed || $isExpired)
                            @else
                                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                                    data-bs-target="#claimModal">
                                    <i class="bi bi-send"></i> Klaim Garansi
                                </button>
                            @endif
                        @endif

                        {{-- Modal Klaim --}}
                        <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('warranty.claimSend', $warranty->code) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="claimModalLabel">Klaim Garansi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Catatan Klaim</label>
                                                <textarea name="note" id="note" class="form-control" rows="3" placeholder="Tuliskan alasan klaim Anda..."
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Kirim Klaim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('frontend') }}" class="btn btn-outline-secondary mt-4">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
