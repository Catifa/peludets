<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'dni' => 'required|string|max:9|unique:users',
            'password' => 'required|string|min:5'
        ]);

        return User::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'dni' => $request->input('dni'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorect.']
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function check()
    {
        return (Auth::check()) ? json_encode(true) : json_encode(false);
    }
}
