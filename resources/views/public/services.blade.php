@extends('layouts.public')
@section('title', 'সেবাসমূহ — আল-সফর ট্রাভেলস')
@section('activePage', 'services')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">হোম</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">সেবাসমূহ</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">আমাদের সকল সেবা</h1>
      <p class="mt-3 max-w-2xl text-navy-100">হজ্জ কাফেলা থেকে শুরু করে বিদেশে চাকরি ও শিক্ষার্থী ভর্তি — আমাদের অভিজ্ঞ টিম আপনার প্রতিটি যাত্রায় বিশ্বস্ত সহযাত্রী।</p>
    </div>
  </section>

  <div class="container py-16 space-y-20">
    @forelse($services as $service)
      <section id="{{ $service->slug }}" class="scroll-mt-24 grid lg:grid-cols-2 gap-10 items-center">
        <div class="{{ $loop->even ? 'order-1 lg:order-2' : '' }}">
          <span class="inline-flex items-center gap-2 rounded-full bg-primary-100 px-3 py-1 text-xs font-bold text-primary-800 mb-3">{{ t($service->type) ?: 'সেবা' }}</span>
          <h2 class="font-serif text-3xl font-bold text-ink">{{ t($service->title) }}</h2>
          <p class="mt-4 text-slate-600 leading-relaxed">{{ t($service->body) ?: t($service->short_desc) }}</p>
          @if($service->slug === 'hajj' || $service->type === 'hajj')
            <div class="mt-8"><a href="{{ route('packages.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">হজ্জ ও উমরাহ প্যাকেজ দেখুন</a></div>
          @elseif($service->type === 'manpower' || $service->type === 'job')
            <div class="mt-8"><a href="{{ route('jobs.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">চলমান জব ডিমান্ড দেখুন</a></div>
          @elseif($service->type === 'study')
            <div class="mt-8"><a href="{{ route('study.index') }}" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">বিশ্ববিদ্যালয় ও প্রোগ্রামসমূহ</a></div>
          @else
            <div class="mt-8"><a href="{{ route('contact') }}#consult" class="rounded-xl bg-primary-700 px-5 py-2.5 font-semibold text-white hover:bg-primary-800 transition">পরামর্শের জন্য যোগাযোগ করুন</a></div>
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
      <p class="text-center text-slate-500">সেবার তালিকা শীঘ্রই আসছে।</p>
    @endforelse
  </div>
</main>
@endsection
