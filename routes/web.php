<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/traductor', function () {
    return view('traductor');
})->name('traductor');

Route::post('/traducir', [App\Http\Controllers\TraductorController::class, 'traducir'])->name('traducir');