<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\AdminController;

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

// Volunteer Routes
Route::prefix('volunteer')->name('volunteers.')->group(function () {
    Route::get('/home', [VolunteerController::class, 'index'])->name('index');
    Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('editProfile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('/profile/{user}/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::put('/profile/{user}/change-password', [ProfileController::class, 'savePassword'])->name('savePassword');
    Route::get('/events', [VolunteerController::class, 'eventsList'])->name('events');
    Route::get('/status', [VolunteerController::class, 'statusList'])->name('status');
    Route::get('/assigned-events', [VolunteerController::class, 'assignedEvents'])->name('assignedEvents');
});

// Moderator Routes
Route::prefix('moderator')->name('moderators.')->group(function () {
    Route::get('/home', [ModeratorController::class, 'index'])->name('index');
    Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('editProfile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('/profile/{user}/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::put('/profile/{user}/change-password', [ProfileController::class, 'savePassword'])->name('savePassword');
    Route::get('/events', [ModeratorController::class, 'eventsList'])->name('events');
    Route::get('/completed-events', [ModeratorController::class, 'completedEventsList'])->name('completedEvents');
});

// Admin Routes
Route::prefix('admin')->name('admins.')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('index');
    Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('editProfile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('/profile/{user}/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::put('/profile/{user}/change-password', [ProfileController::class, 'savePassword'])->name('savePassword');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'userProfile'])->name('userProfile');
    Route::put('/user/{user}/update-role', [AdminController::class, 'updateUserRole'])->name('updateUserRole');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('userDestroy');
    Route::get('/admin/registrations', [AdminController::class, 'registrations'])->name('registrations');
    Route::get('/admin/registrations/{year}', [AdminController::class, 'registrationsByYear'])->name('registrationsByYear');

});
