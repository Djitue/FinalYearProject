<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
     // Show apply form
    public function applyForm($jobId)
    {
        $job = JobPosting::findOrFail($jobId);
        return view('jobseeker.application', compact('job'));
    }

    // Handle application submission
    public function apply(Request $request, $jobId)
    {
        $userId = auth()->id();

        // Check if user has already applied
        $applicationCount = Application::where([
            'user_id' => $userId,
            'job_posting_id' => $jobId
        ])->count();

        if ($applicationCount > 0) {
             return back()->withErrors(['email' => 'You have already applied for this job.']);
        }

        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Store the CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Save application
        Application::create([
            'user_id'=> $userId,
            'job_posting_id' => $jobId,
            'cv' => $cvPath,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
