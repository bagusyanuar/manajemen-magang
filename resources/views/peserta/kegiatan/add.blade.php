@extends('peserta.layout')

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
            <p class="content-title">Karyawan</p>
            <p class="content-sub-title">Manajemen data karyawan</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('peserta.kegiatan') }}">Kegiatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    <div class="card-content">
        <form method="post" id="form-data">
            @csrf
            <div class="w-100 mb-3">
                <label for="date" class="form-label input-label">Tanggal Kegiatan <span
                        class="color-danger">*</span></label>
                <input type="date" class="text-input" id="date"
                       name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                @if($errors->has('date'))
                    <span id="date-error" class="input-label-error">
                        {{ $errors->first('date') }}
                    </span>
                @endif
            </div>
            <div class="w-100 mb-3">
                <label for="activity" class="form-label input-label">Kegiatan <span
                        class="color-danger">*</span></label>
                <textarea rows="5" placeholder="Kegiatan" class="text-input" id="activity"
                          name="activity"></textarea>
                @if($errors->has('activity'))
                    <span id="activity-error" class="input-label-error">
                        {{ $errors->first('activity') }}
                    </span>
                @endif
            </div>
            <hr class="custom-divider"/>
            <div class="d-flex align-items-center justify-content-end w-100">
                <a href="#" class="btn-add" id="btn-save">
                    <i class='bx bx-check'></i>
                    <span>Simpan</span>
                </a>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        function eventSave() {
            $('#btn-save').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin menyimpan data?', function () {
                    $('#form-data').submit();
                })
            })
        }

        $(document).ready(function () {
            eventSave();
        })
    </script>
@endsection
