@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="my-auto">Laporan Penjualan</h4>
            </div>
            <div class="card-body">

                {{-- Filter --}}
                <div class="row mb-3">
                    <div class="col-md-2">
                        <select id="status" class="form-control">
                            <option value="all">All Status</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select id="shop_id" class="form-control">
                            <option value="all">All Shops</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="date_range" class="form-control" placeholder="Pilih rentang tanggal">
                    </div>
                    <div class="col-md-2">
                        <select id="per_page" class="form-control">
                            <option value="15">15 Rows</option>
                            <option value="50">50 Rows</option>
                            <option value="100">100 Rows</option>
                            <option value="500">500 Rows</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button id="btn-export-excel" class="btn btn-success">Export Excel</button>
                        <button id="btn-export-pdf" class="btn btn-danger">Export PDF</button>

                    </div>
                </div>

                {{-- Table --}}
                <div id="order-table">
                    @include('admin.reports.partials.order_table')
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        function loadOrders(page = 1) {
            // Ambil tanggal dari date range picker
            let dateRange = $('#date_range').val() ? $('#date_range').val().split(' - ') : ['', ''];
            let start_date = dateRange[0] || '';
            let end_date = dateRange[1] || '';

            $.ajax({
                url: "{{ route('reports.order') }}?page=" + page,
                data: {
                    status: $('#status').val(),
                    shop_id: $('#shop_id').val(),
                    start_date: start_date,
                    end_date: end_date,
                    per_page: $('#per_page').val()
                },
                success: function(res) {
                    $('#order-table').html(res);
                }
            });
        }

        $(function() {
            // Default range awal bulan hingga hari ini
            let start = moment().startOf('month');
            let end = moment();

            function cb(start, end) {
                $('#date_range').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                loadOrders();
            }

            $('#date_range').daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'Terapkan',
                    cancelLabel: 'Batal',
                    customRangeLabel: 'Custom'
                },
                ranges: {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            // Set default date range dan load awal
            cb(start, end);

            // Trigger filter change
            $('#status, #shop_id, #per_page').on('change', function() {
                loadOrders();
            });

            // Handle pagination click via delegation
            $(document).on('click', '#order-table .pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadOrders(page);
            });
        });
    </script>
@endpush --}}

@push('scripts')
    <script>
        $(function() {
            $('#date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
                loadOrders();
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                loadOrders();
            });

            function loadOrders(page = 1) {
                let dateRange = $('#date_range').val() ? $('#date_range').val().split(' - ') : ['', ''];
                $.ajax({
                    url: "{{ route('reports.order') }}?page=" + page,
                    data: {
                        status: $('#status').val(),
                        shop_id: $('#shop_id').val(),
                        start_date: dateRange[0],
                        end_date: dateRange[1],
                        per_page: $('#per_page').val()
                    },
                    success: function(res) {
                        $('#order-table').html(res);
                    }
                });
            }

            $('#status, #shop_id, #per_page').on('change', function() {
                loadOrders();
            });

            $(document).on('click', '#order-table .pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                loadOrders(page);
            });

            function exportFile(type) {
                let dateRange = $('#date_range').val() ? $('#date_range').val().split(' - ') : ['', ''];
                let params = $.param({
                    status: $('#status').val(),
                    shop_id: $('#shop_id').val(),
                    start_date: dateRange[0],
                    end_date: dateRange[1]
                });

                if (type === 'excel') {
                    window.location.href = "{{ route('reports.orders.export.excel') }}?" + params;
                } else if (type === 'pdf') {
                    window.location.href = "{{ route('reports.orders.export.pdf') }}?" + params;
                } else if (type === 'word') {
                    window.location.href = "{{ route('reports.orders.export.word') }}?" + params;
                }
            }

            $('#btn-export-excel').on('click', function() {
                exportFile('excel');
            });
            $('#btn-export-pdf').on('click', function() {
                exportFile('pdf');
            });
            $('#btn-export-word').on('click', function() {
                exportFile('word');
            });
        });

        // Detail item
        $(document).on('click', '.btn-show-items', function() {
            const orderId = $(this).data('id');
            $('#item-details-content').html('<p>Loading...</p>');
            $('#modalShowItems').modal('show');

            $.get("{{ url('/admin/reports/order') }}/" + orderId + "/items", function(data) {
                $('#item-details-content').html(data);
            }).fail(function() {
                $('#item-details-content').html('<p class="text-danger">Gagal memuat item.</p>');
            });
        });
    </script>
@endpush
