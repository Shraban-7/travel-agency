<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        $totalFee = $this->faker->numberBetween(50000, 300000);

        return [
            'tracking_code' => 'TA-2026-' . $this->faker->unique()->numerify('######'),
            'client_id' => Client::inRandomOrder()->first()?->id ?? Client::factory(),
            'service_type' => $this->faker->randomElement(['hajj', 'umrah', 'tour', 'job', 'study', 'visa', 'other']),
            'status' => 'submitted',
            'submitted_at' => now(),
            'total_fee' => $totalFee,
            'paid_amount' => 0,
            'due_amount' => $totalFee,
        ];
    }
}
