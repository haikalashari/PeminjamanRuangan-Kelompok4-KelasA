<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(RuanganController::class)->group(function () {
    Route::get('/ruangan', 'index')->name('ruangan.index');
    Route::get('/ruangan/create', 'create')->name('ruangan.create');
    Route::post('/ruangan', 'store')->name('ruangan.store');
    Route::get('/ruangan/{ruangan}', 'show')->name('ruangan.show');
    Route::get('/ruangan/{ruangan}/edit', 'edit')->name('ruangan.edit');
    Route::put('/ruangan/{ruangan}', 'update')->name('ruangan.update');
    Route::delete('/ruangan/{ruangan}', 'destroy')->name('ruangan.destroy');
});

Route::controller(PeminjamanController::class)->group(function () {
    Route::get('/peminjaman', 'index')->name('peminjaman.index');
    Route::get('/peminjaman/create', 'create')->name('peminjaman.create');
    Route::post('/peminjaman', 'store')->name('peminjaman.store');
    Route::get('/peminjaman/{peminjaman}', 'show')->name('peminjaman.show');
    Route::get('/peminjaman/{peminjaman}/edit', 'edit')->name('peminjaman.edit');
    Route::put('/peminjaman/{peminjaman}', 'update')->name('peminjaman.update');
    Route::delete('/peminjaman/{peminjaman}', 'destroy')->name('peminjaman.destroy');
});