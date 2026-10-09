@extends('layouts.admin')

@section('title', $package->exists ? __('Edit Package') : __('Create Package'))

@section('content')
<nav class="flex items-center gap-2 text-xs text-slate-500 mb-1">
  <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
  <i data-lucide="chevron-right" class="h-3 w-3"></i>
  <a href="{{ route('admin.packages.index') }}" class="hover:underline">Packages</a>
  <i data-lucide="chevron-right" class="h-3 w-3"></i>
  <span class="text-slate-800">{{ $package->exists ? 'Edit' : 'Create' }}</span>
</nav>

<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Package Editor</h2>
    <p class="text-sm text-slate-500">Create or modify packages with translatable fields, departures &amp; pricing.</p>
  </div>
</div>

@if ($errors->any())
  <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
    <ul class="list-disc pl-4">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif
@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ $package->exists ? route('admin.packages.update', $package) : route('admin.packages.store') }}" enctype="multipart/form-data" class="grid lg:grid-cols-12 gap-8 items-start">
  @csrf
  @if ($package->exists) @method('PUT') @endif

  <div class="lg:col-span-8 space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink pb-4 border-b border-slate-100">Translatable Information (বাংলা / English)</h3>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">প্যাকেজের নাম (Bangla Title) *</label>
        <input type="text" name="title_bn" value="{{ old('title_bn', is_array($package->title) ? ($package->title['bn'] ?? '') : '') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Package Title (English)</label>
        <input type="text" name="title_en" value="{{ old('title_en', is_array($package->title) ? ($package->title['en'] ?? '') : '') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">
      </div>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">সংক্ষিপ্ত বিবরণ (BN)</label>
          <textarea name="summary_bn" rows="2" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">{{ old('summary_bn', is_array($package->summary) ? ($package->summary['bn'] ?? '') : '') }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Short Summary (EN)</label>
          <textarea name="summary_en" rows="2" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">{{ old('summary_en', is_array($package->summary) ? ($package->summary['en'] ?? '') : '') }}</textarea>
        </div>
      </div>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">বিস্তারিত বিবরণ (BN)</label>
          <textarea name="description_bn" rows="5" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">{{ old('description_bn', is_array($package->description) ? ($package->description['bn'] ?? '') : '') }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Detailed Overview (EN)</label>
          <textarea name="description_en" rows="5" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:bg-white">{{ old('description_en', is_array($package->description) ? ($package->description['en'] ?? '') : '') }}</textarea>
        </div>
      </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink pb-4 border-b border-slate-100">Media Library (cover &amp; gallery)</h3>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Cover (single — replaces existing)</label>
          <input type="file" name="cover" accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-slate-600">
          @if ($package->exists && $package->getFirstMediaUrl('cover'))
            <img src="{{ $package->getFirstMediaUrl('cover', 'thumb') }}" alt="Cover" class="mt-2 h-20 w-auto rounded-lg border border-slate-200 object-cover">
          @endif
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Gallery (multiple — appended)</label>
          <input type="file" name="gallery[]" multiple accept="image/jpeg,image/png,image/webp" class="w-full text-xs text-slate-600">
        </div>
      </div>
      @if ($package->exists && $package->getMedia('gallery')->isNotEmpty())
        <div>
          <p class="text-xs font-semibold text-slate-700 mb-2">Gallery ({{ $package->getMedia('gallery')->count() }})</p>
          <div class="flex flex-wrap gap-3">
            @foreach ($package->getMedia('gallery') as $image)
              <div class="relative">
                <img src="{{ $image->getUrl('thumb') }}" alt="Gallery image" class="h-20 w-28 rounded-lg border border-slate-200 object-cover">
                <form method="POST" action="{{ route('admin.packages.media.destroy', [$package, $image]) }}" onsubmit="return confirm('Delete this image?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="absolute -right-2 -top-2 grid h-6 w-6 place-items-center rounded-full bg-red-600 text-white hover:bg-red-700" aria-label="Delete image"><i data-lucide="x" class="h-3 w-3"></i></button>
                </form>
              </div>
            @endforeach
          </div>
        </div>
      @endif
      <p class="text-[11px] text-slate-400">JPG, PNG or WebP up to 5MB each. Existing <span class="font-mono">cover_image</span> data is left untouched.</p>
    </div>

    @if ($package->exists && $package->departures->isNotEmpty())
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
        <h3 class="text-base font-bold text-ink pb-4 border-b border-slate-100 mb-4">Departures &amp; Batches ({{ $package->departures->count() }})</h3>
        <table class="w-full text-left text-xs">
          <thead class="text-slate-400 font-semibold border-b border-slate-200 uppercase">
            <tr><th class="pb-2">Departure Date</th><th class="pb-2">Total Seats</th><th class="pb-2">Booked</th><th class="pb-2">Booking Deadline</th><th class="pb-2">Status</th></tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach ($package->departures as $dep)
              <tr>
                <td class="py-3 font-semibold text-ink">{{ $dep->departure_date?->format('d M Y') }}</td>
                <td class="py-3">{{ $dep->seats_total }}</td>
                <td class="py-3 font-bold text-primary-800">{{ $dep->seats_booked }}</td>
                <td class="py-3">{{ $dep->booking_deadline?->format('d M Y') ?? '—' }}</td>
                <td class="py-3">{{ ucfirst($dep->status) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <div class="lg:col-span-4 space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink pb-3 border-b border-slate-100">Publishing Settings</h3>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Service</label>
        <select name="service_id" class="w-full rounded-xl border-slate-200 bg-slate-50 text-xs">
          <option value="">— None —</option>
          @foreach ($services as $svc)
            <option value="{{ $svc->id }}" @selected((string) old('service_id', $package->service_id) === (string) $svc->id)>{{ t($svc->title) }} ({{ $svc->slug }})</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Type</label>
        <input type="text" name="type" value="{{ old('type', $package->type ?? 'general') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-xs">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">URL Slug (auto from EN title if empty)</label>
        <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-mono text-slate-500">
          <span>/packages/</span>
          <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" class="border-0 bg-transparent p-0 text-xs font-mono text-ink focus:ring-0 w-full">
        </div>
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Base Price (BDT ৳) *</label>
          <input type="number" name="base_price" min="0" step="0.01" value="{{ old('base_price', $package->base_price ?? 0) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm font-bold text-primary-900">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Duration (days)</label>
          <input type="number" name="duration_days" min="1" max="365" value="{{ old('duration_days', $package->duration_days) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm">
        </div>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Countries</label>
        <select name="countries[]" multiple class="w-full rounded-xl border-slate-200 bg-slate-50 text-xs h-28">
          @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(in_array($country->id, old('countries', $package->exists ? $package->countries->pluck('id')->all() : [])))>{{ t($country->name) }}</option>
          @endforeach
        </select>
      </div>
      <label class="flex items-center gap-2 text-xs cursor-pointer">
        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $package->is_published)) class="rounded border-slate-300 text-primary-600">
        <span class="font-semibold">Published (active on site)</span>
      </label>
      <label class="flex items-center gap-2 text-xs cursor-pointer">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $package->is_featured)) class="rounded border-slate-300 text-primary-600">
        <span class="font-semibold">Featured</span>
      </label>
      <button type="submit" class="w-full rounded-xl bg-primary-700 px-5 py-2.5 text-xs font-bold text-white hover:bg-primary-800 shadow-soft">
        {{ $package->exists ? 'Update Package' : 'Save & Publish' }}
      </button>
    </div>
  </div>
</form>
@endsection
