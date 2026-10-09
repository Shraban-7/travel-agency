@extends('layouts.auth')

@section('title', __('Staff Login — Al-Safar Admin'))

@section('content')
<div class="pattern-geo absolute inset-0 opacity-20 pointer-events-none"></div>

<div class="relative w-full max-w-md">
  <div class="text-center mb-8">
    <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 shadow-lift mb-3">
      <svg viewBox="0 0 32 32" class="h-8 w-8" aria-hidden="true"><path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017"/></svg>
    </div>
    <h1 class="text-2xl font-bold text-white tracking-tight">Al-Safar Portal</h1>
    <p class="text-sm text-navy-200 mt-1">Authorized Agency Staff &amp; Officer Login</p>
  </div>

  <div class="rounded-2xl border border-white/10 bg-navy-900/90 p-8 shadow-2xl backdrop-blur-xl">
    @if ($errors->any())
      <div class="mb-5 rounded-xl border border-red-400/30 bg-red-500/10 p-3 text-xs text-red-200">
        <ul class="list-disc pl-4 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if (session('status'))
      <div class="mb-5 rounded-xl border border-emerald-400/30 bg-emerald-500/10 p-3 text-xs text-emerald-200">{{ session('status') }}</div>
    @endif

    <form action="{{ route('admin.login.attempt') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-navy-200 mb-1.5">Official Email</label>
        <div class="relative">
          <span class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"><i data-lucide="mail" class="h-4 w-4"></i></span>
          <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="name@alsafar.com.bd" class="h-11 w-full rounded-xl border border-white/15 bg-white/5 pl-10 pr-4 text-sm text-white placeholder:text-navy-400 focus:border-accent focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-accent/20">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between mb-1.5">
          <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-navy-200">Password</label>
          <a href="#" class="text-xs text-accent hover:underline">Forgot?</a>
        </div>
        <div class="relative">
          <span class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"><i data-lucide="lock" class="h-4 w-4"></i></span>
          <input id="password" name="password" type="password" required class="h-11 w-full rounded-xl border border-white/15 bg-white/5 pl-10 pr-4 text-sm text-white placeholder:text-navy-400 focus:border-accent focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-accent/20">
        </div>
      </div>

      <div class="flex items-center justify-between text-xs text-navy-200">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : 'checked' }} class="rounded border-white/20 bg-white/10 text-primary-600 focus:ring-0">
          <span>Remember this device</span>
        </label>
        <span class="text-slate-400">2FA Active</span>
      </div>

      <button type="submit" class="h-11 w-full rounded-xl bg-accent font-semibold text-ink shadow-gold hover:bg-accent-400 transition flex items-center justify-center gap-2">
        <i data-lucide="log-in" class="h-4 w-4"></i> Sign In to Dashboard
      </button>
    </form>
  </div>

  <p class="text-center text-xs text-navy-400 mt-6">
    Restricted to authorized personnel. All login sessions are audited.
  </p>
</div>
@endsection
