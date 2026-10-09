@extends('layouts.public')
@section('title', 'আমাদের সম্পর্কে — আল-সফর ট্রাভেলস অ্যান্ড ওভারসিজ')
@section('activePage', 'about')
@section('content')
<main id="main">
  <section class="relative bg-navy-900 py-16 text-white overflow-hidden">
    <div class="pattern-geo absolute inset-0 opacity-20"></div>
    <div class="container relative z-10">
      <nav class="flex items-center gap-2 text-sm text-navy-200" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-white">হোম</a>
        <i data-lucide="chevron-right" class="h-4 w-4"></i>
        <span class="text-white font-medium">আমাদের সম্পর্কে</span>
      </nav>
      <h1 class="mt-4 font-serif text-3xl font-bold sm:text-4xl lg:text-5xl">সততা, নিরাপত্তা ও আস্থার ১৭ বছর</h1>
      <p class="mt-3 max-w-2xl text-navy-100">“আপনার পরিবার নির্দ্বিধায় যাদের হাতে পাসপোর্ট ও প্রয়োজনীয় কাগজপত্র তুলে দিতে পারে।”</p>
    </div>
  </section>

  <section class="py-16">
    <div class="container grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="font-en text-xs font-bold uppercase tracking-widest text-primary-700">About Us</span>
        <h2 class="mt-2 font-serif text-3xl font-bold text-ink sm:text-4xl">মানুষের পবিত্র স্বপ্ন ও ক্যারিয়ার গঠনে বিশ্বস্ত সঙ্গী</h2>
        @if($page && t($page->body))
          <div class="mt-4 text-slate-600 leading-relaxed">{!! nl2br(e(t($page->body))) !!}</div>
        @else
          <p class="mt-4 text-slate-600 leading-relaxed">
            ২০০৯ সালে প্রতিষ্ঠার পর থেকে আল-সফর ট্রাভেলস অ্যান্ড ওভারসিজ বাংলাদেশের অন্যতম শীর্ষস্থানীয় ট্রাভেল ও রিক্রুটিং এজেন্সি হিসেবে পরিচিতি লাভ করেছে। আমরা বিশ্বাস করি, বিদেশযাত্রা কেবল একটি ভ্রমণ নয় — এটি একজন মানুষের সারাজীবনের সঞ্চয়, স্বপ্ন ও পরিবারের ভবিষ্যতের সাথে জড়িত।
          </p>
          <p class="mt-4 text-slate-600 leading-relaxed">
            তাই কোনো ধরনের মধ্যস্বত্বভোগী বা অসদুপায় অবলম্বন না করে সরকারি অনুমোদিত বৈধ ফ্রেমওয়ার্কের ভেতরে প্রতিটি নাগরিকের কাগজপত্র শতভাগ গোপনীয়তা ও সুরক্ষার সাথে পরিচালনা করি।
          </p>
        @endif
        <div class="mt-8 grid grid-cols-2 gap-4">
          <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-soft">
            <p class="text-2xl font-bold text-primary-800">২৫,০০০+</p>
            <p class="text-xs text-slate-500 mt-1">সফল গ্রাহক ও হাজী সাহেবান</p>
          </div>
          <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-soft">
            <p class="text-2xl font-bold text-accent-700">১০০%</p>
            <p class="text-xs text-slate-500 mt-1">স্বচ্ছ হিসাব ও লিখিত রসিদ</p>
          </div>
        </div>
      </div>
      <div class="space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
          <h3 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
            <i data-lucide="badge-check" class="h-5 w-5 text-accent"></i> সরকারি অনুমোদন ও লাইসেন্সসমূহ
          </h3>
          <div class="space-y-3 text-sm">
            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 border border-slate-100">
              <span class="font-medium text-slate-700">হজ্জ লাইসেন্স (ধর্ম মন্ত্রণালয়)</span>
              <span class="font-en font-bold text-primary-800">HL-1234</span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 border border-slate-100">
              <span class="font-medium text-slate-700">রিক্রুটিং লাইসেন্স (BMET)</span>
              <span class="font-en font-bold text-primary-800">RL-0987</span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 border border-slate-100">
              <span class="font-medium text-slate-700">IATA অনুমোদিত ট্রাভেল এজেন্ট</span>
              <span class="font-en font-bold text-primary-800">IATA-42019</span>
            </div>
            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 border border-slate-100">
              <span class="font-medium text-slate-700">অ্যাসোসিয়েশন অব ট্রাভেল এজেন্টস (ATAB)</span>
              <span class="font-en font-bold text-primary-800">ATAB-5678</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-16 border-y border-slate-200/60">
    <div class="container">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <h2 class="font-serif text-3xl font-bold text-ink">আমাদের মূল মূল্যবোধ</h2>
        <p class="mt-2 text-slate-600">যেসব অঙ্গীকারের ওপর আমাদের ১৭ বছরের গৌরবময় পথচলা প্রতিষ্ঠিত।</p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="p-6 rounded-2xl bg-surface border border-slate-100 shadow-soft">
          <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary-100 text-primary-800 mb-4"><i data-lucide="shield" class="h-6 w-6"></i></span>
          <h3 class="text-lg font-bold text-ink">কাগজপত্রের শতভাগ নিরাপত্তা</h3>
          <p class="mt-2 text-sm text-slate-600">আপনার মূল পাসপোর্ট ও ন্যাশনাল আইডি ডিজিটাল এনক্রিপশন ও ব্যাংক ভল্ট সমতুল্য নিরাপত্তায় সংরক্ষিত থাকে।</p>
        </div>
        <div class="p-6 rounded-2xl bg-surface border border-slate-100 shadow-soft">
          <span class="grid h-12 w-12 place-items-center rounded-xl bg-accent-100 text-accent-800 mb-4"><i data-lucide="file-check" class="h-6 w-6"></i></span>
          <h3 class="text-lg font-bold text-ink">স্বচ্ছ ফি ও মানি রিসিপ্ট</h3>
          <p class="mt-2 text-sm text-slate-600">কোনো অদৃশ্য বা গোপন চার্জ নেই। প্রতিটি আর্থিক লেনদেনের বিপরীতে অফিসিয়াল ভ্যাট-চালান ও রসিদ প্রদান করা হয়।</p>
        </div>
        <div class="p-6 rounded-2xl bg-surface border border-slate-100 shadow-soft">
          <span class="grid h-12 w-12 place-items-center rounded-xl bg-sky-100 text-sky-800 mb-4"><i data-lucide="activity" class="h-6 w-6"></i></span>
          <h3 class="text-lg font-bold text-ink">লাইভ অ্যাপ্লিকেশন ট্র্যাকিং</h3>
          <p class="mt-2 text-sm text-slate-600">অনলাইনে ঘরে বসেই মোবাইলের মাধ্যমে জানতে পারবেন আপনার ফাইল এখন কোন দপ্তরে রয়েছে।</p>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
