<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Custemer;
use App\Livewire\Treatment;
use App\Livewire\Transaksi;
use App\Livewire\Laporan;
use App\Livewire\Gaji;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/custemer', Custemer::class)->middleware(['auth'])->name('custemer');
Route::get('/treatment', Treatment::class)->middleware(['auth'])->name('treatment');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/gaji', Gaji::class)->middleware(['auth'])->name('gaji');