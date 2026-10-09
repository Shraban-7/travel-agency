@extends('layouts.admin')

@section('title', __('Operations Dashboard'))

@section('content')
@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif

<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Welcome back, {{ auth()->user()->name ?? 'Officer' }}</h2>
    <p class="text-sm text-slate-500">Here is what is happening across visas, Hajj registrations &amp; manpower pipelines today.</p>
  </div>
  <div class="flex items-center gap-3">
    <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
      <i data-lucide="inbox" class="h-4 w-4"></i> View Inquiries ({{ $stats['new_leads'] }})
    </a>
    <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-sm font-semibold text-white shadow-soft hover:bg-primary-800 transition">
      <i data-lucide="plus" class="h-4 w-4"></i> New Package
    </a>
  </div>
</div>

<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
  <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">New Leads</span>
      <span class="grid h-10 w-10 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="inbox" class="h-5 w-5"></i></span>
    </div>
    <p class="mt-3 text-3xl font-bold text-ink">{{ $stats['new_leads'] }}</p>
    <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
      <a href="{{ route('admin.leads.index', ['status' => 'new']) }}" class="hover:underline">View new inquiries →</a>
    </div>
  </div>

  <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Active Applications</span>
      <span class="grid h-10 w-10 place-items-center rounded-xl bg-accent-50 text-accent-700"><i data-lucide="folder-kanban" class="h-5 w-5"></i></span>
    </div>
    <p class="mt-3 text-3xl font-bold text-ink">{{ $stats['active_applications'] }}</p>
    <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
      <span>{{ $stats['published_packages'] }} published packages · {{ $stats['open_jobs'] }} open jobs</span>
    </div>
  </div>

  <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Upcoming Deadlines</span>
      <span class="grid h-10 w-10 place-items-center rounded-xl bg-red-50 text-danger"><i data-lucide="bell-ring" class="h-5 w-5"></i></span>
    </div>
    <p class="mt-3 text-3xl font-bold {{ $stats['upcoming_deadlines'] > 0 ? 'text-danger' : 'text-ink' }}">{{ $stats['upcoming_deadlines'] }}</p>
    <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
      <span>Booking deadlines in next 14 days</span>
    </div>
  </div>

  <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
    <div class="flex items-center justify-between">
      <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Due</span>
      <span class="grid h-10 w-10 place-items-center rounded-xl bg-green-50 text-success"><i data-lucide="wallet" class="h-5 w-5"></i></span>
    </div>
    <p class="mt-3 text-3xl font-bold text-ink">৳ {{ number_format($stats['due_amount']) }}</p>
    <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-500">
      <span>Outstanding across active files</span>
    </div>
  </div>
</div>

<div class="grid gap-8 lg:grid-cols-12 items-start">
  <div class="lg:col-span-7 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft" data-table>
    <div class="flex items-center justify-between mb-4">
      <div>
        <h3 class="text-base font-bold text-ink">Recent Inquiries &amp; Leads</h3>
        <p class="text-xs text-slate-500">Real-time incoming web inquiries requiring agent assignment</p>
      </div>
      <a href="{{ route('admin.leads.index') }}" class="text-xs font-semibold text-primary-700 hover:underline">View All Leads →</a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm">
        <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
          <tr>
            <th class="pb-3">Client</th>
            <th class="pb-3">Service</th>
            <th class="pb-3">Status</th>
            <th class="pb-3 text-right">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($recentLeads as $lead)
            <tr>
              <td class="py-3.5">
                <p class="font-semibold text-ink">{{ $lead->name }}</p>
                <p class="text-xs text-slate-500">{{ maskString($lead->phone ?? '') }}</p>
              </td>
              <td class="py-3.5"><span class="text-xs font-medium text-slate-700">{{ $lead->service_type ?? '—' }}</span></td>
              <td class="py-3.5"><span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ ucfirst($lead->status) }}</span></td>
              <td class="py-3.5 text-right">
                <a href="{{ route('admin.leads.show', $lead) }}" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-semibold hover:bg-primary-50 hover:text-primary-800">Details</a>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="py-6 text-center text-xs text-slate-500">No recent leads.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="lg:col-span-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h3 class="text-base font-bold text-ink">Active Application Pipeline</h3>
        <p class="text-xs text-slate-500">Recent tracking file status updates</p>
      </div>
      <a href="{{ route('admin.applications.index') }}" class="text-xs font-semibold text-primary-700 hover:underline">All Applications →</a>
    </div>

    <div class="space-y-3.5">
      @forelse ($recentApplications as $app)
        <a href="{{ route('admin.applications.show', $app) }}" class="block p-3.5 rounded-xl border border-slate-100 hover:border-primary-300 hover:bg-slate-50 transition">
          <div class="flex items-center justify-between mb-1">
            <span class="font-mono text-xs font-bold text-primary-800 bg-primary-50 px-2 py-0.5 rounded">{{ $app->tracking_code }}</span>
            <span class="text-xs font-bold text-accent-700">{{ $app->status_label ?? ucfirst(str_replace('_', ' ', $app->status)) }}</span>
          </div>
          <p class="font-bold text-sm text-ink">{{ $app->client->full_name ?? '—' }}</p>
          <p class="text-xs text-slate-500">{{ $app->service_type ?? '' }} · Updated {{ $app->updated_at?->diffForHumans() }}</p>
        </a>
      @empty
        <p class="text-xs text-slate-500">No applications yet.</p>
      @endforelse
    </div>

    @if ($followUps->isNotEmpty())
      <div class="mt-6 border-t border-slate-100 pt-4">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Follow-ups due today ({{ $followUps->count() }})</h4>
        <ul class="space-y-2 text-xs">
          @foreach ($followUps as $fu)
            <li class="flex items-center justify-between rounded-lg bg-slate-50 px-3 py-2">
              <span class="font-semibold text-ink">{{ $fu->name }} <span class="font-normal text-slate-500">{{ maskString($fu->phone ?? '') }}</span></span>
              <a href="{{ route('admin.leads.show', $fu) }}" class="font-bold text-primary-700 hover:underline">Open</a>
            </li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>
@endsection
