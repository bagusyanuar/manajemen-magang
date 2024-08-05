@extends('Mentor.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Laporan Kegiatan</p>
            <p class="content-sub-title">Laporan kegiatan Peserta</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('mentor.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Kegiatan Peserta</li>
            </ol>
        </nav>
    </div>
    <div class="card-content">
        <div class="content-header mb-3">
            <p class="header-title">Data Kegiatan Peserta</p>
        </div>
        <hr class="custom-divider">
        <div class="w-100">
            <label for="status" class="form-label input-label">Filter Tanggal</label>
            <div class="d-flex align-items-center justify-content-start gap-1">
                <input type="date" class="text-input" style="width: fit-content;" id="start"
                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                       name="start">
                <span style="font-weight: 600; color: var(--dark); font-size: 0.8em;">s/d</span>
                <input type="date" class="text-input" style="width: fit-content;" id="end"
                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                       name="end">
                <a href="#" class="btn-add" id="btn-search">
                    <i class='bx bx-search'></i>
                    <span>Cari</span>
                </a>
                <a href="#" class="btn-print" id="btn-print">
                    <i class='bx bx-printer'></i>
                    <span>Cetak</span>
                </a>
            </div>

        </div>
        <hr class="custom-divider"/>
        <table id="table-data" class="display table w-100">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%" class="text-center">Tanggal</th>
                <th width="18%" class="text-center">Nama</th>
                <th>Nama Kegiatan</th>
                <th width="15%" class="text-center">Lampiran</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTable() {
            table = $('#table-data').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.start = $('#start').val();
                        d.end = $('#end').val();
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'text-center middle-header',},
                    {
                        data: 'tanggal',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.peserta.nama',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'kegiatan',
                        className: 'middle-header',
                    },
                    {
                        data: 'file',
                        className: 'middle-header text-center',
                        render: function (data) {
                            if (data !== null) {
                                return '<a href="' + data + '">Lihat</a>'
                            }
                            return '-';
                        }
                    },
                ],
            });
        }

        $(document).ready(function () {
            generateTable();
            $('#btn-search').on('click', function (e) {
                e.preventDefault();
                table.ajax.reload();
            });
            $('#btn-print').on('click', function (e) {
                e.preventDefault();
                let start = $('#start').val();
                let end = $('#end').val();
                window.open('/mentor/laporan-kegiatan/cetak?start=' + start + '&end=' + end, '_blank');
            })
        })
    </script>
@endsection
