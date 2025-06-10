<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobSeekerJobController extends Controller
{
    /**
     * Display a listing pf job to the job seeker.
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

   public function toggle(JobPosting  $job, Request $request)
    {
        $user = $request->user();
        
        if ($user->savedJobs()->where('job_id', $job->id)->exists()) {
            $user->savedJobs()->detach($job->id);
            return response()->json(['status' => 'removed']);
        } else {
            $user->savedJobs()->attach($job->id);
            return response()->json(['status' => 'added']);
        }
    }

    public function index(Request $request)
    {
        $savedJobs = $request->user()->savedJobs()->with('company')->get();
        return view('jobseeker.saved-job', compact('savedJobs'));
    }


}
