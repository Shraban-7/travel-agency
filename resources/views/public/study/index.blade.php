@extends('layouts.public')
@section('title', 'বিদেশে উচ্চশিক্ষা (Study Abroad) — আল-সফর ট্রাভেলস')
@section('activePage', 'study')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">হোম</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">বিদেশে উচ্চশিক্ষা</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">বিশ্বমানের বিশ্ববিদ্যালয়ে উচ্চশিক্ষা</h1>
      <p class="mt-3 max-w-2xl text-navy-100">সঠিক কোর্স নির্বাচন, অফার লেটার সংগ্রহ, স্কলারশিপ ও স্টুডেন্ট ভিসা আবেদনের পূর্ণাঙ্গ গাইডেন্স।</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container">
      <form method="GET" action="{{ route('study.index') }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft sm:p-6 mb-10">
        <div class="grid gap-4 md:grid-cols-4">
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">দেশ</label>
            <select name="country" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              <option value="">সকল দেশ</option>
              @foreach($countries as $c)
                <option value="{{ $c->id }}" @selected((string) request('country') === (string) $c->id)>{{ t($c->name) }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">ডিগ্রি লেভেল</label>
            <select name="level" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              <option value="">সকল লেভেল</option>
              @foreach(['bachelor' => 'স্নাতক (Bachelor’s)', 'master' => 'মাস্টার্স (Master’s)', 'diploma' => 'ডিপ্লোমা', 'phd' => 'পিএইচডি'] as $key => $label)
                <option value="{{ $key }}" @selected(request('level') === $key)>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">পড়ার বিষয়</label>
            <input name="field" value="{{ request('field') }}" placeholder="যেমন: Computer Science" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
          </div>
          <div class="flex items-end">
            <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-primary-700 px-6 text-sm font-semibold text-white hover:bg-primary-800"><i data-lucide="search" class="h-4 w-4"></i> খুঁজুন</button>
          </div>
        </div>
      </form>

      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($universities as $uni)
          @php
            $minFee = $uni->studyPrograms->whereNotNull('tuition_fee')->min('tuition_fee');
            $feeCurrency = $uni->studyPrograms->firstWhere('tuition_fee', $minFee)?->currency;
            $nextIntake = $uni->studyPrograms->flatMap->intakes->sortBy('application_deadline')->first();
          @endphp
          <article class="lift rounded-2xl border border-slate-200 bg-white p-6 shadow-soft hover:border-primary-300 hover:shadow-lift flex flex-col">
            <div class="flex items-center gap-4">
              <span class="grid h-14 w-14 place-items-center rounded-xl bg-navy-50 font-serif text-xl font-bold text-navy-800 border border-slate-200">{{ mb_substr(t($uni->name), 0, 2) }}</span>
              <div>
                <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-0.5">
                  @if($uni->country?->flag_code)<img src="https://flagcdn.com/{{ $uni->country->flag_code }}.svg" alt="" class="h-3 w-4 rounded-sm">@endif
                  {{ $uni->country ? t($uni->country->name) : '' }}{{ $uni->city ? ' · '.$uni->city : '' }}
                </div>
                <h2 class="text-lg font-bold text-ink">{{ t($uni->name) }}</h2>
              </div>
            </div>
            <div class="mt-5 space-y-2 border-y border-slate-100 py-4 text-sm">
              <div class="flex justify-between"><span class="text-slate-500">অফারকৃত প্রোগ্রাম:</span><span class="font-bold text-ink">{{ $uni->programs_count }}টি</span></div>
              <div class="flex justify-between"><span class="text-slate-500">টিউশন ফি শুরু:</span><span class="font-bold text-primary-800 font-en">{{ $minFee ? $feeCurrency.' '.number_format($minFee).' / year' : '—' }}</span></div>
              <div class="flex justify-between"><span class="text-slate-500">পরবর্তী ইনটেক:</span><span class="font-semibold text-slate-800">{{ $nextIntake ? t($nextIntake->intake_name) : '—' }}</span></div>
            </div>
            <div class="mt-5 flex items-center justify-between mt-auto pt-2">
              @if($nextIntake?->application_deadline)
                <span data-countdown="{{ $nextIntake->application_deadline->toIso8601String() }}" class="text-xs font-bold text-primary-800 flex items-center gap-1.5"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>
              @else
                <span></span>
              @endif
              <a href="{{ route('study.show', $uni->id) }}" class="rounded-xl bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">বিস্তারিত</a>
            </div>
          </article>
        @empty
          <p class="col-span-full text-center text-slate-500">কোনো বিশ্ববিদ্যালয় পাওয়া যায়নি। ফিল্টার বদলে আবার চেষ্টা করুন।</p>
        @endforelse
      </div>

      <div class="mt-12 flex justify-center">{{ $universities->links() }}</div>
    </div>
  </section>
</main>
@endsection
