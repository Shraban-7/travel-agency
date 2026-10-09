@extends('layouts.public')
@section('title', 'ট্র্যাকিং ফলাফল — আল-সফর ট্রাভেলস')
@section('activePage', 'track')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-12 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10 text-center max-w-2xl mx-auto">
      <h1 class="font-serif text-3xl font-bold">আবেদনের স্ট্যাটাস</h1>
    </div>
  </section>

  <section class="py-12">
    <div class="container max-w-3xl">
      @if(isset($error))
        <div class="rounded-2xl border border-red-200 bg-white p-6 sm:p-8 shadow-soft text-center">
          <span class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-red-50 text-danger"><i data-lucide="search-x" class="h-7 w-7"></i></span>
          <h2 class="mt-4 text-xl font-bold">কোনো আবেদন পাওয়া যায়নি</h2>
          <p class="mt-2 text-sm text-slate-600">{{ $error }}</p>
          <a href="{{ route('track') }}" class="mt-6 inline-flex h-11 items-center gap-2 rounded-xl bg-primary-700 px-6 text-sm font-semibold text-white hover:bg-primary-800"><i data-lucide="rotate-ccw" class="h-4 w-4"></i> আবার চেষ্টা করুন</a>
        </div>
      @else
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft sm:p-8">
          <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-6 mb-6">
            <div>
              <div class="flex items-center gap-2 mb-1">
                <span class="font-en font-bold text-sm text-primary-800 bg-primary-50 px-2.5 py-0.5 rounded-md border border-primary-100">{{ $application->tracking_code }}</span>
                <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-xs font-bold text-ink">{{ $application->status_label ?: $application->status }}</span>
              </div>
              <h3 class="text-2xl font-bold text-ink">{{ $application->client?->full_name_bn ?: $application->client?->full_name }}</h3>
              <p class="text-sm text-slate-500 mt-0.5">
                মোবাইল: <span class="font-en font-semibold text-slate-700">{{ maskString($application->client?->phone ?? '') }}</span>
                @if($application->country) · {{ t($application->country->name) }}@endif
              </p>
            </div>
            <div class="flex gap-2">
              <a href="https://wa.me/8801700000000" target="_blank" class="inline-flex items-center gap-1.5 rounded-xl border border-green-300 bg-green-50 px-4 py-2.5 text-sm font-bold text-[#128C7E] hover:bg-green-100 transition">
                <i data-lucide="message-circle" class="h-4 w-4"></i> দায়িত্বপ্রাপ্ত কর্মকর্তার সাথে কথা বলুন
              </a>
            </div>
          </div>

          <h4 class="text-base font-bold text-ink mb-6">অগ্রগতি টাইমলাইন (Status Timeline)</h4>
          @if($application->statusLogs->isNotEmpty())
            <div class="space-y-6 border-l-2 border-primary-200 pl-6 ml-3">
              @foreach($application->statusLogs as $log)
                <div class="relative">
                  @if($loop->last)
                    <span class="absolute -left-[31px] top-1 grid h-4 w-4 place-items-center rounded-full bg-accent ring-4 ring-accent-100 text-ink"><i data-lucide="clock" class="h-2.5 w-2.5 stroke-[3]"></i></span>
                  @else
                    <span class="absolute -left-[31px] top-1 grid h-4 w-4 place-items-center rounded-full bg-success text-white"><i data-lucide="check" class="h-2.5 w-2.5 stroke-[3]"></i></span>
                  @endif
                  <div class="flex flex-wrap items-baseline justify-between gap-2">
                    <p class="font-bold text-base text-ink">{{ $log->to_status }}</p>
                    <time class="font-en text-xs text-slate-400">{{ $log->created_at->format('d M Y, h:i A') }}</time>
                  </div>
                  @if($log->note)<p class="text-sm text-slate-600 mt-1">{{ $log->note }}</p>@endif
                </div>
              @endforeach
            </div>
          @else
            <p class="text-sm text-slate-500">আপনার আবেদনটি গৃহীত হয়েছে। প্রথম আপডেট শীঘ্রই এখানে দেখা যাবে।</p>
          @endif

          @if($application->public_note)
            <div class="mt-6 rounded-xl bg-primary-50 border border-primary-100 p-4 text-sm text-primary-900">{{ $application->public_note }}</div>
          @endif

          <div class="mt-8 rounded-xl bg-slate-50 p-4 border border-slate-200 flex items-start gap-3">
            <i data-lucide="info" class="h-5 w-5 text-primary-700 shrink-0 mt-0.5"></i>
            <p class="text-xs text-slate-600 leading-relaxed">
              কোনো তথ্যে অমিল পরিলক্ষিত হলে হেল্পলাইনে কল করুন <a href="tel:+8801700000000" class="font-bold text-primary-800 underline">০১৭০০-০০০০০০</a>।
            </p>
          </div>

          <div class="mt-6 text-center">
            <a href="{{ route('track') }}" class="text-sm font-semibold text-primary-700 hover:underline">← অন্য আবেদন ট্র্যাক করুন</a>
          </div>
        </div>
      @endif
    </div>
  </section>
</main>
@endsection
