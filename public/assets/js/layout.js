/**
 * Public layout partials (DESIGN.md §4): Top bar, Header, Footer, Floating WhatsApp/Call,
 * mobile sticky bottom bar. Injected into:
 *   <div data-layout="header"></div>   and   <div data-layout="footer"></div>
 * Active nav item = <body data-page="home|services|packages|jobs|study|deadlines|about|contact|track">
 *
 * In the React app these become: <TopBar/>, <SiteHeader/>, <SiteFooter/>, <WhatsAppButton/>, <MobileActionBar/>
 */
(function () {
  const url = new URL(location.href);
  const lang = url.searchParams.get('lang') || localStorage.getItem('lang') || document.documentElement.lang || 'bn';
  const isEn = lang === 'en';

  const PHONE = '+8801700000000';
  const PHONE_LABEL = isEn ? '+880 1700-000000' : '০১৭০০-০০০০০০';
  const WA = 'https://wa.me/8801700000000';

  const t = {
    siteName: isEn ? 'Al-Safar Travels' : 'আল-সফর ট্রাভেলস',
    siteSubtitle: 'Travels & Overseas',
    skip: isEn ? 'Skip to main content' : 'মূল কন্টেন্টে যান',
    hours: isEn ? 'Sat–Thu, 10 AM – 7 PM' : 'শনি–বৃহঃ, সকাল ১০টা – সন্ধ্যা ৭টা',
    trackApp: isEn ? 'Track Application' : 'আবেদন ট্র্যাক করুন',
    trackAppShort: isEn ? 'Track Application' : 'আবেদন ট্র্যাক',
    staffLogin: isEn ? 'Staff Login' : 'স্টাফ লগইন',
    langSelect: isEn ? 'Select language' : 'ভাষা নির্বাচন',
    mainMenu: isEn ? 'Main Menu' : 'প্রধান মেনু',
    freeConsult: isEn ? 'Free Consultation' : 'ফ্রি পরামর্শ',
    getFreeConsult: isEn ? 'Get Free Consultation' : 'ফ্রি পরামর্শ নিন',
    openMenu: isEn ? 'Open menu' : 'মেনু খুলুন',
    footerAbout: isEn ? 'Trusted companion of thousands of families since 2009 for Hajj, Umrah, visas, overseas jobs and higher education. Your documents are safe with us.' : '২০০৯ সাল থেকে হজ্জ, উমরাহ, ভিসা, বিদেশে চাকরি ও উচ্চশিক্ষায় হাজারো পরিবারের বিশ্বস্ত সঙ্গী। আপনার কাগজপত্র আমাদের কাছে নিরাপদ।',
    hajjLic: isEn ? 'Hajj Licence No: ' : 'হজ্জ লাইসেন্স নং: ',
    hajjMinistry: isEn ? '(Ministry of Religious Affairs)' : '(ধর্ম বিষয়ক মন্ত্রণালয়)',
    recruitingLic: isEn ? 'Recruiting Licence: ' : 'রিক্রুটিং লাইসেন্স: ',
    iataMember: isEn ? 'IATA / ATAB Member: ' : 'IATA / ATAB সদস্য: ',
    quickLinks: isEn ? 'Quick Links' : 'দ্রুত লিংক',
    packages: isEn ? 'All Packages' : 'প্যাকেজসমূহ',
    jobs: isEn ? 'Job Demands' : 'জব ডিমান্ড',
    deadlines: isEn ? 'Upcoming Deadlines' : 'আসন্ন ডেডলাইন',
    aboutUs: isEn ? 'About Us' : 'আমাদের সম্পর্কে',
    contactUs: isEn ? 'Contact' : 'যোগাযোগ',
    services: isEn ? 'Services' : 'সেবাসমূহ',
    ourOffice: isEn ? 'Our Offices' : 'আমাদের অফিস',
    headOffice: isEn ? 'Head Office:' : 'প্রধান কার্যালয়:',
    headOfficeAddr: isEn ? 'House 12, Road 5, Dhanmondi, Dhaka-1205' : 'হাউস ১২, রোড ৫, ধানমন্ডি, ঢাকা-১২০৫',
    ctgOffice: isEn ? 'Chattogram Branch:' : 'চট্টগ্রাম শাখা:',
    ctgOfficeAddr: isEn ? 'Agrabad Commercial Area, Chattogram' : 'আগ্রাবাদ বাণিজ্যিক এলাকা, চট্টগ্রাম',
    rights: isEn ? 'Al-Safar Travels & Overseas. All rights reserved.' : 'আল-সফর ট্রাভেলস অ্যান্ড ওভারসিজ। সর্বস্বত্ব সংরক্ষিত।',
    disclaimer: isEn ? 'Disclaimer:' : 'দাবিত্যাগ:',
    disclaimerText: isEn ? 'The final decision on visas and jobs rests with the respective embassy/employer. We do not guarantee any visa or job.' : 'ভিসা ও চাকরির চূড়ান্ত সিদ্ধান্ত সংশ্লিষ্ট দূতাবাস/নিয়োগকর্তার এখতিয়ারভুক্ত। আমরা কোনো ভিসা বা চাকরির নিশ্চয়তা প্রদান করি না।',
    callNow: isEn ? 'Call now' : 'কল করুন',
    whatsappMsg: isEn ? 'Message on WhatsApp' : 'হোয়াটসঅ্যাপে মেসেজ',
    quickContact: isEn ? 'Quick Contact' : 'দ্রুত যোগাযোগ',
    call: isEn ? 'Call' : 'কল',
    whatsapp: isEn ? 'WhatsApp' : 'হোয়াটসঅ্যাপ',
    inquiry: isEn ? 'Inquiry' : 'ইনকোয়ারি'
  };

  const nav = [
    { key: 'home', label: isEn ? 'Home' : 'হোম', href: 'index.html' },
    { key: 'services', label: isEn ? 'Services' : 'সেবাসমূহ', href: 'services.html', children: [
      { label: isEn ? 'Hajj & Umrah' : 'হজ্জ ও উমরাহ', href: 'services.html#hajj', icon: 'moon-star' },
      { label: isEn ? 'Tour Packages' : 'ট্যুর প্যাকেজ', href: 'services.html#tour', icon: 'tree-palm' },
      { label: isEn ? 'Air Tickets' : 'এয়ার টিকেট', href: 'services.html#ticket', icon: 'plane' },
      { label: isEn ? 'Visa Processing' : 'ভিসা প্রসেসিং', href: 'services.html#visa', icon: 'stamp' },
      { label: isEn ? 'Overseas Jobs (Manpower)' : 'বিদেশে চাকরি (ম্যানপাওয়ার)', href: 'services.html#manpower', icon: 'briefcase' },
      { label: isEn ? 'Higher Studies Abroad' : 'বিদেশে উচ্চশিক্ষা', href: 'services.html#study', icon: 'graduation-cap' },
    ]},
    { key: 'packages', label: isEn ? 'Packages' : 'প্যাকেজ', href: 'packages.html' },
    { key: 'jobs', label: isEn ? 'Overseas Jobs' : 'বিদেশে চাকরি', href: 'jobs.html' },
    { key: 'study', label: isEn ? 'Study Abroad' : 'বিদেশে পড়াশোনা', href: 'study.html' },
    { key: 'deadlines', label: isEn ? 'Deadlines' : 'ডেডলাইন', href: 'deadlines.html' },
    { key: 'about', label: isEn ? 'About Us' : 'আমাদের সম্পর্কে', href: 'about.html' },
    { key: 'contact', label: isEn ? 'Contact' : 'যোগাযোগ', href: 'contact.html' },
  ];

  const page = document.body.dataset.page || '';

  const logo = (light = false) => `
    <a href="index.html" class="flex items-center gap-2.5 shrink-0" aria-label="${t.siteName} — ${isEn ? 'Home' : 'হোম'}">
      <span class="grid h-11 w-11 place-items-center rounded-xl bg-gradient-to-br from-primary-600 to-primary-800 text-white shadow-soft ring-1 ring-white/20">
        <svg viewBox="0 0 32 32" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M16 3l3.2 7.8L27 14l-7.8 3.2L16 25l-3.2-7.8L5 14l7.8-3.2z" fill="#D4A017" stroke="#D4A017"/>
          <path d="M6 28h20"/>
        </svg>
      </span>
      <span class="leading-tight">
        <span class="block text-lg font-bold ${light ? 'text-white' : 'text-ink'}">${t.siteName}</span>
        <span class="block font-en text-[11px] font-medium uppercase tracking-[0.14em] ${light ? 'text-primary-200' : 'text-primary-700'}">${t.siteSubtitle}</span>
      </span>
    </a>`;

  const desktopNav = nav.map((item) => {
    const active = item.key === page;
    const base = `relative inline-flex items-center gap-1 rounded-lg px-3 py-2 text-[15px] font-medium transition-colors ${active ? 'text-primary-700' : 'text-slate-700 hover:text-primary-700'}`;
    const underline = active ? '<span class="absolute inset-x-3 -bottom-0.5 h-0.5 rounded-full bg-accent"></span>' : '';
    if (!item.children) return `<a href="${item.href}" class="${base}" ${active ? 'aria-current="page"' : ''}>${item.label}${underline}</a>`;
    return `
      <div class="group relative">
        <a href="${item.href}" class="${base}" aria-haspopup="true">${item.label}<i data-lucide="chevron-down" class="h-4 w-4 transition-transform group-hover:rotate-180"></i>${underline}</a>
        <div class="invisible absolute left-0 top-full z-40 w-72 translate-y-2 pt-3 opacity-0 transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100">
          <div class="rounded-2xl border border-slate-100 bg-white p-2 shadow-lift">
            ${item.children.map((c) => `
              <a href="${c.href}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-800">
                <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-50 text-primary-700"><i data-lucide="${c.icon}" class="h-[18px] w-[18px]"></i></span>${c.label}
              </a>`).join('')}
          </div>
        </div>
      </div>`;
  }).join('');

  const mobileNav = nav.map((item) => `
    <a href="${item.href}" class="flex items-center justify-between rounded-xl px-4 py-3 text-base font-medium ${item.key === page ? 'bg-primary-50 text-primary-800' : 'text-slate-700 hover:bg-slate-50'}">
      ${item.label}<i data-lucide="chevron-right" class="h-4 w-4 text-slate-400"></i>
    </a>
    ${item.children ? `<div class="mb-1 ml-4 grid grid-cols-2 gap-1 border-l border-slate-100 pl-3">${item.children.map((c) => `<a href="${c.href}" class="rounded-lg px-2 py-2 text-sm text-slate-600 hover:bg-slate-50">${c.label}</a>`).join('')}</div>` : ''}
  `).join('');

  const header = `
  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:shadow-lift">${t.skip}</a>

  <!-- Top bar -->
  <div class="hidden bg-navy text-[13px] text-navy-100 md:block">
    <div class="container flex h-10 items-center justify-between gap-4">
      <div class="flex items-center gap-5">
        <a href="tel:${PHONE}" class="inline-flex items-center gap-1.5 hover:text-white"><i data-lucide="phone" class="h-3.5 w-3.5"></i>${PHONE_LABEL}</a>
        <a href="${WA}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-white"><i data-lucide="message-circle" class="h-3.5 w-3.5"></i>${t.whatsapp}</a>
        <span class="hidden items-center gap-1.5 lg:inline-flex"><i data-lucide="clock" class="h-3.5 w-3.5"></i>${t.hours}</span>
      </div>
      <div class="flex items-center gap-4">
        <a href="track.html" class="inline-flex items-center gap-1.5 font-medium text-accent-300 hover:text-accent-200"><i data-lucide="search-check" class="h-3.5 w-3.5"></i>${t.trackApp}</a>
        <span class="h-4 w-px bg-white/20"></span>
        <div class="inline-flex rounded-md bg-white/10 p-0.5" role="group" aria-label="${t.langSelect}">
          <button type="button" data-lang="bn" class="rounded px-2 py-0.5 font-medium ${!isEn ? 'bg-accent text-ink shadow-sm' : ''}">বাং</button>
          <button type="button" data-lang="en" class="rounded px-2 py-0.5 font-en font-medium ${isEn ? 'bg-accent text-ink shadow-sm' : ''}">EN</button>
        </div>
        <a href="#" aria-label="Facebook" class="hover:text-white"><i data-lucide="facebook" class="h-4 w-4"></i></a>
        <a href="#" aria-label="YouTube" class="hover:text-white"><i data-lucide="youtube" class="h-4 w-4"></i></a>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/85 backdrop-blur-lg" data-sticky-header>
    <div class="container flex h-[72px] items-center justify-between gap-4">
      ${logo()}
      <nav class="hidden items-center gap-0.5 xl:flex" aria-label="${t.mainMenu}">${desktopNav}</nav>
      <div class="flex items-center gap-2">
        <a href="contact.html#consult" class="hidden items-center gap-2 rounded-xl bg-accent px-5 py-2.5 text-[15px] font-semibold text-ink shadow-gold transition hover:-translate-y-0.5 hover:bg-accent-400 sm:inline-flex">
          <i data-lucide="calendar-check" class="h-4 w-4"></i>${t.freeConsult}
        </a>
        <button type="button" class="grid h-11 w-11 place-items-center rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 xl:hidden" data-toggle="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="${t.openMenu}">
          <i data-lucide="menu" class="h-5 w-5"></i>
        </button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden max-h-[calc(100vh-72px)] overflow-y-auto border-t border-slate-100 bg-white xl:hidden">
      <div class="container space-y-1 py-4">
        ${mobileNav}
        <div class="flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
          <div class="inline-flex rounded-lg bg-slate-100 p-1" role="group" aria-label="${t.langSelect}">
            <button type="button" data-lang="bn" class="rounded-md px-3 py-1.5 text-sm font-medium ${!isEn ? 'bg-accent text-ink shadow-sm' : ''}">বাং</button>
            <button type="button" data-lang="en" class="rounded-md px-3 py-1.5 font-en text-sm font-medium ${isEn ? 'bg-accent text-ink shadow-sm' : ''}">EN</button>
          </div>
          <a href="track.html" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-700"><i data-lucide="search-check" class="h-4 w-4"></i>${t.trackAppShort}</a>
        </div>
        <a href="contact.html#consult" class="mt-3 flex items-center justify-center gap-2 rounded-xl bg-accent px-5 py-3 font-semibold text-ink">${t.getFreeConsult}</a>
      </div>
    </div>
  </header>`;

  const footer = `
  <footer class="relative mt-0 overflow-hidden bg-navy-900 text-navy-100">
    <div class="pattern-geo absolute inset-0 opacity-60" aria-hidden="true"></div>
    <div class="container relative grid gap-10 py-16 md:grid-cols-2 lg:grid-cols-12">
      <div class="lg:col-span-4">
        ${logo(true)}
        <p class="mt-5 max-w-sm text-sm leading-7 text-navy-200">${t.footerAbout}</p>
        <div class="mt-6 space-y-2 rounded-xl border border-white/10 bg-white/5 p-4 text-[13px]">
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>${t.hajjLic}<b class="font-en text-white">HL-1234</b> ${t.hajjMinistry}</span></p>
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>${t.recruitingLic}<b class="font-en text-white">RL-0987</b> (BMET)</span></p>
          <p class="flex items-start gap-2"><i data-lucide="badge-check" class="mt-0.5 h-4 w-4 shrink-0 text-accent"></i><span>${t.iataMember}<b class="font-en text-white">ATAB-5678</b></span></p>
        </div>
      </div>
      <div class="lg:col-span-2">
        <h2 class="text-base font-semibold text-white">${t.quickLinks}</h2>
        <ul class="mt-4 space-y-2.5 text-sm">
          <li><a class="hover:text-accent-300" href="packages.html">${t.packages}</a></li>
          <li><a class="hover:text-accent-300" href="jobs.html">${t.jobs}</a></li>
          <li><a class="hover:text-accent-300" href="deadlines.html">${t.deadlines}</a></li>
          <li><a class="hover:text-accent-300" href="track.html">${t.trackAppShort}</a></li>
          <li><a class="hover:text-accent-300" href="about.html">${t.aboutUs}</a></li>
          <li><a class="hover:text-accent-300" href="contact.html">${t.contactUs}</a></li>
        </ul>
      </div>
      <div class="lg:col-span-2">
        <h2 class="text-base font-semibold text-white">${t.services}</h2>
        <ul class="mt-4 space-y-2.5 text-sm">
          <li><a class="hover:text-accent-300" href="services.html#hajj">${isEn ? 'Hajj & Umrah' : 'হজ্জ ও উমরাহ'}</a></li>
          <li><a class="hover:text-accent-300" href="services.html#tour">${isEn ? 'Tour Packages' : 'ট্যুর প্যাকেজ'}</a></li>
          <li><a class="hover:text-accent-300" href="services.html#ticket">${isEn ? 'Air Tickets' : 'এয়ার টিকেট'}</a></li>
          <li><a class="hover:text-accent-300" href="services.html#visa">${isEn ? 'Visa Processing' : 'ভিসা প্রসেসিং'}</a></li>
          <li><a class="hover:text-accent-300" href="services.html#manpower">${isEn ? 'Manpower' : 'ম্যানপাওয়ার'}</a></li>
          <li><a class="hover:text-accent-300" href="services.html#study">${isEn ? 'Higher Studies' : 'উচ্চশিক্ষা'}</a></li>
        </ul>
      </div>
      <div class="lg:col-span-4">
        <h2 class="text-base font-semibold text-white">${t.ourOffice}</h2>
        <div class="mt-4 space-y-4 text-sm">
          <p class="flex gap-3"><i data-lucide="map-pin" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><span><b class="text-white">${t.headOffice}</b> ${t.headOfficeAddr}</span></p>
          <p class="flex gap-3"><i data-lucide="map-pin" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><span><b class="text-white">${t.ctgOffice}</b> ${t.ctgOfficeAddr}</span></p>
          <p class="flex gap-3"><i data-lucide="phone" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><a href="tel:${PHONE}" class="hover:text-white">${PHONE_LABEL}</a></p>
          <p class="flex gap-3"><i data-lucide="mail" class="mt-1 h-4 w-4 shrink-0 text-accent"></i><a href="mailto:info@alsafar.com.bd" class="font-en hover:text-white">info@alsafar.com.bd</a></p>
        </div>
        <div class="mt-6 flex gap-2">
          <a href="#" aria-label="Facebook" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="facebook" class="h-5 w-5"></i></a>
          <a href="#" aria-label="YouTube" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="youtube" class="h-5 w-5"></i></a>
          <a href="${WA}" aria-label="WhatsApp" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="message-circle" class="h-5 w-5"></i></a>
          <a href="#" aria-label="Instagram" class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 transition hover:bg-accent hover:text-ink"><i data-lucide="instagram" class="h-5 w-5"></i></a>
        </div>
      </div>
    </div>
    <div class="relative border-t border-white/10">
      <div class="container flex flex-col gap-3 py-6 pb-24 text-xs text-navy-300 md:flex-row md:items-center md:justify-between md:pb-6">
        <p>© <span data-year></span> ${t.rights}</p>
        <p class="max-w-2xl md:text-right"><b class="text-navy-100">${t.disclaimer}</b> ${t.disclaimerText}</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp + Call (desktop) -->
  <div class="fixed bottom-6 right-6 z-40 hidden flex-col gap-3 md:flex">
    <a href="tel:${PHONE}" aria-label="${t.callNow}" class="grid h-14 w-14 place-items-center rounded-full bg-primary-700 text-white shadow-lift transition hover:scale-105"><i data-lucide="phone" class="h-6 w-6"></i></a>
    <a href="${WA}" target="_blank" rel="noopener" aria-label="${t.whatsappMsg}" class="relative grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-lift transition hover:scale-105">
      <span class="absolute inset-0 animate-ping rounded-full bg-[#25D366] opacity-30"></span>
      <svg viewBox="0 0 24 24" class="relative h-7 w-7" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.7.1-.2.3-.8.9-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.2-.5-2.3-1.4-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6l.4-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.4-.1-.1-.3-.2-.6-.3zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4C2.7 15.6 2.2 13.8 2.2 12 2.2 6.6 6.6 2.2 12 2.2S21.8 6.6 21.8 12 17.4 21.8 12 21.8zM12 0C5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12S18.6 0 12 0z"/></svg>
    </a>
  </div>

  <!-- Mobile sticky bottom bar: Call | WhatsApp | Inquiry -->
  <nav class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-3 border-t border-slate-200 bg-white/95 pb-[env(safe-area-inset-bottom)] backdrop-blur md:hidden" aria-label="${t.quickContact}">
    <a href="tel:${PHONE}" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 text-xs font-medium text-primary-700"><i data-lucide="phone" class="h-5 w-5"></i>${t.call}</a>
    <a href="${WA}" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 border-x border-slate-100 text-xs font-medium text-[#128C7E]"><i data-lucide="message-circle" class="h-5 w-5"></i>${t.whatsapp}</a>
    <a href="contact.html#consult" class="flex min-h-[56px] flex-col items-center justify-center gap-0.5 bg-accent text-xs font-semibold text-ink"><i data-lucide="send" class="h-5 w-5"></i>${t.inquiry}</a>
  </nav>`;

  const h = document.querySelector('[data-layout="header"]');
  const f = document.querySelector('[data-layout="footer"]');
  if (h) h.outerHTML = header;
  if (f) f.outerHTML = footer;
})();
