<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Livewire\UserDashboard;
use App\Livewire\AdminDashboard;
use App\Livewire\ModeratorDashboard;

use App\Http\Controllers\SepaController;

Route::get('/download-sepa', [SepaController::class, 'downloadExistingSepa'])->name('sepa.download');



Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);
Route::view('/',"welcome")->name('welcome');

Route::view('/register',"auth/register")->name('register');

Route::view('/login',"auth/login")->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::view('/dashboard', "admin/admin-dashboard")->name('admin.dashboard');
    Route::view('/dashboard', "moderator/moderator-dashboard")->name('moderator.dashboard');
    Route::view('/dashboard', "user/user-dashboard")->name('user.dashboard');
    Route::view('/rentlocker',"user/rent-locker")->name('rent-locker');
    Route::view('/sepa-steps',"user/sepa-steps")->name('sepa.steps');


});