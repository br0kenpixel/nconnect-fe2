<?php

namespace Database\Factories;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stage>
 */
class StageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "conference" => Conference::all()->random()->id,
            "name" => fake()->randomKey(["AI & DATA", "Hacking", "Python world", "Linux world", "Data collection", "Web development", "Game development", "Mac Software"])
        ];
    }
}
