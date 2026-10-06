<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => [
                'bn' => 'আস্থা ট্রাভেল এজেন্সি',
                'en' => 'Astha Travel Agency',
            ],
            'phone' => '+8801712345678',
            'whatsapp' => '+8801712345678',
            'email' => 'info@travelagency.test',
            'address' => [
                'bn' => 'বাড়ি ১২, রোড ৫, গুলশান-১, ঢাকা ১২১২, বাংলাদেশ',
                'en' => 'House 12, Road 5, Gulshan-1, Dhaka 1212, Bangladesh',
            ],
            'facebook' => 'https://facebook.com/asthatravel',
            'youtube' => 'https://youtube.com/@asthatravel',
            'license_hajj' => 'Hajj License No. 1234',
            'license_recruiting' => 'Recruiting License No. RL-5678',
            'office_hours' => [
                'bn' => 'শনি–বৃহস্পতি, সকাল ৯টা – রাত ৮টা',
                'en' => 'Sat–Thu, 9:00 AM – 8:00 PM',
            ],
            'seo_title' => [
                'bn' => 'আস্থা ট্রাভেল এজেন্সি — হজ, ওমরাহ, চাকরি ও বিদেশে পড়াশোনা',
                'en' => 'Astha Travel Agency — Hajj, Umrah, Jobs & Study Abroad',
            ],
            'seo_description' => [
                'bn' => 'হজ ও ওমরাহ, বৈদেশিক কর্মসংস্থান, বিদেশে উচ্চশিক্ষা, ট্যুর প্যাকেজ, ভিসা প্রসেসিং ও এয়ার টিকিটের বিশ্বস্ত ঠিকানা।',
                'en' => 'Trusted partner for Hajj & Umrah, overseas jobs, study abroad, tour packages, visa processing and air tickets.',
            ],
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
