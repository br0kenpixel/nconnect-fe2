<?php

namespace Database\Factories;

use App\Models\Speaker;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maybe_speaker = fake()->randomElement([true, false]) ? Speaker::all()->random()->id : null;

        return [
            "title" => fake()->text("32"),
            "description" => fake()->paragraph(),
            "start" => fake()->time("H:i"),
            "end" => fake()->time("H:i", "+1 hour"),
            "speaker" => $maybe_speaker,
            "stage" => Stage::all()->random()->id,
            "seats" => fake()->numberBetween(10, 20)
        ];
    }
}
