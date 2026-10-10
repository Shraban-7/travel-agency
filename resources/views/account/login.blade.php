@extends('layouts.public')

@section('title', __('account.login.title').' — '.t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
@section('activePage', 'account')

@section('content')
<div class="container py-12">
  <div class="mx-auto max-w-md rounded-2xl border border-slate-200 bg-white p-8 shadow-soft">
    <h1 class="text-2xl font-bold text-ink">{{ __('account.login.title') }}</h1>
    <p class="mt-1 text-sm text-slate-500">{{ __('account.login.subtitle') }}</p>

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
        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.login.phone') }}</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
          class="w-full rounded-xl border-slate-200 font-en" placeholder="01XXXXXXXXX">
      </div>
      <div>
        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">{{ __('account.login.password') }}</label>
        <input id="password" name="password" type="password" required class="w-full rounded-xl border-slate-200">
      </div>
      <label class="flex items-center gap-2 text-sm text-slate-600">
        <input type="checkbox" name="remember" value="1" class="rounded border-slate-300"> {{ __('account.login.remember') }}
      </label>
      <button type="submit" class="w-full rounded-xl bg-primary-700 px-5 py-3 font-semibold text-white hover:bg-primary-800">{{ __('account.login.submit') }}</button>
    </form>

    <p class="mt-4 text-center text-sm text-slate-600">{{ __('account.login.no_account') }} <a href="{{ route('account.register') }}" class="font-semibold text-primary-700">{{ __('account.login.register_link') }}</a></p>
  </div>
</div>
@endsection
