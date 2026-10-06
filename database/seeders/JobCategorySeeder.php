<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'driver', 'name' => ['bn' => 'ড্রাইভার', 'en' => 'Driver']],
            ['slug' => 'construction', 'name' => ['bn' => 'নির্মাণ শ্রমিক', 'en' => 'Construction Worker']],
            ['slug' => 'hospitality', 'name' => ['bn' => 'হোটেল ও আতিথেয়তা', 'en' => 'Hospitality']],
            ['slug' => 'cleaner', 'name' => ['bn' => 'ক্লিনার', 'en' => 'Cleaner']],
            ['slug' => 'security-guard', 'name' => ['bn' => 'নিরাপত্তা প্রহরী', 'en' => 'Security Guard']],
            ['slug' => 'nurse', 'name' => ['bn' => 'নার্স', 'en' => 'Nurse']],
            ['slug' => 'factory-worker', 'name' => ['bn' => 'ফ্যাক্টরি কর্মী', 'en' => 'Factory Worker']],
            ['slug' => 'technician', 'name' => ['bn' => 'টেকনিশিয়ান', 'en' => 'Technician']],
        ];

        foreach ($categories as $category) {
            JobCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
