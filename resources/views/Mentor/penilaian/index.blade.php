@extends('Mentor.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Penilaian Peserta Magang</p>
            <p class="content-sub-title">Manajemen data penilaian peserta magang</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('mentor.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penilaian Peserta Magang</li>
            </ol>
        </nav>
    </div>
    <div class="card-content">
        <div class="content-header mb-3">
            <p class="header-title">Data Nilai Peserta Magang</p>
        </div>
        <hr class="custom-divider"/>
        <table id="table-data" class="display table w-100">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama</th>
                <th width="15%" class="text-center">No. Hp</th>
                <th width="12%" class="text-center">Nilai</th>
                <th width="10%" class="text-center">Aksi</th>
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
                    // 'data': data
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    scoreExistAction();
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'text-center middle-header',},
                    {
                        data: 'nama',
                        className: 'middle-header',
                    },
                    {
                        data: 'no_hp',
                        className: 'middle-header text-center',
                    },
                    {
                        data: 'nilai',
                        className: 'middle-header text-center',
                        render: function (data) {
                            if (data !== null) {
                                return data;
                            }
                            return '-'
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let nilai = data['nilai'];
                            let urlDetail = path + '/' + id;
                            if (nilai !== null) {
                                return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                    '<a style="color: var(--dark-tint)" href="#" class="btn-exist"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                    '</div>';
                            }
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class=""><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }


        function scoreExistAction() {
            $('.btn-exist').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Success',
                    text: 'Peserta Sudah Di Beri Nilai...',
                    icon: 'success',
                    timer: 700
                })
            })

        }
        $(document).ready(function () {
            generateTable();
            scoreExistAction();
        })
    </script>
@endsection
