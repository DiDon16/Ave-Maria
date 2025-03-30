<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|min:4|confirmed',
            'role_id' => ['required', 'exists:roles,id'],
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        return redirect()->route('login')->with('success', 'Account created successfully !');
    }

    //  Login actions
    public function login() {
        return view('auth.login');
    }

    public function loginAction(Request $request) {

        $credentials = $request->validate([
            "email" => "required|email|max:250",
            'password' => 'required|string|min:4',
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = $request->user()->name;
            return redirect()->intended(route('laravel.index'))->with('success', "Welcome $user !");
        };

        return to_route('login')->with([
            'error'=> 'Invalids credentials !'
        ])->withInput(['name', 'email', 'role_id']);
    }

    //  Logout
    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('success', 'You are disconnected !');
    }
}
