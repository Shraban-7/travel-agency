@extends('layouts.public')
@section('title', __('deadlines.meta.title'))
@section('activePage', 'deadlines')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">{{ __('common.home') }}</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">{{ __('deadlines.breadcrumb.current') }}</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('deadlines.hero.title') }}</h1>
      <p class="mt-3 max-w-2xl text-navy-100">{{ __('deadlines.hero.subtitle') }}</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container">
      <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2 mb-8">
        <a href="{{ route('deadlines') }}" class="rounded-full px-5 py-2 text-sm font-semibold shadow-soft {{ $kind === 'all' ? 'bg-primary-700 text-white' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">{{ __('deadlines.filter.all') }}</a>
        <a href="{{ route('deadlines', ['kind' => 'notice']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'notice' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">{{ __('deadlines.filter.hajj_umrah') }}</a>
        <a href="{{ route('deadlines', ['kind' => 'job']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'job' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">{{ __('deadlines.filter.jobs') }}</a>
        <a href="{{ route('deadlines', ['kind' => 'departure']) }}" class="rounded-full px-5 py-2 text-sm font-semibold {{ $kind === 'departure' ? 'bg-primary-700 text-white shadow-soft' : 'border border-slate-200 bg-white text-slate-700 hover:border-primary-300' }}">{{ __('deadlines.filter.tours') }}</a>
      </div>

      <div class="space-y-4">
        @forelse($deadlines as $d)
          @php $urgent = $d['deadline_at'] && $d['deadline_at']->diffInDays(now()) <= 7; @endphp
          <article class="lift flex flex-col md:flex-row md:items-center justify-between gap-5 rounded-2xl border {{ $urgent ? 'border-red-200' : 'border-slate-200' }} bg-white p-6 shadow-soft">
            <div class="flex items-start gap-4">
              <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl {{ $urgent ? 'bg-red-100 text-danger' : 'bg-primary-50 text-primary-700' }}"><i data-lucide="{{ $d['icon'] }}" class="h-6 w-6"></i></span>
              <div>
                <div class="flex items-center gap-2 mb-1">
                  <span class="rounded-full px-2.5 py-0.5 text-xs font-bold {{ $urgent ? 'bg-red-100 text-danger' : 'bg-primary-50 text-primary-700' }}">{{ $urgent ? __('deadlines.urgent_badge') : t($d['badge']) }}</span>
                </div>
                <h2 class="text-lg font-bold text-ink">{{ t($d['title']) }}</h2>
                @if($d['subtitle'])<p class="text-sm text-slate-600 mt-1">{{ t($d['subtitle']) }}</p>@endif
              </div>
            </div>
            <div class="flex items-center justify-between md:justify-end gap-4 shrink-0 border-t md:border-t-0 pt-4 md:pt-0">
              <span data-countdown="{{ $d['deadline_at']->toIso8601String() }}" class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-bold {{ $urgent ? 'border-red-200 bg-red-50 text-danger' : 'border-slate-200 bg-slate-50 text-primary-800' }}">
                <span class="cd-dot h-2 w-2 rounded-full {{ $urgent ? 'bg-danger animate-ping' : 'bg-primary-600' }}"></span>
                <span data-cd-label>…</span>
              </span>
              @if($d['url'])
                <a href="{{ $d['url'] }}" class="rounded-xl bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">{{ __('common.view_details') }}</a>
              @endif
            </div>
          </article>
        @empty
          <p class="text-center text-slate-500 rounded-2xl border border-slate-200 bg-white p-8">{{ __('deadlines.empty') }}</p>
        @endforelse
      </div>
    </div>
  </section>
</main>
@endsection
