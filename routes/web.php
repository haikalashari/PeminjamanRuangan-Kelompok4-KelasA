<?php

use App\Models\User;
use App\Models\Admin;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::controller(RuanganController::class)->middleware('auth')->middleware([IsAdmin::class])->group(function () {
    Route::get('/ruangan', 'index')->name('ruangan.index');
    Route::get('/ruangan/create', 'create')->name('ruangan.create');
    Route::post('/ruangan', 'store')->name('ruangan.store');
    Route::get('/ruangan/{ruangan}', 'show')->name('ruangan.show');
    Route::get('/ruangan/{ruangan}/edit', 'edit')->name('ruangan.edit');
    Route::put('/ruangan/{ruangan}', 'update')->name('ruangan.update');
    Route::delete('/ruangan/{ruangan}', 'destroy')->name('ruangan.destroy');
});

Route::controller(PeminjamanController::class)->middleware('auth')->group(function () {
    Route::get('/peminjaman/riwayat', 'riwayat')->name('peminjaman.riwayat');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', 'store')->name('peminjaman.store');
    Route::get('/peminjaman/{peminjaman}', 'show')->name('peminjaman.show');
    Route::get('/peminjaman/{peminjaman}/edit', 'edit')->name('peminjaman.edit');
    Route::put('/peminjaman/{peminjaman}', 'update')->name('peminjaman.update');
    Route::delete('/peminjaman/{peminjaman}', 'destroy')->name('peminjaman.destroy');
    Route::get('/peminjaman', 'index')->name('peminjaman.index')->middleware([IsAdmin::class]);
});

Route::controller(AdminController::class)->middleware('auth')->middleware([IsAdmin::class])->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/admin/create', 'create')->name('admin.create');
    Route::post('/admin', 'store')->name('admin.store');
    Route::get('/admin/{admin}', 'show')->name('admin.show');
    Route::get('/admin/{admin}/edit', 'edit')->name('admin.edit');
    Route::put('/admin/{admin}', 'update')->name('admin.update');
    Route::delete('/admin/{admin}', 'destroy')->name('admin.destroy');
});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'show')->name('profile.show');
    Route::get('/profile/edit', 'edit')->name('profile.edit');
    Route::put('/profile/{user}', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});