<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_path = fake()->picsum(null, 64, 64, true);
        $raw_image = file_get_contents($image_path);
        $image = "data:image/jpeg;base64, " . base64_encode($raw_image);

        return [
            "name" => fake()->name(),
            "opinion" => fake()->paragraph(),
            "position" => fake()->text(10),
            "image" => $image
        ];
    }
}
