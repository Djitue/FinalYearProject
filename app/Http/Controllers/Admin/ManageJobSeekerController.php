<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageJobSeekerController extends Controller
{
    public function index()
    {
        $jobSeekers = User::all();
        return view('admin.job_seekers.index', compact('jobSeekers'));
    }

    public function create()
    {
        return view('admin.job_seekers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:255',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->back()->with('success', 'Job Seeker created successfully.');
    }

    // public function show(JobSeeker $jobSeeker)
    // {
    //     return view('admin.job_seekers.show', compact('jobSeeker'));
    // }

    // public function edit(JobSeeker $jobSeeker)
    // {
    //     return view('admin.job_seekers.edit', compact('jobSeeker'));
    // }

    // public function update(Request $request, JobSeeker $jobSeeker)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => "required|email|unique:job_seekers,email,{$jobSeeker->id}",
    //     ]);

    //     $jobSeeker->update($validated);

    //     return redirect()->route('job-seekers.index')->with('success', 'Job Seeker updated successfully.');
    // }

    // public function destroy(JobSeeker $jobSeeker)
    // {
    //     $jobSeeker->delete();
    //     return redirect()->route('job-seekers.index')->with('success', 'Job Seeker deleted successfully.');
    // }
}
