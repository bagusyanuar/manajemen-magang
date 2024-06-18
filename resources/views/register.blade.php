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
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>SISTEM INFORMASI MANAJEMEN MAGANG DIGIMIZU | LOGIN</title>
</head>
<body>
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
            timer: 1500
        }).then(() => {
            window.location.href = '/';
        })
    </script>
@endif
<div class="login-body">
    <div class="card-login" style="width: 850px; height: 500px;">
        <div class="image-login-container">
            <img src="{{ asset('/assets/images/login-image.jpeg') }}" alt="login-image">
        </div>
        <form method="post" id="form-register" enctype="multipart/form-data">
            @csrf
            <div class="form-login-container" style="width: 500px; justify-content: start;">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="login-logo" width="150"
                     style="margin-bottom: 10px;">
                <p style="font-size: 0.8em; color: var(--dark); font-weight: bold; text-align: center;">
                    Form Pengajuan Magang</p>

                <div class="bs-stepper w-100">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#account-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="account-part"
                                    id="account-part-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Akun</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#sign-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="sign-part"
                                    id="sign-part-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Data Diri</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#document-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="document-part"
                                    id="document-part-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Dokumen</span>
                            </button>
                        </div>
                    </div>
                    <div style="padding: 1rem 1.5rem;">
                        <div class="bs-stepper-content">
                            <div id="account-part" class="content" role="tabpanel"
                                 aria-labelledby="account-part-trigger">
                                <label for="email" class="form-label d-none"></label>
                                <div class="text-group-container mb-2">
                                    <i class='bx bx-envelope'></i>
                                    <input type="email" placeholder="email" class="text-group-input" id="email"
                                           name="email">
                                </div>
                                <label for="username" class="form-label d-none"></label>
                                <div class="text-group-container mb-2">
                                    <i class='bx bx-user'></i>
                                    <input type="text" placeholder="username" class="text-group-input" id="username"
                                           name="username">
                                </div>
                                <label for="password" class="form-label d-none"></label>
                                <div class="text-group-container mb-3">
                                    <i class='bx bx-lock-alt'></i>
                                    <input type="password" placeholder="password" class="text-group-input"
                                           id="password" name="password">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="btn-action-primary btn-next"
                                       style="width: fit-content;">Selanjutnya</a>
                                </div>

                            </div>
                            <div id="sign-part" class="content" role="tabpanel" aria-labelledby="sign-part-trigger">
                                <label for="name" class="form-label d-none"></label>
                                <div class="text-group-container mb-2">
                                    <i class='bx bx-user'></i>
                                    <input type="text" placeholder="nama lengkap" class="text-group-input" id="name"
                                           name="name">
                                </div>
                                <label for="phone" class="form-label d-none"></label>
                                <div class="text-group-container mb-2">
                                    <i class='bx bx-phone'></i>
                                    <input type="number" placeholder="contoh: 62895422630233" class="text-group-input"
                                           id="phone"
                                           name="phone">
                                </div>
                                <label for="address" class="form-label d-none"></label>
                                <div class="text-group-container mb-2">
                                    <i class='bx bx-home'></i>
                                    <input type="text" placeholder="jl. urip sumohardjo" class="text-group-input"
                                           id="address"
                                           name="address">
                                </div>
                                <label for="institute" class="form-label d-none"></label>
                                <div class="text-group-container mb-3">
                                    <i class='bx bxs-school'></i>
                                    <input type="text" placeholder="SMK N 2 SURAKARTA" class="text-group-input"
                                           id="institute"
                                           name="institute">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn-action-primary btn-prev"
                                       style="width: fit-content;">Sebelumnya</a>
                                    <a href="#" class="btn-action-primary btn-next"
                                       style="width: fit-content;">Selanjutnya</a>
                                </div>
                            </div>
                            <div id="document-part" class="content" role="tabpanel"
                                 aria-labelledby="document-part-trigger">
                                <label for="document" class="form-label input-label">Surat Pengajuan</label>
                                <input type="file" class="text-input mb-2"
                                       id="document"
                                       name="document">
                                <label for="cv" class="form-label input-label">CV</label>
                                <input type="file" placeholder="jl. urip sumohardjo" class="text-input mb-3"
                                       id="cv"
                                       name="cv">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn-action-primary btn-prev"
                                       style="width: fit-content;">Sebelumnya</a>
                                    <a href="#" class="btn-action-primary btn-next" id="btn-register"
                                       style="width: fit-content;">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="d-flex align-items-center justify-content-center w-100" style="font-size: 0.7em">
                    <div style="color: var(--dark-tint); text-align: center;">Belum punya akun?
                        <a href="#" class="ms-1"
                           style="color: var(--bg-primary); text-decoration: none; font-weight: bold;">
                            Daftar Pengajuan Magang
                        </a>
                    </div>

                </div>
            </div>
        </form>

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
<script src="{{ asset('/js/helper.js') }}"></script>
<script>
    function eventRegister() {
        $('#btn-register').on('click', function (e) {
            e.preventDefault();
            $('#form-register').submit();
        })
    }

    $(document).ready(function () {
        var stepper = new Stepper($('.bs-stepper')[0], {
            linear: true
        });

        $('.btn-next').on('click', function (e) {
            e.preventDefault();
            stepper.next();
        });

        $('.btn-prev').on('click', function (e) {
            e.preventDefault();
            stepper.previous();
        });

        eventRegister();
    })
</script>
</body>
</html>
