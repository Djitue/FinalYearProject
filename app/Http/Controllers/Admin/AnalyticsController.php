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
        $totalEmployers = Employer::count();
        $totalJobseekers = User::count();
        $totalAdmins = Admin::count();
        $totalUsers = $totalJobseekers + $totalEmployers + $totalAdmins;
        $totalJobs = Jobposting::count();
        $totalApplications = Application::count();

        $today = Carbon::today();

        $expiredJobs = JobPosting::whereDate('deadline', '<', $today)->count();
        // $activeJobs = JobPosting::whereDate('deadline', '>=', $today)->count();

        return view('admin.analytics.index', compact(
            'totalEmployers', 'totalJobseekers', 'totalJobs',
             'expiredJobs', 'totalApplications', 'totalAdmins', 'totalUsers'
        ));
    }
}
