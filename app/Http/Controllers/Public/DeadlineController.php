<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JobDemand;
use App\Models\Notice;
use App\Models\PackageDeparture;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeadlineController extends Controller
{
    public function index(Request $request): View
    {
        $kind = $request->string('kind', 'all')->toString();
        $deadlines = collect();

        if (in_array($kind, ['all', 'notice'], true)) {
            $notices = Notice::query()
                ->where('is_active', true)
                ->whereNotNull('deadline_at')
                ->where('deadline_at', '>=', now())
                ->orderBy('deadline_at')
                ->take(20)
                ->get()
                ->map(fn ($n) => [
                    'kind' => 'notice',
                    'icon' => 'megaphone',
                    'badge' => $n->type ?: 'নোটিশ',
                    'title' => t($n->title),
                    'subtitle' => t($n->body) ? mb_substr(strip_tags(t($n->body)), 0, 120) : '',
                    'deadline_at' => $n->deadline_at,
                    'url' => null,
                ]);
            $deadlines = $deadlines->merge($notices);
        }

        if (in_array($kind, ['all', 'job'], true)) {
            $jobs = JobDemand::query()
                ->where('is_published', true)
                ->where('status', 'open')
                ->whereNotNull('application_deadline')
                ->whereDate('application_deadline', '>=', now()->toDateString())
                ->with('country')
                ->orderBy('application_deadline')
                ->take(20)
                ->get()
                ->map(fn ($j) => [
                    'kind' => 'job',
                    'icon' => 'briefcase',
                    'badge' => 'বিদেশে চাকরি',
                    'title' => t($j->title).($j->country ? ' — '.t($j->country->name) : ''),
                    'subtitle' => $j->positions.'টি পদ · আবেদন চলছে',
                    'deadline_at' => $j->application_deadline,
                    'url' => route('jobs.show', $j->slug),
                ]);
            $deadlines = $deadlines->merge($jobs);
        }

        if (in_array($kind, ['all', 'departure'], true)) {
            $departures = PackageDeparture::query()
                ->where('status', 'open')
                ->whereNotNull('booking_deadline')
                ->whereDate('booking_deadline', '>=', now()->toDateString())
                ->with('package')
                ->orderBy('booking_deadline')
                ->take(20)
                ->get()
                ->filter(fn ($d) => $d->package && $d->package->is_published)
                ->map(fn ($d) => [
                    'kind' => 'departure',
                    'icon' => 'plane',
                    'badge' => 'প্যাকেজ বুকিং',
                    'title' => t($d->package->title),
                    'subtitle' => 'যাত্রা: '.$d->departure_date->format('d M Y'),
                    'deadline_at' => $d->booking_deadline,
                    'url' => route('packages.show', $d->package->slug),
                ]);
            $deadlines = $deadlines->merge($departures);
        }

        $deadlines = $deadlines->sortBy('deadline_at')->values();

        return view('public.deadlines', compact('deadlines', 'kind'));
    }
}
