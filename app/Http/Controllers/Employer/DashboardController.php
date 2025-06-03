<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employer = Auth::guard('employer')->user();
        return view('dashboard.employer', compact('employer'));
    }

    public function indexx()
    {
        $user = Auth::guard('web')->user();  
        return view('dashboard.jobseeker', compact('user'));

    }
}
