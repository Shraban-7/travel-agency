<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobDemand>
 */
class JobDemandFactory extends Factory
{
    public function definition(): array
    {
        $titleEn = $this->faker->jobTitle();
        $salaryMin = $this->faker->numberBetween(30000, 80000);

        return [
            'country_id' => Country::inRandomOrder()->first()?->id ?? 1,
            'category_id' => JobCategory::inRandomOrder()->first()?->id ?? 1,
            'slug' => $this->faker->unique()->slug(),
            'title' => [
                'en' => $titleEn,
                'bn' => 'বাংলা ' . $titleEn,
            ],
            'company_name' => $this->faker->optional(0.8)->company(),
            'positions' => $this->faker->numberBetween(1, 100),
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMin + $this->faker->numberBetween(5000, 40000),
            'salary_currency' => 'BDT',
            'contract_months' => $this->faker->randomElement([12, 24, 36]),
            'application_deadline' => $this->faker->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'status' => 'open',
            'is_published' => true,
        ];
    }
}
