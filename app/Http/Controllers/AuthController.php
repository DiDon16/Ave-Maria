<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    //  Register
    public function register(Request $request) {

        $roles = Role::select(['id', 'name'])->get();

        return view('auth.register', [
            'roles' => $roles,
        ]);
    }

    public function registerAction(Request $request) {
        $validatedData = $request->validate([
            "name" => "required|string|max:250",
            "email" => "required|email|max:250|unique:users,email",
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/[a-z]/', // Minuscule
                'regex:/[A-Z]/', // Majuscule
                'regex:/[0-9]/', // Chiffre
                'regex:/[^A-Za-z0-9]/', // Caractère spécial
            ],
            'role_id' => ['required', 'exists:roles,id'],
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        Auth::login($user);
        event(new Registered($user));
        // Mail::to($user->email)->send(new VerifyEmail($user));
        $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('success', 'Account created successfully !');
    }

    //  Login actions
    public function login() {
        return view('auth.login');
    }

    public function loginAction(Request $request) {

        $credentials = $request->validate([
            "email" => "required|email",
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user && !$user->hasVerifiedEmail()){
                return to_route('verification.notice');
            }

            // $request->session()->regenerate();
            // $user = $request->user()->name;
            // return redirect()->intended(route('dashboard'))->with('success', "Success !");

            // Générer un code 2FA à 5 chiffres
            $code = rand(10000, 99999);

            // Sauvegarder le code et l'expiration (ex: 5 minutes)
            $user->two_fa_secret = $code;
            $user->two_fa_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            // Envoyer le code par email
            Mail::raw("Votre code de vérification est : $code", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject("Code de vérification 2FA");
            });

            // Rediriger vers le formulaire de vérification 2FA
            return redirect()->route('2fa.form');

    };

        return back()->with([
            'error'=> 'Invalids credentials !'
        ])->onlyInput('email');
    }

    public function verify2FA(Request $request)
    {
        $code = $request->validate([
            'code' => 'required|numeric|digits:5'
        ]);

        $code = $code['code'];
        $user = Auth::user();

        if(!$user){
            return redirect()->route('login')->with('error', "Temps écoulé ! Veuillez vous reconnecter !");
        }


        // Vérifier si le code est correct et pas expiré
        if ($user->two_fa_secret == $code && Carbon::now()->lt($user->two_fa_expires_at)) {
            // Réinitialiser le champ 2FA
            $user->two_fa_secret = null;
            $user->two_fa_expires_at = null;
            $user->save();

            $request->session()->regenerate();
            $user = $request->user()->name;
            return redirect()->intended(route('dashboard'))->with('success', "Success !");
        }

        return back()->withErrors(['code' => 'Code incorrect ou expiré.']);
    }

    public function resend2FA()
    {
        $user = Auth::user();

        // if (Carbon::now()->lt(Carbon::parse($user->two_fa_expires_at)->addMinutes(2))) {
        //     return back()->withErrors(['error' => 'Vous devez attendre 2 minutes avant de redemander un code.']);
        // }

        $code = rand(10000, 99999);
        $user->two_fa_secret = $code;
        $user->two_fa_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        Mail::raw("Votre nouveau code de vérification est : $code", function ($message) use ($user) {
            $message->to($user->email)
                ->subject("Nouveau code de vérification 2FA");
        });

        return back()->with('success', 'Un nouveau code a été envoyé.');
    }

    //  Logout
    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You are disconnected !');
    }
}
