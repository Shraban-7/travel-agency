<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyProgram>
 */
class StudyProgramFactory extends Factory
{
    public function definition(): array
    {
        $nameEn = $this->faker->randomElement([
            'BSc in Computer Science',
            'MBA',
            'BBA',
            'MSc in Data Science',
            'BA in English',
            'BSc in Nursing',
        ]);

        return [
            'university_id' => University::inRandomOrder()->first()?->id ?? University::factory(),
            'name' => [
                'en' => $nameEn,
                'bn' => 'বাংলা ' . $nameEn,
            ],
            'level' => $this->faker->randomElement(['diploma', 'bachelor', 'master', 'phd']),
            'tuition_fee' => $this->faker->numberBetween(500000, 3000000),
            'currency' => 'BDT',
            'is_active' => true,
        ];
    }
}
