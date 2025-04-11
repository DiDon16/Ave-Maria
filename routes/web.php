<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/', function () {
//     return redirect()->route('login');
//     // return view('welcome');
// });

//  Register routes
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerAction']);
//  Mail verification
Route::middleware('auth')->group(function () {
    //  permet de renvoyer un email de vérification sur demande.
    Route::post('/email/verification-notification', function (Request $request) {

        $request->user()->sendEmailVerificationNotification();
        return "<p>Email de vérification renvoyé</p>";
        return "<p>Email de vérification renvoyé</p>";
    })->middleware('throttle:6,1')->name('verification.send');
});

//  route est appelée lorsque l’utilisateur clique sur le lien de vérification dans son email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json(['message' => 'Email vérifié avec succès']);
})->middleware(['auth', 'signed'])->name('verification.verify');

//  Envoie de notification de verification de mail
Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verification.notice');

//  Login routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction']);

//  2fa routes
Route::middleware(['auth'])->group(function () {
    Route::get('/2fa', function () {
        return view('auth.2fa');
    })->name('2fa.form');

    Route::post('/2fa-verify', [AuthController::class, 'verify2FA'])->name('2fa.verify');
    Route::post('/2fa-resend', [AuthController::class, 'resend2FA'])->name('2fa.resend');
});


//  Logout route
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


//  Route about patients
Route::prefix('/patient')->name('patient.')->controller(PatientController::class)->middleware('auth', 'verified', '2fa')->group(function(){

    //  Display patients list
    Route::get('/', 'index')->name('index');
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

Route::get('/mrcAnalyses', [\App\Http\Controllers\MrcController::class, 'index'])->name('mrc.index')->middleware('auth', 'verified', '2fa');

//  dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth', 'verified', '2fa');
//  index page
Route::get('/index', function (){
    return to_route('dashboard');
})->name('index')->middleware('auth', 'verified', '2fa');
Route::get('/', function(){
    return to_route('dashboard');
});

