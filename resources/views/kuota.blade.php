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
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>Kuota Magang DIGIMIZU</title>
    <style>
        .pre-text-quota {
            font-size: 1.5em;
            font-weight: bold;
            color: var(--dark);
        }

        .text-quota {
            font-size: 2.5em;
            font-weight: bold;
            color: var(--dark);
        }
    </style>
</head>
<body>
<div class="w-100 p-5">
    <div class="w-100 align-items-center justify-content-center mb-5">
        <p class="text-center">Kuota Magang DIGIMIZU</p>
        <p class="text-quota text-center">20</p>
    </div>

    <div class="card-content">
        <div class="content-header mb-3">
            <p class="header-title">Data Peserta Magang</p>
        </div>
        <hr class="custom-divider"/>
        <table id="table-data" class="display table w-100">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama</th>
                <th width="15%" class="text-center">Instansi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $datum)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $datum->nama }}</td>
                    <td width="15%" class="text-center">{{ $datum->instansi }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('/js/helper.js') }}"></script>
<script>


    $(document).ready(function () {
        $('#table-data').DataTable();
    })
</script>
</body>
</html>
