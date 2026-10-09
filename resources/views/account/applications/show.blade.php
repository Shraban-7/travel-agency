@extends('layouts.public')

@section('title', 'আবেদন '.($application->tracking_code).' — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-10">
  <a href="{{ route('account.dashboard') }}" class="text-sm font-semibold text-primary-700 hover:underline">← ড্যাশবোর্ডে ফিরুন</a>

  <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
    <div class="flex flex-wrap items-center justify-between gap-2">
      <div>
        <p class="font-en text-sm font-semibold text-primary-700">{{ $application->tracking_code }}</p>
        <h1 class="mt-1 text-2xl font-bold text-ink">{{ $application->service_type }}</h1>
        <p class="mt-1 text-sm text-slate-500">আবেদনকারী: {{ $application->client->full_name ?? $client->full_name }}</p>
      </div>
      <span class="rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-800">{{ $application->status_label ?? $application->status }}</span>
    </div>

    <div class="mt-4 flex flex-wrap gap-4 text-sm text-slate-600">
      <span>মোট ফি: <b class="text-ink">{{ money($application->total_fee) }}</b></span>
      <span>পরিশোধিত: <b class="text-green-700">{{ money($application->paid_amount) }}</b></span>
      <span>বকেয়া: <b class="text-amber-700">{{ money($application->due_amount) }}</b></span>
      @if($application->country)<span>দেশ: <b class="text-ink">{{ t($application->country->name) }}</b></span>@endif
    </div>

    @if($application->public_note)
      <div class="mt-4 rounded-xl bg-blue-50 px-4 py-3 text-sm text-blue-900">{{ $application->public_note }}</div>
    @endif
  </div>

  <div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="rounded-2xl border border-slate-200 bg-white p-6">
      <h2 class="text-base font-bold text-ink">স্ট্যাটাস আপডেট</h2>
      <ul class="mt-4 space-y-3 text-sm">
        @forelse($application->statusLogs as $log)
          <li class="rounded-xl bg-slate-50 px-3 py-2">
            <p class="font-semibold text-ink">{{ $log->to_status }}</p>
            @if($log->note)<p class="text-slate-600">{{ $log->note }}</p>@endif
            <p class="mt-1 text-xs text-slate-400">{{ $log->created_at->format('d M Y, h:i A') }}</p>
          </li>
        @empty
          <li class="text-slate-500">এখনো কোনো পাবলিক আপডেট নেই।</li>
        @endforelse
      </ul>
    </div>

    <div class="space-y-6">
      <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="text-base font-bold text-ink">পেমেন্টসমূহ</h2>
        <ul class="mt-4 space-y-2 text-sm">
          @forelse($application->payments as $payment)
            <li class="flex items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2">
              <span>{{ $payment->paid_at?->format('d M Y') ?? $payment->created_at->format('d M Y') }} · {{ $payment->method ?? '—' }}</span>
              <b>{{ money($payment->amount) }}</b>
            </li>
          @empty
            <li class="text-slate-500">কোনো পেমেন্ট পাওয়া যায়নি।</li>
          @endforelse
        </ul>

        @if($application->schedules->count())
          <h3 class="mt-5 text-sm font-bold text-ink">পেমেন্ট শিডিউল</h3>
          <ul class="mt-2 space-y-2 text-sm">
            @foreach($application->schedules as $schedule)
              <li class="flex items-center justify-between gap-2 rounded-xl bg-amber-50 px-3 py-2">
                <span>{{ $schedule->due_date }} · {{ $schedule->label ?? $schedule->status }}</span>
                <b>{{ money($schedule->amount) }}</b>
              </li>
            @endforeach
          </ul>
        @endif
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-6">
        <h2 class="text-base font-bold text-ink">ডকুমেন্টস</h2>
        <ul class="mt-4 space-y-2 text-sm">
          @forelse($application->documents as $document)
            <li class="flex items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2">
              <span>{{ $document->type }}</span>
              @if($document->verified)
                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">যাচাইকৃত</span>
              @else
                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">অপেক্ষমাণ</span>
              @endif
            </li>
          @empty
            <li class="text-slate-500">কোনো ডকুমেন্ট নেই।</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
