<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $request->validate($request->all(), [
            'guard' => 'required|string|in:user',
        ]);
            return response()->view('auth.login', ['guard' => 'user']);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ]);
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'login is successfully', Auth::user()]);
        }
    }

    public function logout(Request $request)
    {
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login', 'user');
    }
}
