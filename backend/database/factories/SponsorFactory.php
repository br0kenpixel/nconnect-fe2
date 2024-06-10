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
        $image_path = fake()->image(width: 32, height: 32, format: "png");
        $raw_image = file_get_contents($image_path);
        $image = "data:image/jpeg;base64, " . base64_encode($raw_image);

        return [
            "name" => fake()->company(),
            "image" => $image
        ];
    }
}
