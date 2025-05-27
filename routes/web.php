<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthEmployerController;
use App\Http\Controllers\AuthJobSeekerController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/employer/register',[AuthEmployerController::class, 'showRegister'])->name('show.registeremployer');
Route::get('/employer/login',[AuthEmployerController::class, 'showLogin'])->name('show.loginemployer');
Route::post('/employer/register',[AuthEmployerController::class, 'register'])->name('registeremployer');
Route::post('/employer/login',[AuthEmployerController::class, 'login'])->name('loginemployer');

Route::get('/jobseeker/register',[AuthJobSeekerController::class, 'showRegister'])->name('show.registerjobseeker');
Route::get('/jobseeker/login',[AuthJobSeekerController::class, 'showLogin'])->name('show.loginjobseeker');
Route::post('/jobseeker/register',[AuthJobSeekerController::class, 'register'])->name('registerjobseeker');
Route::post('/jobseeker/login',[AuthJobSeekerController::class, 'login'])->name('loginjobseeker');

Route::get('/admin/register',[AuthAdminController::class, 'showRegister'])->name('show.registeradmin');
Route::get('/admin/login',[AuthAdminrController::class, 'showLogin'])->name('show.loginadmin');
Route::post('/admin/register',[AuthAdminController::class, 'register'])->name('registeradmin');
Route::post('/admin/login',[AuthAdminController::class, 'login'])->name('loginadmin');