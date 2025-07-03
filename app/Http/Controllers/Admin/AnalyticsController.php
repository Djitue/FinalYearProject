<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function analytics()
    {
        // Get current date for comparisons
        $today = Carbon::today();

        // Basic counts
        $totalEmployers = Employer::count();
        $totalJobseekers = User::count();
        $totalAdmins = Admin::count();
        $totalUsers = $totalJobseekers + $totalEmployers + $totalAdmins;

        // Job related counts
        $totalJobs = JobPosting::count();
        $expiredJobs = JobPosting::whereDate('deadline', '<', $today)->count();
        $activeJobs = $totalJobs - $expiredJobs;
        $totalApplications = Application::count();

        return view('admin.analytics.index', compact(
            'totalEmployers',
            'totalJobseekers',
            'totalAdmins',
            'totalUsers',
            'totalJobs',
            'activeJobs',
            'expiredJobs',
            'totalApplications'
        ));
    }
}
