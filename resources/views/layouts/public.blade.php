<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস') . ' — হজ্জ, উমরাহ, বিদেশে চাকরি ও উচ্চশিক্ষা')</title>
  <meta name="description" content="@yield('meta_description', 'সরকার অনুমোদিত হজ্জ ও রিক্রুটিং এজেন্সি। হজ্জ-উমরাহ প্যাকেজ, ভিসা প্রসেসিং, বিদেশে চাকরি ও উচ্চশিক্ষায় বিশ্বস্ত সেবা — ঢাকা ও চট্টগ্রাম।')">
  <link rel="alternate" hreflang="bn" href="{{ url('/') }}">
  <link rel="alternate" hreflang="en" href="{{ url('/en') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Noto+Serif+Bengali:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  @stack('styles')
</head>
@php
  $activePage = $activePage ?? (trim($__env->yieldContent('activePage')) ?: 'home');
  $siteName   = t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস');
  $phone      = $settings['phone'] ?? '+8801700000000';
  $phoneLabel = $settings['phone_label'] ?? bn_digits($phone);
  $waRaw      = $settings['whatsapp'] ?? $phone;
  $whatsapp   = is_string($waRaw) && str_starts_with(trim($waRaw), 'http')
    ? trim($waRaw)
    : 'https://wa.me/' . ltrim(preg_replace('/\D+/', '', (string) $waRaw), '+');
  $facebook   = $settings['facebook'] ?? '#';
  $youtube    = $settings['youtube'] ?? '#';
  $instagram  = $settings['instagram'] ?? null;
  $email      = $settings['email'] ?? 'info@alsafar.com.bd';
  $addrMain   = t($settings['address_main'] ?? $settings['address'] ?? 'হাউস ১২, রোড ৫, ধানমন্ডি, ঢাকা-১২০৫');
  $addrCtg    = isset($settings['address_ctg']) ? t($settings['address_ctg']) : null;
  $hours      = t($settings['office_hours'] ?? 'শনি–বৃহঃ, সকাল ১০টা – সন্ধ্যা ৭টা');
  $isActive = fn ($key) => $activePage === $key;
  $navLink = fn ($key) => ($isActive($key) ? 'relative inline-flex items-center gap-1 rounded-lg px-3 py-2 text-[15px] font-medium transition-colors text-primary-700' : 'relative inline-flex items-center gap-1 rounded-lg px-3 py-2 text-[15px] font-medium transition-colors text-slate-700 hover:text-primary-700');
