<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.main');
    }

    public function authLogin(Request $r)
    {
        $loginData = $r->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $user = User::where('email', $loginData['email'])->first();

        if ($user && $user->status != 1) {

            return redirect(route('login'))->withErrors(['loginFailed' => 'Infelizmente sua conta está banida da nossa plataforma...']);

        }

        $authLogin = Auth::attempt($loginData);

        if ($authLogin) {

            return redirect(route('home'));

        } else {

            return redirect(route('login'))->withErrors(['loginFailed' => 'As credenciais fornecidas são inválidas. Por favor, verifique e tente novamente.']);

        }
    }

    public function register()
    {

        return view('auth.register');
    }

    public function authRegister(Request $r)
    {
        $registerData = $r->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        $registerData['password'] = Hash::make($registerData['password']);

        $registerData['username'] = str_replace(' ', '-', strtolower($registerData['name']));

        while(User::where('username', $registerData['username'])->first()) {

            $registerData['username'] = str_replace(' ', '', strtolower($registerData['name']) . rand(1, 1000));

        };

        $user = new User($registerData);

        $user->save();

        Auth::attempt($r->only('email', 'password'));

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
