<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.public', 'layouts.admin', 'layouts.auth'], function ($view) {
            $defaults = [
                'site_name' => 'আল-সফর ট্রাভেলস',
                'site_name_en' => 'Al-Safar Travels & Overseas',
                'phone' => '+8801700000000',
                'phone_label' => '০১৭০০-০০০০০০',
                'whatsapp' => 'https://wa.me/8801700000000',
                'facebook' => '#',
                'youtube' => '#',
                'email' => 'info@alsafar.com.bd',
                'address' => 'হাউস ১২, রোড ৫, ধানমন্ডি, ঢাকা-১২০৫',
                'address_main' => 'হাউস ১২, রোড ৫, ধানমন্ডি, ঢাকা-১২০৫',
                'office_hours' => 'শনি–বৃহঃ, সকাল ১০টা – সন্ধ্যা ৭টা',
                'license_hajj' => 'হজ্জ লাইসেন্স নং: HL-1234 (ধর্ম বিষয়ক মন্ত্রণালয়)',
                'license_recruiting' => 'রিক্রুটিং লাইসেন্স: RL-0987 (BMET)',
                'hajj_license' => 'HL-1234',
                'recruiting_license' => 'RL-0987',
                'atab_no' => 'ATAB-5678',
            ];

            $settings = $defaults;

            try {
                if (Schema::hasTable('settings')) {
                    $db = Cache::remember('settings.all', 3600, fn () => Setting::pluck('value', 'key')->toArray());
                    foreach ($db as $k => $v) {
                        $settings[$k] = is_array($v) && array_key_exists('value', $v) ? $v['value'] : $v;
                    }
                }
            } catch (\Throwable $e) {
                // fall back to defaults (e.g. during install / migrate)
            }

            $view->with('settings', $settings);
        });

        View::composer('layouts.public', function ($view) {
            $services = [];
            try {
                if (Schema::hasTable('services')) {
                    $services = Cache::remember(
                        'services.nav',
                        3600,
                        fn () => Service::where('is_active', true)->orderBy('sort_order')->limit(6)->get(['slug', 'type', 'title', 'icon'])
                    );
                }
            } catch (\Throwable $e) {
                $services = [];
            }

            $view->with('services', $services);
        });
    }
}
