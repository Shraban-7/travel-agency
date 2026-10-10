/**
 * Shared behaviour for the static templates (vanilla JS, no deps besides Lucide icons).
 * Each block maps to a React component/hook listed in DESIGN.md §6 / §12.
 */
(function () {
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
  const BN = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
  const toBn = (v) => String(v).replace(/\d/g, (d) => BN[d]);
  const LANG = document.documentElement.lang || 'bn';
  const num = (v) => (LANG === 'en' ? String(v) : toBn(v));
  const pad = (n) => String(n).padStart(2, '0');
  window.toBn = toBn;

  /* ---------- Language toggle (persist: localStorage + ?lang) — DESIGN §8 ---------- */
  const url = new URL(location.href);
  const lang = url.searchParams.get('lang') || localStorage.getItem('lang') || 'bn';
  localStorage.setItem('lang', lang);
  document.documentElement.lang = lang;
  $$('[data-lang]').forEach((b) => {
    const on = b.dataset.lang === lang;
    b.setAttribute('aria-pressed', on);
    b.classList.toggle('bg-white', on && !b.closest('.bg-navy'));
    b.classList.toggle('text-ink', on);
    b.classList.toggle('shadow-sm', on);
    if (b.closest('.bg-navy')) b.classList.toggle('bg-accent', on);
    b.addEventListener('click', () => {
      localStorage.setItem('lang', b.dataset.lang);
      url.searchParams.set('lang', b.dataset.lang);
      location.href = url.toString();
    });
  });

  /* ---------- Generic toggle (mobile menu etc.) ---------- */
  $$('[data-toggle]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const t = $(btn.dataset.toggle);
      if (!t) return;
      const hidden = t.classList.toggle('hidden');
      btn.setAttribute('aria-expanded', String(!hidden));
    });
  });

  /* ---------- Admin sidebar ---------- */
  const sb = $('#admin-sidebar'), sbb = $('#admin-sidebar-backdrop');
  $$('[data-sidebar-open]').forEach((b) => b.addEventListener('click', () => { sb?.classList.remove('-translate-x-full'); sbb?.classList.remove('hidden'); }));
  $$('[data-sidebar-close]').forEach((b) => b.addEventListener('click', () => { sb?.classList.add('-translate-x-full'); sbb?.classList.add('hidden'); }));

  /* ---------- Tabs: [data-tabs] > [role=tab][data-tab=x] + [data-panel=x] ---------- */
  $$('[data-tabs]').forEach((wrap) => {
    const tabs = $$('[data-tab]', wrap);
    const select = (key) => {
      tabs.forEach((t) => t.setAttribute('aria-selected', String(t.dataset.tab === key)));
      $$('[data-panel]', wrap).forEach((p) => p.classList.toggle('hidden', p.dataset.panel !== key));
    };
    tabs.forEach((t) => t.addEventListener('click', () => select(t.dataset.tab)));
    select((tabs.find((t) => t.getAttribute('aria-selected') === 'true') || tabs[0])?.dataset.tab);
  });

  /* ---------- Countdown (DeadlineChip / useCountdown) ----------
     <span data-countdown="2026-11-01T23:59:00+06:00">…</span>
     Optional children: [data-unit="d|h|m|s"] for block style. */
  const cds = $$('[data-countdown]');
  const tick = () => {
    const now = Date.now();
    cds.forEach((el) => {
      const diff = new Date(el.dataset.countdown).getTime() - now;
      const label = $('[data-cd-label]', el) || el;
      if (diff <= 0) { el.dataset.state = 'expired'; label.textContent = LANG === 'en' ? 'Expired' : 'সময় শেষ'; return; }
      const d = Math.floor(diff / 864e5), h = Math.floor(diff / 36e5) % 24, m = Math.floor(diff / 6e4) % 60, s = Math.floor(diff / 1e3) % 60;
      el.dataset.state = d < 3 ? 'urgent' : d < 10 ? 'soon' : 'ok';
      const units = $$('[data-unit]', el);
      if (units.length) {
        units.forEach((u) => { u.textContent = num(pad({ d, h, m, s }[u.dataset.unit])); });
      } else {
        label.textContent = d > 0
          ? (LANG === 'en' ? `${d}d ${h}h left` : `${num(d)} দিন ${num(h)} ঘণ্টা বাকি`)
          : (LANG === 'en' ? `${pad(h)}:${pad(m)}:${pad(s)} left` : `${num(pad(h))}:${num(pad(m))}:${num(pad(s))} বাকি`);
      }
    });
  };
  if (cds.length) { tick(); setInterval(tick, 1000); }

  /* ---------- Stat counters (StatCounter) ---------- */
  const counters = $$('[data-count-to]');
  const runCounter = (el) => {
    const to = +el.dataset.countTo, dur = 1400, start = performance.now();
    const fmt = (n) => num(n.toLocaleString('en-IN'));
    const step = (t) => {
      const p = Math.min(1, (t - start) / dur), e = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt(Math.round(to * e)) + (el.dataset.suffix || '');
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };

  /* ---------- Scroll reveal + counters ---------- */
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  if ('IntersectionObserver' in window && !reduce) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        e.target.classList.add('is-visible');
        if (e.target.dataset.countTo) runCounter(e.target);
        io.unobserve(e.target);
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    $$('.reveal, [data-count-to]').forEach((el) => io.observe(el));
  } else {
    $$('.reveal').forEach((el) => el.classList.add('is-visible'));
    counters.forEach((el) => { el.textContent = num((+el.dataset.countTo).toLocaleString('en-IN')) + (el.dataset.suffix || ''); });
  }

  /* ---------- Carousel (scroll-snap + prev/next) ---------- */
  $$('[data-carousel]').forEach((wrap) => {
    const track = $('[data-carousel-track]', wrap);
    const by = () => (track.firstElementChild?.getBoundingClientRect().width || 300) + 24;
    $('[data-carousel-prev]', wrap)?.addEventListener('click', () => track.scrollBy({ left: -by(), behavior: 'smooth' }));
    $('[data-carousel-next]', wrap)?.addEventListener('click', () => track.scrollBy({ left: by(), behavior: 'smooth' }));
  });

  /* ---------- Modal: [data-modal-open="#id"], [data-modal-close] ---------- */
  const openModal = (m) => { m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden'; $('[autofocus], button, input', m)?.focus(); };
  const closeModal = (m) => { m.classList.add('hidden'); m.classList.remove('flex'); document.body.style.overflow = ''; };
  $$('[data-modal-open]').forEach((b) => b.addEventListener('click', () => { const m = $(b.dataset.modalOpen); m && openModal(m); }));
  $$('[data-modal]').forEach((m) => {
    m.addEventListener('click', (e) => { if (e.target === m || e.target.closest('[data-modal-close]')) closeModal(m); });
  });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') $$('[data-modal]:not(.hidden)').forEach(closeModal); });

  /* ---------- Gallery lightbox ---------- */
  const lb = $('#lightbox');
  if (lb) {
    const img = $('img', lb);
    const items = $$('[data-lightbox]');
    let idx = 0;
    const show = (i) => { idx = (i + items.length) % items.length; img.src = items[idx].dataset.lightbox; img.alt = items[idx].querySelector('img')?.alt || ''; };
    items.forEach((el, i) => el.addEventListener('click', () => { show(i); openModal(lb); }));
    $('[data-lb-prev]', lb)?.addEventListener('click', (e) => { e.stopPropagation(); show(idx - 1); });
    $('[data-lb-next]', lb)?.addEventListener('click', (e) => { e.stopPropagation(); show(idx + 1); });
  }

  /* ---------- Toast ---------- */
  window.showToast = (msg, type = 'success') => {
    let host = $('#toast-host');
    if (!host) { host = document.createElement('div'); host.id = 'toast-host'; host.className = 'fixed bottom-20 left-1/2 z-[90] flex w-[calc(100%-2rem)] max-w-sm -translate-x-1/2 flex-col gap-2 md:bottom-6 md:left-6 md:translate-x-0'; host.setAttribute('aria-live', 'polite'); document.body.appendChild(host); }
    const colors = { success: 'bg-success', error: 'bg-danger', info: 'bg-info' };
    const t = document.createElement('div');
    t.className = 'toast-enter flex items-start gap-3 rounded-xl bg-ink px-4 py-3 text-sm text-white shadow-lift';
    t.innerHTML = `<span class="mt-1.5 h-2 w-2 shrink-0 rounded-full ${colors[type] || colors.success}"></span><span class="flex-1"></span>`;
    t.lastChild.textContent = msg;
    host.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; t.style.transition = 'opacity .3s'; setTimeout(() => t.remove(), 300); }, 3200);
  };

  /* ---------- Demo forms: inline validation + toast (InquiryForm) ---------- */
  $$('form[data-demo-form]').forEach((form) => {
    form.setAttribute('novalidate', '');
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let ok = true;
      $$('[required]', form).forEach((f) => {
        const err = form.querySelector(`[data-error-for="${f.id}"]`);
        const bad = !f.value.trim() || (f.type === 'tel' && !/^(\+?88)?01[3-9]\d{8}$/.test(f.value.replace(/[\s-]/g, '')));
        f.setAttribute('aria-invalid', String(bad));
        err?.classList.toggle('hidden', !bad);
        if (bad && ok) { f.focus(); ok = false; }
      });
      if (!ok) return;
      const target = form.dataset.demoForm;
      if (target && target.startsWith('#')) { const el = $(target); el?.classList.remove('hidden'); el?.scrollIntoView({ behavior: 'smooth', block: 'start' }); return; }
      if (target && target.endsWith('.html')) { location.href = target; return; }
      showToast(form.dataset.success || (LANG === 'en' ? 'Thank you! Our representative will contact you soon.' : 'ধন্যবাদ! আমাদের প্রতিনিধি শীঘ্রই আপনার সাথে যোগাযোগ করবেন।'));
      form.reset();
    });
  });

  /* ---------- Admin DataTable: search + sort ---------- */
  $$('[data-table]').forEach((wrap) => {
    const tbody = $('tbody', wrap);
    const search = $('[data-table-search]', wrap);
    const count = $('[data-table-count]', wrap);
    const filter = () => {
      const q = (search?.value || '').toLowerCase();
      const statusSel = $('[data-table-status]', wrap)?.value || '';
      let n = 0;
      $$('tr', tbody).forEach((tr) => {
        const show = tr.textContent.toLowerCase().includes(q) && (!statusSel || tr.dataset.status === statusSel);
        tr.classList.toggle('hidden', !show); if (show) n++;
      });
      if (count) count.textContent = n;
    };
    search?.addEventListener('input', filter);
    $('[data-table-status]', wrap)?.addEventListener('change', filter);
    $$('th[data-sort]', wrap).forEach((th, _, all) => {
      th.classList.add('cursor-pointer', 'select-none');
      th.addEventListener('click', () => {
        const col = [...th.parentNode.children].indexOf(th);
        const dir = th.dataset.dir === 'asc' ? 'desc' : 'asc';
        all.forEach((o) => delete o.dataset.dir); th.dataset.dir = dir;
        const rows = $$('tr', tbody).sort((a, b) => {
          const x = a.children[col].dataset.value ?? a.children[col].textContent.trim();
          const y = b.children[col].dataset.value ?? b.children[col].textContent.trim();
          return (isNaN(x) || isNaN(y) ? x.localeCompare(y) : x - y) * (dir === 'asc' ? 1 : -1);
        });
        rows.forEach((r) => tbody.appendChild(r));
      });
    });
    filter();
  });

  /* ---------- Select-all checkbox ---------- */
  $$('[data-check-all]').forEach((all) => all.addEventListener('change', () => {
    $$(all.dataset.checkAll).forEach((c) => { if (!c.closest('tr')?.classList.contains('hidden')) c.checked = all.checked; });
  }));

  /* ---------- Misc ---------- */
  $$('[data-year]').forEach((el) => (el.textContent = num(new Date().getFullYear())));
  $$('[data-copy]').forEach((b) => b.addEventListener('click', () => { navigator.clipboard?.writeText(b.dataset.copy); showToast((LANG === 'en' ? 'Copied: ' : 'কপি হয়েছে: ') + b.dataset.copy, 'info'); }));

  // Header shadow on scroll
  const hdr = $('[data-sticky-header]');
  if (hdr) addEventListener('scroll', () => hdr.classList.toggle('shadow-soft', scrollY > 8), { passive: true });

  /* ---------- Icons ---------- */
  if (window.lucide) lucide.createIcons({ attrs: { 'stroke-width': 1.9 } });
})();
