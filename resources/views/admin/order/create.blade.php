@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Buat Order</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <!-- Customer -->
            <div class="card">
                <div class="card-header bg-white">
                    <h4> Data Customer</h4>
                </div>
                <div class="card-body">

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Cari Customer</label>
                            <input type="text" id="customer-search" class="form-control" placeholder="Cari customer...">
                            <input type="hidden" name="customer_id" id="customer_id">
                        </div>
                    </div>


                    <div id="customer-fields">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nomor Whatsapp (Opsional)</label>
                                <input type="text" name="phone" class="form-control" placeholder="Telepon">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="address" class="form-control" placeholder="Alamat">
                            </div>
                        </div>

                    </div>

                </div>
            </div>



            <div class="card my-4">
                <div class="card-header bg-white">
                    <h4>Data Barang</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <!-- Payment -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Metode Pembayaran</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="qris">QRIS</option>
                                    <option value="payment gateway">Payment Gateway</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status Pembayaran</label>
                                <select name="payment_status" class="form-control" required>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <!-- Produk -->
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Cari Produk (Nomor atau Nama)</label>
                        <input type="text" id="product-search" class="form-control" placeholder="Cari produk...">
                    </div>

                    <table class="table" id="product-table">
                        <thead>
                            <tr>
                                <th>No. Produk</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-6">
                            <div class="mb-2">
                                <label for="discount" class="form-label">Diskon (Rp)</label>
                                <input type="number" id="discount" name="discount" value="0" class="form-control"
                                    min="0">
                            </div>
                            <div class="mb-2">
                                <label for="grand_total" class="form-label">Grand Total</label>
                                <input type="number" id="grand_total" name="grand_total" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Simpan Order</button>
                </div>
            </div>
        </form>

    </div>

@endsection

@push('scripts')
    <script>
        $(function() {
            // Autocomplete customer
            $('#customer-search').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/customers/autocomplete",
                        data: {
                            q: request.term
                        },
                        success: function(data) {
                            response(data.map(function(item) {
                                return {
                                    label: `${item.full_name} (${item.phone})`,
                                    value: item.full_name,
                                    id: item.id,
                                    phone: item.phone,
                                    address: item.address
                                };
                            }));
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $('#customer_id').val(ui.item.id);
                    $('input[name=full_name]').val(ui.item.value);
                    $('input[name=phone]').val(ui.item.phone);
                    $('input[name=address]').val(ui.item.address);
                }
            });

            let rowId = 0;
            const addedProductIds = new Set();

            // Autocomplete produk dan tambah ke table
            $('#product-search').autocomplete({
                source(request, response) {
                    $.ajax({
                        url: "{{ route('product-numbers.autocomplete') }}",
                        data: {
                            q: request.term
                        },
                        success(data) {
                            response(data.map(item => ({
                                label: `${item.number} — ${item.product_name}`,
                                value: item.number,
                                data: item
                            })));
                        }
                    });
                },
                minLength: 1,
                select(event, ui) {
                    const item = ui.item.data;

                    if (addedProductIds.has(item.id)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Produk sudah ada',
                            text: 'Produk ini sudah ditambahkan ke tabel.',
                        });
                        $(this).val('');
                        return false;
                    }

                    // Gunakan jumlah row yang ada sekarang untuk index
                    rowId = $('#product-table tbody tr').length;

                    addedProductIds.add(item.id);

                    $('#product-table tbody').append(`
        <tr id="row-${rowId}">
            <input type="hidden" name="items[${rowId}][product_number_id]" value="${item.id}">
            <input type="hidden" name="items[${rowId}][product_id]" value="${item.product_id}">
            <td>${item.number}</td>
            <td>${item.product_name}</td>
            <td><input type="number" name="items[${rowId}][quantity]" value="1" min="1" class="form-control quantity" data-row="${rowId}"></td>
            <td><input type="number" name="items[${rowId}][price]" value="${item.sell_price}" min="0" class="form-control price" data-row="${rowId}"></td>
            <td><input type="number" name="items[${rowId}][total]" value="${item.sell_price}" class="form-control total" data-row="${rowId}" readonly></td>
            <td><button type="button" class="btn btn-sm btn-danger btn-remove" data-row="${rowId}" data-product-id="${item.id}">&times;</button></td>
        </tr>
    `);

                    updateGrandTotal();
                    $('#product-search').val('');
                    return false;
                }
            });



            // Event delegation: handle qty/price input change
            $('#product-table').on('input', '.quantity, .price', function() {
                const row = $(this).data('row');
                const qty = parseFloat($(`input[name="items[${row}][quantity]"]`).val()) || 0;
                const price = parseFloat($(`input[name="items[${row}][price]"]`).val()) || 0;
                const total = qty * price;
                $(`input[name="items[${row}][total]"]`).val(total);

                updateGrandTotal();

                // ✅ Tambahkan bagian ini untuk validasi stok realtime
                const productId = $(`input[name="items[${row}][product_id]"]`).val();
                const productNumberId = $(`input[name="items[${row}][product_number_id]"]`).val();

                if (qty > 0) {
                    $.ajax({
                        url: "{{ route('stock.check') }}",
                        method: 'GET',
                        data: {
                            product_id: productId,
                            product_number_id: productNumberId,
                            quantity: qty
                        },
                        success: function(res) {
                            if (res.status === 'error') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Stok Tidak Cukup',
                                    html: `${res.message}<br><strong>Tersedia:</strong> ${res.available ?? 0}, <strong>Diminta:</strong> ${qty}`,
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });

            // Remove produk
            $('#product-table').on('click', '.btn-remove', function() {
                const rid = $(this).data('row');
                const pid = $(this).data('product-id');
                addedProductIds.delete(pid);
                $(`#row-${rid}`).remove();
                updateGrandTotal();
            });

            // Diskon berubah
            $('#discount').on('input', function() {
                updateGrandTotal();
            });

            // Fungsi hitung grand total
            function updateGrandTotal() {
                let totalAll = 0;

                $('.total').each(function() {
                    const val = parseFloat($(this).val()) || 0;
                    totalAll += val;
                });

                const discount = parseFloat($('#discount').val()) || 0;
                const grandTotal = totalAll - discount;

                $('#grand_total').val(grandTotal > 0 ? grandTotal : 0);
            }

        });
    </script>
@endpush
