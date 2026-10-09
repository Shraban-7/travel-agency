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
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.attempt')->middleware('throttle:5,1');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
        Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
        Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.status');
        Route::post('leads/{lead}/notes', [LeadController::class, 'storeNote'])->name('leads.note');

        Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'changeStatus'])->name('applications.status');
        Route::post('applications/{application}/payments', [ApplicationController::class, 'storePayment'])->name('applications.payment');

        Route::get('packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::post('packages', [PackageController::class, 'store'])->name('packages.store');
        Route::get('packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::put('packages/{package}', [PackageController::class, 'update'])->name('packages.update');
        Route::patch('packages/{package}/publish', [PackageController::class, 'togglePublish'])->name('packages.publish');
        Route::delete('packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
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
