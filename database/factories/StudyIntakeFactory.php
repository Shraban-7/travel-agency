<?php

namespace Database\Factories;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyIntake>
 */
class StudyIntakeFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('+1 month', '+1 year');

        return [
            'program_id' => StudyProgram::inRandomOrder()->first()?->id ?? StudyProgram::factory(),
            'intake_name' => $startDate->format('M Y'),
            'start_date' => $startDate->format('Y-m-d'),
            'application_deadline' => $this->faker->dateTimeBetween('now', $startDate)->format('Y-m-d'),
        ];
    }
}
