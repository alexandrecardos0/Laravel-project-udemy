<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/usuarios', [UserController::class, 'index']);
Route::get('admin/usuarios/{user}', [UserController::class, 'show']);

Route::get('pagina-simples', function () {
    return view('test.simple-page');
});
Route::get('pagina-completa', function () {
    return view('test.full-page');
});
