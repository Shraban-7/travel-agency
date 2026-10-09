<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Database\Seeder;

class DemoCustomerSeeder extends Seeder
{
    public function run(): void
    {
        $phone = '+8801711111111';

        $client = Client::firstOrCreate(
            ['phone' => $phone],
            [
                'full_name' => 'ডেমো কাস্টমার',
                'password' => 'password',
            ]
        );

        // Ensure password is set (firstOrCreate skips update when found)
        if (! $client->password) {
            $client->password = 'password';
            $client->save();
        }

        $application = Application::orderBy('id')->first();

        if ($application && (int) $application->client_id !== (int) $client->id) {
            $application->client_id = $client->id;
            $application->save();

            // Move that application's payments to the demo client for a coherent dashboard
            $application->payments()->update(['client_id' => $client->id]);
        }
    }
}
