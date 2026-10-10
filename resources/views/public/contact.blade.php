@extends('layouts.public')
@section('title', __('যোগাযোগ'))
@section('activePage', 'contact')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">{{ __('common.home') }}</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">{{ __('contact.breadcrumb.current') }}</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">{{ __('contact.hero.title') }}</h1>
      <p class="mt-3 max-w-2xl text-navy-100">{{ __('contact.hero.subtitle') }}</p>
    </div>
  </section>

  <section class="py-12 border-b border-slate-200/60">
    <div class="container">
      <div class="grid md:grid-cols-2 gap-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
          <div class="flex items-center gap-3 mb-4">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary-100 text-primary-800"><i data-lucide="building-2" class="h-6 w-6"></i></span>
            <div>
              <span class="rounded-full bg-primary-50 px-2.5 py-0.5 text-xs font-bold text-primary-700">{{ __('contact.office.dhaka_badge') }}</span>
              <h2 class="text-xl font-bold text-ink">{{ __('contact.office.dhaka_title') }}</h2>
            </div>
          </div>
          <div class="space-y-3 text-sm text-slate-600">
            <p class="flex items-start gap-2.5"><i data-lucide="map-pin" class="h-4 w-4 text-primary-700 shrink-0 mt-1"></i><span>{{ __('contact.office.dhaka_addr') }}</span></p>
            <p class="flex items-center gap-2.5"><i data-lucide="phone" class="h-4 w-4 text-primary-700 shrink-0"></i><a href="tel:+8801700000000" class="font-bold text-primary-800 hover:underline">০১৭০০-০০০০০০, ০২-৯৮৭৬৫৪৩</a></p>
            <p class="flex items-center gap-2.5"><i data-lucide="mail" class="h-4 w-4 text-primary-700 shrink-0"></i><a href="mailto:dhaka@alsafar.com.bd" class="font-en hover:underline">dhaka@alsafar.com.bd</a></p>
            <p class="flex items-center gap-2.5"><i data-lucide="clock" class="h-4 w-4 text-primary-700 shrink-0"></i><span>{{ __('contact.office.dhaka_hours') }}</span></p>
          </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
          <div class="flex items-center gap-3 mb-4">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-navy-100 text-navy-800"><i data-lucide="building-2" class="h-6 w-6"></i></span>
            <div>
              <span class="rounded-full bg-navy-50 px-2.5 py-0.5 text-xs font-bold text-navy-700">{{ __('contact.office.ctg_badge') }}</span>
              <h2 class="text-xl font-bold text-ink">{{ __('contact.office.ctg_title') }}</h2>
            </div>
          </div>
          <div class="space-y-3 text-sm text-slate-600">
            <p class="flex items-start gap-2.5"><i data-lucide="map-pin" class="h-4 w-4 text-navy-700 shrink-0 mt-1"></i><span>{{ __('contact.office.ctg_addr') }}</span></p>
            <p class="flex items-center gap-2.5"><i data-lucide="phone" class="h-4 w-4 text-navy-700 shrink-0"></i><a href="tel:+8801700000001" class="font-bold text-navy-800 hover:underline">০১৭০০-০০০০০১, ০৩১-৭৬৫৪৩২</a></p>
            <p class="flex items-center gap-2.5"><i data-lucide="mail" class="h-4 w-4 text-navy-700 shrink-0"></i><a href="mailto:ctg@alsafar.com.bd" class="font-en hover:underline">ctg@alsafar.com.bd</a></p>
            <p class="flex items-center gap-2.5"><i data-lucide="clock" class="h-4 w-4 text-navy-700 shrink-0"></i><span>{{ __('contact.office.ctg_hours') }}</span></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="consult" class="py-16 scroll-mt-20">
    <div class="container grid lg:grid-cols-12 gap-10">
      <div class="lg:col-span-7">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft sm:p-8">
          <h2 class="font-serif text-2xl font-bold text-ink mb-1">{{ __('contact.form.title') }}</h2>
          <p class="text-sm text-slate-500 mb-6">{{ __('contact.form.subtitle') }}</p>
          @if(session('success'))
            <p class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4 text-sm font-semibold text-success">{{ session('success') }}</p>
          @endif
          <form method="POST" action="{{ route('inquiry.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="source" value="contact">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label for="c-name" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('contact.form.name') }} <span class="text-danger">*</span></label>
                <input id="c-name" name="name" type="text" required value="{{ old('name') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
                @error('name')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="c-phone" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('contact.form.phone') }} <span class="text-danger">*</span></label>
                <input id="c-phone" name="phone" type="tel" required placeholder="01XXXXXXXXX" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm font-en focus:border-primary-500">
                @error('phone')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
              </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label for="c-service" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('contact.form.service') }}</label>
                <select id="c-service" name="service" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
                  @foreach([__('হজ্জ'),__('উমরাহ'),__('ট্যুর প্যাকেজ'),__('ভিসা প্রসেসিং'),__('বিদেশে চাকরি'),__('উচ্চশিক্ষা'),__('এয়ার টিকেট')] as $opt)
                    <option value="{{ $opt }}" @selected(old('service') === $opt)>{{ $opt }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label for="c-country" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('contact.form.country') }}</label>
                <input id="c-country" name="country" type="text" value="{{ old('country') }}" placeholder="{{ __('contact.form.country_placeholder') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">
              </div>
            </div>
            <div>
              <label for="c-msg" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('contact.form.message') }}</label>
              <textarea id="c-msg" name="message" rows="4" placeholder="{{ __('contact.form.message_placeholder') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-primary-500">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="h-12 w-full rounded-xl bg-accent font-bold text-ink shadow-gold hover:bg-accent-400 transition flex items-center justify-center gap-2">
              <i data-lucide="send" class="h-4 w-4"></i> {{ __('contact.form.submit') }}
            </button>
          </form>
        </div>
      </div>

      <div class="lg:col-span-5 space-y-6">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-soft">
          <iframe title="ধানমন্ডি প্রধান কার্যালয় ম্যাপ" src="https://www.google.com/maps?q=Dhanmondi%20Dhaka&output=embed" class="h-64 w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <div class="p-4 bg-slate-50 text-xs text-slate-500">
            {{ __('contact.map.note') }}
          </div>
        </div>

        <div class="rounded-2xl border border-green-200 bg-green-50/70 p-6">
          <h3 class="font-bold text-green-900 flex items-center gap-2 mb-2">
            <i data-lucide="message-circle" class="h-5 w-5 text-[#128C7E]"></i> {{ __('contact.urgent.title') }}
          </h3>
          <p class="text-sm text-slate-700 mb-4">{{ __('contact.urgent.desc') }}</p>
          <a href="https://wa.me/8801700000000" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-[#25D366] px-5 py-2.5 text-sm font-bold text-white hover:brightness-105 transition">
            <i data-lucide="message-circle" class="h-4 w-4"></i> {{ __('contact.urgent.whatsapp') }}
          </a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
