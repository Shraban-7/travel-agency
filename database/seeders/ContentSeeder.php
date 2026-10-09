<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\ApplicationExtra;
use App\Models\Certificate;
use App\Models\Country;
use App\Models\Download;
use App\Models\Faq;
use App\Models\GalleryItem;
use App\Models\Lead;
use App\Models\LeadNote;
use App\Models\Notice;
use App\Models\NotificationLog;
use App\Models\Office;
use App\Models\Package;
use App\Models\PackageMedia;
use App\Models\Page;
use App\Models\PaymentSchedule;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPages();
        $this->seedFaqs();
        $this->seedTestimonials();
        $this->seedTeamMembers();
        $this->seedCertificates();
        $this->seedGalleryItems();
        $this->seedPosts();
        $this->seedNotices();
        $this->seedDownloads();
        $this->seedOffices();
        $this->seedPackageMedia();
        $this->seedPackageCountries();
        $this->seedLeadNotes();
        $this->seedApplicationExtras();
        $this->seedApplicationDocuments();
        $this->seedPaymentSchedules();
        $this->seedNotificationLogs();
    }

    protected function seedPages(): void
    {
        $pages = [
            [
                'slug' => 'about-us',
                'title' => ['bn' => 'আমাদের সম্পর্কে', 'en' => 'About Us'],
                'body' => [
                    'bn' => "আমরা গত এক দশকেরও বেশি সময় ধরে বাংলাদেশি মুসল্লি, চাকরিপ্রত্যাশী ও শিক্ষার্থীদের সেবা দিয়ে আসছি। হজ ও ওমরাহ, বৈদেশিক কর্মসংস্থান, বিদেশে উচ্চশিক্ষা, ট্যুর ও ভিসা প্রসেসিং — প্রতিটি সেবায় আমাদের লক্ষ্য একটাই: স্বচ্ছ খরচ, সঠিক তথ্য ও নিরাপদ ভ্রমণ।\n\nআমাদের রয়েছে সরকারি হজ লাইসেন্স ও বিএমইটি রিক্রুটিং লাইসেন্স। অভিজ্ঞ কনসালট্যান্ট, ঢাকা ও চট্টগ্রামে নিজস্ব অফিস এবং সৌদি আরব, মালয়েশিয়া ও মধ্যপ্রাচ্যে নির্ভরযোগ্য পার্টনার নেটওয়ার্কের মাধ্যমে আমরা প্রতিটি ক্লায়েন্টকে শুরু থেকে শেষ পর্যন্ত সহযোগিতা করি।\n\nভিসা, টিকিট, হোটেল, প্রশিক্ষণ কিংবা এয়ারপোর্ট সহায়তা — যেকোনো প্রয়োজনে আমাদের হটলাইনে কল করুন অথবা অফিসে এসে ফ্রি কাউন্সেলিং নিন। আপনার আস্থাই আমাদের সবচেয়ে বড় অর্জন।",
                    'en' => "For more than a decade we have been serving Bangladeshi pilgrims, job seekers and students. From Hajj and Umrah to overseas jobs, study abroad, tours and visa processing, our promise is simple: transparent pricing, correct information and safe travel.\n\nWe hold a government Hajj license and a BMET recruiting license. With experienced consultants, our own offices in Dhaka and Chattogram, and trusted partners in Saudi Arabia, Malaysia and the Middle East, we support every client from the first consultation to the safe return home.\n\nFor visas, tickets, hotels, training or airport assistance, call our hotline or visit our office for free counselling. Your trust is our biggest achievement.",
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'privacy-policy',
                'title' => ['bn' => 'প্রাইভেসি পলিসি', 'en' => 'Privacy Policy'],
                'body' => [
                    'bn' => "আপনার ব্যক্তিগত তথ্যের নিরাপত্তা আমাদের কাছে অত্যন্ত গুরুত্বপূর্ণ। পাসপোর্ট, জাতীয় পরিচয়পত্র, ছবি, মেডিকেল রিপোর্ট কিংবা পেমেন্ট সংক্রান্ত যেকোনো তথ্য আমরা শুধুমাত্র আপনার সেবা প্রক্রিয়াকরণের কাজে ব্যবহার করি। আপনার অনুমতি ছাড়া কোনো তথ্য তৃতীয় পক্ষের কাছে বিক্রি বা হস্তান্তর করা হয় না।\n\nভিসা, এয়ারলাইন্স, হোটেল বা সরকারি কর্তৃপক্ষের কাছে ফাইল জমা দেওয়ার প্রয়োজনে শুধুমাত্র সংশ্লিষ্ট তথ্য শেয়ার করা হয়, এবং তা শুধু আপনার আবেদন সম্পন্ন করার উদ্দেশ্যে। আমাদের ওয়েবসাইটে সংরক্ষিত তথ্য নিরাপদ সার্ভারে রাখা হয় এবং অনুমোদিত কর্মী ছাড়া কেউ তা দেখতে পারে না।\n\nআপনি চাইলে যেকোনো সময় আপনার তথ্য দেখতে, সংশোধন করতে বা মুছে ফেলার অনুরোধ করতে পারেন। এজন্য আমাদের অফিসে যোগাযোগ করুন অথবা ইমেইল করুন। এই নীতি সময়ে সময়ে হালনাগাদ হতে পারে এবং হালনাগাদ সংস্করণ এই পাতায় প্রকাশ করা হবে।",
                    'en' => "The security of your personal information is very important to us. Passports, national ID cards, photographs, medical reports and payment details are used only to process your service. We never sell or hand over your data to third parties without your permission.\n\nRelevant information is shared with visa authorities, airlines, hotels or government bodies only when required to complete your application. Data stored on our website is kept on secure servers and is accessible only to authorized staff.\n\nYou may request to view, correct or delete your information at any time by contacting our office or sending an email. This policy may be updated from time to time, and the updated version will be published on this page.",
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'terms-conditions',
                'title' => ['bn' => 'শর্তাবলী', 'en' => 'Terms and Conditions'],
                'body' => [
                    'bn' => "আমাদের যেকোনো প্যাকেজ বা সেবা বুকিং করার মাধ্যমে আপনি নিম্নোক্ত শর্তাবলীতে সম্মত হচ্ছেন। বুকিং কনফার্ম করতে নির্ধারিত অগ্রিম পরিশোধ করতে হবে এবং বাকি টাকা যাত্রা বা ভিসা জমার আগেই পরিশোধ করতে হবে। ভিসা নীতি, এয়ারলাইন্স ভাড়া বা হোটেল মূল্য পরিবর্তন হলে প্যাকেজ মূল্য যৌক্তিকভাবে সমন্বয় করা হতে পারে, যা আগেই জানিয়ে দেওয়া হবে।\n\nআবেদনকারীকে সঠিক ও আসল কাগজপত্র জমা দিতে হবে। ভুয়া তথ্য বা নকল ডকুমেন্টের কারণে ভিসা বাতিল হলে বা জরিমানা হলে তার দায় আবেদনকারীর। দূতাবাস বা সরকারি কর্তৃপক্ষ ভিসা প্রত্যাখ্যান করলে আমরা পুনরায় আবেদনের সর্বোচ্চ চেষ্টা করব, তবে ভিসা অনুমোদনের নিশ্চয়তা কেউ দিতে পারে না।\n\nযাত্রা বাতিল বা তারিখ পরিবর্তনের ক্ষেত্রে রিফান্ড পলিসি অনুযায়ী ব্যবস্থা নেওয়া হবে। এয়ারলাইন্স, হোটেল বা প্রাকৃতিক দুর্যোগের কারণে সূচি পরিবর্তন হলে বিকল্প ব্যবস্থা নেওয়া হবে। কোনো বিরোধ দেখা দিলে প্রথমে আলোচনার মাধ্যমে সমাধানের চেষ্টা করা হবে।",
                    'en' => "By booking any of our packages or services you agree to the following terms. A fixed advance is required to confirm a booking, and the remaining amount must be paid before travel or visa submission. If visa policies, airfares or hotel rates change, the package price may be reasonably adjusted with prior notice.\n\nApplicants must submit correct and genuine documents. If a visa is rejected due to false information or forged papers, the applicant bears full responsibility. If an embassy or authority refuses a visa, we will try our best to reapply, but no one can guarantee visa approval.\n\nCancellations or date changes are handled according to our refund policy. If schedules change due to airlines, hotels or natural causes, alternative arrangements will be made. Any dispute will first be addressed through discussion and negotiation.",
                ],
                'is_active' => true,
            ],
            [
                'slug' => 'refund-policy',
                'title' => ['bn' => 'রিফান্ড পলিসি', 'en' => 'Refund Policy'],
                'body' => [
                    'bn' => "বুকিং বাতিল করলে নিম্নোক্ত নিয়মে রিফান্ড দেওয়া হয়। ভিসা জমা বা টিকিট ইস্যুর আগে বাতিল করলে সার্ভিস চার্জ বাদে বাকি টাকা ফেরত দেওয়া হয়। টিকিট ইস্যু হয়ে গেলে এয়ারলাইন্সের নিয়ম অনুযায়ী ক্যানসেলেশন চার্জ কাটা হবে এবং হোটেল বুকিং বাতিলের চার্জ প্রযোজ্য হতে পারে।\n\nভিসা প্রত্যাখ্যাত হলে ভিসা ফি, মেডিকেল ফি ও দূতাবাস চার্জ ফেরতযোগ্য নয়, তবে প্যাকেজের বাকি অংশের টাকা ফেরত বা পরবর্তী তারিখে সমন্বয় করা যায়। আমাদের পক্ষ থেকে সেবা বাতিল হলে সম্পূর্ণ অগ্রিম টাকা ফেরত দেওয়া হয় অথবা বিকল্প প্যাকেজের ব্যবস্থা করা হয়।\n\nরিফান্ডের আবেদন লিখিতভাবে অফিসে জমা দিতে হবে অথবা ইমেইল করতে হবে। যাচাই শেষে ৭ থেকে ১৫ কর্মদিবসের মধ্যে ব্যাংক বা নগদে রিফান্ড পরিশোধ করা হয়। রিফান্ড সংক্রান্ত যেকোনো প্রশ্নে আমাদের হটলাইনে যোগাযোগ করুন।",
                    'en' => "Cancellations are refunded under the following rules. If you cancel before visa submission or ticket issuance, the paid amount is refunded after deducting the service charge. After ticket issuance, airline cancellation charges apply, and hotel cancellation fees may also apply.\n\nIf a visa is refused, visa fees, medical fees and embassy charges are non refundable, but the remaining package amount can be refunded or adjusted to a later date. If we cancel a service from our side, the full advance is refunded or an alternative package is arranged.\n\nRefund requests must be submitted to our office in writing or by email. After verification, refunds are paid by bank transfer or cash within 7 to 15 working days. For any refund question, please contact our hotline.",
                ],
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }

    protected function seedFaqs(): void
    {
        $hajj = Service::where('slug', 'hajj-umrah')->first();
        $jobs = Service::where('slug', 'overseas-employment')->first();
        $study = Service::where('slug', 'study-abroad')->first();

        $faqs = [
            [
                'service_id' => $hajj?->id,
                'country_id' => null,
                'question' => ['bn' => 'হজ প্যাকেজের খরচ কত?', 'en' => 'How much does a Hajj package cost?'],
                'answer' => [
                    'bn' => 'মৌসুম ও প্যাকেজভেদে হজের খরচ সাধারণত ৫ লাখ ৫০ হাজার থেকে ৮ লাখ টাকার মধ্যে হয়। এর মধ্যে ভিসা, বিমান টিকিট, মক্কা ও মদিনার হোটেল, তিন বেলা খাবার, পরিবহন ও গাইড সেবা অন্তর্ভুক্ত। সঠিক মূল্য জানতে চলতি বছরের প্যাকেজ তালিকা দেখুন অথবা অফিসে যোগাযোগ করুন।',
                    'en' => 'Depending on the season and package, Hajj usually costs between BDT 550,000 and BDT 800,000. This includes the visa, air ticket, hotels in Makkah and Madinah, three meals a day, transport and guide service. Check the current year package list or contact our office for the exact price.',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'service_id' => $hajj?->id,
                'country_id' => null,
                'question' => ['bn' => 'হজ বা ওমরাহে যেতে কী কী কাগজপত্র লাগবে?', 'en' => 'Which documents are required for Hajj or Umrah?'],
                'answer' => [
                    'bn' => 'বৈধ পাসপোর্ট (মেয়াদ কমপক্ষে ৬ মাস), জাতীয় পরিচয়পত্রের কপি, পাসপোর্ট সাইজ ছবি, করোনা টিকা সনদ (প্রযোজ্য হলে) এবং মহিলাদের ক্ষেত্রে মাহরামের প্রমাণপত্র লাগবে। ৪০ বছরের বেশি বয়সী মহিলারা নির্ধারিত শর্তে একা যেতে পারেন। মূল কাগজ নিয়ে অফিসে এলে আমরা ফাইল তৈরি করে দিই।',
                    'en' => 'You need a valid passport with at least 6 months validity, a copy of your national ID, passport size photographs, a vaccination certificate if applicable, and proof of mahram for female pilgrims. Women above 40 may travel alone under set conditions. Bring your original papers to our office and we will prepare the file for you.',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'service_id' => $jobs?->id,
                'country_id' => null,
                'question' => ['bn' => 'বিদেশে চাকরিতে যেতে মোট খরচ কত হবে?', 'en' => 'What is the total cost of going abroad for a job?'],
                'answer' => [
                    'bn' => 'দেশ ও কাজের ধরন অনুযায়ী খরচ ২ লাখ থেকে ৫ লাখ টাকার মধ্যে হয়। এর মধ্যে ভিসা প্রসেসিং, মেডিকেল, প্রশিক্ষণ, টিকিট ও সার্ভিস চার্জ অন্তর্ভুক্ত। প্রতিটি চাকরির বিজ্ঞপ্তিতে মোট খরচ, বেতন ও সুবিধা স্পষ্টভাবে লেখা থাকে। কোনো লুকানো চার্জ নেওয়া হয় না।',
                    'en' => 'Depending on the country and job type, the cost ranges from BDT 200,000 to BDT 500,000. This covers visa processing, medical tests, training, tickets and the service charge. Every job circular clearly states the total cost, salary and benefits. There are no hidden charges.',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'service_id' => $jobs?->id,
                'country_id' => null,
                'question' => ['bn' => 'ওয়ার্ক ভিসা পেতে কতদিন সময় লাগে?', 'en' => 'How long does it take to get a work visa?'],
                'answer' => [
                    'bn' => 'সাধারণত ৪৫ থেকে ৯০ দিনের মধ্যে সম্পূর্ণ প্রক্রিয়া শেষ হয়। এর মধ্যে ইন্টারভিউ, মেডিকেল, ভিসা স্ট্যাম্পিং ও ফ্লাইট অন্তর্ভুক্ত। সৌদি আরব, কাতার ও মালয়েশিয়ার ফাইল দ্রুত হয়, ইউরোপের ক্ষেত্রে ৩ থেকে ৬ মাস লাগতে পারে। প্রতিটি ধাপে এসএমএস ও ফোনে আপডেট দেওয়া হয়।',
                    'en' => 'The full process usually takes 45 to 90 days, including the interview, medical tests, visa stamping and flight. Files for Saudi Arabia, Qatar and Malaysia move fast, while Europe may take 3 to 6 months. You receive updates by SMS and phone at every stage.',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'service_id' => $study?->id,
                'country_id' => null,
                'question' => ['bn' => 'মালয়েশিয়ায় পড়াশোনার খরচ কেমন?', 'en' => 'How much does it cost to study in Malaysia?'],
                'answer' => [
                    'bn' => 'বিশ্ববিদ্যালয়ভেদে বছরে টিউশন ফি ৩ লাখ থেকে ৭ লাখ টাকা এবং থাকা-খাওয়া বাবদ মাসে ৩০ থেকে ৪৫ হাজার টাকা খরচ হয়। ভর্তি, ভিসা ও টিকিটসহ প্রথম বছরে মোটামুটি ৬ থেকে ৯ লাখ টাকা বাজেট রাখা ভালো। আমাদের কাউন্সেলর আপনার বাজেট অনুযায়ী বিশ্ববিদ্যালয় বাছাই করে দেবেন।',
                    'en' => 'Depending on the university, yearly tuition is BDT 300,000 to BDT 700,000, and living costs are BDT 30,000 to BDT 45,000 per month. Including admission, visa and tickets, keeping a first year budget of BDT 600,000 to BDT 900,000 is wise. Our counsellor will help you choose a university that fits your budget.',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'service_id' => $study?->id,
                'country_id' => null,
                'question' => ['bn' => 'স্টুডেন্ট ভিসার জন্য কী কী ডকুমেন্ট লাগবে?', 'en' => 'Which documents are needed for a student visa?'],
                'answer' => [
                    'bn' => 'এসএসসি ও এইচএসসির সার্টিফিকেট ও মার্কশিট, পাসপোর্ট, ছবি, জন্ম নিবন্ধন বা এনআইডি, ব্যাংক স্টেটমেন্ট এবং বিশ্ববিদ্যালয়ের অফার লেটার লাগবে। আইইএলটিএস ছাড়াও মালয়েশিয়ার অনেক বিশ্ববিদ্যালয়ে ভর্তি হওয়া যায়। ডকুমেন্ট প্রস্তুত থেকে ভিসা পর্যন্ত আমরা পুরো সহযোগিতা করি।',
                    'en' => 'You need SSC and HSC certificates and mark sheets, a passport, photographs, birth registration or NID, bank statements and the university offer letter. Many Malaysian universities accept students without IELTS. We support you fully, from document preparation to the visa.',
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'service_id' => null,
                'country_id' => null,
                'question' => ['bn' => 'কীভাবে পেমেন্ট করবো? কিস্তির সুবিধা আছে কি?', 'en' => 'How can I pay? Is there an installment facility?'],
                'answer' => [
                    'bn' => 'নগদ, ব্যাংক ট্রান্সফার, বিকাশ, নগদ ও রকেটে পেমেন্ট করতে পারবেন। প্রতিটি পেমেন্টের বিপরীতে অফিসিয়াল রসিদ দেওয়া হয়। হজ, স্টাডি ও বড় ট্যুর প্যাকেজে ২ থেকে ৩ কিস্তিতে টাকা পরিশোধের সুবিধা আছে। বাকি টাকার তারিখ পেমেন্ট শিডিউলে লিখে দেওয়া হয়।',
                    'en' => 'You can pay by cash, bank transfer, bKash, Nagad or Rocket. An official receipt is issued for every payment. Hajj, study and large tour packages can be paid in 2 to 3 installments. Due dates are written clearly in your payment schedule.',
                ],
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'service_id' => null,
                'country_id' => null,
                'question' => ['bn' => 'বুকিং বাতিল করলে কি টাকা ফেরত পাবো? অগ্রগতি কীভাবে জানবো?', 'en' => 'Will I get a refund on cancellation? How do I track progress?'],
                'answer' => [
                    'bn' => 'হ্যাঁ, রিফান্ড পলিসি অনুযায়ী টাকা ফেরত পাবেন। ভিসা বা টিকিট হওয়ার আগে বাতিল করলে সার্ভিস চার্জ বাদে বাকি টাকা ফেরত দেওয়া হয়। আপনার ট্র্যাকিং কোড দিয়ে ওয়েবসাইটে অগ্রগতি দেখতে পারবেন এবং প্রতিটি ধাপে এসএমএস পাবেন। বিস্তারিত জানতে হটলাইনে কল করুন।',
                    'en' => 'Yes, you will get a refund under our refund policy. If you cancel before visa or ticket issuance, the paid amount is refunded after deducting the service charge. You can track progress on our website with your tracking code and you will receive SMS updates at each stage. Call our hotline for details.',
                ],
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            $existing = Faq::where('question->bn', $faq['question']['bn'])->first();
            if ($existing) {
                $existing->update($faq);
            } else {
                Faq::create($faq);
            }
        }
    }

    protected function seedTestimonials(): void
    {
        $hajj = Service::where('slug', 'hajj-umrah')->first();
        $jobs = Service::where('slug', 'overseas-employment')->first();
        $study = Service::where('slug', 'study-abroad')->first();
        $tour = Service::where('slug', 'tour-packages')->first();

        $rows = [
            [
                'name' => 'মোঃ রফিকুল ইসলাম',
                'photo' => null,
                'designation' => 'ব্যবসায়ী, ঢাকা',
                'country' => 'সৌদি আরব',
                'service_id' => $hajj?->id,
                'content' => [
                    'bn' => 'আলহামদুলিল্লাহ, তাদের মাধ্যমে ২০২৫ সালে হজ সম্পন্ন করেছি। হোটেল ছিল হারাম শরীফের কাছে, খাবার ভালো ছিল এবং গাইড সবসময় সাথে ছিলেন। টাকা নিয়ে কোনো ঝামেলা হয়নি।',
                    'en' => 'Alhamdulillah, I performed Hajj in 2025 through them. The hotel was close to Haram Sharif, the food was good, and the guide stayed with us all the time. There was no issue regarding money.',
                ],
                'video_url' => null,
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'হাজী আব্দুল করিম',
                'photo' => null,
                'designation' => 'অবসরপ্রাপ্ত শিক্ষক, কুমিল্লা',
                'country' => 'সৌদি আরব',
                'service_id' => $hajj?->id,
                'content' => [
                    'bn' => 'বয়স্ক মানুষ হিসেবে আমার জন্য তাদের সেবা ছিল অসাধারণ। হুইলচেয়ার, ওষুধ ও বিশ্রামের দিকে তারা বিশেষ খেয়াল রেখেছে। আমার পরিবারের সবাই সন্তুষ্ট।',
                    'en' => 'As an elderly person, their service was excellent for me. They took special care of my wheelchair, medicines and rest. My whole family is satisfied.',
                ],
                'video_url' => null,
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'মোঃ জাহাঙ্গীর আলম',
                'photo' => null,
                'designation' => 'ফ্যাক্টরি কর্মী, গাজীপুর',
                'country' => 'সৌদি আরব',
                'service_id' => $jobs?->id,
                'content' => [
                    'bn' => 'আমি সৌদি আরবে একটি ফ্যাক্টরিতে কাজ করছি। বেতন ঠিকমতো পাচ্ছি, থাকার ব্যবস্থা কোম্পানি দিয়েছে। ভিসা থেকে ফ্লাইট পর্যন্ত তারা প্রতিটি ধাপে খবর দিয়েছে।',
                    'en' => 'I am working in a factory in Saudi Arabia. I receive my salary on time, and the company provides accommodation. They kept me informed at every step, from visa to flight.',
                ],
                'video_url' => null,
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'শারমিন আক্তার',
                'photo' => null,
                'designation' => 'নার্স, চট্টগ্রাম',
                'country' => 'মালয়েশিয়া',
                'service_id' => $study?->id,
                'content' => [
                    'bn' => 'মালয়েশিয়ায় নার্সিং পড়ার স্বপ্ন তাদের কারণেই পূরণ হয়েছে। বিশ্ববিদ্যালয় ভর্তি থেকে ভিসা পর্যন্ত সব কাজ তারা করে দিয়েছে। খরচও আগে থেকেই পরিষ্কার জানিয়ে দিয়েছিল।',
                    'en' => 'My dream of studying nursing in Malaysia came true because of them. They handled everything from university admission to the visa. The costs were also made clear in advance.',
                ],
                'video_url' => null,
                'rating' => 4,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'ফাতেমা বেগম',
                'photo' => null,
                'designation' => 'গৃহিণী, সিলেট',
                'country' => 'সংযুক্ত আরব আমিরাত',
                'service_id' => $tour?->id,
                'content' => [
                    'bn' => 'পরিবারসহ দুবাই ঘুরে এসেছি। হোটেল, গাড়ি ও গাইড সব ঠিকঠাক ছিল। বাচ্চাদের নিয়ে কোনো কষ্ট হয়নি। পরের বছর মালয়েশিয়া যাওয়ার ইচ্ছা আছে তাদের সাথেই।',
                    'en' => 'We visited Dubai with our family. The hotel, car and guide were all well arranged. Travelling with kids was comfortable. We plan to visit Malaysia next year with them again.',
                ],
                'video_url' => null,
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'তানভীর আহমেদ',
                'photo' => null,
                'designation' => 'প্রবাসী কর্মী, রিয়াদ',
                'country' => 'সৌদি আরব',
                'service_id' => $jobs?->id,
                'content' => [
                    'bn' => 'দালালের খপ্পরে না পড়ে বৈধভাবে বিদেশ আসতে পেরে আমি খুশি। তাদের লাইসেন্স যাচাই করে নিয়েছিলাম। দুই মাসের মধ্যে ভিসা পেয়ে গেছি। ধন্যবাদ পুরো টিমকে।',
                    'en' => 'I am glad I could come abroad legally without falling into the trap of middlemen. I verified their license first. I received my visa within two months. Thanks to the whole team.',
                ],
                'video_url' => null,
                'rating' => 4,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($rows as $row) {
            $existing = Testimonial::where('name', $row['name'])
                ->where('sort_order', $row['sort_order'])
                ->first();
            if ($existing) {
                $existing->update($row);
            } else {
                Testimonial::create($row);
            }
        }
    }

    protected function seedTeamMembers(): void
    {
        $members = [
            [
                'name' => ['bn' => 'আলহাজ্ব মোঃ নূরুল আমিন', 'en' => 'Alhaj Md. Nurul Amin'],
                'role' => ['bn' => 'ব্যবস্থাপনা পরিচালক', 'en' => 'Managing Director'],
                'photo' => null,
                'phone' => '+8801712345678',
                'sort_order' => 1,
            ],
            [
                'name' => ['bn' => 'হাফেজ মাওলানা আব্দুল্লাহ', 'en' => 'Hafez Mawlana Abdullah'],
                'role' => ['bn' => 'হজ কনসালট্যান্ট', 'en' => 'Hajj Consultant'],
                'photo' => null,
                'phone' => '+8801812345678',
                'sort_order' => 2,
            ],
            [
                'name' => ['bn' => 'মোঃ কামরুল হাসান', 'en' => 'Md. Kamrul Hasan'],
                'role' => ['bn' => 'ভিসা অফিসার', 'en' => 'Visa Officer'],
                'photo' => null,
                'phone' => '+8801912345678',
                'sort_order' => 3,
            ],
            [
                'name' => ['bn' => 'নুসরাত জাহান', 'en' => 'Nusrat Jahan'],
                'role' => ['bn' => 'স্টুডেন্ট কাউন্সেলর', 'en' => 'Student Counselor'],
                'photo' => null,
                'phone' => '+8801612345678',
                'sort_order' => 4,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(['sort_order' => $member['sort_order']], $member);
        }
    }

    protected function seedCertificates(): void
    {
        $certs = [
            [
                'title' => ['bn' => 'হজ লাইসেন্স', 'en' => 'Hajj License'],
                'number' => 'HL-0932',
                'issuer' => 'ধর্ম বিষয়ক মন্ত্রণালয়, বাংলাদেশ',
                'image' => null,
                'sort_order' => 1,
            ],
            [
                'title' => ['bn' => 'রিক্রুটিং লাইসেন্স (বিএমইটি)', 'en' => 'Recruiting License (BMET)'],
                'number' => 'RL-1587',
                'issuer' => 'জনশক্তি কর্মসংস্থান ও প্রশিক্ষণ ব্যুরো (বিএমইটি)',
                'image' => null,
                'sort_order' => 2,
            ],
            [
                'title' => ['bn' => 'আটাব সদস্যপদ', 'en' => 'ATAB Membership'],
                'number' => 'ATAB-4521',
                'issuer' => 'অ্যাসোসিয়েশন অব ট্রাভেল এজেন্টস অব বাংলাদেশ (আটাব)',
                'image' => null,
                'sort_order' => 3,
            ],
        ];

        foreach ($certs as $cert) {
            Certificate::updateOrCreate(['number' => $cert['number']], $cert);
        }
    }

    protected function seedGalleryItems(): void
    {
        $items = [
            [
                'type' => 'photo',
                'file' => 'assets/img/hero-makkah.jpg',
                'caption' => ['bn' => 'পবিত্র মক্কা শরীফে হাজীদের গ্রুপ', 'en' => 'Pilgrim group at Makkah Sharif'],
                'album' => 'hajj',
                'sort_order' => 1,
            ],
            [
                'type' => 'photo',
                'file' => 'assets/img/madinah.jpg',
                'caption' => ['bn' => 'মদিনায় মসজিদে নববীর সামনে', 'en' => 'In front of Masjid Nabawi in Madinah'],
                'album' => 'hajj',
                'sort_order' => 2,
            ],
            [
                'type' => 'photo',
                'file' => 'assets/img/malaysia.jpg',
                'caption' => ['bn' => 'মালয়েশিয়া ট্যুর গ্রুপ', 'en' => 'Malaysia tour group'],
                'album' => 'tour',
                'sort_order' => 3,
            ],
            [
                'type' => 'photo',
                'file' => 'assets/img/hero-makkah.jpg',
                'caption' => ['bn' => 'ওমরাহ যাত্রীদের বিদায় অনুষ্ঠান', 'en' => 'Farewell program for Umrah travellers'],
                'album' => 'office',
                'sort_order' => 4,
            ],
            [
                'type' => 'photo',
                'file' => 'assets/img/madinah.jpg',
                'caption' => ['bn' => 'ঢাকা অফিসে ফ্রি হজ প্রশিক্ষণ', 'en' => 'Free Hajj training at Dhaka office'],
                'album' => 'office',
                'sort_order' => 5,
            ],
            [
                'type' => 'photo',
                'file' => 'assets/img/malaysia.jpg',
                'caption' => ['bn' => 'কুয়ালালামপুর সিটি ট্যুর', 'en' => 'Kuala Lumpur city tour'],
                'album' => 'tour',
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::updateOrCreate(
                ['file' => $item['file'], 'album' => $item['album'], 'sort_order' => $item['sort_order']],
                $item
            );
        }
    }

    protected function seedPosts(): void
    {
        $authorId = User::first()?->id;

        $posts = [
            [
                'slug' => 'hajj-2026-registration-open',
                'title' => ['bn' => 'হজ ২০২৬: অগ্রিম নিবন্ধন শুরু', 'en' => 'Hajj 2026: Early Registration Open'],
                'excerpt' => [
                    'bn' => 'হজ ২০২৬ এর অগ্রিম নিবন্ধন শুরু হয়েছে। আসন সীমিত, তাই দ্রুত বুকিং করুন।',
                    'en' => 'Early registration for Hajj 2026 has started. Seats are limited, so book early.',
                ],
                'body' => [
                    'bn' => "হজ ২০২৬ এর অগ্রিম নিবন্ধন শুরু হয়েছে। সরকারি কোটা অনুযায়ী আসন সীমিত থাকায় আগে আবেদনকারীরা ভালো হোটেল ও ফ্লাইটের সুবিধা পাবেন।\n\nনিবন্ধনের জন্য পাসপোর্ট, এনআইডি কপি ও অগ্রিম টাকা নিয়ে আমাদের ঢাকা বা চট্টগ্রাম অফিসে আসুন। অনলাইনেও ফরম পূরণ করে আসন সংরক্ষণ করা যাবে।\n\nবিস্তারিত প্যাকেজ মূল্য, হোটেলের দূরত্ব ও খাবার মেনু জানতে হটলাইনে কল করুন অথবা অফিসে এসে ফ্রি কাউন্সেলিং নিন।",
                    'en' => "Early registration for Hajj 2026 has started. Since seats under the government quota are limited, early applicants will get better hotels and flights.\n\nBring your passport, NID copy and advance payment to our Dhaka or Chattogram office to register. Seats can also be reserved by filling in the online form.\n\nCall our hotline or visit our office for free counselling to learn package prices, hotel distances and food menus in detail.",
                ],
                'cover_image' => 'assets/img/hero-makkah.jpg',
                'category' => 'news',
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'author_id' => $authorId,
            ],
            [
                'slug' => 'saudi-umrah-visa-update-2026',
                'title' => ['bn' => 'সৌদি ওমরাহ ভিসার নতুন আপডেট', 'en' => 'New Saudi Umrah Visa Update'],
                'excerpt' => [
                    'bn' => 'ওমরাহ ভিসা প্রসেসিং এখন দ্রুত হচ্ছে। নতুন নিয়ম ও প্রয়োজনীয় কাগজপত্র জেনে নিন।',
                    'en' => 'Umrah visa processing is now faster. Learn the new rules and required papers.',
                ],
                'body' => [
                    'bn' => "সৌদি কর্তৃপক্ষ ওমরাহ ভিসা প্রসেসিং আরও সহজ করেছে। এখন সঠিক কাগজপত্র থাকলে ৩ থেকে ৫ কর্মদিবসে ভিসা পাওয়া যাচ্ছে।\n\nপাসপোর্টের মেয়াদ কমপক্ষে ৬ মাস থাকতে হবে এবং ছবি হতে হবে সাদা ব্যাকগ্রাউন্ডের। আগের কোনো ভিসা জটিলতা থাকলে আবেদনের আগেই আমাদের জানান।\n\nএই মাসে ওমরাহ প্যাকেজে বিশেষ ছাড় চলছে। পরিবারসহ যেতে চাইলে গ্রুপ বুকিংয়ে অতিরিক্ত সুবিধা পাবেন।",
                    'en' => "Saudi authorities have made Umrah visa processing easier. With correct papers, visas are now issued within 3 to 5 working days.\n\nYour passport must be valid for at least 6 months and photos must have a white background. Inform us before applying if you had any previous visa complications.\n\nSpecial discounts are available on Umrah packages this month. Family and group bookings receive extra benefits.",
                ],
                'cover_image' => 'assets/img/madinah.jpg',
                'category' => 'visa_update',
                'published_at' => now()->subDays(5),
                'is_published' => true,
                'author_id' => $authorId,
            ],
            [
                'slug' => 'office-holiday-notice-eid',
                'title' => ['bn' => 'ঈদ উপলক্ষে অফিস ছুটির বিজ্ঞপ্তি', 'en' => 'Office Holiday Notice for Eid'],
                'excerpt' => [
                    'bn' => 'পবিত্র ঈদ উপলক্ষে আমাদের অফিস ৩ দিন বন্ধ থাকবে। জরুরি প্রয়োজনে হটলাইনে যোগাযোগ করুন।',
                    'en' => 'Our offices will remain closed for 3 days on Eid. Contact the hotline for urgent needs.',
                ],
                'body' => [
                    'bn' => "পবিত্র ঈদুল ফিতর উপলক্ষে আমাদের ঢাকা ও চট্টগ্রাম অফিস ৩ দিন বন্ধ থাকবে। এই সময়ে অনলাইনে আবেদন করা যাবে, ছুটির পর ধারাবাহিকভাবে ফাইল প্রসেস করা হবে।\n\nযাদের ফ্লাইট ছুটির মধ্যে রয়েছে, তাদের ফাইল আগেই প্রস্তুত করে দেওয়া হয়েছে। জরুরি প্রয়োজনে হটলাইনে কল করুন।\n\nসবাইকে পবিত্র ঈদের শুভেচ্ছা।",
                    'en' => "On the occasion of Eid-ul-Fitr, our Dhaka and Chattogram offices will remain closed for 3 days. Online applications will still be accepted and files will be processed serially after the holiday.\n\nFiles for travellers flying during the holiday have already been prepared. Call the hotline for urgent needs.\n\nEid Mubarak to everyone.",
                ],
                'cover_image' => null,
                'category' => 'notice',
                'published_at' => now()->subDays(9),
                'is_published' => true,
                'author_id' => $authorId,
            ],
            [
                'slug' => 'malaysia-study-guide-2026',
                'title' => ['bn' => 'মালয়েশিয়ায় পড়াশোনা: পূর্ণ গাইডলাইন', 'en' => 'Study in Malaysia: Complete Guideline'],
                'excerpt' => [
                    'bn' => 'কম খরচে মানসম্মত ডিগ্রির জন্য মালয়েশিয়া সেরা পছন্দ। ভর্তি থেকে ভিসা পর্যন্ত ধাপগুলো জেনে নিন।',
                    'en' => 'Malaysia is the best choice for an affordable quality degree. Learn each step from admission to visa.',
                ],
                'body' => [
                    'bn' => "কম টিউশন ফি, সহজ ভিসা ও মুসলিমবান্ধব পরিবেশের কারণে বাংলাদেশি শিক্ষার্থীদের কাছে মালয়েশিয়া এখন শীর্ষ পছন্দ। আইইএলটিএস ছাড়াও অনেক বিশ্ববিদ্যালয়ে ভর্তির সুযোগ আছে।\n\nপ্রথমে পছন্দের সাবজেক্ট ও বাজেট ঠিক করুন, তারপর অফার লেটার, ইএমজিএস অনুমোদন ও ভিসা স্টিকার — এই তিন ধাপে কাজ শেষ হয়। পুরো প্রক্রিয়ায় ৬ থেকে ১০ সপ্তাহ সময় লাগে।\n\nফ্রি কাউন্সেলিংয়ের জন্য সার্টিফিকেট নিয়ে আমাদের অফিসে আসুন। স্কলারশিপের সুযোগ সম্পর্কেও বিস্তারিত জানিয়ে দেওয়া হবে।",
                    'en' => "Malaysia is now a top choice for Bangladeshi students because of low tuition fees, easy visas and a Muslim friendly environment. Many universities offer admission without IELTS.\n\nFirst fix your subject and budget, then complete three steps: the offer letter, EMGS approval and the visa sticker. The full process takes 6 to 10 weeks.\n\nVisit our office with your certificates for free counselling. Scholarship opportunities will also be explained in detail.",
                ],
                'cover_image' => 'assets/img/malaysia.jpg',
                'category' => 'blog',
                'published_at' => now()->subDays(14),
                'is_published' => true,
                'author_id' => $authorId,
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }

    protected function seedNotices(): void
    {
        $notices = [
            [
                'title' => ['bn' => 'হজ ২০২৬: শেষ তারিখ ৩০ নভেম্বর', 'en' => 'Hajj 2026: Deadline 30 November'],
                'body' => [
                    'bn' => 'হজ ২০২৬ এর নিবন্ধনের শেষ তারিখ ৩০ নভেম্বর। এরপর আসন পাওয়া নিশ্চিত নয়। পাসপোর্টসহ দ্রুত অফিসে যোগাযোগ করুন।',
                    'en' => 'The registration deadline for Hajj 2026 is 30 November. Seats cannot be guaranteed after that. Contact our office soon with your passport.',
                ],
                'type' => 'deadline',
                'related_type' => null,
                'related_id' => null,
                'deadline_at' => now()->addDays(45),
                'is_active' => true,
            ],
            [
                'title' => ['bn' => 'রোমানিয়া ওয়ার্ক পারমিট: ইন্টারভিউ ১৫ ডিসেম্বর', 'en' => 'Romania Work Permit: Interview on 15 December'],
                'body' => [
                    'bn' => 'রোমানিয়ার ফ্যাক্টরি ও লজিস্টিকস কাজের জন্য সরাসরি ইন্টারভিউ ১৫ ডিসেম্বর ঢাকা অফিসে অনুষ্ঠিত হবে। মূল পাসপোর্ট ও ছবিসহ সকাল ৯টায় উপস্থিত থাকুন।',
                    'en' => 'Direct interviews for factory and logistics jobs in Romania will be held at our Dhaka office on 15 December. Arrive by 9 AM with your original passport and photographs.',
                ],
                'type' => 'deadline',
                'related_type' => null,
                'related_id' => null,
                'deadline_at' => now()->addDays(60),
                'is_active' => true,
            ],
            [
                'title' => ['bn' => 'ওমরাহ প্যাকেজে বিশেষ ছাড়', 'en' => 'Special Discount on Umrah Packages'],
                'body' => [
                    'bn' => 'এই মাসে ওমরাহ প্যাকেজ বুকিংয়ে বিশেষ ছাড় চলছে। গ্রুপ বুকিংয়ে রয়েছে অতিরিক্ত সুবিধা। বিস্তারিত জানতে অফিসে যোগাযোগ করুন।',
                    'en' => 'Special discounts are available on Umrah package bookings this month, with extra benefits for group bookings. Contact our office for details.',
                ],
                'type' => 'info',
                'related_type' => null,
                'related_id' => null,
                'deadline_at' => null,
                'is_active' => true,
            ],
            [
                'title' => ['bn' => 'নতুন সেবা: অনলাইন ট্র্যাকিং চালু', 'en' => 'New Service: Online Tracking Launched'],
                'body' => [
                    'bn' => 'এখন থেকে ওয়েবসাইটে ট্র্যাকিং কোড দিয়ে আপনার আবেদনের অগ্রগতি দেখতে পারবেন। প্রতিটি ধাপে এসএমএস নোটিফিকেশনও পাবেন।',
                    'en' => 'From now on you can check your application progress on our website using your tracking code. You will also receive SMS notifications at each stage.',
                ],
                'type' => 'info',
                'related_type' => null,
                'related_id' => null,
                'deadline_at' => null,
                'is_active' => true,
            ],
            [
                'title' => ['bn' => 'জরুরি: ভুয়া এজেন্ট থেকে সাবধান', 'en' => 'Urgent: Beware of Fake Agents'],
                'body' => [
                    'bn' => 'আমাদের নাম ব্যবহার করে কেউ অগ্রিম টাকা চাইলে সাবধান থাকুন। অফিসিয়াল রসিদ ছাড়া কাউকে টাকা দেবেন না। সন্দেহ হলে হটলাইনে যাচাই করুন।',
                    'en' => 'Beware if anyone asks for advance money using our name. Never pay anyone without an official receipt. Verify through our hotline if you have any doubt.',
                ],
                'type' => 'urgent',
                'related_type' => null,
                'related_id' => null,
                'deadline_at' => null,
                'is_active' => true,
            ],
        ];

        foreach ($notices as $notice) {
            $existing = Notice::where('title->bn', $notice['title']['bn'])->first();
            if ($existing) {
                $existing->update($notice);
            } else {
                Notice::create($notice);
            }
        }
    }

    protected function seedDownloads(): void
    {
        $files = [
            [
                'title' => ['bn' => 'হজ আবেদন ফরম', 'en' => 'Hajj Application Form'],
                'file' => 'downloads/hajj-form.pdf',
                'category' => 'forms',
                'sort_order' => 1,
            ],
            [
                'title' => ['bn' => 'চাকরির আবেদন ফরম', 'en' => 'Job Application Form'],
                'file' => 'downloads/job-form.pdf',
                'category' => 'forms',
                'sort_order' => 2,
            ],
            [
                'title' => ['bn' => 'ডকুমেন্ট চেকলিস্ট', 'en' => 'Document Checklist'],
                'file' => 'downloads/document-checklist.pdf',
                'category' => 'guides',
                'sort_order' => 3,
            ],
            [
                'title' => ['bn' => 'কোম্পানি প্রোফাইল', 'en' => 'Company Profile'],
                'file' => 'downloads/company-profile.pdf',
                'category' => 'company',
                'sort_order' => 4,
            ],
        ];

        foreach ($files as $file) {
            Download::updateOrCreate(['file' => $file['file']], $file);
        }
    }

    protected function seedOffices(): void
    {
        $offices = [
            [
                'name' => ['bn' => 'ঢাকা প্রধান কার্যালয়', 'en' => 'Dhaka Head Office'],
                'address' => [
                    'bn' => 'বাড়ি ১২, রোড ৫, বনানী, ঢাকা ১২১৩',
                    'en' => 'House 12, Road 5, Banani, Dhaka 1213',
                ],
                'phone' => '+8801712345678',
                'email' => 'dhaka@travelagency.test',
                'map_embed' => null,
                'is_head_office' => true,
            ],
            [
                'name' => ['bn' => 'চট্টগ্রাম শাখা', 'en' => 'Chattogram Branch'],
                'address' => [
                    'bn' => '৩য় তলা, আগ্রাবাদ বাণিজ্যিক এলাকা, চট্টগ্রাম ৪১০০',
                    'en' => '3rd Floor, Agrabad Commercial Area, Chattogram 4100',
                ],
                'phone' => '+8801812345678',
                'email' => 'ctg@travelagency.test',
                'map_embed' => null,
                'is_head_office' => false,
            ],
        ];

        foreach ($offices as $office) {
            Office::updateOrCreate(['email' => $office['email']], $office);
        }
    }

    protected function seedPackageMedia(): void
    {
        $images = ['assets/img/hero-makkah.jpg', 'assets/img/madinah.jpg', 'assets/img/malaysia.jpg'];
        $captions = ['হারাম শরীফের দৃশ্য', 'মদিনার দৃশ্য', 'ট্যুরের দৃশ্য'];

        foreach (Package::all() as $package) {
            for ($i = 1; $i <= 2; $i++) {
                $idx = ($package->id + $i) % count($images);
                PackageMedia::updateOrCreate(
                    ['package_id' => $package->id, 'sort_order' => $i],
                    [
                        'package_id' => $package->id,
                        'file' => $images[$idx],
                        'caption' => $captions[$idx],
                        'sort_order' => $i,
                    ]
                );
            }
        }
    }

    protected function seedPackageCountries(): void
    {
        $bySlug = [];
        foreach (['saudi-arabia', 'malaysia', 'singapore', 'uae'] as $slug) {
            $c = Country::where('slug', $slug)->first();
            if ($c) {
                $bySlug[$slug] = $c->id;
            }
        }

        if (empty($bySlug)) {
            return;
        }

        foreach (Package::all() as $package) {
            $type = strtolower((string) $package->type);
            $ids = [];

            if (in_array($type, ['hajj', 'umrah'], true)) {
                if (isset($bySlug['saudi-arabia'])) {
                    $ids[] = $bySlug['saudi-arabia'];
                }
            } elseif ($type === 'tour') {
                if (isset($bySlug['malaysia'])) {
                    $ids[] = $bySlug['malaysia'];
                }
                $second = ($package->id % 2 === 0) ? 'singapore' : 'uae';
                if (isset($bySlug[$second]) && ! in_array($bySlug[$second], $ids, true)) {
                    $ids[] = $bySlug[$second];
                }
            } elseif (in_array($type, ['study', 'student'], true)) {
                if (isset($bySlug['malaysia'])) {
                    $ids[] = $bySlug['malaysia'];
                }
            } elseif (in_array($type, ['job', 'employment', 'work'], true)) {
                if (isset($bySlug['saudi-arabia'])) {
                    $ids[] = $bySlug['saudi-arabia'];
                }
                if (isset($bySlug['uae'])) {
                    $ids[] = $bySlug['uae'];
                }
            } else {
                if (isset($bySlug['saudi-arabia'])) {
                    $ids[] = $bySlug['saudi-arabia'];
                } elseif (isset($bySlug['malaysia'])) {
                    $ids[] = $bySlug['malaysia'];
                }
            }

            if (! empty($ids)) {
                $package->countries()->syncWithoutDetaching(array_unique($ids));
            }
        }
    }

    protected function seedLeadNotes(): void
    {
        $userId = User::first()?->id;

        $notes = [
            'প্রথমবার ফোনে কথা হয়েছে। হজ প্যাকেজের দাম জানতে চেয়েছেন। হোয়াটসঅ্যাপে প্যাকেজ লিস্ট পাঠানো হয়েছে। ৩ দিন পর ফলোআপ করতে হবে।',
            'অফিসে আসতে চেয়েছেন শুক্রবারে। সৌদি আরবের ফ্যাক্টরি ভিসা নিয়ে আগ্রহী। মেডিকেল ও খরচের হিসাব বুঝিয়ে দেওয়া হয়েছে।',
            'মালয়েশিয়ায় পড়াশোনা নিয়ে জানতে চেয়েছেন। এইচএসসির সার্টিফিকেট নিয়ে কাউন্সেলিংয়ে আসতে বলা হয়েছে।',
            'দুবাই ট্যুরের জন্য ৪ জনের গ্রুপ। পাসপোর্ট কপি পাঠাতে বলা হয়েছে। কোটেশন ইমেইলে পাঠানো হয়েছে।',
            'দ্বিতীয়বার ফোন করা হয়েছে, রিসিভ করেননি। হোয়াটসঅ্যাপে মেসেজ দেওয়া হয়েছে। আগামী সপ্তাহে আবার ফলোআপ করতে হবে।',
        ];

        foreach (Lead::orderBy('id')->take(5)->get() as $index => $lead) {
            LeadNote::firstOrCreate(
                ['lead_id' => $lead->id, 'user_id' => $userId],
                ['note' => $notes[$index % count($notes)]]
            );
        }
    }

    protected function seedApplicationExtras(): void
    {
        foreach (Application::all() as $app) {
            $type = strtolower((string) $app->service_type);

            if (in_array($type, ['study', 'student'], true)) {
                $data = [
                    'education_history' => [
                        ['level' => 'SSC', 'year' => 2019, 'gpa' => '4.50', 'board' => 'Dhaka'],
                        ['level' => 'HSC', 'year' => 2021, 'gpa' => '4.00', 'board' => 'Dhaka'],
                    ],
                    'preferred_subject' => 'Computer Science',
                    'intake' => 'September 2026',
                ];
            } elseif (in_array($type, ['job', 'employment', 'work'], true)) {
                $data = [
                    'job_experience' => [
                        ['job' => 'Factory Worker', 'years' => 2, 'country' => 'Bangladesh'],
                    ],
                    'skills' => ['driving', 'welding'],
                    'passport_valid_until' => '2029-05-01',
                ];
            } elseif (in_array($type, ['hajj', 'umrah'], true)) {
                $data = [
                    'pilgrim_count' => 2,
                    'mahram_info' => 'Travelling with spouse',
                    'previous_hajj' => false,
                    'special_needs' => 'None',
                ];
            } else {
                $data = [
                    'purpose' => $app->service_type,
                    'traveller_count' => 1,
                    'remarks' => 'General application extra info',
                ];
            }

            ApplicationExtra::updateOrCreate(
                ['application_id' => $app->id],
                ['application_id' => $app->id, 'data' => $data]
            );
        }
    }

    protected function seedApplicationDocuments(): void
    {
        foreach (Application::all() as $app) {
            $docs = [
                [
                    'type' => 'passport',
                    'file_path' => "private/applications/{$app->id}/passport.pdf",
                    'original_name' => 'passport.pdf',
                    'mime' => 'application/pdf',
                    'size' => 245760,
                ],
                [
                    'type' => 'photo',
                    'file_path' => "private/applications/{$app->id}/photo.jpg",
                    'original_name' => 'photo.jpg',
                    'mime' => 'image/jpeg',
                    'size' => 102400,
                ],
            ];

            foreach ($docs as $doc) {
                $existing = ApplicationDocument::where('application_id', $app->id)
                    ->where('type', $doc['type'])
                    ->first();
                if (! $existing) {
                    ApplicationDocument::create(array_merge($doc, [
                        'application_id' => $app->id,
                        'verified' => (bool) (($app->id + strlen($doc['type'])) % 2),
                    ]));
                }
            }
        }
    }

    protected function seedPaymentSchedules(): void
    {
        foreach (Application::all() as $app) {
            $due = (float) $app->due_amount;
            if ($due <= 0) {
                continue;
            }

            $half = round($due / 2, 2);
            $dates = [now()->addDays(30)->toDateString(), now()->addDays(60)->toDateString()];

            foreach ($dates as $i => $date) {
                $amount = ($i === 1) ? round($due - $half, 2) : $half;
                PaymentSchedule::updateOrCreate(
                    ['application_id' => $app->id, 'due_date' => $date],
                    ['application_id' => $app->id, 'due_date' => $date, 'amount' => $amount, 'status' => 'pending']
                );
            }
        }
    }

    protected function seedNotificationLogs(): void
    {
        $rows = [
            [
                'channel' => 'sms',
                'to' => '+8801711111111',
                'template' => 'application_submitted',
                'payload' => ['tracking_code' => 'TA-2026-000001', 'message' => 'Your application has been received.'],
                'status' => 'sent',
                'sent_at' => now()->subDays(3),
            ],
            [
                'channel' => 'whatsapp',
                'to' => '+8801822222222',
                'template' => 'payment_reminder',
                'payload' => ['tracking_code' => 'TA-2026-000002', 'due_amount' => '50000'],
                'status' => 'sent',
                'sent_at' => now()->subDays(2),
            ],
            [
                'channel' => 'sms',
                'to' => '+8801933333333',
                'template' => 'visa_update',
                'payload' => ['tracking_code' => 'TA-2026-000003', 'message' => 'Your visa file has been submitted.'],
                'status' => 'sent',
                'sent_at' => now()->subDay(),
            ],
            [
                'channel' => 'whatsapp',
                'to' => '+8801644444444',
                'template' => 'departure_reminder',
                'payload' => ['tracking_code' => 'TA-2026-000004', 'message' => 'Your flight is in 7 days.'],
                'status' => 'sent',
                'sent_at' => now()->subHours(12),
            ],
            [
                'channel' => 'sms',
                'to' => '+8801555555555',
                'template' => 'followup_lead',
                'payload' => ['lead' => 'New enquiry', 'message' => 'Thanks for your interest. Our team will call you soon.'],
                'status' => 'sent',
                'sent_at' => now()->subHours(2),
            ],
        ];

        foreach ($rows as $row) {
            NotificationLog::updateOrCreate(
                ['to' => $row['to'], 'template' => $row['template']],
                $row
            );
        }
    }
}
