@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Laporan Peserta Magang</p>
            <p class="content-sub-title">Daftar data laporan peserta magang</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Peserta Magang</li>
            </ol>
        </nav>
    </div>
    <div class="card-content">
        <div class="content-header mb-3">
            <p class="header-title">Data Laporan Peserta</p>
        </div>
        <hr class="custom-divider"/>
        <div class="w-100">
            <label for="status" class="form-label input-label">Filter Aktif</label>
            <div class="d-flex align-items-center justify-content-start gap-1">
                <select id="status" name="status" class="text-input" style="width: 20%;">
                    <option value="0">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>
                </select>
{{--                <input type="date" class="text-input" style="width: fit-content;" id="start" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
{{--                       name="start">--}}
{{--                <span style="font-weight: 600; color: var(--dark); font-size: 0.8em;">s/d</span>--}}
{{--                <input type="date" class="text-input" style="width: fit-content;" id="end" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
{{--                       name="end">--}}
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
                <th>Nama</th>
                <th width="15%" class="text-center">Instansi</th>
                <th width="12%" class="text-center">Mulai</th>
                <th width="12%" class="text-center">Selesai</th>
                <th width="12%" class="text-center">Pembimbing</th>
                <th width="12%" class="text-center">Nilai</th>
                <th width="12%" class="text-center">Aktif</th>
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
                        d.status = $('#status').val();
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                dom: 'ltrip',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'user.peserta.nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'user.peserta.instansi',
                        className: 'middle-header',
                    },
                    {
                        data: 'tanggal_mulai',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'tanggal_selesai',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'user.peserta.pembimbing',
                        className: 'middle-header text-center',
                        render: function (data) {
                            if (data !== null) {
                                return data['karyawan']['nama'];
                            }
                            return '-'
                        }
                    },
                    {
                        data: 'nilai',
                        className: 'middle-header text-center',
                        orderable: false,
                        render: function (data) {
                            if (data !== null) {
                                return data;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'is_active',
                        className: 'middle-header text-center',
                        orderable: false,
                        render: function (data) {
                            if (data === 1) {
                                return '<i class="bx bxs-check-square" style="font-size: 1.5em; color: var(--success);"></i>';
                            }
                            return '<i class="bx bxs-x-square" style="font-size: 1.5em; color: var(--danger);"></i>';
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
                let status = $('#status').val();
                window.open('/admin/laporan-peserta/cetak?status=' + status, '_blank');
            })


        })
    </script>
@endsection
