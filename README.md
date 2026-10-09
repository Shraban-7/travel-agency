# আস্থা ট্রাভেল এজেন্সি (Astha Travel Agency)

Bilingual (Bangla default, English) website + admin panel for a Bangladeshi travel /
manpower / education / Hajj agency: Hajj & Umrah, foreign employment, study abroad,
tour packages, visa & ticketing.

## Stack

| Layer    | Choice                              |
|----------|-------------------------------------|
| Backend  | Laravel 11 (PHP 8.2+)               |
| Frontend | Blade + Tailwind CSS (CDN) + vanilla JS + Lucide icons |
| Database | MySQL 8 (`utf8mb4_unicode_ci`)      |
| Auth     | Laravel session auth (staff only)   |
| Tests    | PHPUnit feature tests               |

## Features

**Public site** (`/`): home (hero + quick inquiry, trust strip, services, featured
packages, job demands, study, deadlines, testimonials, FAQ, contact), packages list/detail
(filters, departures, seats left, related), jobs list/detail, study list/university detail,
services, deadlines board (notices + job deadlines + departure booking deadlines),
about, contact, application tracking (phone + tracking code → public timeline only).

**Admin panel** (`/admin`): dashboard (counts, dues, follow-ups, recent leads/applications),
leads (search/filter, status pipeline, internal notes, soft delete only), applications
(status change with public/private logs, document list, payments with `R-YYYY-000001`
receipts + automatic paid/due recalculation), packages CRUD (slug auto-generated,
country sync, publish toggle, media library uploads), staff management with roles,
activity log viewer.

**RBAC**: roles `admin` / `manager` / `staff` with 10 granular permissions
(`packages.manage`, `leads.manage`, `applications.manage`, `users.manage`, …) enforced on
every admin route and in the UI via `@can`.

**Customer portal** (`/account`): applicants register/login with phone + password to view
their applications, payment history, dues, document verification status and schedules.

**Media, activity, backups**: spatie media-library (package/post covers + galleries with
thumbnails), activitylog (model changes + key admin actions, `clients.view_sensitive`
excludes credentials), daily `backup:run` at 02:00 (needs `mysqldump` on PATH).

**Forms → Leads**: quick inquiry + contact forms create `Lead` records (phone normalized
to `+880…`, Bengali digits supported, throttled 10/min).

## Project structure

```
app/Helpers/helpers.php      # t(), bn_digits(), money(), currency(), maskString(),
                             # upload_file(), storage_url(), apiResponse()...
app/Http/Controllers/Public/ # Home, Package, Job, Study, Service, Deadline,
                             # Page (about/contact), Track, Inquiry
app/Http/Controllers/Admin/  # Auth, Dashboard, Lead, Application, Package
app/Http/Requests/Admin/     # StorePackage, ChangeApplicationStatus, StoreLeadNote, StorePayment
app/Models/                  # 31 models (translatable JSON casts, SoftDeletes
                             # on leads/applications/payments/packages/posts/...)
bootstrap/app.php            # guests redirect to admin.login
database/migrations/         # 35 migrations, FK-safe timestamp order
database/seeders/            # Settings, Service, Country, JobCategory,
                             # AdminUser, Demo, Content
resources/views/layouts/     # public, admin, auth
resources/views/public/      # 13 pages   resources/views/admin/  # 8 pages
routes/web.php               # public routes + admin group
tests/Feature/SiteTest.php   # 5 tests / 23 assertions
```

## Getting started

```bash
cp .env.example .env
# set DB_* to your MySQL 8 database (utf8mb4_unicode_ci)
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Seeded demo logins (password: `password`):

| Email                    | Use        |
|--------------------------|------------|
| `admin@travelagency.test` | Admin panel |
| `staff@travelagency.test`  | Admin panel |

Public site: `http://127.0.0.1:8000` · Admin: `http://127.0.0.1:8000/admin/login`

## Key conventions

- Translatable DB content is JSON (`{"bn": "...", "en": "..."}`); render with `t($value)`.
- Money is `decimal(12,2)` BDT; display with `money($amount)` (prefix `৳`).
- Sensitive fields (`nid_no`, `passport_no`) use `encrypted` casts and are masked in UI
  (`maskString()`); applicant documents live on the **private** disk, served only through
  authorized controllers — never in public props or logs.
- Statuses are plain strings (`new/contacted/qualified/converted/lost`,
  `submitted/.../closed`, `open/closed`); every application status change writes an
  `application_status_logs` row (`public_visible` flag controls the Track page).
- Tracking codes look like `TA-2026-XXXXXX`; payment receipts like `R-2026-000001`.
- No hard deletes of applications/payments (soft deletes + activity trail).

## Commands

```bash
php artisan test                    # run test suite (10 tests)
php artisan migrate:fresh --seed    # rebuild demo database
php artisan db:seed --class=ContentSeeder   # content only
./vendor/bin/pint                   # code style
```
