<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
    <title>SISTEM INFORMASI MANAJEMEN MAGANG DIGIMIZU | REGISTER</title>
</head>
<body>
<div class="login-body">
    <div class="card-content" style="width: 400px; align-items: center; display: flex; flex-direction: column;">
        <img src="{{ asset('/assets/images/logo.png') }}" alt="login-logo" width="150"
             style="margin-bottom: 10px;">
        <p style="font-size: 1em; color: var(--bg-primary); font-weight: bold; text-align: center">PENGAJUAN PERMOHONAN
            MAGANG
            BERHASIL!</p>
        <p style="font-size: 0.8em; color: var(--dark); font-weight: 500; text-align: center;">
            Mohon menunggu proses konfirmasi dari admin. Pengumuman konfirmasi akan di kirimkan ke email anda.
        </p>
        <p style="font-size: 0.8em; color: var(--dark); font-weight: 600; text-align: center;">
            Terima Kasih
        </p>
        <a href="{{route('login')}}" class="btn-action-primary">Kembali Ke Halaman Login</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/js/helper.js') }}"></script>
</body>
</html>
