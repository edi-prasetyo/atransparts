@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="my-auto">Laporan Stok</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="shop_id" class="form-control">
                            <option value="all">Semua Toko</option>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="type" class="form-control">
                            <option value="all">Semua Tipe</option>
                            <option value="in">In</option>
                            <option value="out">Out</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="date_range" class="form-control" placeholder="Pilih Tanggal">
                    </div>
                    <div class="col-md-3">
                        <select id="per_page" class="form-control">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div id="stock-table">
                    @include('admin.reports.partials.stock_table')
                </div>

            </div>
        </div>
    </div>
@endsection

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
                loadStocks();
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                loadStocks();
            });

            function loadStocks(page = 1) {
                let dateRange = $('#date_range').val() ? $('#date_range').val().split(' - ') : ['', ''];
                $.ajax({
                    url: "{{ route('reports.stock') }}?page=" + page,
                    data: {
                        shop_id: $('#shop_id').val(),
                        type: $('#type').val(),
                        start_date: dateRange[0],
                        end_date: dateRange[1],
                        per_page: $('#per_page').val()
                    },
                    success: function(res) {
                        $('#stock-table').html(res);
                    }
                });
            }

            $('#shop_id, #type, #per_page').on('change', function() {
                loadStocks();
            });

            $(document).on('click', '#stock-table .pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                loadStocks(page);
            });
        });
    </script>
@endpush
