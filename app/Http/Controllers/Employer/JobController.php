<?php

namespace App\Http\Controllers\Employer;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the employer's jobs.
     */
    public function index()
    {
        $jobs = JobPosting::where('employer_id', Auth::id())->get();
        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('employer.add-job');
    }

    public function store(Request $request)
    {

        $employerId = auth()->id(); //Get the authenticated employer's user ID


        $request->validate([
            'job_title' => 'required|string',
            'company_name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'vacancy' => 'nullable|integer',
            'experience' => 'nullable|string',
            'logo' => 'nullable|image',
            'job_type' => 'nullable|string',
            'requirement' => 'nullable|string',
            'skill' => 'nullable|string',
            'proof' => 'nullable|file',
            'deadline' => 'nullable|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'town' => 'nullable|string',
            'facebook' => 'nullable|string',
            'X' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
        ]);
        $data = $request->except(['logo', 'proof']);
        $data['employer_id'] = Auth::guard('employer')->id();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $data['logo'] = 'uploads/logos/' . $filename;
        }

        // Handle proof upload
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/proofs'), $filename);
            $data['proof'] = 'uploads/proofs/' . $filename;
        }

        JobPosting::create($data);
        
        return redirect()->route('employer.dashboard')->with('success', 'Job posted successfully.');
    }
    
    // public function edit(JobPosting $job)
    // {
    //     return view('employer.jobs.edit', compact('job'));
    // }

    
    // public function update(Request $request, JobPosting $job)
    // {
    //     $data = $request->validate([
    //         'job_title' => 'required|string',
    //         'company_name' => 'nullable|string',
    //         'category' => 'nullable|string',
    //         'description' => 'required|string',
    //         'salary' => 'nullable|string',
    //         'vacancy' => 'nullable|integer',
    //         'experience' => 'nullable|string',
    //         'logo' => 'nullable|image',
    //         'job_type' => 'nullable|string',
    //         'requirement' => 'nullable|string',
    //         'skill' => 'nullable|string',
    //         'proof' => 'nullable|file',
    //         'deadline' => 'nullable|date',
    //         'email' => 'nullable|email',
    //         'phone' => 'nullable|string',
    //         'website' => 'nullable|string',
    //         'address' => 'nullable|string',
    //         'town' => 'nullable|string',
    //         'facebook' => 'nullable|string',
    //         'X' => 'nullable|string',
    //         'linkedin' => 'nullable|string',
    //         'instagram' => 'nullable|string',
    //     ]);

    //     // File updates
    //     if ($request->hasFile('logo')) {
    //         Storage::disk('public')->delete($job->logo);
    //         $data['logo'] = $request->file('logo')->store('logos', 'public');
    //     }

    //     if ($request->hasFile('proof')) {
    //         Storage::disk('public')->delete($job->proof);
    //         $data['proof'] = $request->file('proof')->store('proofs', 'public');
    //     }

    //     $job->update($data);

    //     return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully.');
    // }

    // public function destroy(JobPosting $job)
    // {
    //     Storage::disk('public')->delete([$job->logo, $job->proof]);
    //     $job->delete();

    //     return redirect()->route('employer.dashboard')->with('success', 'Job deleted successfully.');
    // }
}
