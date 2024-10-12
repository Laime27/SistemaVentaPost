<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;

Route::get('/', function () {
    return view('Auth/login');
});



Route::post('login', [AuthController::class, 'login']);


// Suggested code may be subject to a license. Learn more: ~LicenseLog:1777834137.
Route::resource('categorias', CategoriasController::class);

Route::get('ListarCategorias', [CategoriasController::class, 'ListarCategorias']);


