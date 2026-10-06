# CLAUDE.md — Rules for AI-assisted development on this repo

## Project
Bangladeshi travel/manpower/education/Hajj agency site. Laravel 11 + Inertia + React 18 (TypeScript) + Tailwind + MySQL. Bilingual (bn default, en). Light admin panel.
Read `docs/REQUIREMENTS.md`, `ARCHITECTURE.md`, `DATABASE.md` before coding.

## Do
- Follow folder structure & conventions in ARCHITECTURE.md
- Validation in FormRequests; auth via Policies; logic in Actions/Services
- Every new text → i18n key (bn + en); DB content → translatable JSON
- Eager load relations; paginate lists
- Write a Pest test for each new feature/bug
- Use enums for statuses; keep migrations reversible
- Store documents on private disk; never expose passport/NID in public props/logs
- Use `useForm` from `@inertiajs/react`; function components + hooks only; show loading + error states
- Keep admin simple: tables + forms, no over-engineering

## Don't
- Don't add new packages without asking
- Don't use `dangerouslySetInnerHTML` with unsanitized user content
- Don't put business logic in React components or controllers
- Don't hard-delete applications/payments
- Don't skip the Bangla layout check on UI changes
- Don't promise visas/jobs in any copy

## Commands
```
composer dev (or php artisan serve + npm run dev)
php artisan test
./vendor/bin/pint
npm run lint
php artisan migrate:fresh --seed
```

## Definition of done
Works in bn+en · mobile checked · permission checked · tests pass · lint clean · docs updated if behavior changed.
