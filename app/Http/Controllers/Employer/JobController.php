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

        $query = Job::query();

        // Filtering
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('salary')) {
            switch ($request->salary) {
                case 'under_50000': $query->where('salary', '<', 50000); break;
                case '50000_100000': $query->whereBetween('salary', [50000, 100000]); break;
                case '100000_200000': $query->whereBetween('salary', [100000, 200000]); break;
                case '200000_300000': $query->whereBetween('salary', [200000, 300000]); break;
                case 'above_500000': $query->where('salary', '>', 500000); break;
            }
        }

        // Sorting
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'views': $query->orderBy('views', 'desc'); break;
                case 'search': $query->orderBy('search_count', 'desc'); break;
                default: $query->orderBy('created_at', 'desc'); break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $jobs = $query->paginate(10);

        return view('jobs', compact('jobs'));
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
    
    public function show($id)
    {
        $job = JobPosting::findOrFail($id); // Assuming your model is JobPosting

        return view('employer.job-detail', compact('job'));
    }


    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);
        return view('employer.edit-job', compact('job'));
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

        $data = $request->all();

         // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        // Handle proof upload if present
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
            $data['proof'] = $proofPath;
        }

        $job->update($data);

        return redirect()->route('employer.dashboard')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully.');
    }
}
