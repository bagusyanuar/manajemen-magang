@extends('admin.layout')

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
                window.location.reload();
            })
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Peserta Magang</p>
            <p class="content-sub-title">Manajemen data peserta magang</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta') }}">peserta Magang</a></li>
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
                        <span
                            style="margin-bottom: 0">{{  \Carbon\Carbon::parse($data->tanggal_mulai)->format('Y-m-d') }}</span>
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
                        <span
                            style="margin-bottom: 0">{{  \Carbon\Carbon::parse($data->tanggal_selesai)->format('Y-m-d') }}</span>
                    </div>
                </div>
                <hr class="custom-divider"/>
                <p class="header-title" style="font-size: 0.8em">Berkas Pengajuan</p>
                <hr class="custom-divider"/>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Surat Pengajuan</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <a href="{{ $data->user->pengajuan_diterima->surat_pengajuan }}" target="_blank"
                           style="margin-bottom: 0">
                            Lihat
                        </a>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>CV</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <a href="{{ $data->user->pengajuan_diterima->cv }}" target="_blank"
                           style="margin-bottom: 0">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title" style="font-size: 0.8em">Nilai</p>
                </div>
                <hr class="custom-divider"/>
                @if($data->nilai !== null)
                    <p style="margin-bottom: 0; text-align: center; font-size: 60px; font-weight: bold; color: var(--dark);">
                        A</p>
                    <hr class="custom-divider"/>
                    <a href="#" class="btn-add" id="btn-finish"
                       style="width: 100%; justify-content: center;">Selesai</a>
                @else
                    <div style="height: 200px; width: 100%;" class="d-flex justify-content-center align-items-center">
                        <p style="margin-bottom: 0; text-align: center; font-size: 1em; font-weight: bold; color: var(--dark);">
                            Belum Ada Penilaian
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';

        function eventSaveConfirm() {
            $('#btn-finish').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin konfirmasi penyelesaian magang?', function () {
                    confirmHandler();
                })
            })
        }

        async function confirmHandler() {
            try {
                await $.post(path);
                Swal.fire({
                    title: 'Success',
                    text: 'Berhasil melakukan penyelesaian magang.',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    window.location.href = '/admin/peserta-magang';
                })
            } catch (e) {
                let error_message = JSON.parse(e.responseText);
                ErrorAlert('Error', error_message.message);
            }
        }

        $(document).ready(function () {
            eventSaveConfirm();
        })
    </script>
@endsection
