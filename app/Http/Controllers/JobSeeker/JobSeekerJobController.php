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

    // public function savedJob(Request $request){
    //     $id = $request->id;

    //     $job = JobPosting::find($id);

    //     if($job == null) {
    //         sessiom()->flash('error', 'Job not found');
    //         return response()->json([
    //             'status' => false,
    //         ]);
    //     }

    //     //check if user already saved job
    //     $count = savedJob::where([
    //         'user_ide' => Auth::user()->id,
    //         'job_posting_id'=> $id
    //     ])->count();

    //     if ($count > 0){
    //         sessiom()->flash('error', 'Job Saved already');
    //         return response()->json([
    //             'status' => false,
    //         ]);
    //     }
    // }

}
