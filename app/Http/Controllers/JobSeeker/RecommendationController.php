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
            return redirect()->route('jobseeker.edit-profile')
                ->with('error', 'Please complete your profile and add skills to get job recommendations.');
        }

        // Convert user's skills to a lowercase, trimmed array
        $userSkills = collect(explode(',', strtolower($user->skill)))
                        ->map(fn($skill) => trim($skill))
                        ->filter();

        // Fetch all active jobs
        $allJobs = JobPosting::all();

        // Calculate match scores for each job based only on skills
        $matchedJobs = $allJobs->map(function ($job) use ($userSkills) {
            if (!$job->skill) return null;

            // Convert job skills to array
            $jobSkills = collect(explode(',', strtolower($job->skill)))
                        ->map(fn($skill) => trim($skill))
                        ->filter();

            // Find matching skills
            $matchedSkills = $userSkills->intersect($jobSkills);
            
            // Calculate match percentage based on how many of the user's skills match the job's required skills
            $matchPercentage = $userSkills->count() > 0 
                ? ($matchedSkills->count() / $userSkills->count()) * 100 
                : 0;

            // Only include jobs with at least 20% skill match
            if ($matchPercentage < 20) {
                return null;
            }

            $job->match_percentage = round($matchPercentage);
            $job->matched_skills = $matchedSkills->values()->toArray();
            
            return $job;
        })->filter()  // Remove null values
          ->sortByDesc('match_percentage')
          ->values();

        return view('jobseeker.recommended_jobs', ['jobs' => $matchedJobs]);
    }
}
