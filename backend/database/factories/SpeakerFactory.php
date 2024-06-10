<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_path = fake()->image(width: 8, height: 8, format: "png");
        $raw_image = file_get_contents($image_path);
        $image = base64_encode($raw_image);

        return [
            "name" => fake()->firstName() . " " . fake()->lastName(),
            "company" => fake()->company(),
            "description" => fake()->text(50),
            "image" => $image,
            "headliner" => fake()->boolean()
        ];
    }
}
