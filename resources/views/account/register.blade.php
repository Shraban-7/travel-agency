@extends('layouts.public')

@section('title', __('account.register.title').' — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-12">
  <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-soft">
    <h1 class="text-2xl font-bold text-ink">{{ __('account.register.title') }}</h1>
    <p class="mt-1 text-sm text-slate-500">{{ __('account.register.subtitle') }}</p>

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
        <label for="full_name" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.register.name') }}</label>
        <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required
          class="w-full rounded-xl border-slate-200" placeholder="{{ __('আপনার নাম লিখুন') }}">
      </div>
      <div>
        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.register.phone') }}</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
          class="w-full rounded-xl border-slate-200 font-en" placeholder="01XXXXXXXXX">
      </div>
      <div>
        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.register.password') }}</label>
        <input id="password" name="password" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <div>
        <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.register.password_confirm') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <button type="submit" class="w-full rounded-xl bg-primary-700 px-5 py-3 font-semibold text-white hover:bg-primary-800">{{ __('account.register.submit') }}</button>
    </form>

    <p class="mt-4 text-center text-sm text-slate-600">{{ __('account.register.have_account') }} <a href="{{ route('account.login') }}" class="font-semibold text-primary-700">{{ __('account.register.login_link') }}</a></p>
  </div>
</div>
@endsection
