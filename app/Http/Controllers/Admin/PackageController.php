<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Models\Country;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::withCount('departures')->with('service')->latest()->paginate(15);

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $package = new Package(['is_published' => false, 'currency' => 'BDT']);
        $services = Service::orderBy('sort_order')->get();
        $countries = Country::orderBy('id')->get();

        return view('admin.packages.form', compact('package', 'services', 'countries'));
    }

    public function store(StorePackageRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title_en'] ?? $data['title_bn'] ?? Str::random(8));
        }

        $package = Package::create($this->mapPackageData($data));

        if (! empty($data['countries'])) {
            $package->countries()->sync($data['countries']);
        }

        return redirect()->route('admin.packages.edit', $package)->with('success', __('Package created.'));
    }

    public function edit(Package $package)
    {
        $package->load(['departures', 'countries']);
        $services = Service::orderBy('sort_order')->get();
        $countries = Country::orderBy('id')->get();

        return view('admin.packages.form', compact('package', 'services', 'countries'));
    }

    public function update(StorePackageRequest $request, Package $package)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title_en'] ?? $data['title_bn'] ?? $package->slug);
        }

        $package->update($this->mapPackageData($data));

        if (array_key_exists('countries', $data)) {
            $package->countries()->sync($data['countries'] ?? []);
        }

        return back()->with('success', __('Package updated.'));
    }

    public function togglePublish(Package $package)
    {
        $package->update(['is_published' => ! $package->is_published]);

        return back()->with('success', $package->is_published ? __('Package published.') : __('Package unpublished.'));
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', __('Package deleted.'));
    }

    protected function mapPackageData(array $data): array
    {
        return [
            'service_id' => $data['service_id'] ?? null,
            'slug' => $data['slug'] ?? null,
            'type' => $data['type'] ?? 'general',
            'title' => ['bn' => $data['title_bn'] ?? null, 'en' => $data['title_en'] ?? null],
            'summary' => ['bn' => $data['summary_bn'] ?? null, 'en' => $data['summary_en'] ?? null],
            'description' => ['bn' => $data['description_bn'] ?? null, 'en' => $data['description_en'] ?? null],
            'duration_days' => $data['duration_days'] ?? null,
            'base_price' => $data['base_price'] ?? 0,
            'currency' => $data['currency'] ?? 'BDT',
            'is_published' => (bool) ($data['is_published'] ?? false),
            'is_featured' => (bool) ($data['is_featured'] ?? false),
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }
}
