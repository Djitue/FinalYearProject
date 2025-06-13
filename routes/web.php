<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthEmployerController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\AuthJobSeekerController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ManageJobController;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\Admin\ManageEmployerController;
use App\Http\Controllers\Admin\ManageJobSeekerController;
use App\Http\Controllers\JobSeeker\JobSeekerJobController;
use App\Http\Controllers\JobSeeker\RecommendationController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Employer\ProfileController as EmployerProfileController;
use App\Http\Controllers\JobSeeker\ProfileController as JobSeekerProfileController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\JobSeeker\DashboardController as JobSeekerDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/search-jobs', [JobSearchController::class, 'search'])->name('jobs.search');

Route::get('/employer/register',[AuthEmployerController::class, 'showRegister'])->name('show.registeremployer');
Route::get('/employer/login',[AuthEmployerController::class, 'showLogin'])->name('show.loginemployer');
Route::post('/employer/register',[AuthEmployerController::class, 'register'])->name('registeremployer');
Route::post('/employer/login',[AuthEmployerController::class, 'login'])->name('loginemployer');
// Route::post('/employer/logout',[AuthEmployerController::class, 'logout'])->name('logoutemployer');

Route::get('/jobseeker/register',[AuthJobSeekerController::class, 'showRegister'])->name('show.registerjobseeker');
Route::get('/jobseeker/login',[AuthJobSeekerController::class, 'showLogin'])->name('show.loginjobseeker');
Route::post('/jobseeker/register',[AuthJobSeekerController::class, 'register'])->name('registerjobseeker');
Route::post('/jobseeker/login',[AuthJobSeekerController::class, 'login'])->name('loginjobseeker');
// Route::post('/jobseeker/logout',[AuthJobSeekerController::class, 'logout'])->name('logoutjobseeker');

Route::get('/admin1/register',[AuthAdminController::class, 'showRegister'])->name('show.registeradmin');
Route::get('/admin1/login',[AuthAdminController::class, 'showLogin'])->name('show.loginadmin');
Route::post('/admin1/register',[AuthAdminController::class, 'register'])->name('registeradmin');
Route::post('/admin1/login',[AuthAdminController::class, 'login'])->name('loginadmin');
// Route::post('/admin/logout',[AuthAdminController::class, 'logout'])->name('logoutadmin');

// Employer Dashboard
Route::middleware(['auth:employer'])->group(function () {
    Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');
        // Edit Profile
    Route::get('/employer/edit-profile', [EmployerProfileController::class, 'edit'])->name('employer.edit-profile');
    Route::post('/employer/edit-profile', [EmployerProfileController::class, 'update'])->name('employer.update-profile');
    // Change Password
    Route::get('/employer/change-password', [EmployerProfileController::class, 'changePasswordForm'])->name('employer.change-password');
    Route::post('/employer/change-password', [EmployerProfileController::class, 'updatePassword'])->name('employer.update-password');
    // Logout
    Route::post('/employer/logout', [AuthEmployerController::class, 'logout'])->name('employer.logout');

    Route::delete('/employer/delete-account', [EmployerProfileController::class, 'destroy'])->name('employer.delete-account');

    //Dashboard links
    Route::get('/employer/add-job', [JobController::class, 'create'])->name('employer.add-job');
    Route::get('/employer/view-candidates', [JobController::class, 'index'])->name('employer.view-candidates');
    Route::get('/employer/manage-job', [JobController::class, 'index'])->name('employer.manage-job');
    Route::get('/employer/job-detail/{id}', [JobController::class, 'show'])->name('employer.job-detail');

    // jobs
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/employer/jobs/candidates', [JobController::class, 'viewPostedJobs'])->name('employer.jobs.candidates');
    Route::get('/employer/jobs/{job}/applicants', [JobController::class, 'viewApplicants'])->name('employer.jobs.applicants');
    Route::put('/applicants/{id}/status', [JobController::class, 'updateStatus'])->name('applicants.update.status');
    Route::delete('/applicants/{id}', [JobController::class, 'destroyapplication'])->name('applicants.destroy');


});

