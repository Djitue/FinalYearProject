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

    public function allJobs(Request $request)
    {
        $query = JobPosting::with('employer')->latest();

        // Filter by job type if provided
        if ($request->has('job_type') && $request->job_type != '') {
            $query->where('job_type', $request->job_type);
        }

        // Filter by location if provided
        if ($request->has('town') && $request->town != '') {
            $query->where('town', 'like', '%' . $request->town . '%');
        }

        // Filter by keyword if provided
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where(function($q) use ($request) {
                $q->where('job_title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('company_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        $jobs = $query->paginate(12); // Show 12 jobs per page
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
