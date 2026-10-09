@extends('layouts.public')
@section('title', t($package->title).' — আল-সফর ট্রাভেলস')
@section('activePage', 'packages')
@section('content')
<main id="main" class="py-8 lg:py-12">
  <div class="container">
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="hover:text-primary-700">হোম</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <a href="{{ route('packages.index') }}" class="hover:text-primary-700">প্যাকেজসমূহ</a>
      <i data-lucide="chevron-right" class="h-4 w-4"></i>
      <span class="text-slate-800 font-medium">{{ t($package->title) }}</span>
    </nav>

    <div class="flex flex-wrap items-start justify-between gap-4 border-b border-slate-200 pb-6 mb-8">
      <div>
        <div class="flex items-center gap-2.5 mb-2">
          <span class="rounded-full bg-primary-700 px-3 py-1 text-xs font-semibold text-white">{{ ['hajj'=>'হজ্জ','umrah'=>'উমরাহ','tour'=>'ট্যুর'][$package->type] ?? 'প্যাকেজ' }}</span>
          @if($package->is_featured)<span class="rounded-full bg-accent/20 px-3 py-1 text-xs font-bold text-ink">জনপ্রিয় প্যাকেজ</span>@endif
        </div>
        <h1 class="font-serif text-3xl font-bold sm:text-4xl text-ink">{{ t($package->title) }}</h1>
        <p class="mt-2 text-slate-600 flex items-center gap-2"><i data-lucide="map-pin" class="h-4 w-4 text-primary-700"></i> {{ $package->duration_days ? $package->duration_days.' দিন' : '' }} {{ $package->airline ? '· '.$package->airline : '' }}</p>
      </div>
      <div class="rounded-2xl bg-primary-50 p-4 border border-primary-100 text-right">
        <p class="text-xs text-primary-800 font-semibold uppercase">প্যাকেজ মূল্য (জনপ্রতি)</p>
        <p class="text-3xl font-bold text-primary-900">{{ money($package->base_price) }}</p>
        @if(t($package->price_note))<p class="text-xs text-slate-500 mt-1">{{ t($package->price_note) }}</p>@endif
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-10">
      <div class="md:col-span-2 md:row-span-2 overflow-hidden rounded-2xl">
        <img src="{{ $package->cover_image ? asset('storage/'.$package->cover_image) : asset('assets/img/hero-makkah.jpg') }}" alt="{{ t($package->title) }}" class="h-full w-full object-cover min-h-[320px]">
      </div>
      @forelse($package->media->take(4) as $m)
        <div class="overflow-hidden rounded-2xl"><img src="{{ asset('storage/'.$m->path) }}" alt="{{ t($package->title) }}" loading="lazy" class="h-48 w-full object-cover"></div>
      @empty
        <div class="overflow-hidden rounded-2xl"><img src="{{ asset('assets/img/madinah.jpg') }}" alt="প্যাকেজ ছবি" loading="lazy" class="h-48 w-full object-cover"></div>
        <div class="overflow-hidden rounded-2xl"><img src="{{ asset('assets/img/malaysia.jpg') }}" alt="প্যাকেজ ছবি" loading="lazy" class="h-48 w-full object-cover"></div>
      @endforelse
    </div>

    <div class="grid gap-10 lg:grid-cols-12 items-start">
      <div class="lg:col-span-8" data-tabs>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-5 rounded-2xl bg-white border border-slate-100 shadow-soft mb-8">
          <div class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="clock" class="h-5 w-5"></i></span>
            <div><p class="text-xs text-slate-500">সময়কাল</p><p class="font-bold text-ink">{{ $package->duration_days ? $package->duration_days.' দিন' : '—' }}</p></div>
          </div>
          <div class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="plane" class="h-5 w-5"></i></span>
            <div><p class="text-xs text-slate-500">এয়ারলাইন্স</p><p class="font-bold text-ink">{{ $package->airline ?: '—' }}</p></div>
          </div>
          <div class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="building" class="h-5 w-5"></i></span>
            <div><p class="text-xs text-slate-500">হোটেল</p><p class="font-bold text-ink">{{ $package->hotel_info ? mb_substr(is_array($package->hotel_info) ? t($package->hotel_info) : $package->hotel_info, 0, 20) : '—' }}</p></div>
          </div>
          <div class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-primary-50 text-primary-700"><i data-lucide="tag" class="h-5 w-5"></i></span>
            <div><p class="text-xs text-slate-500">মূল্য</p><p class="font-bold text-ink">{{ money($package->base_price) }}</p></div>
          </div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 shadow-soft p-6 sm:p-8 space-y-8">
          <div>
            <h2 class="text-xl font-bold mb-3">বিবরণ</h2>
            <div class="prose max-w-none text-slate-600">{!! nl2br(e(t($package->description) ?: t($package->summary))) !!}</div>
          </div>
          @if($package->itinerary)
            <div>
              <h2 class="text-xl font-bold mb-3">আইটিনারি</h2>
              <ol class="space-y-3 text-slate-600 list-decimal list-inside">
                @foreach((array) (is_array($package->itinerary) ? (array_values($package->itinerary) === $package->itinerary ? $package->itinerary : [$package->itinerary]) : []) as $item)
                  <li>{{ is_array($item) ? t($item) : $item }}</li>
                @endforeach
              </ol>
            </div>
          @endif
          <div class="grid sm:grid-cols-2 gap-6">
            @if($package->inclusions)
              <div>
                <h2 class="text-xl font-bold mb-3">যা অন্তর্ভুক্ত</h2>
                <ul class="space-y-2 text-sm text-slate-700">
                  @foreach((array) $package->inclusions as $inc)
                    <li class="flex items-center gap-2"><i data-lucide="check" class="h-4 w-4 text-success shrink-0"></i>{{ is_array($inc) ? t($inc) : $inc }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if($package->exclusions)
              <div>
                <h2 class="text-xl font-bold mb-3">যা অন্তর্ভুক্ত নয়</h2>
                <ul class="space-y-2 text-sm text-slate-700">
                  @foreach((array) $package->exclusions as $exc)
                    <li class="flex items-center gap-2"><i data-lucide="x" class="h-4 w-4 text-danger shrink-0"></i>{{ is_array($exc) ? t($exc) : $exc }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>

        @if($package->departures->isNotEmpty())
          <div class="mt-8 rounded-2xl bg-white border border-slate-100 shadow-soft p-6 sm:p-8">
            <h2 class="text-xl font-bold mb-4">আসন্ন যাত্রা (Departures)</h2>
            <div class="overflow-x-auto">
              <table class="w-full text-sm">
                <thead><tr class="text-left text-xs text-slate-500 uppercase"><th class="pb-3">যাত্রা</th><th class="pb-3">ফেরত</th><th class="pb-3">সিট বাকি</th><th class="pb-3">মূল্য</th><th class="pb-3">বুকিং শেষ</th></tr></thead>
                <tbody class="divide-y divide-slate-100">
                  @foreach($package->departures as $d)
                    <tr>
                      <td class="py-3 font-semibold">{{ $d->departure_date->format('d M Y') }}</td>
                      <td class="py-3">{{ $d->return_date?->format('d M Y') ?: '—' }}</td>
                      <td class="py-3">{{ max(0, ($d->seats_total ?? 0) - ($d->seats_booked ?? 0)) }}</td>
                      <td class="py-3 font-semibold">{{ $d->price ? money($d->price) : money($package->base_price) }}</td>
                      <td class="py-3">@if($d->booking_deadline)<span data-countdown="{{ $d->booking_deadline->toIso8601String() }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary-800"><span class="cd-dot h-1.5 w-1.5 rounded-full bg-primary-600"></span><span data-cd-label>…</span></span>@else — @endif</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </div>

      <aside class="lg:col-span-4">
        <form method="POST" action="{{ route('inquiry.store') }}" class="rounded-2xl bg-white border border-slate-200 p-6 shadow-soft lg:sticky lg:top-6">
          @csrf
          <input type="hidden" name="source" value="web_form">
          <input type="hidden" name="service" value="প্যাকেজ: {{ t($package->title) }}">
          <h3 class="text-lg font-bold">এই প্যাকেজে বুকিং করুন</h3>
          <p class="text-sm text-slate-500 mt-1">ফর্ম পূরণ করুন, আমরা কল করে বুকিং নিশ্চিত করব।</p>
          @if(session('success'))<p class="mt-3 rounded-xl bg-green-50 p-3 text-sm font-semibold text-success">{{ session('success') }}</p>@endif
          <div class="mt-4 space-y-3">
            <input name="name" required placeholder="আপনার নাম" value="{{ old('name') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm">
            <input name="phone" type="tel" required placeholder="01XXXXXXXXX" value="{{ old('phone') }}" class="h-12 w-full rounded-xl border-slate-200 bg-slate-50 text-sm font-en">
            <textarea name="message" rows="3" placeholder="বার্তা (ঐচ্ছিক)" class="w-full rounded-xl border-slate-200 bg-slate-50 text-sm">{{ old('message') }}</textarea>
            <button class="h-12 w-full rounded-xl bg-primary-700 font-semibold text-white hover:bg-primary-800">বুকিং অনুরোধ পাঠান</button>
          </div>
        </form>
      </aside>
    </div>

    @if($related->isNotEmpty())
      <div class="mt-16">
        <h2 class="text-2xl font-bold">সম্পর্কিত প্যাকেজ</h2>
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          @foreach($related as $rel)
            <article class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-soft">
              <img src="{{ $rel->cover_image ? asset('storage/'.$rel->cover_image) : asset('assets/img/hero-makkah.jpg') }}" alt="{{ t($rel->title) }}" loading="lazy" class="aspect-[4/3] w-full object-cover">
              <div class="p-5">
                <h3 class="font-bold">{{ t($rel->title) }}</h3>
                <div class="mt-3 flex items-center justify-between">
                  <p class="font-bold text-primary-800">{{ money($rel->base_price) }}</p>
                  <a href="{{ route('packages.show', $rel->slug) }}" class="text-sm font-semibold text-primary-700 hover:underline">বিস্তারিত →</a>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</main>
@endsection
