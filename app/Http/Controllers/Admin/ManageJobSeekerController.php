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

    public function show($id)
    {
        $jobSeeker = User::findOrFail($id);
        return view('admin.job_seekers.jobseeker', compact('jobSeeker'));
    }

    public function edit($id)
    {   
         $jobseeker = User::findOrFail($id);
        return view('admin.job_seekers.edit', compact('jobseeker'));
    }

        public function update(Request $request, $id)
    {
        $jobSeeker = User::findOrFail($id); // Or however you retrieve the model

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Prevent conflict on same record
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'gender' => 'nullable|string',
            'skill' => 'nullable|string',
            'age' => 'nullable|string',
            'language' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('cvs', 'public');
        }
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $jobSeeker->update($validated);

        return redirect()->back()->with('success', 'Job Seeker updated successfully.');
    }

    public function destroy(User $jobSeeker)
    {
        $jobSeeker->delete();
        return redirect()->route('job-seekers.index')->with('success', 'Job Seeker deleted successfully.');
    }
}
