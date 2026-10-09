@extends('layouts.admin')

@section('title', __('Application :code', ['code' => $application->tracking_code]))

@section('content')
@if (session('success'))
  <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>
@endif
@if ($errors->any())
  <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
    <ul class="list-disc pl-4">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
  <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
    <div class="flex items-start gap-4">
      <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary-100 text-primary-800 font-mono font-bold text-lg">{{ substr($application->tracking_code, -3) }}</span>
      <div>
        <div class="flex items-center gap-2 mb-1 flex-wrap">
          <span class="font-mono text-xs font-bold text-primary-800 bg-primary-50 px-2.5 py-0.5 rounded border border-primary-200">{{ $application->tracking_code }}</span>
          <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ $application->status_label ?? ucfirst(str_replace('_', ' ', $application->status)) }}</span>
          <span class="text-xs text-slate-500">File Created: {{ $application->created_at?->format('d M Y') }}</span>
        </div>
        <h2 class="text-2xl font-bold text-ink">{{ $application->client->full_name ?? '—' }}</h2>
        <p class="text-xs text-slate-500 mt-0.5">Service: <b class="text-slate-800">{{ $application->service_type ?? '—' }}</b> · Officer: <b class="text-slate-800">{{ $application->assignee->name ?? '—' }}</b></p>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
        ← Back to List
      </a>
    </div>
  </div>

  <div class="grid grid-cols-3 gap-4 p-4 mt-6 rounded-xl bg-slate-50 border border-slate-200 text-sm">
    <div><p class="text-xs text-slate-500">Total Agreed</p><p class="text-lg font-bold text-ink">৳ {{ number_format((float) $application->total_fee) }}</p></div>
    <div><p class="text-xs text-slate-500">Total Received</p><p class="text-lg font-bold text-success">৳ {{ number_format((float) $paidSum) }}</p></div>
    <div><p class="text-xs text-slate-500">Remaining Balance</p><p class="text-lg font-bold text-danger">৳ {{ number_format((float) $due) }}</p></div>
  </div>
</div>

