<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
