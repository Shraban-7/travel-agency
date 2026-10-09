/**
 * Admin layout partials (DESIGN.md §6 Admin: Sidebar, TopBar).
 * Usage in admin pages:
 *   <body data-admin-page="dashboard" data-title="Dashboard">
 *     <div data-layout="admin-sidebar"></div>
 *     <div class="lg:pl-72"> <div data-layout="admin-topbar"></div> <main>…</main> </div>
 */
(function () {
  const groups = [
    { title: null, items: [
      { key: 'dashboard', label: 'Dashboard', icon: 'layout-dashboard', href: 'dashboard.html' },
    ]},
    { title: 'CRM', items: [
      { key: 'leads', label: 'Leads / Inquiries', icon: 'inbox', href: 'leads.html', badge: '12' },
      { key: 'applications', label: 'Applications', icon: 'folder-kanban', href: 'applications.html' },
      { key: 'clients', label: 'Clients', icon: 'users', href: '#' },
      { key: 'payments', label: 'Payments', icon: 'wallet', href: '#' },
    ]},
    { title: 'Content', items: [
      { key: 'packages', label: 'Packages', icon: 'package', href: 'package-form.html' },
      { key: 'jobs', label: 'Job Demands', icon: 'briefcase', href: '#' },
      { key: 'study', label: 'Universities & Programs', icon: 'graduation-cap', href: '#' },
      { key: 'notices', label: 'Deadlines & Notices', icon: 'bell-ring', href: '#' },
      { key: 'testimonials', label: 'Testimonials', icon: 'quote', href: '#' },
      { key: 'pages', label: 'Pages & FAQ', icon: 'file-text', href: '#' },
    ]},
    { title: 'System', items: [
      { key: 'users', label: 'Users & Roles', icon: 'shield-check', href: '#' },
      { key: 'activity', label: 'Activity Log', icon: 'history', href: '#' },
      { key: 'settings', label: 'Settings', icon: 'settings', href: '#' },
    ]},
  ];

  const page = document.body.dataset.adminPage || '';
  const title = document.body.dataset.title || 'Admin';

  const sidebar = `
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
      ${groups.map((g) => `
        <div>
          ${g.title ? `<p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-navy-400">${g.title}</p>` : ''}
          <ul class="space-y-0.5">
            ${g.items.map((i) => {
              const active = i.key === page;
              return `<li><a href="${i.href}" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 transition ${active ? 'bg-primary-700 text-white shadow-soft' : 'text-navy-200 hover:bg-white/5 hover:text-white'}" ${active ? 'aria-current="page"' : ''}>
                <i data-lucide="${i.icon}" class="h-[18px] w-[18px] ${active ? 'text-accent-300' : 'text-navy-400 group-hover:text-navy-200'}"></i>
                <span class="flex-1">${i.label}</span>
                ${i.badge ? `<span class="rounded-full bg-accent px-2 py-0.5 text-[11px] font-bold text-ink">${i.badge}</span>` : ''}
              </a></li>`;
            }).join('')}
          </ul>
        </div>`).join('')}
    </nav>
    <div class="border-t border-white/10 p-4 font-en">
      <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
        <span class="grid h-10 w-10 place-items-center rounded-full bg-accent font-semibold text-ink">RK</span>
        <div class="min-w-0 flex-1 leading-tight">
          <p class="truncate text-sm font-medium text-white">Rahim Khan</p>
          <p class="text-xs text-navy-300">Manager</p>
        </div>
        <a href="login.html" class="grid h-9 w-9 place-items-center rounded-lg text-navy-300 hover:bg-white/10 hover:text-white" aria-label="Log out"><i data-lucide="log-out" class="h-4 w-4"></i></a>
      </div>
    </div>
  </aside>`;

  const topbar = `
  <header class="sticky top-0 z-30 flex h-16 items-center gap-3 border-b border-slate-200 bg-white/90 px-4 font-en backdrop-blur sm:px-6">
    <button class="grid h-10 w-10 place-items-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 lg:hidden" data-sidebar-open aria-label="Open sidebar"><i data-lucide="menu" class="h-5 w-5"></i></button>
    <h1 class="text-lg font-semibold text-ink">${title}</h1>
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
      <a href="../index.html" target="_blank" class="grid h-10 w-10 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" aria-label="View site"><i data-lucide="external-link" class="h-[18px] w-[18px]"></i></a>
      <button class="relative grid h-10 w-10 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" aria-label="Notifications">
        <i data-lucide="bell" class="h-[18px] w-[18px]"></i><span class="absolute right-2.5 top-2.5 h-2 w-2 rounded-full bg-danger ring-2 ring-white"></span>
      </button>
    </div>
  </header>`;

  const s = document.querySelector('[data-layout="admin-sidebar"]');
  const t = document.querySelector('[data-layout="admin-topbar"]');
  if (s) s.outerHTML = sidebar;
  if (t) t.outerHTML = topbar;
})();
