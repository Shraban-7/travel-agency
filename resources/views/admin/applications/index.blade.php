@extends('layouts.admin')

@section('title', __('Applications & Client Files'))

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Applications &amp; Client Files</h2>
    <p class="text-sm text-slate-500">Manage all formal processing cases with tracking numbers, private docs &amp; status pipelines.</p>
  </div>
</div>

@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft" data-table>
  <form method="GET" action="{{ route('admin.applications.index') }}" class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
    <div class="flex flex-wrap items-center gap-3">
      <div class="relative w-80">
        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tracking code, client, passport..." class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-4 text-sm focus:border-primary-500 focus:bg-white">
      </div>
      <select name="status" class="h-10 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
        <option value="">All Statuses</option>
        @foreach (['submitted', 'under_review', 'embassy', 'approved', 'completed', 'cancelled', 'rejected'] as $s)
          <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
        @endforeach
      </select>
      <input type="text" name="service_type" value="{{ request('service_type') }}" placeholder="Service type..." class="h-10 rounded-xl border border-slate-200 bg-slate-50 text-sm px-3">
      <button type="submit" class="h-10 rounded-xl bg-primary-700 px-4 text-sm font-semibold text-white hover:bg-primary-800">Filter</button>
      @if (request()->hasAny(['search', 'status', 'service_type']))
        <a href="{{ route('admin.applications.index') }}" class="text-xs font-semibold text-slate-500 hover:underline">Clear</a>
      @endif
    </div>
    <div class="text-xs text-slate-500">
      Showing <span class="font-bold text-slate-800">{{ $applications->count() }}</span> of {{ $applications->total() }} applications
    </div>
  </form>

  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm mt-2">
      <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
        <tr>
          <th class="py-3 px-3">Tracking Code</th>
          <th class="py-3 px-3">Applicant / Client</th>
          <th class="py-3 px-3">Service &amp; Destination</th>
          <th class="py-3 px-3">Current Status</th>
          <th class="py-3 px-3">Payments</th>
          <th class="py-3 px-3">Updated</th>
          <th class="py-3 px-3 text-right">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($applications as $app)
          <tr class="hover:bg-slate-50/70">
            <td class="py-3 px-3 font-mono font-bold text-primary-800">
              <a href="{{ route('admin.applications.show', $app) }}" class="hover:underline">{{ $app->tracking_code }}</a>
            </td>
            <td class="py-3 px-3">
              <p class="font-bold text-ink">{{ $app->client->full_name ?? '—' }}</p>
              <p class="text-xs text-slate-500 font-mono">{{ maskString($app->client->passport_no ?? $app->client->phone ?? '') }}</p>
            </td>
            <td class="py-3 px-3">
              <p class="text-xs font-semibold text-slate-800">{{ $app->service_type ?? '—' }}</p>
            </td>
            <td class="py-3 px-3">
              <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ $app->status_label ?? ucfirst(str_replace('_', ' ', $app->status)) }}</span>
            </td>
            <td class="py-3 px-3 text-xs">
              <span class="font-bold text-success">৳ {{ number_format((float) $app->paid_amount) }}</span> / {{ number_format((float) $app->total_fee) }}
            </td>
            <td class="py-3 px-3 text-xs text-slate-500">{{ $app->updated_at?->diffForHumans() }}</td>
            <td class="py-3 px-3 text-right">
              <a href="{{ route('admin.applications.show', $app) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-3 py-1.5 text-xs font-bold text-primary-800 hover:bg-primary-700 hover:text-white transition">
                View File <i data-lucide="arrow-right" class="h-3 w-3"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="py-8 text-center text-sm text-slate-500">No applications found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $applications->links() }}</div>
</div>
@endsection
