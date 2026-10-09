@extends('layouts.admin')

@section('title', __('Lead: :name', ['name' => $lead->name]))

@section('content')
<nav class="flex items-center gap-2 text-xs text-slate-500">
  <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
  <span>/</span>
  <a href="{{ route('admin.leads.index') }}" class="hover:underline">Leads</a>
  <span>/</span>
  <span class="text-slate-800 font-semibold">{{ $lead->name }}</span>
</nav>

@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif
@if ($errors->any())
  <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
    <ul class="list-disc pl-4">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<div class="grid gap-6 lg:grid-cols-12 items-start">
  <div class="lg:col-span-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
    <div class="flex flex-wrap items-start justify-between gap-4 pb-4 border-b border-slate-100">
      <div>
        <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ ucfirst($lead->status) }}</span>
        <h2 class="mt-2 text-2xl font-bold text-ink">{{ $lead->name }}</h2>
        <p class="text-xs text-slate-500 mt-1 font-mono">{{ maskString($lead->phone ?? '') }} @if($lead->email)· {{ $lead->email }}@endif</p>
        <p class="text-xs text-slate-500 mt-1">Service: <b class="text-slate-800">{{ $lead->service_type ?? '—' }}</b> · Source: {{ $lead->source ?? '—' }} · Officer: <b class="text-slate-800">{{ $lead->assignee->name ?? 'Unassigned' }}</b></p>
        @if ($lead->message)
          <p class="mt-3 text-sm text-slate-700 rounded-xl bg-slate-50 border border-slate-100 p-3">{{ $lead->message }}</p>
        @endif
      </div>
    </div>

    <div>
      <h3 class="text-base font-bold text-ink mb-3">Notes ({{ $lead->notes->count() }})</h3>
      <div class="space-y-3">
        @forelse ($lead->notes as $note)
          <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-sm">
            <p class="text-slate-700">{{ $note->note }}</p>
            <p class="text-[11px] text-slate-400 mt-1">{{ $note->user->name ?? 'Staff' }} · {{ $note->created_at?->diffForHumans() }}</p>
          </div>
        @empty
          <p class="text-xs text-slate-500">No notes yet.</p>
        @endforelse
      </div>

      <form method="POST" action="{{ route('admin.leads.note', $lead) }}" class="mt-4">
        @csrf
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Add Staff Note</label>
        <div class="flex gap-2">
          <input type="text" name="note" value="{{ old('note') }}" placeholder="Note text..." class="flex-1 rounded-xl border-slate-200 bg-slate-50 text-sm">
          <button class="rounded-xl bg-slate-800 px-4 text-xs font-bold text-white hover:bg-black">Add Note</button>
        </div>
      </form>
    </div>
  </div>

  <div class="lg:col-span-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
    <h3 class="text-base font-bold text-ink pb-3 border-b border-slate-100">Lead Actions</h3>
    <div class="text-xs text-slate-500 space-y-2">
      <p><span class="font-semibold text-slate-700">Follow-up:</span> {{ $lead->follow_up_at?->format('d M Y, h:i A') ?? '—' }}</p>
      <p><span class="font-semibold text-slate-700">Created:</span> {{ $lead->created_at?->format('d M Y, h:i A') }}</p>
      @if ($lead->lost_reason)<p><span class="font-semibold text-slate-700">Lost reason:</span> {{ $lead->lost_reason }}</p>@endif
    </div>
    <form method="POST" action="{{ route('admin.leads.status', $lead) }}" class="space-y-3">
      @csrf
      @method('PATCH')
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Update Status</label>
        <select name="status" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm">
          @foreach (['new', 'contacted', 'qualified', 'converted', 'lost'] as $s)
            <option value="{{ $s }}" @selected($lead->status === $s)>{{ ucfirst($s) }}</option>
          @endforeach
        </select>
      </div>
      <button class="w-full rounded-xl bg-primary-700 px-4 py-2 text-xs font-bold text-white hover:bg-primary-800">Update Status</button>
    </form>
  </div>
</div>
@endsection
