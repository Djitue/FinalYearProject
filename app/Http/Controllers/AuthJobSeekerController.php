<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthJobSeekerController extends Controller
{
    public function showRegister()
    {
        return view('auth.registerjobseeker');
    }
    public function showLogin()
    {
        return view('auth.loginjobseeker');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create($validated);// saving to the db

        Auth::login($user);

       return view('welcome');

    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return view('dashboard.jobseeker');
        }

       throw ValidationException::withMessages([
        'credentials' => 'Sorry incorrect credentials'
       ]);
    }
}
