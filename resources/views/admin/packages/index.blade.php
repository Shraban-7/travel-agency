@extends('layouts.admin')

@section('title', __('Packages'))

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Travel Packages</h2>
    <p class="text-sm text-slate-500">Manage packages with departures, pricing &amp; publishing.</p>
  </div>
  @can('packages.manage')
  <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-sm font-semibold text-white shadow-soft hover:bg-primary-800 transition">
    <i data-lucide="plus" class="h-4 w-4"></i> New Package
  </a>
  @endcan
</div>

@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
      <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
        <tr>
          <th class="pb-3 px-3">Package</th>
          <th class="pb-3 px-3">Service</th>
          <th class="pb-3 px-3">Price</th>
          <th class="pb-3 px-3">Departures</th>
          <th class="pb-3 px-3">Status</th>
          <th class="pb-3 px-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($packages as $package)
          <tr class="hover:bg-slate-50/70">
            <td class="py-3 px-3">
              <p class="font-bold text-ink">{{ t($package->title) }}</p>
              <p class="text-xs text-slate-500 font-mono">/{{ $package->slug }}</p>
            </td>
            <td class="py-3 px-3 text-xs text-slate-600">{{ $package->service ? t($package->service->title) : ($package->type ?? '—') }}</td>
            <td class="py-3 px-3 text-xs font-bold text-ink">৳ {{ number_format((float) $package->base_price) }}</td>
            <td class="py-3 px-3 text-xs text-slate-600">{{ $package->departures_count }} {{ Str::plural('batch', $package->departures_count) }}</td>
            <td class="py-3 px-3">
              @if ($package->is_published)
                <span class="rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-bold text-success border border-green-200">Published</span>
              @else
                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-bold text-slate-600">Draft</span>
              @endif
            </td>
            <td class="py-3 px-3 text-right">
              <div class="inline-flex items-center gap-2">
                @can('packages.manage')
                <a href="{{ route('admin.packages.edit', $package) }}" class="rounded-lg bg-primary-50 px-3 py-1 text-xs font-bold text-primary-800 hover:bg-primary-700 hover:text-white transition">Edit</a>
                <form method="POST" action="{{ route('admin.packages.publish', $package) }}" class="inline">
                  @csrf
                  @method('PATCH')
                  <button class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700 hover:bg-slate-200 transition">{{ $package->is_published ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <form method="POST" action="{{ route('admin.packages.destroy', $package) }}" class="inline" onsubmit="return confirm('Delete this package?')">
                  @csrf
                  @method('DELETE')
                  <button class="rounded-lg bg-red-50 px-3 py-1 text-xs font-bold text-red-700 hover:bg-red-600 hover:text-white transition">Delete</button>
                </form>
                @endcan
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="py-8 text-center text-sm text-slate-500">No packages yet. @can('packages.manage')<a href="{{ route('admin.packages.create') }}" class="font-bold text-primary-700 hover:underline">Create one</a>.@endcan</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $packages->links() }}</div>
</div>
@endsection
