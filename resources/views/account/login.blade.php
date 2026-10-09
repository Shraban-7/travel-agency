@extends('layouts.public')

@section('title', 'লগইন — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-12">
  <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-soft">
    <h1 class="text-2xl font-bold text-ink">অ্যাকাউন্টে লগইন</h1>
    <p class="mt-1 text-sm text-slate-500">আপনার মোবাইল নম্বর ও পাসওয়ার্ড দিয়ে প্রবেশ করুন।</p>

    @if($errors->any())
      <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('account.login') }}" class="mt-6 space-y-4">
      @csrf
      <div>
        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">মোবাইল নম্বর</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
          class="w-full rounded-xl border-slate-200" placeholder="01XXXXXXXXX">
      </div>
      <div>
        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">পাসওয়ার্ড</label>
        <input id="password" name="password" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <label class="flex items-center gap-2 text-sm text-slate-600">
        <input type="checkbox" name="remember" value="1" class="rounded border-slate-300"> মনে রাখুন
      </label>
      <button type="submit" class="w-full rounded-xl bg-primary-700 px-5 py-3 font-semibold text-white hover:bg-primary-800">লগইন করুন</button>
    </form>

    <p class="mt-4 text-center text-sm text-slate-600">অ্যাকাউন্ট নেই? <a href="{{ route('account.register') }}" class="font-semibold text-primary-700">রেজিস্টার করুন</a></p>
  </div>
</div>
@endsection
