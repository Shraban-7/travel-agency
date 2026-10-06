# DATABASE.md  (MySQL 8, utf8mb4_unicode_ci)

Notation: `T` = translatable JSON (`{"bn":"","en":""}`). All tables have `id`, `created_at`, `updated_at`; `SD` = soft deletes.

## 1. Auth & settings
**users**: name, email(unique), phone, password, is_active, last_login_at  
**roles / permissions / model_has_roles...**: spatie standard  
**settings**: key(unique), value(json) — site name, phones, WhatsApp, address, socials, license numbers, SEO defaults  
**activity_log**: spatie standard

## 2. Content
**services**: slug(unique), type(enum: hajj_umrah, employment, study, tour, visa, ticket, other), title T, short_desc T, body T, icon, cover_image, sort_order, is_active, seo_title T, seo_desc T  
**countries**: slug, name T, flag_code, region(enum: middle_east, europe, asia, africa, americas, other), intro T, visa_info T, life_info T, cover_image, is_featured, is_active, sort_order  
**pages**: slug, title T, body T, is_active (About, Privacy, Terms, Refund)  
**faqs**: service_id(null), country_id(null), question T, answer T, sort_order, is_active  
**testimonials**: name, photo, designation/country, service_id(null), content T, video_url, rating(1-5), is_active, sort_order  
**team_members**: name T, role T, photo, phone, sort_order  
**certificates**: title T, number, issuer, image, sort_order (licenses)  
**gallery_items**: type(photo/video), file/url, caption T, album, sort_order  
**posts** (SD): slug, title T, excerpt T, body T, cover_image, category(news/visa_update/notice/blog), published_at, is_published, author_id  
**notices**: title T, body T, type(deadline/info/urgent), related_type, related_id, deadline_at, is_active — homepage "Deadlines" board  
**downloads**: title T, file, category, sort_order  
**offices**: name T, address T, phone, email, map_embed, is_head_office

## 3. Packages
**packages** (SD): service_id, slug, type(enum: hajj, umrah, tour, study_package, visa, other), title T, summary T, description T, itinerary(json: days[]), inclusions T(list), exclusions T(list), duration_days, base_price, currency(default BDT), price_note T, hotel_info(json: makkah/madinah/distance), airline, cover_image, is_featured, is_published, sort_order, seo fields  
**package_country**: package_id, country_id  
**package_departures**: package_id, departure_date, return_date, seats_total, seats_booked, price(override null), booking_deadline, status(open/full/closed)  
**package_media**: package_id, file, caption, sort_order

## 4. Employment (job demands)
**job_categories**: slug, name T (Driver, Construction, Hospitality, Cleaner, Security, Nurse, Factory...)  
**job_demands** (SD): country_id, category_id, slug, title T, company_name(null), positions(int), salary_min, salary_max, salary_currency, contract_months, benefits T, requirements T(age, skills, exp), required_documents T, estimated_total_cost, service_charge_note T, demand_ref, application_deadline, status(open/closed/filled), is_published, cover_image

## 5. Study
**universities**: country_id, name T, city, logo, website, ranking(null), description T, is_active  
**study_programs**: university_id, name T, level(diploma/bachelor/master/phd/language), field, duration, tuition_fee, currency, language, requirements T, scholarship_info T, is_active  
**study_intakes**: program_id, intake_name(e.g. Sep 2027), start_date, application_deadline, seats(null)

## 6. CRM / Operations
**leads** (SD): name, phone, email(null), whatsapp(null), service_type, interested_country_id(null), interested_item_type/id (polymorphic: package/job_demand/program), message, source(web_form/whatsapp/facebook/walk_in/referral/phone), utm json, status(new/contacted/qualified/converted/lost), assigned_to(user), follow_up_at, lost_reason, ip, created_at  
**lead_notes**: lead_id, user_id, note, created_at  
**clients** (SD): full_name, full_name_bn(null), phone(unique-ish), email, gender, dob, nid_no(enc), passport_no(enc), passport_expiry, address, district, emergency_contact_name, emergency_contact_phone, lead_id(null), notes  
**applications** (SD): tracking_code(unique), client_id, service_type(enum), applicable_type/id (package/job_demand/program/intake, polymorphic nullable), country_id(null), status, status_label (from pipeline), assigned_to, submitted_at, total_fee, paid_amount (cached), due_amount (cached), remarks_internal, public_note, closed_at  
**application_status_logs**: application_id, from_status, to_status, note, public_visible(bool), changed_by, created_at  
**application_documents**: application_id, type(passport/nid/photo/cv/certificate/medical/ielts/other), file_path(private), original_name, mime, size, verified(bool), verified_by, note  
**application_extra**: application_id, data(json) — service-specific form answers (education history, job experience, pilgrim count)  
**payments** (SD): application_id, client_id, amount, currency, method(cash/bkash/nagad/bank/card/other), reference_no, paid_at, type(deposit/installment/final/refund), receipt_no(unique), received_by, note  
**payment_schedules** (optional): application_id, due_date, amount, status

## 7. Notifications
**notification_logs**: channel(email/sms/whatsapp), to, template, payload(json), status, error, sent_at  
**jobs / failed_jobs**: Laravel queue

## 8. Relationships (summary)
- Service 1—N Package; Package 1—N Departure; Package N—N Country
- Country 1—N JobDemand, University; Category 1—N JobDemand
- University 1—N Program 1—N Intake
- Lead 0..1—1 Client (converted); Client 1—N Application; Application 1—N Logs/Documents/Payments

## 9. Indexes
- `leads(status, created_at)`, `leads(phone)`, `applications(tracking_code)`, `applications(status, service_type)`, `clients(phone)`, `job_demands(status, application_deadline)`, `package_departures(departure_date, status)`, slugs unique.
- FULLTEXT optional on packages/job_demands titles (or use Scout later).

## 10. Rules
- Encrypt `passport_no`, `nid_no` (Laravel `encrypted` cast); keep a hash column (`passport_no_hash`) for lookup.
- Phones normalized to `+8801XXXXXXXXX` before save.
- `paid_amount` recalculated by `PaymentService` on payment create/delete.
- Never hard-delete applications/payments (soft delete + log).
- Seeders: roles, permissions, default services, countries (Saudi Arabia, UAE, Qatar, Kuwait, Oman, Bahrain, Malaysia, Romania, Poland, Croatia, etc.), job categories, settings, admin user.

## 11. ERD sketch
```
services─<packages─<package_departures
   │          └─>package_country<─countries─<job_demands>─job_categories
   │                                  └─<universities─<study_programs─<study_intakes
leads ─(convert)→ clients ─<applications─<application_documents
                                   ├─<application_status_logs
                                   └─<payments
```
