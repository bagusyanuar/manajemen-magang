<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Peserta Magang</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }

        .f-bold {
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .f-small {
            font-size: 0.8em;
        }

        .f-semi-bold {
            font-weight: 600;
        }

        .middle-header {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
<div class="text-center f-bold report-title">Laporan Peserta Magang</div>
{{--<div class="text-center f-small">Periode Laporan {{ $start }} - {{ $end }}</div>--}}
<hr/>
<table id="my-table" class="table display f-small">
    <thead>
    <tr>
        <th width="5%" class="text-center f-small f-semi-bold">#</th>
        <th class="f-semi-bold">Nama</th>
        <th width="15%" class="text-center f-semi-bold">Instansi</th>
        <th width="12%" class="text-center f-semi-bold">Mulai</th>
        <th width="12%" class="text-center f-semi-bold">Selesai</th>
        <th width="12%" class="text-center f-semi-bold">Pembimbing</th>
        <th width="12%" class="text-center f-semi-bold">Nilai</th>
        <th width="12%" class="text-center f-semi-bold">Aktif</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td class="text-center f-small middle-header">{{ $loop->index + 1 }}</td>
            <td class="f-small middle-header">{{ $v->nama }}</td>
            <td class="f-small middle-header text-center">{{ $v->instansi }}</td>
            <td class="f-small middle-header text-center">{{ $v->tanggal_mulai }}</td>
            <td class="f-small middle-header text-center">{{ $v->tanggal_selesai }}</td>
            <td class="f-small middle-header text-center">
                @if($v->user->peserta->pembimbing !== null)
                    {{ $v->user->peserta->pembimbing->karyawan->nama }}
                @else
                    -
                @endif
            </td>
            <td class="f-small middle-header text-center">
                @if($v->nilai !== null)
                    {{ $v->nilai }}
                @else
                    -
                @endif
            </td>
            <td class="f-small middle-header text-center">
                @if($v->is_active !== 1)
                    Tidak
                @else
                    Ya
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
