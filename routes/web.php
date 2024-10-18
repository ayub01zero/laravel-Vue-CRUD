<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');



    Route::get('/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    });


    
    Route::get('/auth/google/callback', function () {
       
            $googleUser = Socialite::driver('google')->user();
            
          
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(24)),
                ]
            );
    
            Auth::login($user);
            dd($user);
      
    });
    

    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']); 
Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']); 



    Route::view('/{any?}', 'dashboard')
    ->where('any', '.*');

