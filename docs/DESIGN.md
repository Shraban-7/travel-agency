# DESIGN.md

## 1. Brand & tone
Trustworthy, warm, professional. Not flashy. Think: "my family can safely hand over documents here."
- Primary: deep teal/green `#0F766E` (trust, Hajj-appropriate) — alt: navy `#0B3B5B`
- Accent: warm gold `#D4A017` (CTAs, highlights)
- Neutral: slate scale; background `#F8FAFC`; text `#0F172A`
- Status colors: success `#16A34A`, warning `#F59E0B`, danger `#DC2626`, info `#0284C7`
(Confirm with client logo colors; define as Tailwind tokens in `tailwind.config.js`.)

## 2. Typography
- Bangla: **Noto Sans Bengali** or **Hind Siliguri** (headings: Noto Serif Bengali optional)
- English: **Inter** / Poppins
- Base 16px (Bangla needs ≥ 1.6 line-height). Self-host fonts (WOFF2) for speed.

## 3. Layout & grid
Mobile-first; breakpoints `sm 640 / md 768 / lg 1024 / xl 1280`. Container max 1200px. 8px spacing scale. Radius `rounded-xl`; soft shadows.

## 4. Public layout
- **Top bar**: phone, WhatsApp, language toggle (বাং | EN), Facebook.
- **Header**: logo, nav (Home, Services ▾, Packages, Jobs Abroad, Study Abroad, Deadlines, About, Contact), CTA "Free Consultation".
- **Footer**: license numbers, offices, quick links, services, social, copyright, disclaimer.
- **Floating**: WhatsApp + Call (mobile sticky bottom bar: Call | WhatsApp | Inquiry).

## 5. Home page wireframe (top→bottom)
1. Hero: headline + sub, search/quick-inquiry card (Service, Country, Phone → submit)
2. Trust strip: licenses, years, people served, countries
3. Services grid (6 cards)
4. Featured packages (Hajj/Umrah/Tour) carousel
5. Latest job demands (cards with country flag, positions, salary, deadline)
6. Study destinations (country tiles) + upcoming intakes
7. Upcoming deadlines board (countdown chips)
8. How it works (4–6 steps)
9. Testimonials / success stories (photo + country + quote, video)
10. News & notices
11. FAQ accordion
12. CTA band + contact form + map

## 6. Component library (build once, reuse)
**Public**: Hero, ServiceCard, PackageCard, JobCard, CountryTile, DeadlineChip(countdown), StepTimeline, TestimonialCard, StatCounter, FAQAccordion, InquiryForm, WhatsAppButton, Breadcrumb, Pagination, FilterBar, Gallery(lightbox), SeoHead.  
**Admin**: Sidebar, TopBar, StatCard, DataTable(sort/filter/paginate), FormField set, RichText editor (TipTap), ImageUploader, FileViewer (PDF/image preview), StatusBadge, StatusStepper, ConfirmModal, Toast, Tabs, TranslatableField (BN/EN tabs).

## 7. Key page specs
### Package detail
Gallery · title + price chip · quick facts (duration, hotel, airline, departures) · tabs (Overview, Itinerary, Inclusions/Exclusions, Documents, FAQ) · sticky side card: next departure, seats left, deadline countdown, "Book / Inquire", WhatsApp.
### Job demand card/detail
Flag + country · category · positions · salary range · contract · deadline · cost estimate · requirements checklist · documents list · Apply button · status badge (Open/Closed).
### Study
Filter by country, level, field, intake; university card (logo, program count, fee from); program detail with intakes + deadlines.
### Track application
Phone + code → vertical timeline of public-visible statuses, with date; contact staff button.
### Admin application view
Header (tracking code, client, service, status stepper) · tabs: Details · Documents (verify toggle) · Payments · Timeline/Notes · Communication.

## 8. Bilingual UX rules
- Default Bangla; toggle persists (cookie + `?lang`).
- URLs: `/bn/...` and `/en/...` (or `/` = bn, `/en` prefix) — keep hreflang.
- Numbers: allow Bangla digits toggle for display (optional); store ASCII.
- Prices: `৳ ১,২০,০০০` style formatting via `Intl.NumberFormat('bn-BD')`.
- Layout must not break with long Bangla words; test every card.

## 9. Accessibility & performance
Contrast ≥ 4.5:1; focus rings; alt text bilingual; tap targets ≥ 44px; forms with inline errors; WebP images; lazy-load below fold; no heavy sliders; font-display: swap.

## 10. Imagery guidance
Real photos of office, team, clients (with consent), Makkah/Madinah, destination cities. Avoid stock-only look. Flags as small SVG icons. Provide placeholders until real assets arrive.

## 11. Motion
Minimal: fade/slide on scroll, hover lift on cards, countdown tick. Respect `prefers-reduced-motion`.

## 12. React implementation notes
Components are function components in `resources/js/Components/{ui,public,admin}`; style with Tailwind utility classes (+ `clsx`/`tailwind-merge`); variants via `class-variance-authority`. Translatable DB fields render with a `t(field)` helper that reads the active locale from shared props. Countdown chips use a small `useCountdown(deadline)` hook (clean up the interval in `useEffect`).
