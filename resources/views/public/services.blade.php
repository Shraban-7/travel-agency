@extends('layouts.public')
@section('title', __('সেবাসমূহ'))
@section('activePage', 'services')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">{{ __('common.home') }}</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">{{ __('services.breadcrumb.current') }}</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('services.hero.title') }}</h1>
      <p class="mt-3 max-w-2xl text-navy-100">{{ __('services.hero.subtitle') }}</p>
    </div>
  </section>

  <div class="container py-16 space-y-20">
    @forelse($services as $service)
      <section id="{{ $service->slug }}" class="scroll-mt-24 grid lg:grid-cols-2 gap-10 items-center">
        <div class="{{ $loop->even ? 'order-1 lg:order-2' : '' }}">
          <span class="inline-flex items-center gap-2 rounded-full bg-primary-100 px-3 py-1 text-xs font-bold text-primary-800 mb-3">{{ t($service->type) ?: __('common.service') }}</span>
          <h2 class="font-serif text-3xl font-bold text-ink">{{ t($service->title) }}</h2>
          <p class="mt-4 text-slate-600 leading-relaxed">{{ t($service->body) ?: t($service->short_desc) }}</p>
          @if($service->slug === 'hajj' || $service->type === 'hajj')
            <div class="mt-8"><a href="{{ route('packages.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">{{ __('services.card.view_hajj') }}</a></div>
          @elseif($service->type === 'manpower' || $service->type === 'job')
            <div class="mt-8"><a href="{{ route('jobs.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">{{ __('services.card.view_jobs') }}</a></div>
          @elseif($service->type === 'study')
            <div class="mt-8"><a href="{{ route('study.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">{{ __('services.card.view_study') }}</a></div>
          @else
            <div class="mt-8"><a href="{{ route('contact') }}#consult" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">{{ __('services.card.contact_cta') }}</a></div>
          @endif
        </div>
        <div class="{{ $loop->even ? 'order-2 lg:order-1' : '' }} overflow-hidden rounded-2xl shadow-soft">
          @if($service->cover_image)
            <img src="{{ asset('storage/'.$service->cover_image) }}" alt="{{ t($service->title) }}" loading="lazy" class="h-80 w-full object-cover">
          @else
            <div class="bg-gradient-to-br from-primary-800 to-navy-950 p-8 text-white min-h-[320px] flex flex-col justify-between">
              <div class="flex items-center justify-between">
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold backdrop-blur">{{ t($service->title) }}</span>
                <i data-lucide="{{ $service->icon ?: 'briefcase' }}" class="h-8 w-8 text-accent"></i>
              </div>
              <p class="mt-2 text-sm text-navy-200">{{ t($service->short_desc) }}</p>
            </div>
          @endif
        </div>
      </section>
    @empty
      <p class="text-center text-slate-500">{{ __('services.empty.message') }}</p>
    @endforelse
  </div>
</main>
@endsection
