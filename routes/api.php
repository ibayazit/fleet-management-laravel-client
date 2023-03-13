<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChargeSesionController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [LoginController::class, 'login']);
    });
    
    Route::get('/user', [UserController::class, 'user']);
    
    Route::prefix('charge')->group(function(){
        Route::post('/', [ChargeSesionController::class, 'charge']);
        Route::get('/active-session', [ChargeSesionController::class, 'activeSession']);
        Route::get('/done-sessions', [ChargeSesionController::class, 'doneSessions']);
    });
});
