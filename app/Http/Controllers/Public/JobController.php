<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\JobCategory;
use App\Models\JobDemand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        $query = JobDemand::query()
            ->where('is_published', true)
            ->with(['country', 'category']);

        $status = $request->string('status', 'open')->toString();
        if (in_array($status, ['open', 'closed'], true)) {
            $query->where('status', $status);
        }

        if ($request->filled('country')) {
            $query->where('country_id', $request->integer('country'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        match ($request->string('sort', 'deadline')->toString()) {
            'recent' => $query->latest(),
            'salary' => $query->orderByDesc('salary_max')->orderByDesc('salary_min'),
            default => $query->orderByRaw('application_deadline IS NULL, application_deadline ASC')->latest(),
        };

        $jobs = $query->paginate(9)->withQueryString();
        $countries = Country::where('is_active', true)->orderBy('sort_order')->get();
        $categories = JobCategory::orderBy('id')->get();

        return view('public.jobs.index', compact('jobs', 'countries', 'categories', 'status'));
    }

    public function show(string $slug): View
    {
        $job = JobDemand::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with(['country', 'category'])
            ->firstOrFail();

        $related = JobDemand::query()
            ->where('is_published', true)
            ->where('status', 'open')
            ->where('id', '!=', $job->id)
            ->when($job->country_id, fn ($q) => $q->where('country_id', $job->country_id))
            ->latest()
            ->take(3)
            ->get();

        return view('public.jobs.show', compact('job', 'related'));
    }
}
