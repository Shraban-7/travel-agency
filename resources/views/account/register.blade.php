@extends('layouts.public')

@section('title', 'রেজিস্টার — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-12">
  <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-soft">
    <h1 class="text-2xl font-bold text-ink">নতুন অ্যাকাউন্ট খুলুন</h1>
    <p class="mt-1 text-sm text-slate-500">মোবাইল নম্বর দিয়ে রেজিস্টার করে আপনার আবেদন ট্র্যাক করুন।</p>

    @if($errors->any())
      <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('account.register') }}" class="mt-6 space-y-4">
      @csrf
      <div>
        <label for="full_name" class="mb-1 block text-sm font-medium text-slate-700">পুরো নাম</label>
        <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required
          class="w-full rounded-xl border-slate-200" placeholder="আপনার নাম লিখুন">
      </div>
      <div>
        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">মোবাইল নম্বর</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
          class="w-full rounded-xl border-slate-200" placeholder="01XXXXXXXXX">
      </div>
      <div>
        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)</label>
        <input id="password" name="password" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <div>
        <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">পাসওয়ার্ড নিশ্চিত করুন</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <button type="submit" class="w-full rounded-xl bg-primary-700 px-5 py-3 font-semibold text-white hover:bg-primary-800">রেজিস্টার করুন</button>
    </form>

    <p class="mt-4 text-center text-sm text-slate-600">ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="{{ route('account.login') }}" class="font-semibold text-primary-700">লগইন করুন</a></p>
  </div>
</div>
@endsection
