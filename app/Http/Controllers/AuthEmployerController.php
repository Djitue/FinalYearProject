<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AuthEmployerController extends Controller
{
    public function showRegister()
    {
        return view('auth.registeremployer');
    }
    public function showLogin()
    {
        return view('auth.loginemployer');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $employer = Employer::create($validated);

        Auth::login($employer);

        return view('welcome');
    }
    public function login()
    {
        
    }
}
