<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['post', 'get'], '/', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::match(['post', 'get'], '/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::get('/register/selesai', [\App\Http\Controllers\RegisterController::class, 'finish'])->name('register.finish');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'kegiatan'], function () {
    Route::get('/', [\App\Http\Controllers\Peserta\KegiatanController::class, 'index'])->name('peserta.kegiatan');
    Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Peserta\KegiatanController::class, 'add'])->name('peserta.kegiatan.add');
    Route::post('/{id}/delete', [\App\Http\Controllers\Peserta\KegiatanController::class, 'delete'])->name('peserta.kegiatan.delete');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\KaryawanController::class, 'index'])->name('admin.staff');
        Route::match(['post', 'get'], '/add', [\App\Http\Controllers\Admin\KaryawanController::class, 'add'])->name('admin.staff.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\KaryawanController::class, 'edit'])->name('admin.staff.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\KaryawanController::class, 'delete'])->name('admin.staff.delete');
    });

    Route::group(['prefix' => 'peserta-magang'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PesertaController::class, 'index'])->name('admin.peserta');
        Route::match(['post', 'get'],'/{id}', [\App\Http\Controllers\Admin\PesertaController::class, 'detail'])->name('admin.peserta.detail');
    });

    Route::group(['prefix' => 'pengajuan-magang'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index'])->name('admin.application');
        Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'detail'])->name('admin.application.detail');
    });

    Route::group(['prefix' => 'laporan-peserta'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_peserta'])->name('admin.report.member');
        Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_peserta_cetak'])->name('admin.report.member.print');
    });

    Route::group(['prefix' => 'laporan-kegiatan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_kegiatan'])->name('admin.report.activity');
        Route::get('/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan_kegiatan_cetak'])->name('admin.report.activity.print');
    });
});

Route::group(['prefix' => 'mentor'], function () {
    Route::get('/', [\App\Http\Controllers\Mentor\DashboardController::class, 'index'])->name('mentor.dashboard');

    Route::group(['prefix' => 'penilaian'], function () {
        Route::get('/', [\App\Http\Controllers\Mentor\PenilaianController::class, 'index'])->name('mentor.penilaian');
        Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\Mentor\PenilaianController::class, 'detail'])->name('mentor.penilaian.detail');
    });

    Route::group(['prefix' => 'laporan-kegiatan'], function () {
        Route::get('/', [\App\Http\Controllers\Mentor\LaporanController::class, 'laporan_kegiatan'])->name('mentor.report.activity');
        Route::get( '/cetak', [\App\Http\Controllers\Mentor\LaporanController::class, 'laporan_kegiatan_cetak'])->name('mentor.report.activity.print');
    });
});
