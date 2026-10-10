@extends('layouts.public')
@section('title', __('packages.meta.title'))
@section('activePage', 'packages')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">{{ __('common.home') }}</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">{{ __('packages.hero.current') }}</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('packages.hero.title') }}</h1>
      <p class="mt-3 max-w-2xl text-navy-100">{{ __('packages.hero.subtitle') }}</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container">
      <form method="GET" action="{{ route('packages.index') }}" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft sm:p-6 mb-10">
        <div class="grid gap-4 md:grid-cols-4">
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('packages.filter.category') }}</label>
            <select name="type" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:ring-primary-200">
              <option value="">{{ __('packages.filter.all_categories') }}</option>
              @foreach($types as $key => $label)
                <option value="{{ $key }}" @selected(request('type') === $key)>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('common.search') }}</label>
            <input name="q" value="{{ request('q') }}" placeholder="{{ __('packages.filter.search_placeholder') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:ring-primary-200">
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">{{ __('common.sort_by') }}</label>
            <select name="sort" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500 focus:ring-primary-200">
              <option value="">{{ __('packages.filter.popular') }}</option>
              <option value="price_asc" @selected(request('sort') === 'price_asc')>{{ __('packages.filter.price_asc') }}</option>
              <option value="price_desc" @selected(request('sort') === 'price_desc')>{{ __('packages.filter.price_desc') }}</option>
            </select>
          </div>
        </div>
        <button class="mt-4 inline-flex h-11 items-center gap-2 rounded-xl bg-primary-700 px-6 text-sm font-semibold text-white hover:bg-primary-800"><i data-lucide="search" class="h-4 w-4"></i> {{ __('packages.filter.submit') }}</button>
      </form>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($packages as $pkg)
          @php $next = $pkg->departures->first(); $seatsLeft = $next ? max(0, ($next->seats_total ?? 0) - ($next->seats_booked ?? 0)) : null; @endphp
          <article class="lift group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-soft hover:shadow-lift flex flex-col">
            <div class="relative aspect-[4/3] overflow-hidden">
              <img src="{{ $pkg->cover_image ? asset('storage/'.$pkg->cover_image) : asset('assets/img/hero-makkah.jpg') }}" alt="{{ t($pkg->title) }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
              <span class="absolute left-3 top-3 rounded-full bg-primary-700 px-3 py-1 text-xs font-semibold text-white shadow">{{ $types[$pkg->type] ?? __('packages.card.package') }}</span>
              @if(!is_null($seatsLeft) && $seatsLeft <= 15)
                <span class="absolute right-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-danger backdrop-blur">{{ __('packages.card.seats_left', ['count' => $seatsLeft]) }}</span>
              @endif
            </div>
            <div class="p-6 flex-1 flex flex-col">
              <h2 class="text-xl font-bold leading-snug group-hover:text-primary-700">{{ t($pkg->title) }}</h2>
              <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ t($pkg->summary) }}</p>
              <ul class="mt-4 grid grid-cols-2 gap-2 text-sm text-slate-600">
                <li class="flex items-center gap-1.5"><i data-lucide="calendar" class="h-4 w-4 text-primary-600"></i>{{ $pkg->duration_days ? __('common.duration_days', ['count' => $pkg->duration_days]) : '—' }}</li>
                <li class="flex items-center gap-1.5"><i data-lucide="plane" class="h-4 w-4 text-primary-600"></i>{{ $pkg->airline ?: '—' }}</li>
              </ul>
              <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                <div>
                  <p class="text-xs text-slate-500">{{ __('packages.card.starting_from') }}</p>
                  <p class="text-xl font-bold text-primary-800">{{ money($pkg->base_price) }}</p>
                </div>
                <a href="{{ route('packages.show', $pkg->slug) }}" class="inline-flex items-center gap-1.5 rounded-xl bg-primary-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-800">{{ __('common.view_details') }} <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
              </div>
            </div>
          </article>
        @empty
          <p class="col-span-full text-center text-slate-500">{{ __('packages.empty') }}</p>
        @endforelse
      </div>

      <div class="mt-12 flex justify-center">{{ $packages->links() }}</div>
    </div>
  </section>
</main>
@endsection
