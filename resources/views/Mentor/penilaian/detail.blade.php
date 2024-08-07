@extends('Mentor.layout')

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            }).then(() => {
                window.location.href = '{{ route('mentor.penilaian') }}';
            })
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Penilaian Peserta Magang</p>
            <p class="content-sub-title">Manajemen data penilaian peserta magang</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta') }}">Penilaian Peserta Magang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->nama }}</li>
            </ol>
        </nav>
    </div>
    <div class="row w-100">
        <div class="col-8">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title" style="font-size: 0.8em">Data Peserta Magang</p>
                </div>
                <hr class="custom-divider"/>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Email</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  $data->user->email }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Nama</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  $data->user->peserta->nama }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Instansi</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  $data->user->peserta->instansi }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>No. HP</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  $data->user->peserta->no_hp }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Alamat</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  $data->user->peserta->alamat }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Tgl. Mulai</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  \Carbon\Carbon::parse($data->tanggal_mulai)->format('Y-m-d') }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Tgl. Selesai</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{  \Carbon\Carbon::parse($data->tanggal_selesai)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <form method="post" id="form-confirm">
                @csrf
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title" style="font-size: 0.8em">Penilaian</p>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100 mb-2">
                        <label for="score" class="form-label input-label">Nilai</label>
                        <select id="score" name="score" class="text-input">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100 justify-content-end d-flex">
                        <a href="#" class="btn-add" id="btn-confirm">
                            <span>Simpan</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function eventChangeConfirmation() {
            $('#status').on('change', function () {
                changeConfirmationHandler();
            })
        }

        function changeConfirmationHandler() {
            let val = $('#status').val();
            let elPanelReason = $('#panel-reason');
            let elPanelAccept = $('#panel-accept');
            if (val === 'ditolak') {
                elPanelReason.removeClass('d-none');
                elPanelAccept.addClass('d-none');
            } else {
                elPanelReason.addClass('d-none');
                elPanelAccept.removeClass('d-none');
            }
        }

        function eventSaveConfirm() {
            $('#btn-confirm').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin konfirmasi pengajuan?', function () {
                    $('#form-confirm').submit();
                })
            })
        }

        $(document).ready(function () {
            eventChangeConfirmation();
            eventSaveConfirm();
        })
    </script>
@endsection
