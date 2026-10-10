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
        View::composer('*', function ($view) {
            static $settings = null;
            if ($settings === null) {
                $defaults = [
                    'site_name' => [
                        'bn' => 'আস্থা ট্রাভেল এজেন্সি',
                        'en' => 'Astha Travel Agency',
                    ],
                    'phone' => '+8801700000000',
                    'whatsapp' => 'https://wa.me/8801700000000',
                    'facebook' => '#',
                    'youtube' => '#',
                    'email' => 'info@alsafar.com.bd',
                    'address' => [
                        'bn' => 'হাউস ১২, রোড ৫, ধানমন্ডি, ঢাকা-১২০৫',
                        'en' => 'House 12, Road 5, Dhanmondi, Dhaka-1205',
                    ],
                    'office_hours' => [
                        'bn' => 'শনি–বৃহঃ, সকাল ১০টা – সন্ধ্যা ৭টা',
                        'en' => 'Sat–Thu, 10:00 AM – 7:00 PM',
                    ],
                    'license_hajj' => 'Hajj License No. 1234',
                    'license_recruiting' => 'Recruiting License No. RL-0987',
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
