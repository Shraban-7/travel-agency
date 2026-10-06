# PHASES.md  (estimates for 1 developer; adjust)

## Phase 0 — Setup & foundations (3–4 days)
- [ ] Repo, Laravel 11, Breeze (Inertia React + TypeScript), Tailwind, Vite, ESLint/Prettier, Pint
- [ ] `.env`, timezone `Asia/Dhaka`, locale bn/en, fonts
- [ ] Packages: spatie permission, translatable, medialibrary, activitylog, backup
- [ ] Base layouts (Public/Admin), UI component kit, i18n plumbing
- [ ] Migrations + seeders (roles, admin, services, countries, categories, settings)
- [ ] CI (tests + lint), staging server
**Done when**: admin can log in, language toggle works, empty layouts render.

## Phase 1 — Admin content core (1–1.5 weeks)
- [ ] Settings, pages, services, countries, FAQs, testimonials, team, certificates, gallery, offices
- [ ] Packages + departures + media
- [ ] Job categories + job demands
- [ ] Universities/programs/intakes
- [ ] Posts + notices(deadlines) + downloads
- [ ] Translatable fields UI (BN/EN tabs), image uploader, rich text
**Done when**: client can create all public content from admin.

## Phase 2 — Public website (1.5–2 weeks)
- [ ] Home, About, Services (+detail), Countries (+detail)
- [ ] Packages list/detail (filters), Jobs list/detail, Study pages
- [ ] Deadlines, Blog, Gallery, FAQ, Downloads, Contact, Process, legal pages
- [ ] SEO (meta, OG, schema, sitemap, hreflang), WhatsApp/Call buttons
- [ ] Performance pass (images, caching, Lighthouse ≥ 90 mobile)
**Done when**: site is presentable and indexable with real/placeholder content.

## Phase 3 — Leads & forms (4–5 days)
- [ ] Inquiry, consultation, booking-request forms → leads
- [ ] Spam protection, throttling, email/SMS notification to staff
- [ ] Admin Leads: list/filter/assign/status/notes/follow-up, CSV export
**Done when**: every form creates a lead and staff is notified.

## Phase 4 — Applications & tracking (1–1.5 weeks)
- [ ] Clients (encrypted fields), job/study/hajj application forms with doc upload
- [ ] Tracking code + public Track page
- [ ] Admin Applications: pipeline per service, status change + logs, doc verify, internal/public notes
- [ ] Lead → Client → Application conversion
- [ ] Applicant notifications (email/SMS) on status change
**Done when**: full journey submit → process → track works.

## Phase 5 — Payments lite & reports (4–6 days)
- [ ] Record payments, installments, due calc, receipt PDF (Bangla font)
- [ ] Dashboard widgets, basic reports + CSV
- [ ] Activity log views
**Done when**: staff can issue receipts and see dues.

## Phase 6 — Hardening & launch (4–5 days)
- [ ] Security checklist, permission audit, backup + restore test
- [ ] QA (TESTING.md), content load, redirects, analytics/pixel
- [ ] Production deploy (DEPLOYMENT.md), SSL, monitoring, handover + admin training (video/PDF)
**Done when**: live, backups verified, client trained.

## Phase 7 — Post-launch / optional
Online payment gateway (SSLCommerz/bKash), WhatsApp Business API, applicant login portal, agent/sub-agent portal, multi-branch, blog automation, mobile app/API, visitor chatbot.

## Milestone summary
| Milestone | Target |
|---|---|
| M1 Foundations + admin content | end of week 2 |
| M2 Public site demo | end of week 4 |
| M3 Leads + applications | end of week 6 |
| M4 Payments + hardening | end of week 7 |
| M5 Launch | week 8 |

## Working agreement
- One feature branch per task; PR checklist: tests, lint, i18n keys, permissions, migration reversible.
- Weekly demo to client; content freeze 1 week before launch.
