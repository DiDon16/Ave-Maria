<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('laravel.index');

//  Register routes
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerAction']);

//  Login routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction']);

//  index page
Route::get('/index', [\App\Http\Controllers\AveMariaController::class, 'index'])->name('index')->middleware('auth');

//  Logout route
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

