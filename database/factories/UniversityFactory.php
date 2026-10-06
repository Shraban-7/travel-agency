<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    public function definition(): array
    {
        $nameEn = $this->faker->company() . ' University';
        $descEn = $this->faker->paragraph(2);

        return [
            'country_id' => Country::inRandomOrder()->first()?->id ?? 1,
            'name' => [
                'en' => $nameEn,
                'bn' => 'বাংলা ' . $nameEn,
            ],
            'city' => $this->faker->city(),
            'description' => [
                'en' => $descEn,
                'bn' => 'বাংলা ' . $descEn,
            ],
            'is_active' => true,
        ];
    }
}
