<?php

use App\Http\Controllers\Api\ObatApiController;
use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\StafApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('pelanggan', PelangganApiController::class)
    ->parameters(['pelanggan' => 'pelanggan'])
    ->names('api.pelanggan');

Route::apiResource('staf', StafApiController::class)
    ->parameters(['staf' => 'staf'])
    ->names('api.staf');

Route::apiResource('obat', ObatApiController::class)
    ->parameters(['obat' => 'obat'])
    ->names('api.obat');
