<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobSearchController extends Controller
{
    public function search(Request $request)
    {
        // Start building the query for JobPosting
        $query = JobPosting::query();

        // Filter by keyword (job title, company name, or description)
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('job_title', 'like', '%' . $keyword . '%')
                  ->orWhere('company_name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%')
                  ->orWhere('skill', 'like', '%' . $keyword . '%');
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

        // Add sorting
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'salary_high':
                $query->orderByRaw('CAST(REGEXP_REPLACE(salary, "[^0-9]", "") AS DECIMAL) DESC');
                break;
            case 'salary_low':
                $query->orderByRaw('CAST(REGEXP_REPLACE(salary, "[^0-9]", "") AS DECIMAL) ASC');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        // Fetch the results with pagination
        $jobs = $query->with('employer')->paginate(9)->withQueryString();

        // Return to the search results view
        return view('job.results', compact('jobs'));
    }

    /**
     * Get search suggestions based on keyword
     */
    public function suggestions(Request $request)
    {
        if (!$request->filled('keyword') || strlen($request->keyword) < 2) {
            return response()->json([]);
        }

        $keyword = $request->input('keyword');
        
        // Get suggestions from job titles, skills, and company names
        $suggestions = JobPosting::where('job_title', 'like', "%{$keyword}%")
            ->orWhere('skill', 'like', "%{$keyword}%")
            ->orWhere('company_name', 'like', "%{$keyword}%")
            ->select('job_title', 'skill', 'company_name')
            ->limit(10)
            ->get();

        // Process and format suggestions
        $results = collect();
        
        // Add job titles
        $results = $results->merge($suggestions->pluck('job_title'));
        
        // Add skills (split by comma and trim)
        $results = $results->merge($suggestions->pluck('skill')
            ->filter()
            ->flatMap(function ($skills) {
                return array_map('trim', explode(',', $skills));
            }));
            
        // Add company names
        $results = $results->merge($suggestions->pluck('company_name'));

        // Remove duplicates, filter out empty values, and limit to 10 suggestions
        $results = $results->unique()
            ->filter()
            ->filter(function ($value) use ($keyword) {
                return stripos($value, $keyword) !== false;
            })
            ->values()
            ->take(10);

        return response()->json($results);
    }
}
