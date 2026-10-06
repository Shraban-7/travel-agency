# SECURITY.md
Passports, NIDs, photos, and payment records are highly sensitive — treat this as a priority.

## 1. Checklist
- [ ] HTTPS everywhere, HSTS, secure cookies (`SESSION_SECURE_COOKIE=true`, `SameSite=Lax`)
- [ ] `APP_DEBUG=false`, `APP_ENV=production` in prod
- [ ] Strong admin passwords; optional 2FA for admin/manager
- [ ] Login throttle; lock after repeated failures
- [ ] Role/permission checks via Policies on every admin route
- [ ] FormRequest validation for all input; mass-assignment guarded (`$fillable`)
- [ ] CSRF enabled (Inertia handles via axios token)
- [ ] XSS: never `dangerouslySetInnerHTML` on unsanitized input; sanitize rich text (HTMLPurifier) before display
- [ ] SQL injection: Eloquent/bindings only
- [ ] Rate limit: inquiry, apply, track, login
- [ ] Honeypot + optional Turnstile on public forms
- [ ] Track page: require phone + code, throttle, don't reveal whether phone exists
- [ ] Security headers: CSP (allow own + fonts/maps/analytics), X-Frame-Options, X-Content-Type-Options, Referrer-Policy

## 2. File uploads
- Allowed: jpg, png, webp, pdf; max 5MB each (configurable)
- Validate MIME by content, not just extension; randomize filenames
- Store documents on **private disk** (not `public/`); serve via authorized controller
- Optional: virus scan (ClamAV) if VPS
- Image uploads → re-encode to strip EXIF/GPS

## 3. Data protection
- Encrypt `passport_no`, `nid_no` (Laravel encrypted cast); store hash for search
- Mask in UI (`A12****89`) unless permission `clients.view_sensitive`
- Access to documents logged (activity log)
- Retention policy: archive/delete applicant docs X months after closure (agree with client)
- Consent checkbox + privacy policy on every form that collects personal data
- Backups encrypted; restricted access

## 4. Fraud/anti-scam (industry reality)
- Prominently show real license numbers and office addresses
- Disclaimer: no job/visa guarantee; official fees only
- Receipts for every payment with receipt number
- Warning banner: "Never pay to anyone outside official channels"
- Admin can mark a job demand "verified" (demand letter ref) before publishing

## 5. Server
- Non-root deploy user, firewall (80/443/SSH only), fail2ban, SSH keys
- Auto security updates; `composer audit` / `npm audit` in CI
- `.env` outside web root; `storage/` not web-readable except `public` link

## 6. Incident response
1. Rotate `APP_KEY`/DB/API secrets · 2. Disable affected accounts · 3. Review activity log + server logs · 4. Restore from backup if needed · 5. Notify client/affected users · 6. Write post-mortem in `DEBUG.md` incidents log.
