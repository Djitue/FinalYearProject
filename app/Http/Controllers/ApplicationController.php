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
        // Check if user has already applied or deleted the application
        $existingApplication = Application::where('user_id', $userId)
            ->where('job_posting_id', $jobId)
            ->first();

        if ($applicationCount > 0) {
             return back()->withErrors(['email' => 'You have already applied for this job or withdrawn your application.']);
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

    public function destroyByUser($id)
    {
        $application = Application::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $application->deleted_by_user = true;
        $application->save();

        return redirect()->back()->with('success', 'Application deleted successfully.');
    }

    public function trackApplications()
    {
        $userId = auth()->id();

        // Get applications that are not deleted by the user
        $applications = Application::where('user_id', $userId)
            ->where('deleted_by_user', false)
            ->with('job') // Load job details for display
            ->latest()
            ->get();

        return view('jobseeker.track', compact('applications'));
    }

}
