<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') — {{ t($settings['site_name'] ?? 'আল-সফর ট্রাভেলস') }} Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  @stack('styles')
</head>
@php
  $adminPage = $adminPage ?? (trim($__env->yieldContent('adminPage')) ?: 'dashboard');
  $user = auth()->user();
  $userName = $user->name ?? 'Admin';
  $userRole = $user->role ?? ($user->role_name ?? 'Staff');
  $initials = collect(preg_split('/\s+/u', trim($userName)))->map(fn ($p) => mb_substr($p, 0, 1))->take(2)->implode('');
  $link = fn ($key, $fallback) => \Illuminate\Support\Facades\Route::has($key) ? route($key) : url($fallback);
  $item = fn ($key, $href) => $adminPage === $key
    ? 'group flex items-center gap-3 rounded-lg px-3 py-2.5 transition bg-primary-700 text-white shadow-soft'
    : 'group flex items-center gap-3 rounded-lg px-3 py-2.5 transition text-navy-200 hover:bg-white/5 hover:text-white';
  $icon = fn ($key) => $adminPage === $key
    ? 'h-[18px] w-[18px] text-accent-300'
    : 'h-[18px] w-[18px] text-navy-400 group-hover:text-navy-200';
@endphp
<body data-admin-page="{{ $adminPage }}" data-title="@yield('title', 'Admin')" class="bg-surface font-sans text-ink antialiased">

  <div id="admin-sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-ink/40 backdrop-blur-sm lg:hidden" data-sidebar-close></div>
  <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-navy-900 text-navy-100 transition-transform duration-300 lg:translate-x-0" aria-label="Admin navigation">
    <div class="flex h-16 items-center gap-3 border-b border-white/10 px-5">
      <span class="grid h-9 w-9 place-items-center rounded-lg bg-gradient-to-br from-primary-500 to-primary-700">
        <svg viewBox="0 0 32 32" class="h-5 w-5" aria-hidden="true"><path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017"/></svg>
      </span>
      <div class="font-en leading-tight">
        <p class="text-sm font-semibold text-white">Al-Safar Admin</p>
        <p class="text-[11px] text-navy-300">Travels &amp; Overseas</p>
      </div>
      <button class="ml-auto grid h-9 w-9 place-items-center rounded-lg hover:bg-white/10 lg:hidden" data-sidebar-close aria-label="Close sidebar"><i data-lucide="x" class="h-5 w-5"></i></button>
    </div>
    <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-5 font-en text-sm">
      <div>
        <ul class="space-y-0.5">
          <li><a href="{{ $link('admin.dashboard', '/admin') }}" class="{{ $item('dashboard', '') }}" @if($adminPage === 'dashboard') aria-current="page" @endif>
            <i data-lucide="layout-dashboard" class="{{ $icon('dashboard') }}"></i><span class="flex-1">Dashboard</span>
          </a></li>
        </ul>
      </div>
      <div>
        <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-navy-400">CRM</p>
        <ul class="space-y-0.5">
          @can('leads.view')
          <li><a href="{{ $link('admin.leads.index', '/admin/leads') }}" class="{{ $item('leads', '') }}" @if($adminPage === 'leads') aria-current="page" @endif>
            <i data-lucide="inbox" class="{{ $icon('leads') }}"></i><span class="flex-1">Leads / Inquiries</span>
            @if(!empty($newLeadsCount))<span class="rounded-full bg-accent px-2 py-0.5 text-[11px] font-bold text-ink">{{ $newLeadsCount }}</span>@endif
          </a></li>
          @endcan
          @can('applications.view')
          <li><a href="{{ $link('admin.applications.index', '/admin/applications') }}" class="{{ $item('applications', '') }}" @if($adminPage === 'applications') aria-current="page" @endif>
            <i data-lucide="folder-kanban" class="{{ $icon('applications') }}"></i><span class="flex-1">Applications</span>
          </a></li>
          @endcan
          <li><a href="{{ $link('admin.clients.index', '/admin/clients') }}" class="{{ $item('clients', '') }}" @if($adminPage === 'clients') aria-current="page" @endif>
            <i data-lucide="users" class="{{ $icon('clients') }}"></i><span class="flex-1">Clients</span>
          </a></li>
          <li><a href="{{ $link('admin.payments.index', '/admin/payments') }}" class="{{ $item('payments', '') }}" @if($adminPage === 'payments') aria-current="page" @endif>
            <i data-lucide="wallet" class="{{ $icon('payments') }}"></i><span class="flex-1">Payments</span>
          </a></li>
        </ul>
      </div>
      <div>
        <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-navy-400">Content</p>
        <ul class="space-y-0.5">
          @can('packages.view')
          <li><a href="{{ $link('admin.packages.index', '/admin/packages') }}" class="{{ $item('packages', '') }}" @if($adminPage === 'packages') aria-current="page" @endif>
            <i data-lucide="package" class="{{ $icon('packages') }}"></i><span class="flex-1">Packages</span>
          </a></li>
          @endcan
          <li><a href="{{ $link('admin.jobs.index', '/admin/jobs') }}" class="{{ $item('jobs', '') }}" @if($adminPage === 'jobs') aria-current="page" @endif>
            <i data-lucide="briefcase" class="{{ $icon('jobs') }}"></i><span class="flex-1">Job Demands</span>
          </a></li>
          <li><a href="{{ $link('admin.study.index', '/admin/study') }}" class="{{ $item('study', '') }}" @if($adminPage === 'study') aria-current="page" @endif>
            <i data-lucide="graduation-cap" class="{{ $icon('study') }}"></i><span class="flex-1">Universities &amp; Programs</span>
          </a></li>
          <li><a href="{{ $link('admin.notices.index', '/admin/notices') }}" class="{{ $item('notices', '') }}" @if($adminPage === 'notices') aria-current="page" @endif>
            <i data-lucide="bell-ring" class="{{ $icon('notices') }}"></i><span class="flex-1">Deadlines &amp; Notices</span>
          </a></li>
          <li><a href="{{ $link('admin.testimonials.index', '/admin/testimonials') }}" class="{{ $item('testimonials', '') }}" @if($adminPage === 'testimonials') aria-current="page" @endif>
            <i data-lucide="quote" class="{{ $icon('testimonials') }}"></i><span class="flex-1">Testimonials</span>
          </a></li>
          <li><a href="{{ $link('admin.pages.index', '/admin/pages') }}" class="{{ $item('pages', '') }}" @if($adminPage === 'pages') aria-current="page" @endif>
            <i data-lucide="file-text" class="{{ $icon('pages') }}"></i><span class="flex-1">Pages &amp; FAQ</span>
          </a></li>
        </ul>
      </div>
      <div>
        <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-navy-400">System</p>
        <ul class="space-y-0.5">
          @can('users.manage')
          <li><a href="{{ $link('admin.users.index', '/admin/users') }}" class="{{ $item('users', '') }}" @if($adminPage === 'users') aria-current="page" @endif>
            <i data-lucide="shield-check" class="{{ $icon('users') }}"></i><span class="flex-1">Users &amp; Roles</span>
          </a></li>
          @endcan
          <li><a href="{{ $link('admin.activity.index', '/admin/activity') }}" class="{{ $item('activity', '') }}" @if($adminPage === 'activity') aria-current="page" @endif>
            <i data-lucide="history" class="{{ $icon('activity') }}"></i><span class="flex-1">Activity Log</span>
          </a></li>
          @can('settings.manage')
          <li><a href="{{ $link('admin.settings.index', '/admin/settings') }}" class="{{ $item('settings', '') }}" @if($adminPage === 'settings') aria-current="page" @endif>
            <i data-lucide="settings" class="{{ $icon('settings') }}"></i><span class="flex-1">Settings</span>
          </a></li>
          @endcan
        </ul>
      </div>
    </nav>
    <div class="border-t border-white/10 p-4 font-en">
      <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
        <span class="grid h-10 w-10 place-items-center rounded-full bg-accent font-semibold text-ink">{{ $initials ?: 'A' }}</span>
        <div class="min-w-0 flex-1 leading-tight">
          <p class="truncate text-sm font-medium text-white">{{ $userName }}</p>
          <p class="text-xs text-navy-300">{{ $userRole }}</p>
        </div>
        @if(Route::has('logout') || Route::has('admin.logout'))
          <form method="POST" action="{{ Route::has('logout') ? route('logout') : route('admin.logout') }}">
            @csrf
            <button type="submit" class="grid h-9 w-9 place-items-center rounded-lg text-navy-300 hover:bg-white/10 hover:text-white" aria-label="Log out"><i data-lucide="log-out" class="h-4 w-4"></i></button>
          </form>
        @else
          <a href="{{ url('/logout') }}" class="grid h-9 w-9 place-items-center rounded-lg text-navy-300 hover:bg-white/10 hover:text-white" aria-label="Log out"><i data-lucide="log-out" class="h-4 w-4"></i></a>
        @endif
      </div>
    </div>
  </aside>

  <div class="lg:pl-72">
    <header class="sticky top-0 z-30 flex h-16 items-center gap-3 border-b border-slate-200 bg-white/90 px-4 font-en backdrop-blur sm:px-6">
      <button class="grid h-10 w-10 place-items-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 lg:hidden" data-sidebar-open aria-label="Open sidebar"><i data-lucide="menu" class="h-5 w-5"></i></button>
      <h1 class="text-lg font-semibold text-ink">@yield('title', 'Admin')</h1>
      <div class="relative ml-auto hidden w-full max-w-sm md:block">
        <i data-lucide="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
        <input type="search" placeholder="Search tracking code, phone, name…" class="h-10 w-full rounded-lg border border-slate-200 bg-slate-50 pl-9 pr-16 text-sm placeholder:text-slate-400 focus:border-primary-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-primary-100">
        <kbd class="absolute right-2 top-1/2 -translate-y-1/2 rounded border border-slate-200 bg-white px-1.5 py-0.5 text-[10px] text-slate-500">Ctrl K</kbd>
      </div>
      <div class="ml-auto flex items-center gap-1 md:ml-2">
        <div class="hidden rounded-lg bg-slate-100 p-0.5 text-xs sm:inline-flex" role="group" aria-label="Language">
          <button data-lang="bn" class="rounded-md px-2.5 py-1.5 font-sans font-medium">বাং</button>
          <button data-lang="en" class="rounded-md px-2.5 py-1.5 font-medium">EN</button>
        </div>
        <a href="{{ Route::has('home') ? route('home') : url('/') }}" target="_blank" class="grid h-10 w-10 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" aria-label="View site"><i data-lucide="external-link" class="h-[18px] w-[18px]"></i></a>
        <button class="relative grid h-10 w-10 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" aria-label="Notifications">
          <i data-lucide="bell" class="h-[18px] w-[18px]"></i><span class="absolute right-2.5 top-2.5 h-2 w-2 rounded-full bg-danger ring-2 ring-white"></span>
        </button>
      </div>
    </header>

    <main class="p-4 sm:p-6">
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
    </main>
  </div>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script>if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.9 } });</script>
  @stack('scripts')
</body>
</html>
