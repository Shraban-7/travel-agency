<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Login') — {{ t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  @stack('styles')
</head>
<body class="bg-surface font-sans text-ink antialiased">
  <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-navy-900 px-4 py-10">
    <div class="pattern-geo absolute inset-0 opacity-60" aria-hidden="true"></div>
    <div class="relative w-full max-w-md">
@php($authSiteName = t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস'))
      <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="mb-6 flex items-center justify-center gap-2.5" aria-label="হোম">
        <span class="grid h-11 w-11 place-items-center rounded-xl bg-gradient-to-br from-primary-600 to-primary-800 text-white shadow-soft ring-1 ring-white/20">
          <svg viewBox="0 0 32 32" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017" stroke="#D4A017"/>
            <path d="M6 28h20"/>
          </svg>
        </span>
        <span class="leading-tight">
          <span class="block text-lg font-bold text-white">{{ $authSiteName }}</span>
          <span class="block font-en text-[11px] font-medium uppercase tracking-[0.14em] text-primary-200">Travels &amp; Overseas</span>
        </span>
      </a>

      <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lift sm:p-8">
        @if(session('success'))
          <div class="mb-4 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="alert"><i data-lucide="check-circle" class="mt-0.5 h-4 w-4 shrink-0"></i><span>{{ session('success') }}</span></div>
        @endif
        @if(session('error'))
          <div class="mb-4 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert"><i data-lucide="alert-circle" class="mt-0.5 h-4 w-4 shrink-0"></i><span>{{ session('error') }}</span></div>
        @endif
        @if(isset($errors) && $errors->any())
          <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
            <ul class="list-disc space-y-1 pl-5">
              @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>

      <p class="mt-6 text-center text-xs text-navy-300">© <span data-year></span> {{ $authSiteName }}। সর্বস্বত্ব সংরক্ষিত।</p>
    </div>
  </div>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script>if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.9 } });</script>
  @stack('scripts')
</body>
</html>
