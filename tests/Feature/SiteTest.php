<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_pages_render(): void
    {
        foreach (['/', '/packages', '/jobs', '/study', '/services', '/deadlines', '/about', '/contact', '/track', '/admin/login'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_package_detail_and_404(): void
    {
        $slug = Package::where('is_published', true)->first()->slug;
        $this->get('/packages/'.$slug)->assertOk();
        $this->get('/packages/no-such-package')->assertNotFound();
    }

    public function test_inquiry_creates_lead(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class)
            ->post('/inquiry', ['name' => 'Test User', 'phone' => '01712345678', 'service' => 'hajj', 'message' => 'hi'])
            ->assertRedirect();
        $this->assertDatabaseHas('leads', ['phone' => '+8801712345678']);
    }

    public function test_track_result(): void
    {
        $app = Application::with('client')->first();
        $this->get('/track/result?phone='.urlencode($app->client->phone).'&tracking_code='.$app->tracking_code)
            ->assertOk()
            ->assertSee($app->tracking_code);
        $this->get('/track/result?phone=01700000000&tracking_code=NOPE')->assertOk();
    }

    public function test_admin_auth_flow(): void
    {
        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
        $this->actingAs(User::first())->get('/admin/dashboard')->assertOk();
        $this->actingAs(User::first())->get('/admin/leads')->assertOk();
        $this->actingAs(User::first())->get('/admin/applications')->assertOk();
        $this->actingAs(User::first())->get('/admin/packages')->assertOk();
    }
}
