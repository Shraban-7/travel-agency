<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobDemand;
use App\Models\Lead;
use App\Models\Package;
use App\Models\PackageDeparture;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'published_packages' => Package::where('is_published', true)->count(),
            'open_jobs' => JobDemand::where('status', 'open')->count(),
            'new_leads' => Lead::where('status', 'new')->count(),
            'active_applications' => Application::whereNotIn('status', ['completed', 'cancelled', 'rejected'])->count(),
            'due_amount' => (float) Application::whereNotIn('status', ['completed', 'cancelled'])->sum('due_amount'),
            'upcoming_deadlines' => PackageDeparture::where('status', 'open')
                ->whereDate('booking_deadline', '>=', now()->toDateString())
                ->whereDate('booking_deadline', '<=', now()->addDays(14)->toDateString())
                ->count(),
        ];

        $recentLeads = Lead::with('assignee')->latest()->take(5)->get();
        $recentApplications = Application::with('client')->latest('updated_at')->take(5)->get();
        $followUps = Lead::whereDate('follow_up_at', now()->toDateString())
            ->whereNotIn('status', ['converted', 'lost'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentLeads', 'recentApplications', 'followUps'));
    }
}
