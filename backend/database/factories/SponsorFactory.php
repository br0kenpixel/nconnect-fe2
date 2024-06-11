<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_path = fake()->picsum(null, 128, 128, true);
        $raw_image = file_get_contents($image_path);
        $image = "data:image/jpeg;base64, " . base64_encode($raw_image);

        return [
            "name" => fake()->text(12),
            "image" => $image
        ];
    }
}
