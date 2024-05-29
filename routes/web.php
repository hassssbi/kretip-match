<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/landing-page', function () {
    return view('landingPage');
});

Route::get('/about-us', function () {
    return view('aboutUs');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');

// Volunteer
Route::get('/home', [VolunteerController::class, 'index'])->name('volunteers.index');
Route::get('/profile', [VolunteerController::class, 'profile'])->name('volunteers.profile');
Route::get('/events', [VolunteerController::class, 'eventsList'])->name('volunteers.events');
Route::get('/status', [VolunteerController::class, 'statusList'])->name('volunteers.status');
Route::get('/assigned-events', [VolunteerController::class, 'assignedEvents'])->name('volunteers.assignedEvents');

// Moderator
Route::get('/home', [ModeratorController::class, 'index'])->name('moderators.index');
Route::get('/profile', [ModeratorController::class, 'profile'])->name('moderators.profile');
Route::get('/events', [ModeratorController::class, 'eventsList'])->name('moderators.events');
Route::get('/completed-events', [ModeratorController::class, 'completedEventsList'])->name('moderators.completedEvents');

// Admin
Route::get('/home', [AdminController::class, 'index'])->name('admins.index');
Route::get('/profile', [AdminController::class, 'profile'])->name('admins.profile');
Route::get('/users', [AdminController::class, 'users'])->name('admins.users');
