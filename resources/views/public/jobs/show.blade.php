@extends('layouts.public')
@section('title', t($job->title).' — আল-সফর ট্রাভেলস')
@section('activePage', 'jobs')
@section('content')
<main id="main" class="py-8 lg:py-12">
  <div class="container max-w-4xl">
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="hover:text-primary-700">হোম</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <a href="{{ route('jobs.index') }}" class="hover:text-primary-700">বিদেশে চাকরি</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <span class="text-slate-800 font-medium">{{ t($job->title) }}</span>
    </nav>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-soft">
      <div class="flex flex-wrap items-start justify-between gap-4">
        <div class="flex items-center gap-4">
          @if($job->country?->flag_code)
            <img src="https://flagcdn.com/{{ $job->country->flag_code }}.svg" alt="{{ t($job->country->name) }}" class="h-12 w-16 rounded object-cover ring-1 ring-slate-200">
          @endif
          <div>
            <p class="font-semibold text-slate-600">{{ $job->country ? t($job->country->name) : '' }}{{ $job->company_name ? ' · '.$job->company_name : '' }}</p>
            <h1 class="text-2xl sm:text-3xl font-bold">{{ t($job->title) }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $job->category ? t($job->category->name) : '' }}@if($job->demand_ref) · রেফ: {{ $job->demand_ref }}@endif</p>
          </div>
        </div>
        @if($job->status === 'open')
          <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-success border border-green-200">আবেদন চলছে</span>
        @else
          <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">আবেদন বন্ধ</span>
        @endif
      </div>

      <dl class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-3 text-sm">
        <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">পদ সংখ্যা</dt><dd class="font-bold">{{ $job->positions }} জন</dd></div>
        <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">মাসিক বেতন</dt><dd class="font-bold">{{ $job->salary_currency }} {{ number_format($job->salary_min) }}{{ $job->salary_max ? '–'.number_format($job->salary_max) : '+' }}</dd></div>
        <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">চুক্তির মেয়াদ</dt><dd class="font-bold">{{ $job->contract_months ? $job->contract_months.' মাস' : '—' }}</dd></div>
        <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">আনুমানিক মোট খরচ</dt><dd class="font-bold">{{ $job->estimated_total_cost ? money($job->estimated_total_cost) : 'আলোচনা সাপেক্ষে' }}</dd></div>
      </dl>

      @if($job->application_deadline)
        <p class="mt-4 flex items-center gap-2 text-sm font-semibold text-primary-800">
          <i data-lucide="alarm-clock" class="h-4 w-4"></i> আবেদনের শেষ তারিখ: {{ $job->application_deadline->format('d M Y') }}
          <span data-countdown="{{ $job->application_deadline->toIso8601String() }}" class="inline-flex items-center gap-1.5 rounded-full border border-primary-100 bg-primary-50 px-3 py-1 text-xs"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>
        </p>
      @endif

      @if($job->requirements)
        <h2 class="mt-8 text-lg font-bold">যোগ্যতা ও শর্তাবলি</h2>
        <ul class="mt-3 space-y-2 text-sm text-slate-700">
          @foreach((array) $job->requirements as $req)
            <li class="flex items-start gap-2"><i data-lucide="check" class="h-4 w-4 text-success shrink-0 mt-0.5"></i>{{ is_array($req) ? t($req) : $req }}</li>
          @endforeach
        </ul>
      @endif

      @if($job->benefits)
        <h2 class="mt-8 text-lg font-bold">সুযোগ-সুবিধা</h2>
        <ul class="mt-3 space-y-2 text-sm text-slate-700">
          @foreach((array) $job->benefits as $ben)
            <li class="flex items-start gap-2"><i data-lucide="gift" class="h-4 w-4 text-primary-600 shrink-0 mt-0.5"></i>{{ is_array($ben) ? t($ben) : $ben }}</li>
          @endforeach
        </ul>
      @endif

      @if($job->required_documents)
        <h2 class="mt-8 text-lg font-bold">প্রয়োজনীয় কাগজপত্র</h2>
        <ul class="mt-3 space-y-2 text-sm text-slate-700">
          @foreach((array) $job->required_documents as $doc)
            <li class="flex items-start gap-2"><i data-lucide="file-text" class="h-4 w-4 text-primary-600 shrink-0 mt-0.5"></i>{{ is_array($doc) ? t($doc) : $doc }}</li>
          @endforeach
        </ul>
      @endif

      @if($job->service_charge_note)
        <div class="mt-8 rounded-xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900">{{ t($job->service_charge_note) }}</div>
      @endif

      <form method="POST" action="{{ route('inquiry.store') }}" class="mt-8 rounded-2xl bg-surface border border-slate-200 p-6">
        @csrf
        <input type="hidden" name="source" value="web_form">
        <input type="hidden" name="service" value="বিদেশে চাকরি: {{ t($job->title) }}">
        <h3 class="font-bold">এই পদে আবেদন করতে চান?</h3>
        <p class="text-sm text-slate-500 mt-1">নাম ও মোবাইল দিন — আমাদের টিম যাচাই করে কল করবে।</p>
        @if(session('success'))<p class="mt-3 rounded-xl bg-green-50 p-3 text-sm font-semibold text-success">{{ session('success') }}</p>@endif
        <div class="mt-4 grid gap-3 sm:grid-cols-2">
          <input name="name" required placeholder="আপনার নাম" value="{{ old('name') }}" class="h-12 w-full rounded-xl border-slate-200 bg-white text-sm">
          <input name="phone" type="tel" required placeholder="01XXXXXXXXX" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-white text-sm font-en">
        </div>
        <button class="mt-4 h-12 w-full rounded-xl bg-primary-700 font-semibold text-white hover:bg-primary-800">আবেদনের অনুরোধ পাঠান</button>
      </form>
    </div>

    @if($related->isNotEmpty())
      <h2 class="mt-12 text-xl font-bold">আরও জব ডিমান্ড</h2>
      <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($related as $rel)
          <a href="{{ route('jobs.show', $rel->slug) }}" class="rounded-2xl border border-slate-100 bg-white p-5 shadow-soft hover:border-primary-200">
            <p class="text-sm text-slate-500">{{ $rel->country ? t($rel->country->name) : '' }}</p>
            <p class="font-bold">{{ t($rel->title) }}</p>
            <p class="mt-1 text-sm font-semibold text-primary-800">{{ $rel->salary_currency }} {{ number_format($rel->salary_min) }}+</p>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</main>
@endsection
