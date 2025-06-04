<?php

namespace App\Http\Controllers\JobSeeker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function index()
    {
        $user = Auth::guard('web')->user();  
        return view('dashboard.jobseeker', compact('user'));

    }
}
