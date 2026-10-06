<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'hajj-umrah',
                'type' => 'hajj_umrah',
                'title' => ['bn' => 'হজ ও ওমরাহ', 'en' => 'Hajj & Umrah'],
                'short_desc' => [
                    'bn' => 'সরকারি লাইসেন্সসহ নিরাপদ ও আরামদায়ক হজ ও ওমরাহ প্যাকেজ।',
                    'en' => 'Safe and comfortable Hajj & Umrah packages with government license.',
                ],
                'body' => [
                    'bn' => 'অভিজ্ঞ গাইড, মানসম্মত হোটেল ও ঝামেলাহীন ভিসা প্রসেসিংসহ সম্পূর্ণ হজ ও ওমরাহ সেবা।',
                    'en' => 'Complete Hajj & Umrah service with experienced guides, quality hotels and hassle-free visa processing.',
                ],
                'icon' => 'kaaba',
                'cover_image' => null,
                'sort_order' => 1,
                'is_active' => true,
                'seo_title' => ['bn' => 'হজ ও ওমরাহ প্যাকেজ', 'en' => 'Hajj & Umrah Packages'],
                'seo_desc' => [
                    'bn' => 'সেরা দামে নির্ভরযোগ্য হজ ও ওমরাহ প্যাকেজ বুক করুন।',
                    'en' => 'Book reliable Hajj & Umrah packages at the best price.',
                ],
            ],
            [
                'slug' => 'overseas-employment',
                'type' => 'employment',
                'title' => ['bn' => 'বৈদেশিক কর্মসংস্থান', 'en' => 'Overseas Employment'],
                'short_desc' => [
                    'bn' => 'মধ্যপ্রাচ্য, এশিয়া ও ইউরোপে যাচাইকৃত চাকরির সুযোগ।',
                    'en' => 'Verified job opportunities in the Middle East, Asia and Europe.',
                ],
                'body' => [
                    'bn' => 'সরকারি রিক্রুটিং লাইসেন্সের আওতায় প্রশিক্ষণ, মেডিকেল ও ভিসা সহায়তাসহ বিদেশে চাকরির সম্পূর্ণ সহযোগিতা।',
                    'en' => 'Full overseas job support including training, medical and visa assistance under government recruiting license.',
                ],
                'icon' => 'briefcase',
                'cover_image' => null,
                'sort_order' => 2,
                'is_active' => true,
                'seo_title' => ['bn' => 'বিদেশে চাকরি', 'en' => 'Overseas Jobs'],
                'seo_desc' => [
                    'bn' => 'বিদেশে বৈধ ও নিরাপদ চাকরির জন্য আবেদন করুন।',
                    'en' => 'Apply for legal and safe overseas jobs.',
                ],
            ],
            [
                'slug' => 'study-abroad',
                'type' => 'study',
                'title' => ['bn' => 'বিদেশে উচ্চশিক্ষা', 'en' => 'Study Abroad'],
                'short_desc' => [
                    'bn' => 'মালয়েশিয়া, ইউরোপসহ বিভিন্ন দেশে পড়াশোনার পরামর্শ ও ভর্তি সহায়তা।',
                    'en' => 'Counselling and admission support for Malaysia, Europe and more.',
                ],
                'body' => [
                    'bn' => 'বিশ্ববিদ্যালয় নির্বাচন, ভর্তি, স্কলারশিপ গাইডলাইন ও স্টুডেন্ট ভিসা প্রসেসিংসহ পূর্ণাঙ্গ সহায়তা।',
                    'en' => 'End-to-end support with university selection, admission, scholarship guidance and student visa processing.',
                ],
                'icon' => 'graduation-cap',
                'cover_image' => null,
                'sort_order' => 3,
                'is_active' => true,
                'seo_title' => ['bn' => 'বিদেশে পড়াশোনা', 'en' => 'Study Abroad'],
                'seo_desc' => [
                    'bn' => 'বিদেশে উচ্চশিক্ষার জন্য ফ্রি কাউন্সেলিং নিন।',
                    'en' => 'Get free counselling for higher study abroad.',
                ],
            ],
            [
                'slug' => 'tour-packages',
                'type' => 'tour',
                'title' => ['bn' => 'ট্যুর প্যাকেজ', 'en' => 'Tour Packages'],
                'short_desc' => [
                    'bn' => 'দেশ-বিদেশে পরিবার ও কর্পোরেট ট্যুরের আকর্ষণীয় প্যাকেজ।',
                    'en' => 'Attractive family and corporate tour packages at home and abroad.',
                ],
                'body' => [
                    'bn' => 'থাইল্যান্ড, মালয়েশিয়া, সিঙ্গাপুর, দুবাইসহ জনপ্রিয় গন্তব্যে হোটেল, ট্রান্সপোর্ট ও গাইডসহ সাজানো প্যাকেজ।',
                    'en' => 'Curated packages with hotel, transport and guide to popular destinations like Thailand, Malaysia, Singapore and Dubai.',
                ],
                'icon' => 'map',
                'cover_image' => null,
                'sort_order' => 4,
                'is_active' => true,
                'seo_title' => ['bn' => 'ট্যুর প্যাকেজ', 'en' => 'Tour Packages'],
                'seo_desc' => [
                    'bn' => 'সেরা দামে দেশ-বিদেশের ট্যুর প্যাকেজ বুক করুন।',
                    'en' => 'Book domestic and international tour packages at the best price.',
                ],
            ],
            [
                'slug' => 'visa-processing',
                'type' => 'visa',
                'title' => ['bn' => 'ভিসা প্রসেসিং', 'en' => 'Visa Processing'],
                'short_desc' => [
                    'bn' => 'ট্যুরিস্ট, ওয়ার্ক, স্টুডেন্ট ও ফ্যামিলি ভিসার দ্রুত ও নির্ভুল প্রসেসিং।',
                    'en' => 'Fast and accurate processing for tourist, work, student and family visas.',
                ],
                'body' => [
                    'bn' => 'ডকুমেন্ট চেকলিস্ট, ফাইল প্রস্তুতি, অ্যাপয়েন্টমেন্ট ও ফলোআপসহ সম্পূর্ণ ভিসা সহায়তা।',
                    'en' => 'Complete visa assistance with document checklist, file preparation, appointments and follow-up.',
                ],
                'icon' => 'stamp',
                'cover_image' => null,
                'sort_order' => 5,
                'is_active' => true,
                'seo_title' => ['bn' => 'ভিসা প্রসেসিং সেবা', 'en' => 'Visa Processing Service'],
                'seo_desc' => [
                    'bn' => 'ট্যুরিস্ট, ওয়ার্ক ও স্টুডেন্ট ভিসার নির্ভরযোগ্য প্রসেসিং।',
                    'en' => 'Reliable processing for tourist, work and student visas.',
                ],
            ],
            [
                'slug' => 'air-ticketing',
                'type' => 'ticket',
                'title' => ['bn' => 'এয়ার টিকিটিং', 'en' => 'Air Ticketing'],
                'short_desc' => [
                    'bn' => 'সব এয়ারলাইন্সের ডোমেস্টিক ও ইন্টারন্যাশনাল টিকিট সেরা দামে।',
                    'en' => 'Domestic and international tickets of all airlines at the best fare.',
                ],
                'body' => [
                    'bn' => 'তারিখ পরিবর্তন, রিফান্ড ও গ্রুপ বুকিং সাপোর্টসহ দ্রুত টিকিট বুকিং সেবা।',
                    'en' => 'Fast ticket booking with date-change, refund and group booking support.',
                ],
                'icon' => 'plane',
                'cover_image' => null,
                'sort_order' => 6,
                'is_active' => true,
                'seo_title' => ['bn' => 'এয়ার টিকিট বুকিং', 'en' => 'Air Ticket Booking'],
                'seo_desc' => [
                    'bn' => 'সেরা দামে বিমানের টিকিট বুক করুন।',
                    'en' => 'Book flight tickets at the best fare.',
                ],
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
