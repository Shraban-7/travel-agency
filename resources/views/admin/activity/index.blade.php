@extends('layouts.admin')

@section('title', __('Activity Log'))

@section('content')
<nav class="flex items-center gap-2 text-xs text-slate-500 mb-1">
  <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
  <i data-lucide="chevron-right" class="h-3 w-3"></i>
  <span class="text-slate-800">Activity Log</span>
</nav>

<div class="flex flex-wrap items-center justify-between gap-4">
  <div>
    <h2 class="text-2xl font-bold text-ink">Activity Log</h2>
    <p class="text-sm text-slate-500">Who changed what, and when.</p>
  </div>
</div>

<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft">
  <form method="GET" action="{{ route('admin.activity.index') }}" class="flex flex-wrap items-end gap-3">
    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">Subject type</label>
      <select name="subject_type" class="rounded-xl border-slate-200 bg-slate-50 text-xs">
        <option value="">— All —</option>
        @foreach ($subjectTypes as $type)
          <option value="{{ $type }}" @selected(request('subject_type') === $type)>{{ class_basename($type) }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">From</label>
      <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-xl border-slate-200 bg-slate-50 text-xs">
    </div>
    <div>
      <label class="block text-xs font-semibold text-slate-700 mb-1">To</label>
      <input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-xl border-slate-200 bg-slate-50 text-xs">
    </div>
    <button type="submit" class="rounded-xl bg-primary-700 px-4 py-2 text-xs font-bold text-white hover:bg-primary-800">Filter</button>
    <a href="{{ route('admin.activity.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50">Reset</a>
  </form>
</div>

<div class="rounded-2xl border border-slate-200 bg-white shadow-soft overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left text-xs">
      <thead class="text-slate-400 font-semibold border-b border-slate-200 uppercase">
        <tr>
          <th class="px-4 py-3">Description</th>
          <th class="px-4 py-3">Causer</th>
          <th class="px-4 py-3">Subject</th>
          <th class="px-4 py-3">Date</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse ($activities as $activity)
          <tr>
            <td class="px-4 py-3 font-semibold text-ink">{{ $activity->description }}</td>
            <td class="px-4 py-3">{{ $activity->causer?->name ?? $activity->causer?->full_name ?? '—' }}</td>
            <td class="px-4 py-3">{{ $activity->subject_type ? class_basename($activity->subject_type).' #'.$activity->subject_id : '—' }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $activity->created_at?->format('d M Y H:i') }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">No activity found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if ($activities->hasPages())
    <div class="border-t border-slate-100 px-4 py-3">{{ $activities->links() }}</div>
  @endif
</div>
@endsection