<div class="grid gap-6 lg:grid-cols-12 items-start">
  <div class="lg:col-span-7 space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink">Applicant Bio &amp; Passport Parameters</h3>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
        <div><p class="text-xs text-slate-500 font-medium">Full Name (English)</p><p class="font-semibold text-ink mt-1">{{ $application->client->full_name ?? '—' }}</p></div>
        <div><p class="text-xs text-slate-500 font-medium">Name (Bangla)</p><p class="font-semibold text-ink mt-1">{{ $application->client->full_name_bn ?? '—' }}</p></div>
        <div><p class="text-xs text-slate-500 font-medium">Passport Number</p><p class="font-mono font-bold text-primary-800 mt-1">{{ maskString($application->client->passport_no ?? '—') }}</p></div>
        <div><p class="text-xs text-slate-500 font-medium">Phone Number</p><p class="font-mono text-slate-800 mt-1">{{ maskString($application->client->phone ?? '') }}</p></div>
        <div><p class="text-xs text-slate-500 font-medium">District / Address</p><p class="text-slate-800 mt-1">{{ $application->client->district ?? '' }} {{ $application->client->address ?? '' }}</p></div>
        <div><p class="text-xs text-slate-500 font-medium">Emergency Contact</p><p class="text-slate-800 mt-1">{{ $application->client->emergency_contact_name ?? '' }} {{ maskString($application->client->emergency_contact_phone ?? '') }}</p></div>
      </div>
      @if ($application->remarks_internal)
        <div class="rounded-xl bg-amber-50 border border-amber-200 p-3 text-xs"><span class="font-bold">Internal remarks:</span> {{ $application->remarks_internal }}</div>
      @endif
      @if ($application->public_note)
        <div class="rounded-xl bg-blue-50 border border-blue-200 p-3 text-xs"><span class="font-bold">Public note:</span> {{ $application->public_note }}</div>
      @endif
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink">Private Document Vault ({{ $application->documents->count() }})</h3>
      <div class="space-y-3">
        @forelse ($application->documents as $doc)
          <div class="flex flex-wrap items-center justify-between gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">
            <div class="flex items-center gap-3">
              <span class="grid h-10 w-10 place-items-center rounded-lg bg-slate-200 text-slate-700"><i data-lucide="file-text" class="h-5 w-5"></i></span>
              <div>
                <p class="font-bold text-sm text-ink">{{ $doc->type }} — {{ $doc->original_name ?? basename($doc->file_path ?? '') }}</p>
                <p class="text-xs text-slate-400">{{ $doc->mime ?? '' }} · {{ $doc->created_at?->format('d M Y') }}</p>
              </div>
            </div>
            <span class="text-xs font-bold {{ $doc->verified ? 'text-success' : 'text-slate-500' }}">{{ $doc->verified ? 'Verified' : 'Pending Verify' }}</span>
          </div>
        @empty
          <p class="text-xs text-slate-500">No documents uploaded.</p>
        @endforelse
      </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <div class="flex items-center justify-between">
        <h3 class="text-base font-bold text-ink">Financial Ledger</h3>
      </div>
      <table class="w-full text-left text-sm">
        <thead class="border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase">
          <tr><th class="py-2.5">Receipt #</th><th class="py-2.5">Date</th><th class="py-2.5">Method</th><th class="py-2.5">Amount</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs">
          @forelse ($application->payments as $pay)
            <tr>
              <td class="py-3 font-mono font-bold text-primary-800">{{ $pay->receipt_no }}</td>
              <td class="py-3">{{ $pay->paid_at?->format('d M Y') ?? $pay->created_at?->format('d M Y') }}</td>
              <td class="py-3">{{ $pay->method }}</td>
              <td class="py-3 font-bold text-ink">৳ {{ number_format((float) $pay->amount) }}</td>
            </tr>
          @empty
            <tr><td colspan="4" class="py-4 text-center text-slate-500">No payments recorded.</td></tr>
          @endforelse
        </tbody>
      </table>

      <form method="POST" action="{{ route('admin.applications.payment', $application) }}" class="pt-4 border-t border-slate-100 grid sm:grid-cols-2 gap-3 text-sm">
        @csrf
        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Amount (BDT) *</label><input type="number" name="amount" min="1" step="0.01" required value="{{ old('amount') }}" class="w-full rounded-xl border-slate-200 bg-slate-50"></div>
        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Method *</label><input type="text" name="method" required value="{{ old('method') }}" placeholder="Cash / Bank / bKash..." class="w-full rounded-xl border-slate-200 bg-slate-50"></div>
        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Reference No</label><input type="text" name="reference_no" value="{{ old('reference_no') }}" class="w-full rounded-xl border-slate-200 bg-slate-50"></div>
        <div><label class="block text-xs font-semibold text-slate-700 mb-1">Paid At</label><input type="date" name="paid_at" value="{{ old('paid_at', now()->format('Y-m-d')) }}" class="w-full rounded-xl border-slate-200 bg-slate-50"></div>
        <div class="sm:col-span-2"><label class="block text-xs font-semibold text-slate-700 mb-1">Note</label><input type="text" name="note" value="{{ old('note') }}" class="w-full rounded-xl border-slate-200 bg-slate-50"></div>
        <div class="sm:col-span-2"><button class="rounded-xl bg-primary-700 px-4 py-2 text-xs font-bold text-white hover:bg-primary-800">Record Payment</button></div>
      </form>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
      <h3 class="text-base font-bold text-ink">Activity Log &amp; Case Notes</h3>
      <div class="space-y-4">
        @forelse ($application->statusLogs as $log)
          <div class="flex gap-4 text-xs">
            <span class="font-mono text-slate-400 shrink-0">{{ $log->created_at?->format('d M, h:i A') }}</span>
            <div>
              <p class="font-bold text-ink">{{ $log->from_status ? ucfirst(str_replace('_', ' ', $log->from_status)).' → ' : '' }}{{ ucfirst(str_replace('_', ' ', $log->to_status)) }}</p>
              @if ($log->note)<p class="text-slate-600">{{ $log->note }}</p>@endif
              <p class="text-[11px] text-slate-400 mt-0.5">By: {{ $log->changer->name ?? 'System' }} @if($log->public_visible)· Visible to client @endif</p>
            </div>
          </div>
        @empty
          <p class="text-xs text-slate-500">No status history yet.</p>
        @endforelse
      </div>
    </div>
  </div>

  <div class="lg:col-span-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft space-y-4">
    <h3 class="text-base font-bold text-ink pb-3 border-b border-slate-100">Update Status</h3>
    <form method="POST" action="{{ route('admin.applications.status', $application) }}" class="space-y-3 text-sm">
      @csrf
      @method('PATCH')
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">New Status *</label>
        <select name="to_status" class="w-full rounded-xl border-slate-200 bg-slate-50">
          @foreach (['submitted', 'under_review', 'embassy', 'approved', 'completed', 'cancelled', 'rejected'] as $s)
            <option value="{{ $s }}" @selected($application->status === $s)>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Note (also saved as public note)</label>
        <textarea name="note" rows="3" class="w-full rounded-xl border-slate-200 bg-slate-50">{{ old('note') }}</textarea>
      </div>
      <label class="flex items-center gap-2 text-xs cursor-pointer">
        <input type="checkbox" name="public_visible" value="1" checked class="rounded border-slate-300 text-primary-600">
        <span>Visible to client on tracking page</span>
      </label>
      <button class="w-full rounded-xl bg-primary-700 px-4 py-2 text-xs font-bold text-white hover:bg-primary-800">Update Status</button>
    </form>
  </div>
</div>
@endsection
