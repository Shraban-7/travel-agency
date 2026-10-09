<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_register_creates_client_and_logs_in(): void
    {
        $response = $this->post('/account/register', [
            'full_name' => 'নতুন কাস্টমার',
            'phone' => '01812345678',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('account.dashboard'));
        $this->assertDatabaseHas('clients', ['phone' => '+8801812345678']);

        $client = Client::where('phone', '+8801812345678')->first();
        $this->assertAuthenticatedAs($client, 'client');

        $this->get('/account/dashboard')->assertOk()->assertSee('নতুন কাস্টমার');
    }

    public function test_login_with_wrong_password_fails(): void
    {
        $client = Client::where('phone', '+8801711111111')->first();
        $this->assertNotNull($client, 'DemoCustomerSeeder should create demo client');

        $this->post('/account/login', [
            'phone' => '+8801711111111',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('phone');

        $this->assertGuest('client');
    }

    public function test_guest_dashboard_redirects_to_login(): void
    {
        $this->get('/account/dashboard')->assertRedirect(route('account.login'));
    }

    public function test_customer_cannot_view_anothers_application(): void
    {
        $me = Client::factory()->create(['password' => 'password']);
        $other = Client::factory()->create(['password' => 'password']);
        $otherApp = Application::factory()->create(['client_id' => $other->id]);

        $this->be($me, 'client');

        $this->get(route('account.applications.show', $otherApp))->assertNotFound();
    }
}
