<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('Auth/login');
});



Route::post('/login', [AuthController::class, 'login']);


