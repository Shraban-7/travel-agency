<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    public function definition(): array
    {
        $titleEn = $this->faker->sentence(4);
        $summaryEn = $this->faker->sentence(10);
        $descriptionEn = $this->faker->paragraph(3);

        return [
            'service_id' => Service::inRandomOrder()->first()?->id ?? 1,
            'slug' => $this->faker->unique()->slug(),
            'type' => $this->faker->randomElement(['hajj', 'umrah', 'tour']),
            'title' => [
                'en' => $titleEn,
                'bn' => 'বাংলা ' . $titleEn,
            ],
            'summary' => [
                'en' => $summaryEn,
                'bn' => 'বাংলা ' . $summaryEn,
            ],
            'description' => [
                'en' => $descriptionEn,
                'bn' => 'বাংলা ' . $descriptionEn,
            ],
            'duration_days' => $this->faker->numberBetween(3, 30),
            'base_price' => $this->faker->numberBetween(50000, 500000),
            'currency' => 'BDT',
            'is_featured' => $this->faker->boolean(30),
            'is_published' => true,
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
