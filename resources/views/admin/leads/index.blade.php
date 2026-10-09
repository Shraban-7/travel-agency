@extends('layouts.admin')

@section('title', __('CRM Leads & Inquiries'))

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Inquiries &amp; Leads Management</h2>
    <p class="text-sm text-slate-500">Track and convert incoming website inquiries and direct client calls.</p>
  </div>
</div>

@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft" data-table>
  <form method="GET" action="{{ route('admin.leads.index') }}" class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
    <div class="flex flex-wrap items-center gap-3">
      <div class="relative w-72">
        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Filter by client name, phone..." class="h-10 w-full rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-4 text-sm focus:border-primary-500 focus:bg-white">
      </div>
      <select name="status" class="h-10 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
        <option value="">All Statuses</option>
        @foreach (['new' => 'New Inquiry', 'contacted' => 'Contacted', 'qualified' => 'Qualified', 'converted' => 'Converted', 'lost' => 'Lost'] as $val => $label)
          <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
        @endforeach
      </select>
      <input type="text" name="service" value="{{ request('service') }}" placeholder="Service type..." class="h-10 rounded-xl border border-slate-200 bg-slate-50 text-sm px-3 focus:border-primary-500">
      <button type="submit" class="h-10 rounded-xl bg-primary-700 px-4 text-sm font-semibold text-white hover:bg-primary-800">Filter</button>
      @if (request()->hasAny(['search', 'status', 'service']))
        <a href="{{ route('admin.leads.index') }}" class="text-xs font-semibold text-slate-500 hover:underline">Clear</a>
      @endif
    </div>
    <div class="text-xs text-slate-500">
      Showing <span class="font-bold text-slate-800">{{ $leads->count() }}</span> of {{ $leads->total() }} records
    </div>
  </form>

  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm mt-2">
      <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
        <tr>
          <th class="py-3 px-3">Client Name</th>
          <th class="py-3 px-3">Service Interest</th>
          <th class="py-3 px-3">Date</th>
          <th class="py-3 px-3">Status</th>
          <th class="py-3 px-3">Assigned Officer</th>
          <th class="py-3 px-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($leads as $lead)
          <tr class="hover:bg-slate-50/70">
            <td class="py-3 px-3 font-medium text-ink">
              <p class="font-bold">{{ $lead->name }}</p>
              <p class="text-xs text-slate-500 font-mono">{{ maskString($lead->phone ?? '') }}</p>
            </td>
            <td class="py-3 px-3"><span class="rounded bg-primary-50 px-2 py-0.5 text-xs font-semibold text-primary-800">{{ $lead->service_type ?? '—' }}</span></td>
            <td class="py-3 px-3 text-xs text-slate-500">{{ $lead->created_at?->format('d M Y') }}</td>
            <td class="py-3 px-3"><span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ ucfirst($lead->status) }}</span></td>
            <td class="py-3 px-3 text-xs text-slate-500">{{ $lead->assignee->name ?? 'Unassigned' }}</td>
            <td class="py-3 px-3 text-right">
              <a href="{{ route('admin.leads.show', $lead) }}" class="rounded-lg bg-primary-50 px-3 py-1 text-xs font-bold text-primary-800 hover:bg-primary-700 hover:text-white transition">View</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="py-8 text-center text-sm text-slate-500">No leads found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $leads->links() }}</div>
</div>
@endsection
