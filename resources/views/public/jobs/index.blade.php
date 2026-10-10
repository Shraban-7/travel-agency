@extends('layouts.public')
@section('title', __('বিদেশে চাকরি'))
@section('activePage', 'jobs')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">{{ __('common.home') }}</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">{{ __('jobs.hero.current') }}</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('jobs.hero.title') }}</h1>
      <p class="mt-3 max-w-2xl text-navy-100">{{ __('jobs.hero.subtitle') }}</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container">
      <form method="GET" action="{{ route('jobs.index') }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft sm:p-6 mb-10">
        <div class="grid gap-4 md:grid-cols-4">
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('jobs.filter.country') }}</label>
            <select name="country" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              <option value="">{{ __('common.all_countries') }}</option>
              @foreach($countries as $c)
                <option value="{{ $c->id }}" @selected((string) request('country') === (string) $c->id)>{{ t($c->name) }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('jobs.filter.sector') }}</label>
            <select name="category" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              <option value="">{{ __('jobs.filter.all_sectors') }}</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected((string) request('category') === (string) $cat->id)>{{ t($cat->name) }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('common.status') }}</label>
            <select name="status" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              <option value="open" @selected($status === 'open')>{{ __('jobs.filter.open') }}</option>
              <option value="closed" @selected($status === 'closed')>{{ __('jobs.filter.closed') }}</option>
              <option value="all" @selected($status === 'all')>{{ __('common.show_all') }}</option>
            </select>
          </div>
          <div class="flex items-end">
            <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-primary-700 px-6 text-sm font-semibold text-white hover:bg-primary-800"><i data-lucide="search" class="h-4 w-4"></i> {{ __('common.search') }}</button>
          </div>
        </div>
      </form>

      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($jobs as $job)
          <article class="lift group flex flex-col rounded-2xl border border-slate-100 bg-white p-6 shadow-soft hover:border-primary-300 hover:shadow-lift">
            <div class="flex items-start justify-between">
              <div class="flex items-center gap-3">
                @if($job->country?->flag_code)
                  <img src="https://flagcdn.com/{{ $job->country->flag_code }}.svg" alt="{{ t($job->country->name) }}" class="h-8 w-11 rounded object-cover shadow-sm ring-1 ring-slate-200" loading="lazy">
                @endif
                <div>
                  <p class="font-bold text-ink">{{ $job->country ? t($job->country->name) : __('jobs.card.abroad') }}</p>
                  <p class="text-xs text-slate-500">{{ $job->company_name }}</p>
                </div>
              </div>
              @if($job->status === 'open')
                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-success border border-green-200">{{ __('jobs.card.open') }}</span>
              @else
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">{{ __('jobs.card.closed') }}</span>
              @endif
            </div>
            <h2 class="mt-4 text-xl font-bold group-hover:text-primary-700">{{ t($job->title) }}</h2>
            <p class="text-sm text-slate-500">{{ $job->category ? t($job->category->name) : '' }}{{ $job->contract_months ? ' · '.__('jobs.card.contract', ['years' => round($job->contract_months/12, 1)]) : '' }}</p>
            <dl class="mt-4 grid grid-cols-2 gap-3 text-sm">
              <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">{{ __('jobs.card.vacancies') }}</dt><dd class="font-bold text-ink">{{ __('jobs.card.vacancy_count', ['count' => $job->positions]) }}</dd></div>
              <div class="rounded-xl bg-slate-50 p-3"><dt class="text-xs text-slate-500">{{ __('jobs.card.salary') }}</dt><dd class="font-bold text-primary-800">{{ $job->salary_currency }} {{ number_format($job->salary_min) }}{{ $job->salary_max ? '–'.number_format($job->salary_max) : '+' }}</dd></div>
            </dl>
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
              <div>
                <p class="text-xs text-slate-500">{{ __('jobs.card.deadline') }}</p>
                @if($job->application_deadline)
                  <span data-countdown="{{ $job->application_deadline->toIso8601String() }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary-800"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>
                @else
                  <span class="text-xs text-slate-500">{{ __('jobs.card.tba') }}</span>
                @endif
              </div>
              <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex items-center gap-1.5 rounded-xl bg-primary-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary-800">{{ __('common.apply') }} <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
            </div>
          </article>
        @empty
          <p class="col-span-full text-center text-slate-500">{{ __('jobs.empty') }}</p>
        @endforelse
      </div>

      <div class="mt-12 flex justify-center">{{ $jobs->links() }}</div>
    </div>
  </section>
</main>
@endsection
