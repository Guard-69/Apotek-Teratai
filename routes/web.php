<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StafController;
use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Staf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda', [
        'jumlahPelanggan' => Pelanggan::count(),
        'jumlahStaf' => Staf::count(),
        'jumlahObat' => Obat::count(),
        'obatKadaluarsa' => Obat::whereDate('tanggal_kadaluarsa', '<', today())->count(),
    ]);
})->name('beranda');

Route::resource('pelanggan', PelangganController::class)
    ->except('show')
    ->parameters(['pelanggan' => 'pelanggan']);

Route::resource('staf', StafController::class)
    ->except('show')
    ->parameters(['staf' => 'staf']);

Route::resource('obat', ObatController::class)
    ->except('show')
    ->parameters(['obat' => 'obat']);
