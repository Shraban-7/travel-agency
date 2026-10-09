@extends('layouts.public')
@section('title', 'আসন্ন ডেডলাইন বোর্ড — আল-সফর ট্রাভেলস')
@section('activePage', 'deadlines')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">হোম</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">ডেডলাইনসমূহ</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">গুরুত্বপূর্ণ সময়সীমা ও নোটিশ বোর্ড</h1>
      <p class="mt-3 max-w-2xl text-navy-100">হজ্জ, উমরাহ, চাকরি ও উচ্চশিক্ষা আবেদনের সর্বশেষ সময়সীমা মিস করবেন না। লাইভ কাউন্টডাউন দেখে সময়মত প্রস্তুত হোন।</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container">
      <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2 mb-8">
        <a href="{{ route('deadlines') }}" class="rounded-full px-5 py-2 text-sm font-semibold shadow-soft {{ $kind === 'all' ? 'bg-primary-700 text-white' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">সকল ডেডলাইন</a>
        <a href="{{ route('deadlines', ['kind' => 'notice']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'notice' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">হজ্জ ও উমরাহ</a>
        <a href="{{ route('deadlines', ['kind' => 'job']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'job' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">বিদেশে চাকরি</a>
        <a href="{{ route('deadlines', ['kind' => 'departure']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'departure' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">ট্যুর ও প্যাকেজ</a>
      </div>

      <div class="space-y-4">
        @forelse($deadlines as $d)
          @php $urgent = $d['deadline_at'] && $d['deadline_at']->diffInDays(now()) <= 7; @endphp
          <article class="lift flex flex-col md:flex-row md:items-center justify-between gap-5 rounded-2xl border {{ $urgent ? 'border-red-200' : 'border-slate-200' }} bg-white p-6 shadow-soft">
            <div class="flex items-start gap-4">
              <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl {{ $urgent ? 'bg-red-100 text-danger' : 'bg-primary-50 text-primary-700' }}"><i data-lucide="{{ $d['icon'] }}" class="h-6 w-6"></i></span>
              <div>
                <div class="flex items-center gap-2 mb-1">
                  <span class="rounded-full px-2.5 py-0.5 text-xs font-bold {{ $urgent ? 'bg-red-100 text-danger' : 'bg-primary-50 text-primary-700' }}">{{ $urgent ? 'জরুরি ডেডলাইন' : $d['badge'] }}</span>
                </div>
                <h2 class="text-lg font-bold text-ink">{{ $d['title'] }}</h2>
                @if($d['subtitle'])<p class="text-sm text-slate-600 mt-1">{{ $d['subtitle'] }}</p>@endif
              </div>
            </div>
            <div class="flex items-center justify-between md:justify-end gap-4 shrink-0 border-t md:border-t-0 pt-4 md:pt-0">
              <span data-countdown="{{ $d['deadline_at']->toIso8601String() }}" class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-bold {{ $urgent ? 'border-red-200 bg-red-50 text-danger' : 'border-slate-200 bg-slate-50 text-primary-800' }}">
                <span class="cd-dot h-2 w-2 rounded-full {{ $urgent ? 'bg-danger animate-ping' : 'bg-primary-600' }}"></span>
                <span data-cd-label>…</span>
              </span>
              @if($d['url'])
                <a href="{{ $d['url'] }}" class="rounded-xl bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">বিস্তারিত</a>
              @endif
            </div>
          </article>
        @empty
          <p class="text-center text-slate-500 rounded-2xl border border-slate-200 bg-white p-8">এই মুহূর্তে কোনো আসন্ন ডেডলাইন নেই।</p>
        @endforelse
      </div>
    </div>
  </section>
</main>
@endsection
