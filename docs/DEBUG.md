# DEBUG.md — Troubleshooting Playbook

## 0. Method
1. Reproduce → 2. Read the log (`storage/logs/laravel.log`, browser console, Network tab) → 3. Isolate (route → controller → request → model → view) → 4. Fix → 5. Add a test → 6. Note it below if it was nasty.

## 1. Tools
Local: Laravel Debugbar, Telescope (local/staging only), `dd()/dump()/ray()`, React Developer Tools, `php artisan tinker`, `php artisan route:list`, `php artisan about`.
Prod: Sentry/Flare, log files, `php artisan pail`, slow query log.

## 2. Common issues & fixes
| Symptom | Likely cause | Fix |
|---|---|---|
| Blank page / "Vite manifest not found" | Assets not built | `npm run build` (prod) or `npm run dev` (local) |
| Changes not showing in prod | Cached config/views/assets | `php artisan optimize:clear` then re-cache; hard refresh |
| 419 Page Expired on forms | CSRF/session expired, wrong domain/cookie | Check `SESSION_DOMAIN`, HTTPS, `APP_URL`; use `useForm` from `@inertiajs/react` |
| Inertia full-page reload / "version mismatch" | Asset hash changed after deploy | Normal once; ensure `HandleInertiaRequests::version` correct |
| 413 on upload | Nginx/PHP size limit | `client_max_body_size`, `upload_max_filesize`, `post_max_size` |
| Uploaded file 403/404 | Missing `storage:link` or private disk misuse | `php artisan storage:link`; docs go through controller |
| Images not found after deploy | Wrong `APP_URL`/disk URL | Fix env, clear config cache |
| Bangla shows as `???` in DB | Wrong charset | `utf8mb4` + `utf8mb4_unicode_ci` on DB/connection |
| Bangla broken in PDF | Font lacks glyphs / no shaping | Use Noto Sans Bengali TTF; dompdf has weak conjunct shaping → consider `mPDF` or Browsershot (headless Chrome) |
| Translatable returns null | Locale missing in JSON | Set fallback locale; seed both bn/en |
| Wrong dates (off by 6h) | Timezone mismatch | `APP_TIMEZONE=Asia/Dhaka`, MySQL stores UTC consistently |
| Slow list pages | N+1 queries | `with()` eager loads; `Model::preventLazyLoading()`; add indexes |
| Queue jobs not running | Worker down | Supervisor status; `queue:restart`; check `failed_jobs` |
| Emails/SMS not sent | Credentials/queue/port blocked | Test with tinker; check `notification_logs` |
| 500 after deploy | Missing env/migration/permissions | Read log; `chmod -R ug+rw storage bootstrap/cache`; `migrate --force` |
| Mixed content warnings | HTTP URLs behind proxy | `TrustProxies`, `APP_URL=https://` |
| Language toggle doesn't persist | Middleware order | `SetLocale` before `HandleInertiaRequests`; cookie set |
| Props too large / slow Inertia | Passing whole models | Use API Resources / select columns |
| SEO tags missing in source | CSR only | Enable Inertia SSR or render meta in Blade |
| Track page leaks info | Returning internal logs | Filter `public_visible = true`; generic errors |
| Duplicate leads | Double submit | Disable button on submit, idempotency token, dedupe by phone+24h |

## 3. Logging standards
- Log channel `daily`, 14 days. Context-rich: `Log::warning('Upload rejected', ['app_id'=>..., 'mime'=>...])`.
- Never log passwords, full passport/NID, tokens.
- Log all status changes and document downloads (activity log).

## 4. Health check commands
```
php artisan about
php artisan migrate:status
php artisan queue:failed
php artisan schedule:list
df -h ; free -m ; tail -n 100 storage/logs/laravel.log
```

## 5. Frontend debugging
- React DevTools → check props from Inertia (`usePage().props`).
- Console errors for failed i18n keys (`missing key` handler in dev).
- Test on real low-end Android + throttled 3G in DevTools.

## 6. Incidents log (append)
| Date | Issue | Root cause | Fix | Prevention |
|---|---|---|---|---|
| | | | | |

## 7. React/Inertia-specific issues
| Symptom | Cause | Fix |
|---|---|---|
| "Cannot find module ./Pages/..." / blank page | Wrong filename case or extension in `resolvePageComponent` | Match controller `Inertia::render('Public/Home')` to `Pages/Public/Home.tsx` exactly (case-sensitive on Linux) |
| Hydration mismatch warning (SSR) | Date/locale/random values differ server vs client | Format dates deterministically; set countdowns inside `useEffect` |
| Infinite re-render / effect loop | Missing or unstable `useEffect` deps | Memoize with `useMemo/useCallback`; check deps array |
| Form state resets on navigation | Component remounts | Give stable `key`; use `remember` option of `useForm` |
| Props undefined on first render | Optional/deferred props | Use Inertia `Deferred`/optional chaining and loading UI |
| Stale list after save | Partial reload not triggered | `router.reload({ only: ['items'] })` or redirect back with fresh props |
| `window is not defined` (SSR) | Browser API at module scope | Guard with `typeof window !== 'undefined'` or use inside `useEffect` |
| Locale flicker on load | Locale applied client-side only | Pass locale in shared props; init i18n before first render |
