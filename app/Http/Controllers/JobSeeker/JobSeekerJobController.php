<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobSeekerJobController extends Controller
{
    /**
     * Display a listing oto the job seeker.
     */

    public function allJobs()
    {
        $jobs = JobPosting::with('employer')->latest()->paginate(4); // all jobs
        return view('jobseeker.job', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobPosting::with('employer')->findOrFail($id);
        return view('jobseeker.show', compact('job'));
    }

}
