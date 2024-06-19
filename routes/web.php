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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\KaryawanController::class, 'index'])->name('admin.staff');
        Route::match(['post', 'get'],'/add', [\App\Http\Controllers\Admin\KaryawanController::class, 'add'])->name('admin.staff.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\KaryawanController::class, 'edit'])->name('admin.staff.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\KaryawanController::class, 'delete'])->name('admin.staff.delete');
    });
});
