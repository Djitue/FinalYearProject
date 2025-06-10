<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::latest()->take(10)->get();
        return view('welcome', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobPosting::with('employer')->findOrFail($id);
        return view('details', compact('job'));
    }

    public function allJobs()
    {
        $jobs = JobPosting::with('employer')->latest()->paginate(4); // all jobs
        return view('browse-job', compact('jobs'));
    }
}
