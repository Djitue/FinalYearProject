<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function recommendedJobs()
    {
        $user = auth()->user();

        if (!$user || !$user->skill) {
            return redirect()->route('job_seekers.edit-profile')
                ->with('error', 'Please complete your profile and add skills to get job recommendations.');
        }

        // Convert user's skills to a lowercase, trimmed array
        $seekerSkills = collect(explode(',', strtolower($user->skill)))
                        ->map(fn($skill) => trim($skill))
                        ->filter();

        // Fetch all jobs and filter based on matching skills
        $jobs = JobPosting::all()->filter(function ($job) use ($seekerSkills) {
            if (!$job->skill) return false;

            $jobSkills = collect(explode(',', strtolower($job->skill)))
                        ->map(fn($skill) => trim($skill))
                        ->filter();

            return $seekerSkills->intersect($jobSkills)->isNotEmpty();
        });

        return view('jobseeker.recommended_jobs', compact('jobs'));
    }

}
