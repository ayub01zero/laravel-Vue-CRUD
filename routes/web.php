<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::view('/{any?}', 'dashboard') 
    ->where('any', '.*'); 
