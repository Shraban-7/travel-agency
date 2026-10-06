# ARCHITECTURE.md

## 1. Stack
| Layer | Choice | Why |
|---|---|---|
| Backend | Laravel 11 (PHP 8.2+) | Mature, fast to build CRUD, great ecosystem |
| Frontend | Inertia.js + React 18 (function components + hooks, TypeScript recommended) | SPA feel without separate API |
| Styling | Tailwind CSS | Fast, consistent |
| DB | MySQL 8 | Standard for BD hosting |
| Auth | Laravel Breeze (`--stack=react --typescript`) | Staff login only |
| Roles | spatie/laravel-permission | Admin/Manager/Staff |
| Media | spatie/laravel-medialibrary (or plain storage) | Image conversions (WebP) |
| i18n | Laravel lang files + react-i18next (JSON bundles shared via Inertia props); DB fields as JSON (spatie/laravel-translatable) | Bangla/English |
| Activity log | spatie/laravel-activitylog | Audit |
| PDF | barryvdh/laravel-dompdf | Receipts (needs Bangla font, e.g. Noto Sans Bengali) |
| Excel/CSV | maatwebsite/excel | Exports |
| Queue | database driver (v1) | Emails/SMS |
| Cache | file/redis | Public pages |
| SEO | custom meta component + sitemap generator | |

SSR (Inertia SSR) is **recommended for public pages** for SEO; alternative: keep public pages as Blade + React islands. Decide in Phase 0 (default: Inertia SSR on VPS; if shared hosting without Node, use Blade for public pages and Inertia only for admin).

## 2. High-level diagram
```
Browser ──► Nginx/Apache ──► Laravel (PHP-FPM)
                              ├─ Public controllers  ─► Inertia ─► React pages (Public)
                              ├─ Admin controllers   ─► Inertia ─► React pages (Admin)
                              ├─ Form actions (inquiry/application)
                              ├─ Jobs (mail/SMS) ─► queue worker
                              └─ MySQL / Storage (public + private disk)
```

## 3. Folder structure
```
app/
  Enums/            ServiceType, ApplicationStatus, LeadStatus, PaymentMethod...
  Http/
    Controllers/
      Public/       HomeController, PackageController, JobDemandController, ...
      Admin/        DashboardController, PackageController, LeadController, ...
    Requests/       FormRequest per action
    Middleware/     SetLocale, HandleInertiaRequests
  Models/
  Services/         ApplicationTrackingService, PaymentService, NotificationService
  Actions/          CreateLead, ChangeApplicationStatus (single-purpose classes)
  Policies/
resources/
  js/
    Pages/
      Public/       Home.tsx, Packages/Index.tsx, Packages/Show.tsx, Jobs/..., Study/...
      Admin/        Dashboard.tsx, Packages/..., Leads/..., Applications/...
    Layouts/        PublicLayout.tsx, AdminLayout.tsx
    Components/
      ui/           Button, Input, Select, Modal, Badge, Table, Pagination, Toast
      public/       Hero, ServiceCard, PackageCard, JobCard, DeadlineList, Testimonials...
      admin/        StatCard, StatusBadge, FileViewer, Timeline
    hooks/          useLocale, useFilters, useToast
    lang/           bn.json, en.json
database/
  migrations/ seeders/ factories/
routes/ web.php  admin.php
docs/               (these files)
tests/ Feature/ Unit/
```

## 4. Conventions
- Controllers thin → logic in Actions/Services.
- Validation only in FormRequests.
- Authorization via Policies + permissions (`packages.manage`, `leads.view`...).
- Enums for statuses (PHP backed enums) mirrored in a shared JS constants file.
- All user-visible text via i18n keys; DB content via translatable JSON `{ "bn": "...", "en": "..." }`.
- Slugs: unique, English-transliterated; keep `slug` + translatable `title`.
- Money: integer paisa? Simpler: `decimal(12,2)` BDT. Always store currency column.
- Dates stored UTC; app timezone `Asia/Dhaka`; display with Bangla numerals optional.
- Files: public images on `public` disk; **documents (passport, CV, NID) on private disk**, served via signed/authorized route only.
- Soft deletes on leads, applications, packages, clients.
- Every admin write → activity log.

## 5. Key flows
### Inquiry → Lead
Visitor submits form → `StoreInquiryRequest` → `CreateLead` action → DB → queue: email/SMS to staff, auto-reply to visitor → lead visible in admin.

### Application + tracking
Visitor submits application → create `client` (match by phone/passport) + `application` with `tracking_code` (e.g., `TA-2026-XXXXXX`) → upload docs (private) → staff reviews → `ChangeApplicationStatus` action → writes `application_status_logs` → notify applicant → public Track page reads logs (public-safe fields only).

### Package + departures
Package has many departures (date, seats_total, seats_booked, price override, booking_deadline). Public site shows "next departure" + "seats left" + deadline countdown. Closed automatically after deadline (scheduled command).

## 6. Scheduled commands
- `deadlines:close-expired` daily — marks job demands/departures/notices expired.
- `leads:remind-followups` daily — notifies staff of today's follow-ups.
- `db:backup` daily (spatie/laravel-backup).

## 7. Caching & performance
- Cache homepage payload (5–15 min), bust on admin save.
- Eager-load relations (avoid N+1; use `Model::preventLazyLoading()` in non-prod).
- Image conversions: thumb 400w, card 800w, hero 1600w WebP.
- Vite code splitting; admin bundle separate from public.

## 8. Environments
local → staging → production. `.env.example` maintained. No secrets in repo.

## 9. Decisions log (fill as you go)
| # | Decision | Date | Reason |
|---|---|---|---|
| 1 | Laravel+Inertia+React+MySQL | | Team stack |
| 2 | SSR vs Blade for public | | Hosting dependent |

## 10. React/Inertia specifics
- Entry: `resources/js/app.tsx` (`createInertiaApp`, `resolvePageComponent` over `./Pages/**/*.tsx`); SSR entry `resources/js/ssr.tsx` (run `php artisan inertia:start-ssr` under Supervisor on VPS).
- Pages are default-exported function components; layouts via `Page.layout = (page) => <PublicLayout>{page}</PublicLayout>`.
- Forms: `useForm` from `@inertiajs/react`; links: `<Link>`; shared data via `usePage<PageProps>().props` (locale, auth user, settings, flash).
- i18n: share `locale` + translation bundle from `HandleInertiaRequests`; init `react-i18next` once in `app.tsx`; helper hook `useT()`.
- Types: `resources/js/types/` (PageProps, models, enums mirrored from PHP enums).
- UI kit: Tailwind + headless primitives (Radix/shadcn-ui optional); icons `lucide-react`; rich text `@tiptap/react`; tables `@tanstack/react-table`; dates `date-fns`; toasts `sonner`.
- Perf: `React.lazy` for heavy admin pages (rich text, charts); keep public bundle small; avoid passing full models as props (use API Resources).
