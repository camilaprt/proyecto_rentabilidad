<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegister()
    {

        return view('auth.register');
    }

    public function showLogin()
    {

        return view('auth.login');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create($validated);

        //Laravel creates a cookie session and token for the logged in user
        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            //it regenerates session id to ensure security of the session
            $request->session()->regenerate();

            return redirect()->route('proyectos');
        }

        throw ValidationException::withMessages([
            'credentials' => "Las credenciales son incorrectas"
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        //helps to remove reamining data of the user in the session(i.e shopping carts, config,etc)
        $request->session()->invalidate();
        //regenerates new token. It's an added layer of security to prevent using old token
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
