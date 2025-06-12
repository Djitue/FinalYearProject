<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employer;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageJobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::with('employer')->latest()->get();
        return view('admin.job', compact('jobs'));
    }

    public function create()
    {
        $employers = Employer::all(); 
        return view('admin.create-job', compact('employers'));
    }


    public function store(Request $request)
    {

        $request->validate([
        'job_title' => 'required|string',
        'company_name' => 'nullable|string',
        'category' => 'nullable|string',
        'description' => 'required|string',
        'salary' => 'nullable|string',
        'vacancy' => 'nullable|integer',
        'experience' => 'nullable|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'job_type' => 'nullable|string',
        'requirement' => 'nullable|string',
        'skill' => 'nullable|string',
        'proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
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

    $data = $request->only([
        'job_title', 'company_name', 'category', 'description', 'salary',
        'vacancy', 'experience', 'job_type', 'requirement', 'skill',
        'deadline', 'email', 'phone', 'website', 'address', 'town',
        'facebook', 'X', 'linkedin', 'instagram'
    ]);

    $data['employer_id'] = $request->input('employer_id'); // Set selected employer


    // Handle logo upload
    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('logos', 'public');
    }

    // Handle proof upload
    if ($request->hasFile('proof')) {
        $data['proof'] = $request->file('proof')->store('proofs', 'public');
    }

    JobPosting::create($data);

    return redirect()->back()->with('success', 'Job created successfully.');

    }

    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);
        return view('admin.job-edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required|string',
            'company_name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'vacancy' => 'nullable|integer',
            'experience' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_type' => 'nullable|string',
            'requirement' => 'nullable|string',
            'skill' => 'nullable|string',
            'proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
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

        $job = JobPosting::findOrFail($id);

        $data = $request->only([
            'job_title', 'company_name', 'category', 'description', 'salary',
            'vacancy', 'experience', 'job_type', 'requirement', 'skill',
            'deadline', 'email', 'phone', 'website', 'address', 'town',
            'facebook', 'X', 'linkedin', 'instagram'
        ]);

        // Delete old logo if new one is uploaded
        if ($request->hasFile('logo')) {
            if ($job->logo) {
                Storage::disk('public')->delete($job->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Delete old proof if new one is uploaded
        if ($request->hasFile('proof')) {
            if ($job->proof) {
                Storage::disk('public')->delete($job->proof);
            }
            $data['proof'] = $request->file('proof')->store('proofs', 'public');
        }

        $job->update($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated.');
    }

    public function destroy($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted.');
    }

    public function show($id)
    {
        $job = JobPosting::findOrFail($id); // fetch job or show 404

        return view('admin.job-details', compact('job'));
    }

}