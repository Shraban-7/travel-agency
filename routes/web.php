<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Public\DeadlineController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\InquiryController;
use App\Http\Controllers\Public\JobController;
use App\Http\Controllers\Public\PackageController as PublicPackageController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\StudyController;
use App\Http\Controllers\Public\TrackController;
use Illuminate\Support\Facades\Route;Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.attempt')->middleware('throttle:5,1');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('leads', [LeadController::class, 'index'])->name('leads.index')->middleware('permission:leads.view');
        Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show')->middleware('permission:leads.view');
        Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status')->middleware('permission:leads.manage');
        Route::post('leads/{lead}/notes', [LeadController::class, 'storeNote'])->name('leads.note')->middleware('permission:leads.manage');

        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index')->middleware('permission:applications.view');
        Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show')->middleware('permission:applications.view');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'changeStatus'])->name('applications.status')->middleware('permission:applications.manage');
        Route::post('applications/{application}/payments', [ApplicationController::class, 'storePayment'])->name('applications.payment')->middleware('permission:applications.manage');

        Route::get('packages', [PackageController::class, 'index'])->name('packages.index')->middleware('permission:packages.view');
        Route::get('packages/create', [PackageController::class, 'create'])->name('packages.create')->middleware('permission:packages.view');
        Route::post('packages', [PackageController::class, 'store'])->name('packages.store')->middleware('permission:packages.manage');
        Route::get('packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit')->middleware('permission:packages.view');
        Route::put('packages/{package}', [PackageController::class, 'update'])->name('packages.update')->middleware('permission:packages.manage');
        Route::patch('packages/{package}/publish', [PackageController::class, 'togglePublish'])->name('packages.publish')->middleware('permission:packages.manage');
        Route::delete('packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy')->middleware('permission:packages.manage');
        Route::delete('packages/{package}/media/{media}', [PackageController::class, 'destroyMedia'])->name('packages.media.destroy')->middleware('permission:packages.manage');

        Route::middleware('permission:users.manage')->group(function () {
            Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
            Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
            Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
            Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
            Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
            Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::get('activity', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity.index');
    });
});

// Public site
Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/packages', [PublicPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PublicPackageController::class, 'show'])->name('packages.show');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/study', [StudyController::class, 'index'])->name('study.index');
Route::get('/study/{university}', [StudyController::class, 'show'])->name('study.show');

Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/track', [TrackController::class, 'form'])->name('track');
Route::get('/track/result', [TrackController::class, 'result'])->middleware('throttle:10,1')->name('track.result');

Route::post('/inquiry', [InquiryController::class, 'store'])->middleware('throttle:10,1')->name('inquiry.store');

// Customer self-service portal
Route::prefix('account')->name('account.')->group(function () {
    Route::middleware('guest:client')->group(function () {
        Route::get('register', [\App\Http\Controllers\Account\AuthController::class, 'showRegister'])->name('register');
        Route::post('register', [\App\Http\Controllers\Account\AuthController::class, 'register']);
        Route::get('login', [\App\Http\Controllers\Account\AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [\App\Http\Controllers\Account\AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    Route::middleware('client')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Account\DashboardController::class, 'index'])->name('dashboard');
        Route::get('applications/{application}', [\App\Http\Controllers\Account\ApplicationController::class, 'show'])->name('applications.show');
        Route::post('logout', [\App\Http\Controllers\Account\AuthController::class, 'logout'])->name('logout');
    });
});
