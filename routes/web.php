<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TraductorController;

// Route::get('/', function () {
//     return view('traductor');
// });

// Route::get('/traductor', function () {
//     return view('traductor');
// })->name('traductor');

// Route::get('/traductor', [TraductorController::class, 'index'])->name('traductor');

Route::view('/', 'traductor')->name('traductor');
Route::view('/traductor', 'traductor');

Route::post('/traducir', [TraductorController::class, 'traducir'])->name('traducir');