@extends('layouts.public')
@section('title', __('আল-সফর ট্রাভেলস — হজ্জ, উমরাহ, বিদেশে চাকরি ও উচ্চশিক্ষা'))
@section('activePage', 'home')
@section('content')
<main id="main">

  {{-- 1. HERO + quick inquiry --}}
  <section class="relative isolate overflow-hidden bg-navy-900">
    <img src="{{ asset('assets/img/hero-makkah.jpg') }}" alt="{{ __('মাসজিদুল হারাম ও পবিত্র কাবা, মক্কা') }}" class="absolute inset-0 -z-10 h-full w-full object-cover" fetchpriority="high">
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-navy-900/95 via-navy-900/80 to-primary-900/40"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-navy-900/80 via-transparent to-transparent"></div>

    <div class="container grid items-center gap-10 py-16 md:py-24 lg:grid-cols-12 lg:py-28">
      <div class="text-white lg:col-span-7">
        <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1.5 text-sm backdrop-blur">
          <span class="h-2 w-2 rounded-full bg-accent"></span> {{ __('হজ্জ ২০২৭ নিবন্ধন চলছে') }}
        </span>
        <h1 class="mt-5 font-serif text-4xl font-bold leading-[1.3] sm:text-5xl lg:text-[3.4rem]">
          {{ __('আপনার পবিত্র সফর ও বিদেশযাত্রার') }} <span class="bg-gradient-to-r from-accent-300 to-accent-500 bg-clip-text text-transparent">{{ __('বিশ্বস্ত সঙ্গী') }}</span>
        </h1>
        <p class="mt-5 max-w-xl text-lg leading-8 text-navy-100">{{ __('হজ্জ-উমরাহ, ভিসা, বিদেশে চাকরি ও উচ্চশিক্ষা — সব কাগজপত্র এক জায়গায়, স্বচ্ছ খরচ ও প্রতিটি ধাপের আপডেটসহ।') }}</p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ route('packages.index') }}" class="inline-flex min-h-[48px] items-center gap-2 rounded-xl bg-accent px-6 font-semibold text-ink shadow-gold transition hover:-translate-y-0.5 hover:bg-accent-400">{{ __('প্যাকেজ দেখুন') }} <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
          <a href="{{ route('track') }}" class="inline-flex min-h-[48px] items-center gap-2 rounded-xl border border-white/30 bg-white/10 px-6 font-semibold text-white backdrop-blur transition hover:bg-white/20"><i data-lucide="search-check" class="h-4 w-4"></i> {{ __('আবেদন ট্র্যাক') }}</a>
        </div>
        <ul class="mt-10 flex flex-wrap gap-x-6 gap-y-3 text-sm text-navy-100">
          <li class="flex items-center gap-2"><i data-lucide="shield-check" class="h-5 w-5 text-accent"></i>{{ __('সরকার অনুমোদিত লাইসেন্স') }}</li>
          <li class="flex items-center gap-2"><i data-lucide="lock" class="h-5 w-5 text-accent"></i>{{ __('ডকুমেন্ট নিরাপদে সংরক্ষিত') }}</li>
          <li class="flex items-center gap-2"><i data-lucide="receipt" class="h-5 w-5 text-accent"></i>{{ __('প্রতিটি পেমেন্টে রসিদ') }}</li>
        </ul>
      </div>

      <div class="lg:col-span-5">
        <form method="POST" action="{{ route('inquiry.store') }}" class="rounded-2xl border border-white/40 bg-white/95 p-6 shadow-2xl backdrop-blur-xl sm:p-7" aria-labelledby="qi-title">
          @csrf
          <input type="hidden" name="source" value="web_form">
          <h2 id="qi-title" class="text-xl font-bold text-ink">{{ __('দ্রুত পরামর্শ নিন') }}</h2>
          <p class="mt-1 text-sm text-slate-500">{{ __('৩০ মিনিটের মধ্যে আমাদের প্রতিনিধি কল করবেন।') }}</p>
          @if(session('success'))
            <p class="mt-3 rounded-xl bg-green-50 p-3 text-sm font-semibold text-success">{{ session('success') }}</p>
          @endif
          <div class="mt-5 space-y-4">
            <div>
              <label for="qi-name" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('আপনার নাম') }}</label>
              <input id="qi-name" name="name" type="text" required value="{{ old('name') }}" placeholder="{{ __('আপনার নাম লিখুন') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200">
            </div>
            <div>
              <label for="qi-service" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('সেবা') }}</label>
              <select id="qi-service" name="service" required class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200">
                <option value="">{{ __('সেবা নির্বাচন করুন') }}</option>
                @foreach([__('হজ্জ'),__('উমরাহ'),__('ট্যুর প্যাকেজ'),__('ভিসা প্রসেসিং'),__('বিদেশে চাকরি'),__('উচ্চশিক্ষা'),__('এয়ার টিকেট')] as $opt)
                  <option value="{{ $opt }}" @selected(old('service') === $opt)>{{ $opt }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label for="qi-country" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('দেশ') }}</label>
              <select id="qi-country" name="country" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200">
                <option value="">{{ __('যেকোনো দেশ') }}</option>
                @foreach($countries as $c)
                  <option value="{{ $c->slug }}">{{ t($c->name) }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label for="qi-phone" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('মোবাইল নম্বর') }}</label>
              <div class="relative">
                <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 font-en text-sm text-slate-500">+88</span>
                <input id="qi-phone" name="phone" type="tel" inputmode="tel" required placeholder="01XXXXXXXXX" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 pl-12 font-en focus:border-primary-500 focus:ring-primary-200">
              </div>
              @error('phone')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-primary-700 font-semibold text-white transition hover:bg-primary-800">
              <i data-lucide="send" class="h-4 w-4"></i> {{ __('পরামর্শের অনুরোধ পাঠান') }}
            </button>
            <p class="flex items-center justify-center gap-1.5 text-xs text-slate-500"><i data-lucide="lock" class="h-3.5 w-3.5"></i>{{ __('আপনার তথ্য গোপন রাখা হবে') }}</p>
          </div>
        </form>
      </div>
    </div>
  </section>

  {{-- 2. TRUST STRIP --}}
  <section class="relative z-10 -mt-8">
    <div class="container">
      <div class="grid grid-cols-2 divide-slate-100 rounded-2xl border border-slate-100 bg-white shadow-soft md:grid-cols-4 md:divide-x">
        <div class="flex items-center gap-4 p-5 sm:p-6">
          <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="award" class="h-6 w-6"></i></span>
          <div><p class="text-2xl font-bold text-ink"><span data-count-to="17">{{ $stats['experience_years'] ?? 17 }}</span>+</p><p class="text-sm text-slate-500">{{ __('বছরের অভিজ্ঞতা') }}</p></div>
        </div>
        <div class="flex items-center gap-4 p-5 sm:p-6">
          <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-accent-50 text-accent-700"><i data-lucide="users" class="h-6 w-6"></i></span>
          <div><p class="text-2xl font-bold text-ink"><span data-count-to="25000">{{ number_format($stats['people_served'] ?? 25000) }}</span>+</p><p class="text-sm text-slate-500">{{ __('মানুষকে সেবা') }}</p></div>
        </div>
        <div class="flex items-center gap-4 p-5 sm:p-6">
          <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-navy-50 text-navy-700"><i data-lucide="globe-2" class="h-6 w-6"></i></span>
          <div><p class="text-2xl font-bold text-ink"><span data-count-to="18">{{ $stats['countries'] ?? 18 }}</span>{{ __('টি') }}</p><p class="text-sm text-slate-500">{{ __('দেশে কার্যক্রম') }}</p></div>
        </div>
        <div class="flex items-center gap-4 p-5 sm:p-6">
          <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-green-50 text-success"><i data-lucide="badge-check" class="h-6 w-6"></i></span>
          <div><p class="text-base font-bold leading-tight text-ink">{{ __('হজ্জ · BMET · ATAB') }}</p><p class="text-sm text-slate-500">{{ __('অনুমোদিত লাইসেন্স') }}</p></div>
        </div>
      </div>
    </div>
  </section>

  {{-- 3. SERVICES GRID --}}
  <section class="py-20" aria-labelledby="services-title">
    <div class="container">
      <div class="mx-auto max-w-2xl text-center reveal">
        <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">Our Services</p>
        <h2 id="services-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('এক ছাদের নিচে সব সেবা') }}</h2>
        <p class="mt-3 text-slate-600">{{ __('আবেদন থেকে যাত্রা পর্যন্ত — অভিজ্ঞ টিম প্রতিটি ধাপে আপনার পাশে।') }}</p>
      </div>
      <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($services as $service)
          <a href="{{ route('services') }}#{{ $service->slug }}" class="lift group relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-7 shadow-soft hover:border-primary-200 hover:shadow-lift reveal">
            <span class="grid h-14 w-14 place-items-center rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 text-white shadow-soft"><i data-lucide="{{ $service->icon ?: 'briefcase' }}" class="h-7 w-7"></i></span>
            <h3 class="mt-5 text-xl font-bold">{{ t($service->title) }}</h3>
            <p class="mt-2 text-slate-600">{{ t($service->short_desc) }}</p>
            <span class="mt-5 inline-flex items-center gap-1.5 font-semibold text-primary-700">{{ __('বিস্তারিত') }} <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-1"></i></span>
          </a>
        @empty
          <p class="col-span-full text-center text-slate-500">{{ __('সেবার তালিকা শীঘ্রই আসছে।') }}</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 4. FEATURED PACKAGES --}}
  <section class="bg-white py-20" aria-labelledby="pkg-title" data-carousel>
    <div class="container">
      <div class="flex flex-wrap items-end justify-between gap-4 reveal">
        <div>
          <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">Featured Packages</p>
          <h2 id="pkg-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('জনপ্রিয় প্যাকেজসমূহ') }}</h2>
        </div>
        <div class="flex items-center gap-2">
          <button data-carousel-prev class="grid h-11 w-11 place-items-center rounded-full border border-slate-200 bg-white text-slate-700 transition hover:border-primary-300 hover:text-primary-700" aria-label="{{ __('আগের প্যাকেজ') }}"><i data-lucide="chevron-left" class="h-5 w-5"></i></button>
          <button data-carousel-next class="grid h-11 w-11 place-items-center rounded-full border border-slate-200 bg-white text-slate-700 transition hover:border-primary-300 hover:text-primary-700" aria-label="{{ __('পরের প্যাকেজ') }}"><i data-lucide="chevron-right" class="h-5 w-5"></i></button>
          <a href="{{ route('packages.index') }}" class="ml-2 hidden font-semibold text-primary-700 hover:underline sm:inline">{{ __('সব দেখুন') }} →</a>
        </div>
      </div>

      <div data-carousel-track class="no-scrollbar -mx-4 mt-10 flex snap-x snap-mandatory gap-6 overflow-x-auto px-4 pb-4">
        @forelse($featuredPackages as $pkg)
          @php $next = $pkg->departures->first(); $seatsLeft = $next ? max(0, ($next->seats_total ?? 0) - ($next->seats_booked ?? 0)) : null; @endphp
          <article class="lift group w-[300px] shrink-0 snap-start overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-soft hover:shadow-lift sm:w-[340px]">
            <div class="relative aspect-[4/3] overflow-hidden">
              <img src="{{ $pkg->cover_image ? asset('storage/'.$pkg->cover_image) : asset('assets/img/hero-makkah.jpg') }}" alt="{{ t($pkg->title) }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
              <span class="absolute left-3 top-3 rounded-full bg-primary-700 px-3 py-1 text-xs font-semibold text-white">{{ ['hajj'=>__('হজ্জ'),'umrah'=>__('উমরাহ'),'tour'=>__('ট্যুর')][$pkg->type] ?? __('প্যাকেজ') }}</span>
              @if(!is_null($seatsLeft) && $seatsLeft <= 15)
                <span class="absolute right-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-danger backdrop-blur">{{ __('মাত্র :countটি সিট বাকি', ['count' => $seatsLeft]) }}</span>
              @endif
            </div>
            <div class="p-5">
              <h3 class="text-lg font-bold leading-snug">{{ t($pkg->title) }}</h3>
              <ul class="mt-3 grid grid-cols-2 gap-2 text-sm text-slate-600">
                <li class="flex items-center gap-1.5"><i data-lucide="calendar-days" class="h-4 w-4 text-primary-600"></i>{{ $pkg->duration_days ? __(':count দিন', ['count' => $pkg->duration_days]) : '—' }}</li>
                <li class="flex items-center gap-1.5"><i data-lucide="plane" class="h-4 w-4 text-primary-600"></i>{{ $pkg->airline ?: __('এয়ার টিকেট সহ') }}</li>
              </ul>
              <div class="mt-4 flex items-end justify-between border-t border-slate-100 pt-4">
                <div><p class="text-xs text-slate-500">{{ __('শুরু') }}</p><p class="text-xl font-bold text-primary-800">{{ money($pkg->base_price) }}</p></div>
                <a href="{{ route('packages.show', $pkg->slug) }}" class="rounded-xl bg-primary-50 px-4 py-2.5 text-sm font-semibold text-primary-800 transition hover:bg-primary-700 hover:text-white">{{ __('বিস্তারিত') }}</a>
              </div>
            </div>
          </article>
        @empty
          <p class="text-slate-500">{{ __('কোনো ফিচার্ড প্যাকেজ পাওয়া যায়নি।') }} <a href="{{ route('packages.index') }}" class="font-semibold text-primary-700 hover:underline">{{ __('সব প্যাকেজ দেখুন') }}</a></p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 5. LATEST JOB DEMANDS --}}
  <section class="py-20" aria-labelledby="jobs-title">
    <div class="container">
      <div class="flex flex-wrap items-end justify-between gap-4 reveal">
        <div>
          <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">Job Demands</p>
          <h2 id="jobs-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('সর্বশেষ জব ডিমান্ড') }}</h2>
        </div>
        <a href="{{ route('jobs.index') }}" class="font-semibold text-primary-700 hover:underline">{{ __('সব জব দেখুন') }} →</a>
      </div>
      <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        @forelse($jobDemands as $job)
          <a href="{{ route('jobs.show', $job->slug) }}" class="lift group flex flex-col rounded-2xl border border-slate-100 bg-white p-5 shadow-soft hover:border-primary-200 hover:shadow-lift reveal">
            <div class="flex items-start justify-between">
              <div class="flex items-center gap-3">
                @if($job->country?->flag_code)
                  <img src="https://flagcdn.com/{{ $job->country->flag_code }}.svg" alt="{{ t($job->country->name) }} {{ __('পতাকা') }}" class="h-8 w-11 rounded object-cover ring-1 ring-slate-200" loading="lazy">
                @endif
                <div><p class="font-semibold">{{ $job->country ? t($job->country->name) : __('বিদেশ') }}</p><p class="text-xs text-slate-500">{{ $job->company_name }}</p></div>
              </div>
              <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-success">{{ __('চলমান') }}</span>
            </div>
            <h3 class="mt-4 text-lg font-bold group-hover:text-primary-700">{{ t($job->title) }}</h3>
            <p class="text-sm text-slate-500">{{ $job->category ? t($job->category->name) : '' }}{{ $job->contract_months ? ' · '.__(':years বছরের চুক্তি', ['years' => round($job->contract_months/12, 1)]) : '' }}</p>
            <dl class="mt-4 grid grid-cols-2 gap-3 text-sm">
              <div class="rounded-lg bg-slate-50 p-2.5"><dt class="text-xs text-slate-500">{{ __('পদ সংখ্যা') }}</dt><dd class="font-semibold">{{ __(':count জন', ['count' => $job->positions]) }}</dd></div>
              <div class="rounded-lg bg-slate-50 p-2.5"><dt class="text-xs text-slate-500">{{ __('বেতন (মাসিক)') }}</dt><dd class="font-semibold">{{ $job->salary_currency }} {{ number_format($job->salary_min) }}{{ $job->salary_max ? '–'.number_format($job->salary_max) : '+' }}</dd></div>
            </dl>
            @if($job->application_deadline)
              <span data-countdown="{{ $job->application_deadline->toIso8601String() }}" class="mt-4 inline-flex w-fit items-center gap-1.5 rounded-full border border-primary-100 bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-800"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>
            @endif
          </a>
        @empty
          <p class="col-span-full text-slate-500">{{ __('এই মুহূর্তে কোনো চলমান জব ডিমান্ড নেই।') }}</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 6. STUDY DESTINATIONS + INTAKES --}}
  <section class="relative overflow-hidden bg-primary-900 py-20 text-white" aria-labelledby="study-title">
    <div class="pattern-geo absolute inset-0" aria-hidden="true"></div>
    <div class="container relative grid gap-12 lg:grid-cols-12">
      <div class="lg:col-span-7">
        <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-accent-300">Study Abroad</p>
        <h2 id="study-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('উচ্চশিক্ষার জনপ্রিয় গন্তব্য') }}</h2>
        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3">
          @forelse($countries as $c)
            <a href="{{ route('study.index', ['country' => $c->id]) }}" class="lift group rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur hover:border-accent/50 hover:bg-white/10 reveal">
              @if($c->flag_code)<img src="https://flagcdn.com/{{ $c->flag_code }}.svg" alt="" class="h-9 w-12 rounded object-cover shadow" loading="lazy">@endif
              <p class="mt-3 font-semibold">{{ t($c->name) }}</p><p class="text-sm text-primary-200">{{ $c->universities_count ?? '' }}</p>
            </a>
          @empty
            <p class="col-span-full text-primary-200">{{ __('গন্তব্য তালিকা শীঘ্রই আসছে।') }}</p>
          @endforelse
        </div>
      </div>
      <div class="lg:col-span-5">
        <div class="rounded-2xl bg-white p-6 text-ink shadow-2xl reveal">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold">{{ __('আসন্ন ইনটেক') }}</h3>
            <i data-lucide="calendar-range" class="h-5 w-5 text-primary-700"></i>
          </div>
          <ul class="mt-4 divide-y divide-slate-100">
            @forelse($intakes as $in)
              <li class="flex items-center gap-4 py-3.5">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-primary-50 text-center font-en text-xs font-bold leading-tight text-primary-800">{{ $in->start_date ? $in->start_date->format('M').'<br>'.$in->start_date->format('Y') : '—' }}</span>
                <div class="min-w-0 flex-1"><p class="font-semibold">{{ $in->program ? t($in->program->university->name).' — '.t($in->intake_name) : t($in->intake_name) }}</p><p class="text-sm text-slate-500">{{ __('আবেদনের শেষ: :date', ['date' => $in->application_deadline?->format('d M Y')]) }}</p></div>
                @if($in->application_deadline)
                  <span data-countdown="{{ $in->application_deadline->toIso8601String() }}" class="shrink-0 rounded-full border border-primary-100 bg-primary-50 px-2.5 py-1 text-xs font-semibold text-primary-800"><span data-cd-label>…</span></span>
                @endif
              </li>
            @empty
              <li class="py-3.5 text-sm text-slate-500">{{ __('আসন্ন ইনটেকের তথ্য শীঘ্রই আসছে।') }}</li>
            @endforelse
          </ul>
          <a href="{{ route('study.index') }}" class="mt-4 flex h-11 items-center justify-center rounded-xl bg-primary-700 font-semibold text-white hover:bg-primary-800">{{ __('বিশ্ববিদ্যালয় খুঁজুন') }}</a>
        </div>
      </div>
    </div>
  </section>

  {{-- 7. UPCOMING DEADLINES BOARD --}}
  <section class="py-20" aria-labelledby="dl-title">
    <div class="container">
      <div class="flex flex-wrap items-end justify-between gap-4 reveal">
        <div>
          <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">Deadlines</p>
          <h2 id="dl-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('আসন্ন ডেডলাইন') }}</h2>
          <p class="mt-2 text-slate-600">{{ __('সময় থাকতে আবেদন করুন — ডেডলাইন মিস করবেন না।') }}</p>
        </div>
        <a href="{{ route('deadlines') }}" class="font-semibold text-primary-700 hover:underline">{{ __('সব ডেডলাইন') }} →</a>
      </div>
      <div class="mt-8 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-soft reveal">
        <ul class="divide-y divide-slate-100">
          @forelse($deadlines as $n)
            <li class="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:gap-5">
              <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="megaphone" class="h-6 w-6"></i></span>
              <div class="min-w-0 flex-1"><p class="font-semibold">{{ t($n->title) }}</p><p class="text-sm text-slate-500">{{ $n->type ?: __('নোটিশ') }}</p></div>
              @if($n->deadline_at)
                <span data-countdown="{{ $n->deadline_at->toIso8601String() }}" class="inline-flex w-fit items-center gap-1.5 rounded-full border border-primary-100 bg-primary-50 px-3 py-1.5 text-sm font-semibold text-primary-800"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>
              @endif
            </li>
          @empty
            <li class="p-5 text-slate-500">{{ __('এই মুহূর্তে কোনো আসন্ন ডেডলাইন নেই।') }}</li>
          @endforelse
        </ul>
      </div>
    </div>
  </section>

  {{-- 8. HOW IT WORKS --}}
  <section class="bg-white py-20" aria-labelledby="how-title">
    <div class="container">
      <div class="mx-auto max-w-2xl text-center reveal">
        <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">How it works</p>
        <h2 id="how-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('কীভাবে কাজ করি') }}</h2>
      </div>
      <ol class="relative mt-14 grid gap-8 md:grid-cols-5">
        <div class="absolute left-0 right-0 top-7 hidden h-0.5 bg-gradient-to-r from-primary-100 via-primary-300 to-accent-300 md:block" aria-hidden="true"></div>
        @foreach([['১',__('পরামর্শ'),__('ফোন বা অফিসে বিনামূল্যে পরামর্শ')],['২',__('ডকুমেন্ট জমা'),__('চেকলিস্ট অনুযায়ী কাগজপত্র যাচাই')],['৩',__('প্রসেসিং'),__('ফাইল প্রস্তুত ও সংশ্লিষ্ট দপ্তরে জমা')],['৪',__('ট্র্যাকিং'),__('ট্র্যাকিং কোড দিয়ে অনলাইনে আপডেট')],['৫',__('যাত্রা'),__('ব্রিফিং, টিকেট ও এয়ারপোর্ট সহায়তা')]] as $i => $s)
          <li class="relative text-center reveal">
            <span class="relative mx-auto grid h-14 w-14 place-items-center rounded-full {{ $i === 4 ? 'bg-accent text-ink' : 'bg-primary-700 text-white' }} text-lg font-bold ring-8 ring-white">{{ $s[0] }}</span>
            <h3 class="mt-4 font-bold">{{ $s[1] }}</h3><p class="mt-1 text-sm text-slate-600">{{ $s[2] }}</p>
          </li>
        @endforeach
      </ol>
    </div>
  </section>

  {{-- 9. TESTIMONIALS --}}
  <section class="py-20" aria-labelledby="t-title">
    <div class="container">
      <div class="mx-auto max-w-2xl text-center reveal">
        <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">Success Stories</p>
        <h2 id="t-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('যাদের পাশে ছিলাম') }}</h2>
      </div>
      <div class="mt-12 grid gap-6 lg:grid-cols-3">
        @forelse($testimonials as $tm)
          <figure class="rounded-2xl border border-slate-100 bg-white p-6 shadow-soft reveal">
            <div class="flex gap-0.5 text-accent">
              @for($s = 0; $s < 5; $s++)<i data-lucide="star" class="h-4 w-4 {{ $s < ($tm->rating ?? 5) ? 'fill-current' : '' }}"></i>@endfor
            </div>
            <blockquote class="mt-3 text-slate-700">“{{ t($tm->content) }}”</blockquote>
            <figcaption class="mt-5 flex items-center gap-3">
              <span class="grid h-11 w-11 place-items-center rounded-full bg-primary-100 font-bold text-primary-800">{{ mb_substr($tm->name, 0, 2) }}</span>
              <div><p class="font-semibold">{{ $tm->name }}</p><p class="text-sm text-slate-500">{{ $tm->designation }}{{ $tm->country ? ' · '.$tm->country : '' }}</p></div>
            </figcaption>
          </figure>
        @empty
          <p class="col-span-full text-center text-slate-500">{{ __('সাফল্যের গল্প শীঘ্রই আসছে।') }}</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 10. NEWS & NOTICES --}}
  <section class="bg-white py-20" aria-labelledby="news-title">
    <div class="container">
      <div class="flex flex-wrap items-end justify-between gap-4 reveal">
        <div>
          <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">News &amp; Notices</p>
          <h2 id="news-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('খবর ও নোটিশ') }}</h2>
        </div>
      </div>
      <div class="mt-10 grid gap-6 md:grid-cols-3">
        @forelse($notices as $n)
          <article class="group rounded-2xl border border-slate-100 bg-surface p-6 transition hover:bg-white hover:shadow-soft reveal">
            <div class="flex items-center gap-2 text-xs"><span class="rounded-full bg-danger/10 px-2.5 py-1 font-semibold text-danger">{{ $n->type ?: __('নোটিশ') }}</span><time class="text-slate-500" datetime="{{ $n->created_at->toDateString() }}">{{ $n->created_at->format('d M Y') }}</time></div>
            <h3 class="mt-3 text-lg font-bold leading-snug group-hover:text-primary-700">{{ t($n->title) }}</h3>
            <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ mb_substr(strip_tags(t($n->body ?? '')), 0, 140) }}</p>
          </article>
        @empty
          <p class="col-span-full text-slate-500">{{ __('এই মুহূর্তে কোনো খবর বা নোটিশ নেই।') }}</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 11. FAQ --}}
  <section class="py-20" aria-labelledby="faq-title">
    <div class="container grid gap-10 lg:grid-cols-12">
      <div class="lg:col-span-4 reveal">
        <p class="font-en text-sm font-semibold uppercase tracking-[0.18em] text-primary-700">FAQ</p>
        <h2 id="faq-title" class="mt-2 text-3xl font-bold sm:text-4xl">{{ __('সাধারণ জিজ্ঞাসা') }}</h2>
        <p class="mt-3 text-slate-600">{{ __('আপনার প্রশ্নের উত্তর না পেলে সরাসরি আমাদের সাথে কথা বলুন।') }}</p>
        <a href="{{ route('contact') }}" class="mt-6 inline-flex min-h-[44px] items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 font-semibold text-primary-700 hover:border-primary-300">{{ __('প্রশ্ন করুন') }} <i data-lucide="message-square" class="h-4 w-4"></i></a>
      </div>
      <div class="space-y-3 lg:col-span-8">
        @forelse($faqs as $faq)
          <details class="group rounded-2xl border border-slate-100 bg-white p-5 shadow-soft open:border-primary-200 reveal" @if($loop->first) open @endif>
            <summary class="flex items-center justify-between gap-4 font-semibold">{{ t($faq->question) }}<i data-lucide="chevron-down" class="h-5 w-5 shrink-0 text-primary-700 transition group-open:rotate-180"></i></summary>
            <p class="mt-3 text-slate-600">{{ t($faq->answer) }}</p>
          </details>
        @empty
          <p class="text-slate-500">{{ __('সাধারণ জিজ্ঞাসার তালিকা শীঘ্রই আসছে।') }}</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- 12. CTA band + contact form + map --}}
  <section id="contact" class="pb-20" aria-labelledby="cta-title">
    <div class="container">
      <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary-700 via-primary-800 to-navy-800 p-8 text-white shadow-lift sm:p-12">
        <div class="pattern-geo absolute inset-0" aria-hidden="true"></div>
        <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-accent/20 blur-3xl" aria-hidden="true"></div>
        <div class="relative grid gap-10 lg:grid-cols-2">
          <div>
            <h2 id="cta-title" class="font-serif text-3xl font-bold leading-snug sm:text-4xl">{{ __('আজই বিনামূল্যে পরামর্শ নিন') }}</h2>
            <p class="mt-3 max-w-md text-primary-100">{{ __('ফর্মটি পূরণ করুন অথবা সরাসরি কল করুন — আমাদের অভিজ্ঞ কাউন্সেলর আপনাকে সঠিক পথ দেখাবেন।') }}</p>
            <div class="mt-6 flex flex-wrap gap-3">
              <a href="tel:+8801700000000" class="inline-flex min-h-[48px] items-center gap-2 rounded-xl bg-white px-5 font-semibold text-primary-800 hover:bg-primary-50"><i data-lucide="phone" class="h-4 w-4"></i>০১৭০০-০০০০০০</a>
              <a href="https://wa.me/8801700000000" class="inline-flex min-h-[48px] items-center gap-2 rounded-xl bg-[#25D366] px-5 font-semibold text-white hover:brightness-110"><i data-lucide="message-circle" class="h-4 w-4"></i>{{ __('হোয়াটসঅ্যাপ') }}</a>
            </div>
            <div class="mt-8 overflow-hidden rounded-2xl ring-1 ring-white/20">
              <iframe title="{{ __('অফিসের লোকেশন — ধানমন্ডি, ঢাকা') }}" src="https://www.google.com/maps?q=Dhanmondi%20Dhaka&output=embed" class="h-56 w-full grayscale-[30%]" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <form method="POST" action="{{ route('inquiry.store') }}" class="rounded-2xl bg-white p-6 text-ink shadow-2xl sm:p-8">
            @csrf
            <input type="hidden" name="source" value="contact">
            <div class="grid gap-4 sm:grid-cols-2">
              <div class="sm:col-span-2">
                <label for="cf-name" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('আপনার নাম') }} <span class="text-danger">*</span></label>
                <input id="cf-name" name="name" required value="{{ old('name') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200">
              </div>
              <div>
                <label for="cf-phone" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('মোবাইল') }} <span class="text-danger">*</span></label>
                <input id="cf-phone" name="phone" type="tel" required placeholder="01XXXXXXXXX" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 font-en focus:border-primary-500 focus:ring-primary-200">
              </div>
              <div>
                <label for="cf-service" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('সেবা') }}</label>
                <select id="cf-service" name="service" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200">
                  @foreach([__('হজ্জ / উমরাহ'),__('বিদেশে চাকরি'),__('উচ্চশিক্ষা'),__('ভিসা'),__('ট্যুর')] as $opt)
                    <option value="{{ $opt }}" @selected(old('service') === $opt)>{{ $opt }}</option>
                  @endforeach
                </select>
              </div>
              <div class="sm:col-span-2">
                <label for="cf-msg" class="mb-1.5 block text-sm font-medium text-slate-700">{{ __('বার্তা') }}</label>
                <textarea id="cf-msg" name="message" rows="4" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:border-primary-500 focus:ring-primary-200" placeholder="{{ __('সংক্ষেপে আপনার প্রয়োজন লিখুন…') }}">{{ old('message') }}</textarea>
              </div>
            </div>
            <button class="mt-5 flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-accent font-semibold text-ink shadow-gold transition hover:bg-accent-400"><i data-lucide="send" class="h-4 w-4"></i>{{ __('পাঠিয়ে দিন') }}</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
