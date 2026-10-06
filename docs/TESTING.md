# TESTING.md

## Tools
Pest/PHPUnit (feature + unit), Laravel Dusk or Playwright (E2E, optional), Lighthouse, axe.

## Must-have automated tests
- Auth: login, throttle, role access (staff can't hit settings/users)
- Inquiry: validation, honeypot, throttle, lead created, notification queued
- Application: create client+application, tracking code unique, doc upload rules (type/size), private disk
- Status change: log row created, notification queued, public-visible filtering
- Track: wrong code/phone → generic error; throttled; only public logs shown
- Payments: totals/due recalculation, receipt number unique, refund handling
- Package/job: published-only on public, expired items auto-close command
- Localization: bn/en fallback, translatable JSON read/write
- Policies: staff only sees assigned applications (if enforced)

## Manual QA checklist
- [ ] All pages in Bangla + English, no overflow with long Bangla text
- [ ] Mobile 360px / 390px / tablet / desktop
- [ ] Forms: error states, success states, file upload on slow network
- [ ] WhatsApp/Call links work on phone
- [ ] SEO: titles, OG preview on Facebook debugger, sitemap, robots
- [ ] Lighthouse mobile: Perf ≥ 85, A11y ≥ 90, SEO ≥ 95
- [ ] Emails/SMS render Bangla correctly
- [ ] Receipt PDF shows Bangla glyphs + ৳
- [ ] Backup → restore on a clean server
- [ ] 404/500 pages branded

## Test data
Factories + `DemoSeeder` (20 packages, 30 jobs, 10 programs, 50 leads, 20 applications).

## Frontend tests (React)
Vitest + React Testing Library for key components (InquiryForm validation, DeadlineChip countdown, StatusStepper, locale switch); optional Playwright for the apply → track flow.
