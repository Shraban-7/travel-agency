<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Package::query()
            ->where('is_published', true)
            ->with(['departures' => function ($q) {
                $q->where('status', 'open')
                    ->whereDate('departure_date', '>=', now()->toDateString())
                    ->orderBy('departure_date');
            }]);

        if ($request->filled('type')) {
            $query->where('type', $request->string('type')->toString());
        }

        if ($request->filled('q')) {
            $term = '%'.$request->string('q')->toString().'%';
            $query->where(function ($w) use ($term) {
                $w->where('title->bn', 'like', $term)
                    ->orWhere('title->en', 'like', $term)
                    ->orWhere('slug', 'like', $term);
            });
        }

        match ($request->string('sort')->toString()) {
            'price_asc' => $query->orderBy('base_price'),
            'price_desc' => $query->orderByDesc('base_price'),
            default => $query->orderByDesc('is_featured')->orderBy('sort_order'),
        };

        $packages = $query->paginate(9)->withQueryString();

        $types = [
            'hajj' => 'হজ্জ প্যাকেজ',
            'umrah' => 'উমরাহ প্যাকেজ',
            'tour' => 'ইন্টারন্যাশনাল ট্যুর',
            'other' => 'অন্যান্য',
        ];

        return view('public.packages.index', compact('packages', 'types'));
    }

    public function show(string $slug): View
    {
        $package = Package::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'service',
                'countries',
                'media',
                'departures' => function ($q) {
                    $q->whereDate('departure_date', '>=', now()->toDateString())
                        ->orderBy('departure_date');
                },
            ])
            ->firstOrFail();

        $related = Package::query()
            ->where('is_published', true)
            ->where('type', $package->type)
            ->where('id', '!=', $package->id)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('public.packages.show', compact('package', 'related'));
    }
}
