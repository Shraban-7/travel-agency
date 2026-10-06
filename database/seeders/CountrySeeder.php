<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'slug' => 'saudi-arabia',
                'name' => ['bn' => 'সৌদি আরব', 'en' => 'Saudi Arabia'],
                'flag_code' => 'SA',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'হজ, ওমরাহ ও কর্মসংস্থানের জন্য বাংলাদেশিদের সবচেয়ে জনপ্রিয় গন্তব্য।',
                    'en' => 'The most popular destination for Bangladeshis for Hajj, Umrah and employment.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক, ভিজিট ও হজ/ওমরাহ ভিসা চালু আছে; মেডিকেল ও পুলিশ ক্লিয়ারেন্স বাধ্যতামূলক।',
                    'en' => 'Work, visit and Hajj/Umrah visas available; medical and police clearance required.',
                ],
                'life_info' => [
                    'bn' => 'জীবনযাত্রার ব্যয় মাঝারি; আবাসন অনেক ক্ষেত্রে নিয়োগকর্তা বহন করে।',
                    'en' => 'Moderate cost of living; accommodation often covered by the employer.',
                ],
                'cover_image' => null,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'uae',
                'name' => ['bn' => 'সংযুক্ত আরব আমিরাত', 'en' => 'United Arab Emirates'],
                'flag_code' => 'AE',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'দুবাই ও আবুধাবিতে চাকরি, ব্যবসা ও ভ্রমণের বড় সুযোগ।',
                    'en' => 'Big opportunities for jobs, business and travel in Dubai and Abu Dhabi.',
                ],
                'visa_info' => [
                    'bn' => 'ট্যুরিস্ট, ওয়ার্ক ও রেসিডেন্স ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Tourist, work and residence visas are processed.',
                ],
                'life_info' => [
                    'bn' => 'জীবনযাত্রার ব্যয় বেশি হলেও বেতন কাঠামো আকর্ষণীয়।',
                    'en' => 'Cost of living is high but salary structure is attractive.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'qatar',
                'name' => ['bn' => 'কাতার', 'en' => 'Qatar'],
                'flag_code' => 'QA',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'নির্মাণ, হসপিটালিটি ও নিরাপত্তা খাতে প্রচুর চাকরির সুযোগ।',
                    'en' => 'Plenty of jobs in construction, hospitality and security sectors.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক ও ফ্যামিলি ভিজিট ভিসা চালু আছে।',
                    'en' => 'Work and family visit visas are available.',
                ],
                'life_info' => [
                    'bn' => 'করমুক্ত বেতন ও নিরাপদ জীবনযাপন।',
                    'en' => 'Tax-free salary and safe living.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'kuwait',
                'name' => ['bn' => 'কুয়েত', 'en' => 'Kuwait'],
                'flag_code' => 'KW',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'ড্রাইভার, ক্লিনার ও টেকনিশিয়ান পদে নিয়মিত নিয়োগ।',
                    'en' => 'Regular recruitment for driver, cleaner and technician roles.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক ভিসার জন্য মেডিকেল ও ফিঙ্গারপ্রিন্ট প্রয়োজন।',
                    'en' => 'Medical and fingerprint required for work visa.',
                ],
                'life_info' => [
                    'bn' => 'আবাসন ও যাতায়াত সুবিধা অনেক কোম্পানি দেয়।',
                    'en' => 'Many companies provide accommodation and transport.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'slug' => 'oman',
                'name' => ['bn' => 'ওমান', 'en' => 'Oman'],
                'flag_code' => 'OM',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'শান্ত পরিবেশে কাজ ও বসবাসের নির্ভরযোগ্য গন্তব্য।',
                    'en' => 'A reliable destination to work and live in a peaceful environment.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক ও ট্যুরিস্ট ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Work and tourist visas are processed.',
                ],
                'life_info' => [
                    'bn' => 'জীবনযাত্রার ব্যয় তুলনামূলক কম।',
                    'en' => 'Comparatively low cost of living.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'slug' => 'bahrain',
                'name' => ['bn' => 'বাহরাইন', 'en' => 'Bahrain'],
                'flag_code' => 'BH',
                'region' => 'middle_east',
                'intro' => [
                    'bn' => 'হসপিটালিটি, কারখানা ও সেবা খাতে চাকরির সুযোগ।',
                    'en' => 'Job opportunities in hospitality, factory and service sectors.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক ও ভিজিট ভিসা চালু আছে।',
                    'en' => 'Work and visit visas are available.',
                ],
                'life_info' => [
                    'bn' => 'ছোট দেশ হওয়ায় যাতায়াত সহজ।',
                    'en' => 'Easy commute due to the small size of the country.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'slug' => 'malaysia',
                'name' => ['bn' => 'মালয়েশিয়া', 'en' => 'Malaysia'],
                'flag_code' => 'MY',
                'region' => 'asia',
                'intro' => [
                    'bn' => 'পড়াশোনা, চাকরি ও ভ্রমণ — তিনটির জন্যই জনপ্রিয় গন্তব্য।',
                    'en' => 'A popular destination for study, work and travel alike.',
                ],
                'visa_info' => [
                    'bn' => 'স্টুডেন্ট, ওয়ার্ক ও ট্যুরিস্ট ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Student, work and tourist visas are processed.',
                ],
                'life_info' => [
                    'bn' => 'খাবার ও সংস্কৃতিতে বাংলাদেশিদের জন্য মানিয়ে নেওয়া সহজ।',
                    'en' => 'Easy to adapt for Bangladeshis in terms of food and culture.',
                ],
                'cover_image' => null,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'slug' => 'singapore',
                'name' => ['bn' => 'সিঙ্গাপুর', 'en' => 'Singapore'],
                'flag_code' => 'SG',
                'region' => 'asia',
                'intro' => [
                    'bn' => 'দক্ষ কর্মী ও শিক্ষার্থীদের জন্য স্বপ্নের আধুনিক শহর।',
                    'en' => 'A dream modern city for skilled workers and students.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক পারমিট ও স্টুডেন্ট পাসের জন্য কঠোর ডকুমেন্ট যাচাই হয়।',
                    'en' => 'Strict document verification applies for work permits and student passes.',
                ],
                'life_info' => [
                    'bn' => 'জীবনযাত্রার ব্যয় বেশি; নিয়মশৃঙ্খলা কঠোর।',
                    'en' => 'High cost of living; strict rules and discipline.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'slug' => 'romania',
                'name' => ['bn' => 'রোমানিয়া', 'en' => 'Romania'],
                'flag_code' => 'RO',
                'region' => 'europe',
                'intro' => [
                    'bn' => 'ইউরোপে কম খরচে কাজ ও পড়াশোনার উদীয়মান গন্তব্য।',
                    'en' => 'An emerging destination for affordable work and study in Europe.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক পারমিট ও স্টুডেন্ট ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Work permit and student visa processing available.',
                ],
                'life_info' => [
                    'bn' => 'পশ্চিম ইউরোপের তুলনায় খরচ কম।',
                    'en' => 'Lower cost compared to Western Europe.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'slug' => 'poland',
                'name' => ['bn' => 'পোল্যান্ড', 'en' => 'Poland'],
                'flag_code' => 'PL',
                'region' => 'europe',
                'intro' => [
                    'bn' => 'ফ্যাক্টরি, লজিস্টিকস ও আইটি খাতে চাহিদা বাড়ছে।',
                    'en' => 'Growing demand in factory, logistics and IT sectors.',
                ],
                'visa_info' => [
                    'bn' => 'ওয়ার্ক পারমিট ও স্টুডেন্ট ভিসা চালু আছে।',
                    'en' => 'Work permits and student visas are available.',
                ],
                'life_info' => [
                    'bn' => 'শিক্ষার মান ভালো ও টিউশন ফি তুলনামূলক কম।',
                    'en' => 'Good education quality with comparatively low tuition fees.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'slug' => 'croatia',
                'name' => ['bn' => 'ক্রোয়েশিয়া', 'en' => 'Croatia'],
                'flag_code' => 'HR',
                'region' => 'europe',
                'intro' => [
                    'bn' => 'পর্যটন ও হসপিটালিটি খাতে মৌসুমি ও স্থায়ী চাকরি।',
                    'en' => 'Seasonal and permanent jobs in tourism and hospitality.',
                ],
                'visa_info' => [
                    'bn' => 'শেনজেন ওয়ার্ক ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Schengen work visa processing available.',
                ],
                'life_info' => [
                    'bn' => 'উপকূলীয় দেশ; পর্যটন মৌসুমে আয় ভালো।',
                    'en' => 'A coastal country; good income during tourist season.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'slug' => 'italy',
                'name' => ['bn' => 'ইতালি', 'en' => 'Italy'],
                'flag_code' => 'IT',
                'region' => 'europe',
                'intro' => [
                    'bn' => 'কৃষি, হসপিটালিটি ও কেয়ারগিভার খাতে সুযোগ।',
                    'en' => 'Opportunities in agriculture, hospitality and caregiver sectors.',
                ],
                'visa_info' => [
                    'bn' => 'স্পন্সর ও মৌসুমি ওয়ার্ক ভিসা প্রসেসিং করা হয়।',
                    'en' => 'Sponsor and seasonal work visa processing available.',
                ],
                'life_info' => [
                    'bn' => 'জীবনযাত্রার মান উন্নত; ভাষা শেখা জরুরি।',
                    'en' => 'High quality of life; learning the language is important.',
                ],
                'cover_image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 12,
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['slug' => $country['slug']],
                $country
            );
        }
    }
}