@endphp
<body data-page="{{ $activePage }}" class="bg-surface font-sans text-ink antialiased">

  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:shadow-lift">মূল কন্টেন্টে যান</a>

  <!-- Top bar -->
  <div class="hidden bg-navy text-[13px] text-navy-100 md:block">
    <div class="container flex h-10 items-center justify-between gap-4">
      <div class="flex items-center gap-5">
        <a href="tel:{{ $phone }}" class="inline-flex items-center gap-1.5 hover:text-white"><i data-lucide="phone" class="h-3.5 w-3.5"></i>{{ $phoneLabel }}</a>
        <a href="{{ $whatsapp }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-white"><i data-lucide="message-circle" class="h-3.5 w-3.5"></i>হোয়াটসঅ্যাপ</a>
        <span class="hidden items-center gap-1.5 lg:inline-flex"><i data-lucide="clock" class="h-3.5 w-3.5"></i>{{ $hours }}</span>
      </div>
      <div class="flex items-center gap-4">
        <a href="{{ route('track') }}" class="inline-flex items-center gap-1.5 font-medium text-accent-300 hover:text-accent-200"><i data-lucide="search-check" class="h-3.5 w-3.5"></i>আবেদন ট্র্যাক করুন</a>
        <span class="h-4 w-px bg-white/20"></span>
        <div class="inline-flex rounded-md bg-white/10 p-0.5" role="group" aria-label="ভাষা নির্বাচন">
          <button type="button" data-lang="bn" class="rounded px-2 py-0.5 font-medium">বাং</button>
          <button type="button" data-lang="en" class="rounded px-2 py-0.5 font-en font-medium">EN</button>
        </div>
        <a href="{{ $facebook }}" aria-label="Facebook" class="hover:text-white"><i data-lucide="facebook" class="h-4 w-4"></i></a>
        <a href="{{ $youtube }}" aria-label="YouTube" class="hover:text-white"><i data-lucide="youtube" class="h-4 w-4"></i></a>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/85 backdrop-blur-lg" data-sticky-header>
    <div class="container flex h-[72px] items-center justify-between gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0" aria-label="{{ $siteName }} — হোম">
        <span class="grid h-11 w-11 place-items-center rounded-xl bg-gradient-to-br from-primary-600 to-primary-800 text-white shadow-soft ring-1 ring-white/20">
          <svg viewBox="0 0 32 32" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017" stroke="#D4A017"/>
            <path d="M6 28h20"/>
          </svg>
        </span>
        <span class="leading-tight">
          <span class="block text-lg font-bold text-ink">{{ $siteName }}</span>
          <span class="block font-en text-[11px] font-medium uppercase tracking-[0.14em] text-primary-700">Travels &amp; Overseas</span>
        </span>
      </a>
      <nav class="hidden items-center gap-0.5 xl:flex" aria-label="প্রধান মেনু">
        <a href="{{ route('home') }}" class="{{ $navLink('home') }}" @if($isActive('home')) aria-current="page" @endif>হোম@if($isActive('home'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <div class="group relative">
          <a href="{{ route('services') }}" class="{{ $navLink('services') }}" aria-haspopup="true">সেবাসমূহ<i data-lucide="chevron-down" class="h-4 w-4 transition-transform group-hover:rotate-180"></i>@if($isActive('services'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
          <div class="invisible absolute left-0 top-full z-40 w-72 translate-y-2 pt-3 opacity-0 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100">
            <div class="rounded-2xl border border-slate-100 bg-white p-2 shadow-lift">
              @if(!empty($services) && count($services))
                @foreach($services as $svc)
                  <a href="{{ route('services') }}#{{ is_object($svc) ? $svc->slug : ($svc['slug'] ?? '') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="{{ is_object($svc) ? ($svc->icon ?? 'briefcase') : ($svc['icon'] ?? 'briefcase') }}" class="h-[18px] w-[18px]"></i></span>{{ is_object($svc) ? t($svc->title) : ($svc['label'] ?? '') }}
                  </a>
                @endforeach
              @else
                <a href="{{ route('services') }}#hajj" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="moon-star" class="h-[18px] w-[18px]"></i></span>হজ্জ ও উমরাহ
                </a>
                <a href="{{ route('services') }}#tour" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="tree-palm" class="h-[18px] w-[18px]"></i></span>ট্যুর প্যাকেজ
                </a>
                <a href="{{ route('services') }}#ticket" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="plane" class="h-[18px] w-[18px]"></i></span>এয়ার টিকেট
                </a>
                <a href="{{ route('services') }}#visa" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="stamp" class="h-[18px] w-[18px]"></i></span>ভিসা প্রসেসিং
                </a>
                <a href="{{ route('services') }}#manpower" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="briefcase" class="h-[18px] w-[18px]"></i></span>বিদেশে চাকরি (ম্যানপাওয়ার)
                </a>
                <a href="{{ route('services') }}#study" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                  <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="graduation-cap" class="h-[18px] w-[18px]"></i></span>বিদেশে উচ্চশিক্ষা
                </a>
              @endif
            </div>
          </div>
        </div>
        <a href="{{ route('packages.index') }}" class="{{ $navLink('packages') }}" @if($isActive('packages')) aria-current="page" @endif>প্যাকেজ@if($isActive('packages'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <a href="{{ route('jobs.index') }}" class="{{ $navLink('jobs') }}" @if($isActive('jobs')) aria-current="page" @endif>বিদেশে চাকরি@if($isActive('jobs'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <a href="{{ route('study.index') }}" class="{{ $navLink('study') }}" @if($isActive('study')) aria-current="page" @endif>বিদেশে পড়াশোনা@if($isActive('study'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <a href="{{ route('deadlines') }}" class="{{ $navLink('deadlines') }}" @if($isActive('deadlines')) aria-current="page" @endif>ডেডলাইন@if($isActive('deadlines'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <a href="{{ route('about') }}" class="{{ $navLink('about') }}" @if($isActive('about')) aria-current="page" @endif>আমাদের সম্পর্কে@if($isActive('about'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
        <a href="{{ route('contact') }}" class="{{ $navLink('contact') }}" @if($isActive('contact')) aria-current="page" @endif>যোগাযোগ@if($isActive('contact'))<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>@endif</a>
      </nav>
      <div class="flex items-center gap-2">
        <a href="{{ route('contact') }}#consult" class="hidden items-center gap-2 rounded-xl bg-accent px-5 py-2.5 text-[15px] font-semibold text-ink shadow-gold transition hover:-translate-y-0.5 hover:bg-accent-400 sm:inline-flex">
          <i data-lucide="calendar-check" class="h-4 w-4"></i>ফ্রি পরামর্শ
        </a>
        <button type="button" class="grid h-11 w-11 place-items-center rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 xl:hidden" data-toggle="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="মেনু খুলুন">
          <i data-lucide="menu" class="h-5 w-5"></i>
        </button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden max-h-[calc(100vh-72px)] overflow-y-auto border-t border-slate-100 bg-white xl:hidden">
      <div class="container space-y-1 py-4">
        <a href="{{ route('home') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('home') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">হোম<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('services') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('services') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">সেবাসমূহ<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <div class="mb-1 ml-4 grid grid-cols-2 gap-1 border-l border-slate-100 pl-3">
          <a href="{{ route('services') }}#hajj" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">হজ্জ ও উমরাহ</a>
          <a href="{{ route('services') }}#tour" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">ট্যুর প্যাকেজ</a>
          <a href="{{ route('services') }}#ticket" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">এয়ার টিকেট</a>
          <a href="{{ route('services') }}#visa" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">ভিসা প্রসেসিং</a>
          <a href="{{ route('services') }}#manpower" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">ম্যানপাওয়ার</a>
          <a href="{{ route('services') }}#study" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">উচ্চশিক্ষা</a>
        </div>
        <a href="{{ route('packages.index') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('packages') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">প্যাকেজ<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('jobs.index') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('jobs') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">বিদেশে চাকরি<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('study.index') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('study') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">বিদেশে পড়াশোনা<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('deadlines') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('deadlines') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">ডেডলাইন<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('about') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('about') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">আমাদের সম্পর্কে<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <a href="{{ route('contact') }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium {{ $isActive('contact') ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50' }}">যোগাযোগ<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i></a>
        <div class="flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
          <div class="inline-flex rounded-lg bg-slate-100 p-1" role="group" aria-label="ভাষা নির্বাচন">
            <button type="button" data-lang="bn" class="rounded-md px-3 py-1.5 text-sm font-medium">বাং</button>
            <button type="button" data-lang="en" class="rounded-md px-3 py-1.5 font-en text-sm font-medium">EN</button>
          </div>
          <a href="{{ route('track') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-700"><i data-lucide="search-check" class="h-4 w-4"></i>আবেদন ট্র্যাক</a>
        </div>
        <a href="{{ route('contact') }}#consult" class="mt-3 flex items-center justify-center gap-2 rounded-xl bg-accent px-5 py-3 font-semibold text-ink">ফ্রি পরামর্শ নিন</a>
      </div>
    </div>
  </header>

  @if(session('success') || session('error'))
    <div class="container pt-4">
      @if(session('success'))
        <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="alert"><i data-lucide="check-circle" class="mt-0.5 h-4 w-4 shrink-0"></i><span>{{ session('success') }}</span></div>
      @endif
      @if(session('error'))
        <div class="mt-2 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert"><i data-lucide="alert-circle" class="mt-0.5 h-4 w-4 shrink-0"></i><span>{{ session('error') }}</span></div>
      @endif
    </div>
  @endif

  <main id="main">
    @yield('content')
  </main>

  <footer class="relative mt-0 overflow-hidden bg-navy-900 text-navy-100">
    <div class="pattern-geo absolute inset-0 opacity-60" aria-hidden="true"></div>
    <div class="container relative grid gap-10 py-16 md:grid-cols-2 lg:grid-cols-12">
      <div class="lg:col-span-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0" aria-label="{{ $siteName }} — হোম">
          <span class="grid h-11 w-11 place-items-center rounded-xl bg-gradient-to-br from-primary-600 to-primary-800 text-white shadow-soft ring-1 ring-white/20">
            <svg viewBox="0 0 32 32" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017" stroke="#D4A017"/>
              <path d="M6 28h20"/>
            </svg>
          </span>
          <span class="leading-tight">
            <span class="block text-lg font-bold text-white">{{ $siteName }}</span>
            <span class="block font-en text-[11px] font-medium uppercase tracking-[0.14em] text-primary-200">Travels &amp; Overseas</span>
          </span>
        </a>
        <p class="mt-5 max-w-sm text-sm leading-7 text-navy-200">২০০৯ সাল থেকে হজ্জ, উমরাহ, ভিসা, বিদেশে চাকরি ও উচ্চশিক্ষায় হাজারো পরিবারের বিশ্বস্ত সঙ্গী। আপনার কাগজপত্র আমাদের কাছে নিরাপদ।</p>
        <div class="mt-6 space-y-2 rounded-xl border border-white/10 bg-white/5 p-4 text-[13px]">
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>{{ $settings['license_hajj'] ?? $settings['hajj_license'] ?? 'হজ্জ লাইসেন্স নং: HL-1234 (ধর্ম বিষয়ক মন্ত্রণালয়)' }}</span></p>
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>{{ $settings['license_recruiting'] ?? $settings['recruiting_license'] ?? 'রিক্রুটিং লাইসেন্স: RL-0987 (BMET)' }}</span></p>
          @if(!empty($settings['atab_no']))
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>IATA / ATAB সদস্য: <b class="font-en text-white">{{ $settings['atab_no'] }}</b></span></p>
          @endif
        </div>
      </div>
      <div class="lg:col-span-2">
        <h2 class="text-base font-semibold text-white">দ্রুত লিংক</h2>
        <ul class="mt-4 space-y-2.5 text-sm">
          <li><a class="hover:text-accent-300" href="{{ route('packages.index') }}">প্যাকেজসমূহ</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('jobs.index') }}">জব ডিমান্ড</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('deadlines') }}">আসন্ন ডেডলাইন</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('track') }}">আবেদন ট্র্যাক</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('about') }}">আমাদের সম্পর্কে</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('contact') }}">যোগাযোগ</a></li>
        </ul>
      </div>
      <div class="lg:col-span-2">
        <h2 class="text-base font-semibold text-white">সেবাসমূহ</h2>
        <ul class="mt-4 space-y-2.5 text-sm">
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#hajj">হজ্জ ও উমরাহ</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#tour">ট্যুর প্যাকেজ</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#ticket">এয়ার টিকেট</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#visa">ভিসা প্রসেসিং</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#manpower">ম্যানপাওয়ার</a></li>
          <li><a class="hover:text-accent-300" href="{{ route('services') }}#study">উচ্চশিক্ষা</a></li>
        </ul>
      </div>
      <div class="lg:col-span-4">
        <h2 class="text-base font-semibold text-white">আমাদের অফিস</h2>
        <div class="mt-4 space-y-4 text-sm">
          <p class="flex gap-3"><i data-lucide="map-pin" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><span><b class="text-white">প্রধান কার্যালয়:</b> {{ $addrMain }}</span></p>
          @if($addrCtg)
          <p class="flex gap-3"><i data-lucide="map-pin" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><span><b class="text-white">চট্টগ্রাম শাখা:</b> {{ $addrCtg }}</span></p>
          @endif
          <p class="flex gap-3"><i data-lucide="phone" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><a href="tel:{{ $phone }}" class="hover:text-white">{{ $phoneLabel }}</a></p>
          <p class="flex gap-3"><i data-lucide="mail" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><a href="mailto:{{ $email }}" class="font-en hover:text-white">{{ $email }}</a></p>
        </div>
        <div class="mt-6 flex gap-2">
          <a href="{{ $facebook }}" aria-label="Facebook" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="facebook" class="h-5 w-5"></i></a>
          <a href="{{ $youtube }}" aria-label="YouTube" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="youtube" class="h-5 w-5"></i></a>
          <a href="{{ $whatsapp }}" aria-label="WhatsApp" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="message-circle" class="h-5 w-5"></i></a>
          @if($instagram)
          <a href="{{ $instagram }}" aria-label="Instagram" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="instagram" class="h-5 w-5"></i></a>
          @endif
        </div>
      </div>
    </div>
    <div class="relative border-t border-white/10">
      <div class="container flex flex-col gap-3 py-6 pb-24 text-xs text-navy-300 md:flex-row md:items-center md:justify-between md:pb-6">
        <p>© <span data-year></span> {{ $siteName }}। সর্বস্বত্ব সংরক্ষিত।</p>
        <p class="max-w-2xl md:text-right"><b class="text-navy-100">দাবিত্যাগ:</b> ভিসা ও চাকরির চূড়ান্ত সিদ্ধান্ত সংশ্লিষ্ট দূতাবাস/নিয়োগকর্তার এখতিয়ারভুক্ত। আমরা কোনো ভিসা বা চাকরির নিশ্চয়তা প্রদান করি না।</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp + Call (desktop) -->
  <div class="fixed bottom-6 right-6 z-40 hidden flex-col gap-3 md:flex">
    <a href="tel:{{ $phone }}" aria-label="কল করুন" class="grid h-14 w-14 place-items-center rounded-full bg-primary-700 text-white shadow-lift transition hover:scale-105"><i data-lucide="phone" class="h-6 w-6"></i></a>
    <a href="{{ $whatsapp }}" target="_blank" rel="noopener" aria-label="হোয়াটসঅ্যাপে মেসেজ" class="relative grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-lift transition hover:scale-105">
      <span class="absolute inset-0 animate-ping rounded-full bg-[#25D366] opacity-30"></span>
      <svg viewBox="0 0 24 24" class="relative h-7 w-7" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.7.1-.2.3-.8.9-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.2-.5-2.3-1.4-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6l.4-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.4-.1-.1-.3-.2-.6-.3zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4C2.7 15.6 2.2 13.8 2.2 12 2.2 6.6 6.6 2.2 12 2.2S21.8 6.6 21.8 12 17.4 21.8 12 21.8zM12 0C5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12S18.6 0 12 0z"/></svg>
    </a>
  </div>

  <!-- Mobile sticky bottom bar: Call | WhatsApp | Inquiry -->
  <nav class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-3 border-t border-slate-200 bg-white/95 pb-[env(safe-area-inset-bottom)] backdrop-blur md:hidden" aria-label="দ্রুত যোগাযোগ">
    <a href="tel:{{ $phone }}" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 text-xs font-medium text-primary-700"><i data-lucide="phone" class="h-5 w-5"></i>কল</a>
    <a href="{{ $whatsapp }}" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 border-x border-slate-100 text-xs font-medium text-[#128C7E]"><i data-lucide="message-circle" class="h-5 w-5"></i>হোয়াটসঅ্যাপ</a>
    <a href="{{ route('contact') }}#consult" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 bg-accent text-xs font-semibold text-ink"><i data-lucide="send" class="h-5 w-5"></i>ইনকোয়ারি</a>
  </nav>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script>if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.9 } });</script>
  @stack('scripts')
</body>
</html>
