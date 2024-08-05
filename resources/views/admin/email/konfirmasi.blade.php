<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digimizu | Konfirmasi Penerimaan Magang</title>
    <style>
        .greeting-name {
            font-weight: 600;
        }

        .font-bold {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div style="font-size: 1em; margin-bottom: 2rem;"><span>Halo, </span><span
        class="greeting-name">{{ $member->nama }}</span></div>
<div style="margin-bottom: 1rem;">Dengan ini kami dari <span class="font-bold">Digimizu</span> memberitahukan bahwa
    permohonan magang dengan
    nomor pengajuan <span style="font-weight: 600">No. {{ $no_pengajuan }}</span> atas
    nama <span class="font-bold">{{ $member->nama }}</span> telah kami konfirmasi dengan keputusan :
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 1rem;">
    <tr>
        <td align="center">
            @if($status === 'diterima')
                <div
                    style="padding: 0.5rem 1.5rem; background-color: #38b000; color: whitesmoke; font-weight: 600; border-radius: 12px; width: fit-content">
                    DI TERIMA
                </div>
            @else
                <div
                    style="padding: 0.5rem 1.5rem; background-color: #dc3545; color: whitesmoke; font-weight: 600; border-radius: 12px; width: fit-content">
                    DI TOLAK
                </div>
            @endif
        </td>
    </tr>
</table>

@if($status === 'diterima')
    <div style="width: 100%; text-align: center; margin-bottom: 1rem;">
        Kegiatan magang akan di laksanakan dari tanggal <span class="font-bold">{{ $dateStart }}</span> sampai dengan <span
            class="font-bold">{{ $dateEnd }}</span>
    </div>
    <div style="width: 100%; margin-bottom: 5px;">
        <div>Username Anda : <span style="font-weight: bold">{{ $user->username }}</span></div>
    </div>
    <div style="width: 100%; margin-bottom: 5px;">
        <div>Password Anda : <span style="font-weight: bold">{{ $user->password_hint }}</span></div>
    </div>
@else
    <div style="width: 100%; text-align: center; margin-bottom: 1rem;">
        Adapun penolakan pengajuan magang di karenakan {{ $reason }}
    </div>
@endif

<div style="width: 100%; text-align: right;">
    <div style="width: 20%; text-align: center; display: block">
        <p class="font-bold" style="margin-bottom: 2rem;">TTD</p>
        <p class="font-bold">Admin DIGIMIZU</p>
    </div>
</div>
</body>
</html>