// Jobseeker Dashboard
Route::prefix('jobseeker')->middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [JobSeekerDashboardController::class, 'index'])->name('jobseeker.dashboard');
    Route::get('edit-profile', [JobSeekerProfileController::class, 'edit'])->name('jobseeker.edit-profile');
    Route::post('edit-profile', [JobSeekerProfileController::class, 'update'])->name('jobseeker.update-profile');
    Route::get('/change-password', [JobSeekerProfileController::class, 'changePasswordForm'])->name('jobseeker.change-password');
    Route::post('/change-password', [JobSeekerProfileController::class, 'updatePassword'])->name('jobseeker.update-password');
    Route::post('/logout', [AuthJobSeekerController::class, 'logout'])->name('jobseeker.logout');
    Route::delete('/delete-account', [JobSeekerProfileController::class, 'destroy'])->name('jobseeker.delete-account');
    Route::get('/jobs/{id}', [JobSeekerJobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs', [JobSeekerJobController::class, 'allJobs'])->name('jobseeker.jobs');
    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'applyForm'])->name('job.apply.form');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('job.apply.submit');
    Route::delete('/jobseeker/application/{id}', [ApplicationController::class, 'destroyByUser'])->name('jobseeker.application.delete');
    // Show tracking page
    Route::get('/jobseeker/applications', [ApplicationController::class, 'trackApplications'])->name('jobseeker.applications');
     Route::get('/recommended-jobs', [RecommendationController::class, 'recommendedJobs'])->name('jobseeker.recommended.jobs');

});

// Admin Dashboard
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('edit-profile', [AdminProfileController::class, 'edit'])->name('admin.edit-profile');
    Route::post('edit-profile', [AdminProfileController::class, 'update'])->name('admin.update-profile');
    Route::get('/change-password', [AdminProfileController::class, 'changePasswordForm'])->name('admin.change-password');
    Route::post('/change-password', [AdminProfileController::class, 'updatePassword'])->name('admin.update-password');
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::delete('/delete-account', [AdminProfileController::class, 'destroy'])->name('admin.delete-account');
    //Manage job
    Route::get('jobs', [ManageJobController::class, 'index'])->name('admin.jobs.index');        // View all jobs
    Route::get('jobs/create', [ManageJobController::class, 'create'])->name('admin.jobs.create'); // Show create form
    Route::post('jobs/store', [ManageJobController::class, 'store'])->name('admin.jobs.store');   // Store new job
    Route::get('jobs/{id}/edit', [ManageJobController::class, 'edit'])->name('admin.jobs.edit');  // Show edit form
    Route::put('jobs/{id}/update', [ManageJobController::class, 'update'])->name('admin.jobs.update'); // Update job
    Route::delete('jobs/{id}/delete', [ManageJobController::class, 'destroy'])->name('admin.jobs.destroy'); // Delete job
    Route::get('job-detail/{id}', [ManageJobController::class, 'show'])->name('admin.job-detail');
    //manage job seeker
    
    Route::get('/job-seekers', [ManageJobSeekerController::class, 'index'])->name('job-seekers.index');// Show all job seekers
    Route::get('/job-seekers/create', [ManageJobSeekerController::class, 'create'])->name('job-seekers.create'); // Show create form
    Route::post('/job-seekers', [ManageJobSeekerController::class, 'store'])->name('job-seekers.store');// Store new job seeker
    Route::get('/job-seekers/{id}', [ManageJobSeekerController::class, 'show'])->name('job-seekers.show');// Show specific job seeker details
    Route::get('/job-seekers/{id}/edit', [ManageJobSeekerController::class, 'edit'])->name('job-seekers.edit');// Show edit form
    Route::put('/job-seekers/{id}', [ManageJobSeekerController::class, 'update'])->name('job-seekers.update');// Update job seeker
    Route::delete('/job-seekers/{id}', [ManageJobSeekerController::class, 'destroy'])->name('job-seekers.destroy');// Delete job seeker

    // Admin routes to manage employers
    Route::get('/employers', [ManageEmployerController::class, 'index'])->name('employers.index');           // List all employers
    Route::get('/employers/create', [ManageEmployerController::class, 'create'])->name('employers.create');   // Show create form
    Route::post('/employers', [ManageEmployerController::class, 'store'])->name('employers.store');           // Store new employer
    Route::get('/employers/{id}', [ManageEmployerController::class, 'show'])->name('employers.show');         // Show employer detail
    Route::get('/employers/{id}/edit', [ManageEmployerController::class, 'edit'])->name('employers.edit');    // Show edit form
    Route::put('/employers/{id}', [ManageEmployerController::class, 'update'])->name('employers.update');     // Update employer
    Route::delete('/employers/{id}', [ManageEmployerController::class, 'destroy'])->name('employers.destroy');// Delete employer

    //Analytics
    Route::get('/admin/analytics', [AnalyticsController::class, 'analytics'])->name('admin.analytics');

});






    //unregistered users
    Route::get('/jobs/{id}', [HomeController::class, 'show'])->name('job.details');
    Route::get('/job', [HomeController::class, 'allJobs'])->name('browse.job');
    // Route::get('/saved-job', [JobSeekerJobController::class, 'saveJob'])->name('saveJob');
    Route::post('/jobs/{job}/save', [JobSeekerJobController::class, 'toggle'])
        ->name('jobs.save');
    
    // View saved jobs
    Route::get('/saved-jobs', [JobSeekerJobController::class, 'index'])
        ->name('saved-jobs.index');

