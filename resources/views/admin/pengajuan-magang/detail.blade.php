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
                window.location.href = '{{ route('admin.application') }}';
            })
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <p class="content-title">Pengajuan Magang</p>
            <p class="content-sub-title">Manajemen data pengajuan magang</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.application') }}">Pengajuan Magang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->no_pengajuan }}</li>
            </ol>
        </nav>
    </div>
    <div class="row w-100">
        <div class="col-8">
            <div class="card-content">
                <div class="content-header mb-3">
                    <p class="header-title" style="font-size: 0.8em">Data Pengajuan Magang</p>
                </div>
                <hr class="custom-divider"/>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>No. Pengajuan</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span style="margin-bottom: 0">{{ $data->no_pengajuan }}</span>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center mb-1 gap-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <div class="w-25 d-flex justify-content-between align-items-center"
                         style="margin-bottom: 0; font-weight: 500;">
                        <span>Tgl. Pengajuan</span>
                        <span>:</span>
                    </div>
                    <div class="w-75">
                        <span
                            style="margin-bottom: 0">{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y') }}</span>
                    </div>
                </div>
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
                        <a href="{{ $data->surat_pengajuan }}" target="_blank"
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
                        <a href="{{ $data->cv }}" target="_blank"
                           style="margin-bottom: 0">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <form method="post" id="form-confirm">
                @csrf
                <div class="card-content">
                    <div class="content-header mb-3">
                        <p class="header-title" style="font-size: 0.8em">Konfirmasi Pengajuan</p>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100 mb-2">
                        <label for="status" class="form-label input-label">Status Pengajuan</label>
                        <select id="status" name="status" class="text-input">
                            <option value="diterima">Terima</option>
                            <option value="ditolak">Tolak</option>
                        </select>
                    </div>
                    <div id="panel-accept" class="w-100">
                        <div class="w-100 mb-2">
                            <label for="start" class="form-label input-label">Mulai</label>
                            <input type="date" placeholder="username" class="text-input" id="start"
                                   name="start">
                        </div>
                        <div class="w-100 mb-2">
                            <label for="end" class="form-label input-label">Selesai</label>
                            <input type="date" placeholder="username" class="text-input" id="end"
                                   name="end">
                        </div>
                        <div class="w-100 mb-2">
                            <label for="mentor" class="form-label input-label">Pembimbing</label>
                            <select id="mentor" name="mentor" class="text-input">
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">{{ $mentor->karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="panel-reason" class="d-none w-100">
                        <div class="w-100 mb-1">
                            <label for="reason" class="form-label input-label">Alasan Penolakan</label>
                            <textarea rows="3" placeholder="contoh: bukti tidak valid" class="text-input"
                                      id="reason"
                                      name="reason"></textarea>
                        </div>
                    </div>
                    <hr class="custom-divider"/>
                    <div class="w-100 justify-content-end d-flex">
                        <a href="#" class="btn-add" id="btn-confirm">
                            <span>Konfirmasi</span>
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
