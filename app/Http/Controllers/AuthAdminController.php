<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthAdminController extends Controller
{
    public function showRegister()
    {
        return view('auth.registeradmin');
    }
    public function showLogin()
    {
        return view('auth.loginadmin');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $admin = Admin::create($validated);

        Auth::login($admin);

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

            return view('welcome');
        }

       throw ValidationException::withMessages([
        'credentioals' => 'Sorry incorrect credentials'
       ]);
    }
}
