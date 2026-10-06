<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => '+8801' . $this->faker->numerify('#########'),
            'email' => $this->faker->boolean(70) ? $this->faker->safeEmail() : null,
            'service_type' => $this->faker->randomElement(['hajj', 'umrah', 'tour', 'job', 'study', 'visa', 'other']),
            'message' => $this->faker->paragraph(2),
            'source' => 'web_form',
            'status' => 'new',
            'follow_up_at' => $this->faker->boolean(40) ? $this->faker->dateTimeBetween('+1 day', '+2 weeks') : null,
        ];
    }
}
