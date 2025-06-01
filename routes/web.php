<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthEmployerController;
use App\Http\Controllers\AuthJobSeekerController;
use App\Http\Controllers\Employer\ProfileController;
use App\Http\Controllers\Employer\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


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

Route::get('/admin/register',[AuthAdminController::class, 'showRegister'])->name('show.registeradmin');
Route::get('/admin/login',[AuthAdminController::class, 'showLogin'])->name('show.loginadmin');
Route::post('/admin/register',[AuthAdminController::class, 'register'])->name('registeradmin');
Route::post('/admin/login',[AuthAdminController::class, 'login'])->name('loginadmin');
// Route::post('/admin/logout',[AuthAdminController::class, 'logout'])->name('logoutadmin');

// Employer Dashboard
Route::middleware(['auth:employer'])->group(function () {
    Route::get('/employer/dashboard', [DashboardController::class, 'index'])->name('employer.dashboard');
        // Edit Profile
    Route::get('/employer/edit-profile', [ProfileController::class, 'edit'])->name('employer.edit-profile');
    Route::post('/employer/edit-profile', [ProfileController::class, 'update'])->name('employer.update-profile');
    // Change Password
    Route::get('/employer/change-password', [ProfileController::class, 'changePasswordForm'])->name('employer.change-password');
    Route::post('/employer/change-password', [ProfileController::class, 'updatePassword'])->name('employer.update-password');
    // Logout
    Route::post('/employer/logout', [AuthEmployerController::class, 'logout'])->name('employer.logout');

    Route::delete('/employer/delete-account', [ProfileController::class, 'destroy'])->name('employer.delete-account');


});

