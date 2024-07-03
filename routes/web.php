<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']); 
Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']); 

Route::view('/{any?}', 'dashboard')
    ->where('any', '.*');