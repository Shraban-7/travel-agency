<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_default_locale_is_bengali(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('lang="bn"', false);
        $response->assertSee('আল-সফর ট্রাভেলস');
        $response->assertSee('প্যাকেজসমূহ');
    }

    public function test_locale_switches_to_english_via_query_param(): void
    {
        $response = $this->get('/?lang=en');
        $response->assertOk();
        $response->assertSessionHas('locale', 'en');
        $response->assertCookie('locale', 'en');
        $response->assertSee('lang="en"', false);
        $response->assertSee('Al-Safar Travels');
        $response->assertSee('All Packages');
        $response->assertSee('Free Consultation');
    }

    public function test_locale_persists_in_session(): void
    {
        // First request with ?lang=en
        $this->withSession(['locale' => 'en'])->get('/');
        $this->assertEquals('en', app()->getLocale());

        $response = $this->withSession(['locale' => 'en'])->get('/services');
        $response->assertOk();
        $response->assertSee('lang="en"', false);
        $response->assertSee('Our Services');
    }

    public function test_lang_switch_route(): void
    {
        $response = $this->get('/lang/en');
        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en');

        $response = $this->get('/lang/bn');
        $response->assertRedirect();
        $response->assertSessionHas('locale', 'bn');

        $response = $this->get('/lang/invalid');
        $response->assertRedirect();
        $response->assertSessionHas('locale', 'bn');
    }

    public function test_helpers_respect_locale(): void
    {
        app()->setLocale('bn');
        $this->assertEquals('১২৩৪', bn_digits('1234'));
        $this->assertEquals('বাংলা', t(['bn' => 'বাংলা', 'en' => 'English']));

        app()->setLocale('en');
        $this->assertEquals('1234', bn_digits('1234'));
        $this->assertEquals('English', t(['bn' => 'বাংলা', 'en' => 'English']));
    }

    public function test_public_pages_render_in_english(): void
    {
        $pages = [
            '/' => 'Al-Safar Travels',
            '/services?lang=en' => 'Our Services',
            '/packages?lang=en' => 'All Packages',
            '/jobs?lang=en' => 'Job Demands',
            '/study?lang=en' => 'Higher Studies Abroad',
            '/deadlines?lang=en' => 'Upcoming Deadlines',
            '/about?lang=en' => '17 Years of Honesty, Security & Trust',
            '/contact?lang=en' => 'Contact Us',
            '/track?lang=en' => 'Track Application Progress',
            '/account/login?lang=en' => 'Account Login',
        ];

        foreach ($pages as $url => $expected) {
            $response = $this->withSession(['locale' => 'en'])->get($url);
            $response->assertOk();
            $response->assertSee('lang="en"', false);
            $response->assertSee($expected);
        }
    }
}
