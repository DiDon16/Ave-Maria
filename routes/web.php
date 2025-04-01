<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
})->name('laravel.index');

//  Register routes
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerAction']);
//  Login routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction']);
//  Logout route
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

//  index page
Route::get('/index', [\App\Http\Controllers\AveMariaController::class, 'index'])->name('index')->middleware('auth');

//  Route about patients
Route::prefix('/patient')->name('patient.')->controller(PatientController::class)->middleware('auth')->group(function(){

    //  Create new Patient
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');

    //  Edit patient
    Route::get('/{patient}/edit', 'edit')->name('edit');
    Route::patch('/{patient}/edit', 'update');

    //  Show Patients Infos
    Route::get('/{patient}/show', 'show')->name('show');


    //  Create a MRC analysis
    Route::get('/{patient}/mrc/new', [\App\Http\Controllers\MrcController::class, 'create'])->name('mrc.create');
    Route::post('/{patient}/mrc/new', [\App\Http\Controllers\MrcController::class, 'store']);
    //  Edit a MRC Analysis
    Route::get('/mrc/{mrcAnalysis}/edit', [\App\Http\Controllers\MrcController::class, 'edit'])->name('mrc.edit');
    Route::post('/mrc/{mrcAnalysis}/edit', [\App\Http\Controllers\MrcController::class, 'update']);
    //  Show MRC Analysis
    Route::get('/mrc/{mrcAnalysis}/show', [\App\Http\Controllers\MrcController::class, 'show'])->name('mrc.show');
    //  Prediction with the model
    Route::get('/mrc/{mrcAnalysis}/prediction', [\App\Http\Controllers\MrcController::class, 'prediction'])->name('mrc.prediction');
});


