@extends('layouts.public')
@section('title', 'আবেদন ট্র্যাক করুন (Track Application) — আল-সফর ট্রাভেলস')
@section('activePage', 'track')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10 text-center max-w-2xl mx-auto">
      <span class="inline-flex items-center gap-1.5 rounded-full border border-white/20 bg-white/10 px-3.5 py-1 text-xs backdrop-blur mb-4">
        <i data-lucide="shield-check" class="h-3.5 w-3.5 text-accent"></i> নিরাপদ ট্র্যাকিং সিস্টেম
      </span>
      <h1 class="font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">আবেদনের অগ্রগতি ট্র্যাক করুন</h1>
      <p class="mt-3 text-navy-100 text-base">আপনার মোবাইল নম্বর এবং এসএমএসে প্রাপ্ত ট্র্যাকিং কোড দিয়ে ফাইলের বর্তমান অবস্থা ও পরবর্তী ধাপ জেনে নিন।</p>
    </div>
  </section>

  <section class="py-12">
    <div class="container max-w-3xl">
      <form method="GET" action="{{ route('track.result') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft sm:p-8 mb-8">
        <h2 class="text-xl font-bold text-ink mb-1">তথ্য দিন</h2>
        <p class="text-sm text-slate-500 mb-6">আবেদনের সময় দেওয়া মোবাইল নম্বর ও ট্র্যাকিং কোড (যেমন TA-2026-000123) লিখুন।</p>
        @if($errors->any())
          <p class="mb-4 rounded-xl bg-red-50 border border-red-200 p-3 text-sm font-semibold text-danger">{{ $errors->first() }}</p>
        @endif
        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label for="track-phone" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">রেজিস্টার্ড মোবাইল নম্বর <span class="text-danger">*</span></label>
            <div class="relative">
              <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 font-en text-sm text-slate-400">+88</span>
              <input id="track-phone" name="phone" type="tel" required placeholder="01XXXXXXXXX" value="{{ request('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 pl-12 font-en text-sm focus:border-primary-500 focus:ring-primary-200">
            </div>
          </div>
          <div>
            <label for="track-code" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">ট্র্যাকিং কোড (Tracking Code) <span class="text-danger">*</span></label>
            <input id="track-code" name="tracking_code" type="text" required placeholder="TA-2026-XXXXXX" value="{{ request('tracking_code') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 font-en text-sm uppercase tracking-wider focus:border-primary-500 focus:ring-primary-200">
          </div>
        </div>
        <button type="submit" class="mt-6 flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-primary-700 font-semibold text-white shadow-soft transition hover:bg-primary-800">
          <i data-lucide="search" class="h-4 w-4"></i> স্ট্যাটাস অনুসন্ধান করুন
        </button>
      </form>

      <div class="rounded-xl bg-slate-50 p-4 border border-slate-200 flex items-start gap-3">
        <i data-lucide="info" class="h-5 w-5 text-primary-700 shrink-0 mt-0.5"></i>
        <p class="text-xs text-slate-600 leading-relaxed">
          ট্র্যাকিং কোড হারিয়ে গেলে বা কোনো অমিল দেখা দিলে হেল্পলাইনে কল করুন <a href="tel:+8801700000000" class="font-bold text-primary-800 underline">০১৭০০-০০০০০০</a>।
        </p>
      </div>
    </div>
  </section>
</main>
@endsection
