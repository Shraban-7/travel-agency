@extends('layouts.public')

@section('title', 'আমার অ্যাকাউন্ট — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-10">
  <div class="flex flex-wrap items-center justify-between gap-3">
    <div>
      <h1 class="text-2xl font-bold text-ink">আসসালামু আলাইকুম, {{ $client->full_name }}</h1>
      <p class="mt-1 text-sm text-slate-500">মোবাইল: {{ bn_digits($client->phone) }}</p>
    </div>
    <form method="POST" action="{{ route('account.logout') }}">
      @csrf
      <button type="submit" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">লগআউট</button>
    </form>
  </div>

  <div class="mt-6 grid gap-4 sm:grid-cols-3">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
      <p class="text-sm text-slate-500">মোট ফি</p>
      <p class="mt-1 text-xl font-bold text-ink">{{ money($totalFee) }}</p>
    </div>
    <div class="rounded-2xl border border-green-200 bg-green-50 p-5">
      <p class="text-sm text-green-700">মোট পরিশোধিত</p>
      <p class="mt-1 text-xl font-bold text-green-800">{{ money($paidTotal) }}</p>
    </div>
    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
      <p class="text-sm text-amber-700">মোট বকেয়া</p>
      <p class="mt-1 text-xl font-bold text-amber-800">{{ money($dueTotal) }}</p>
    </div>
  </div>

  <div class="mt-8 grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
      <h2 class="text-lg font-bold text-ink">আমার আবেদনসমূহ ({{ bn_digits(count($applications)) }}টি)</h2>
      <div class="mt-4 space-y-4">
        @forelse($applications as $application)
          <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
            <div class="flex flex-wrap items-center justify-between gap-2">
              <div>
                <p class="font-en text-sm font-semibold text-primary-700">{{ $application->tracking_code }}</p>
                <p class="mt-0.5 text-base font-semibold text-ink">{{ $application->service_type }}</p>
              </div>
              <span class="rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-800">{{ $application->status_label ?? $application->status }}</span>
            </div>
            <div class="mt-3 flex flex-wrap gap-4 text-sm text-slate-600">
              <span>মোট ফি: <b class="text-ink">{{ money($application->total_fee) }}</b></span>
              <span>পরিশোধিত: <b class="text-green-700">{{ money($application->paid_amount) }}</b></span>
              <span>বকেয়া: <b class="text-amber-700">{{ money($application->due_amount) }}</b></span>
            </div>
            <a href="{{ route('account.applications.show', $application) }}" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-primary-700 hover:underline">বিস্তারিত দেখুন →</a>
          </div>
        @empty
          <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-500">এখনো কোনো আবেদন নেই।</div>
        @endforelse
      </div>

      <h2 class="mt-8 text-lg font-bold text-ink">পেমেন্ট হিস্ট্রি</h2>
      <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200 bg-white">
        <table class="w-full min-w-[560px] text-sm">
          <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
            <tr><th class="px-4 py-3">তারিখ</th><th class="px-4 py-3">আবেদন</th><th class="px-4 py-3">পরিমাণ</th><th class="px-4 py-3">মাধ্যম</th><th class="px-4 py-3">রসিদ</th></tr>
          </thead>
          <tbody>
            @forelse($payments as $payment)
              <tr class="border-t border-slate-100">
                <td class="px-4 py-3">{{ $payment->paid_at?->format('d M Y') ?? $payment->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3 font-en">{{ $payment->application->tracking_code ?? '—' }}</td>
                <td class="px-4 py-3 font-semibold">{{ money($payment->amount) }}</td>
                <td class="px-4 py-3">{{ $payment->method ?? '—' }}</td>
                <td class="px-4 py-3 font-en">{{ $payment->receipt_no ?? '—' }}</td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">কোনো পেমেন্ট পাওয়া যায়নি।</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="space-y-6">
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
        <h2 class="text-base font-bold text-ink">প্রোফাইল</h2>
        <dl class="mt-3 space-y-2 text-sm text-slate-600">
          <div class="flex justify-between gap-2"><dt>নাম</dt><dd class="font-semibold text-ink">{{ $client->full_name }}</dd></div>
          <div class="flex justify-between gap-2"><dt>মোবাইল</dt><dd class="font-semibold text-ink">{{ bn_digits($client->phone) }}</dd></div>
          <div class="flex justify-between gap-2"><dt>ইমেইল</dt><dd class="font-en font-semibold text-ink">{{ $client->email ?? '—' }}</dd></div>
          <div class="flex justify-between gap-2"><dt>জেলা</dt><dd class="font-semibold text-ink">{{ $client->district ?? '—' }}</dd></div>
          <div class="flex justify-between gap-2"><dt>ঠিকানা</dt><dd class="text-right font-semibold text-ink">{{ $client->address ?? '—' }}</dd></div>
        </dl>
      </div>

      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
        <h2 class="text-base font-bold text-ink">আমার ডকুমেন্টস</h2>
        <ul class="mt-3 space-y-2 text-sm">
          @forelse($documents as $document)
            <li class="flex items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2">
              <span>{{ $document->type }} <span class="font-en text-xs text-slate-400">{{ $document->application_tracking_code }}</span></span>
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
