<?php

use App\Http\Controllers\EsewaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/esewa', [EsewaController::class, 'esewaPay'])->name('esewa');

// success and failure routes
Route::get('/success', [EsewaController::class, 'esewaPaySuccess'])->name('success');
Route::get('/failure', [EsewaController::class, 'esewaPayFailure'])->name('failure');
