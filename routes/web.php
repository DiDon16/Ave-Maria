<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
})->name('laravel.index');

//  Register routes
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerAction']);

//  Mail verification
Route::middleware('auth')->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return response()->json(['message' => 'Email vérifié avec succès']);
    })->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return "<p>Email de vérification renvoyé</p>";
    })->middleware('throttle:6,1')->name('verification.send');

    // La première route est appelée lorsque l’utilisateur clique sur le lien de vérification dans son email.
    // La deuxième permet de renvoyer un email de vérification sur demande.
});

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verification.notice');

//  Login routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction']);
//  Logout route
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

//  index page
Route::get('/index', [\App\Http\Controllers\AveMariaController::class, 'index'])->name('index')->middleware('auth');

//  Route about patients
Route::prefix('/patient')->name('patient.')->controller(PatientController::class)->middleware('auth', 'verified')->group(function(){

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


