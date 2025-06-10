<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    public function search(Request $request)
    {
        // Start building the query for JobPosting
        $query = JobPosting::query();

        // Filter by keyword (e.g., job title or description)
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        // Filter by town
        if ($request->filled('town')) {
            $query->where('town', 'like', '%' . $request->town . '%');
        }

        // Filter by job type
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // Fetch the results with pagination
        $jobs = $query->latest()->paginate(10);

        // Return to the search results view
        return view('job.results', compact('jobs'));
    }
}
