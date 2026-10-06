<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'phone' => '+8801' . $this->faker->unique()->numerify('#########'),
            'email' => $this->faker->boolean(70) ? $this->faker->unique()->safeEmail() : null,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'district' => $this->faker->city(),
            'address' => $this->faker->address(),
        ];
    }
}
