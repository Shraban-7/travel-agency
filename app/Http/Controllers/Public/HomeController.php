<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Faq;
use App\Models\JobDemand;
use App\Models\Notice;
use App\Models\Package;
use App\Models\Service;
use App\Models\StudyIntake;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredPackages = Package::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->with(['departures' => function ($q) {
                $q->where('status', 'open')
                    ->whereDate('departure_date', '>=', now()->toDateString())
                    ->orderBy('departure_date');
            }])
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $jobDemands = JobDemand::query()
            ->where('is_published', true)
            ->where('status', 'open')
            ->with(['country', 'category'])
            ->latest()
            ->take(6)
            ->get();

        $countries = Country::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        $notices = Notice::query()
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('deadline_at')->orWhere('deadline_at', '>=', now());
            })
            ->orderBy('deadline_at')
            ->take(3)
            ->get();

        $faqs = Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $intakes = StudyIntake::query()
            ->with('program.university.country')
            ->whereDate('application_deadline', '>=', now()->toDateString())
            ->orderBy('application_deadline')
            ->take(3)
            ->get();

        $deadlines = Notice::query()
            ->where('is_active', true)
            ->whereNotNull('deadline_at')
            ->where('deadline_at', '>=', now())
            ->orderBy('deadline_at')
            ->take(4)
            ->get();

        $stats = [
            'experience_years' => 17,
            'people_served' => 25000,
            'countries' => Country::where('is_active', true)->count(),
            'packages' => Package::where('is_published', true)->count(),
        ];

        return view('public.home', compact(
            'featuredPackages', 'jobDemands', 'countries', 'services',
            'testimonials', 'notices', 'faqs', 'intakes', 'deadlines', 'stats'
        ));
    }
}
