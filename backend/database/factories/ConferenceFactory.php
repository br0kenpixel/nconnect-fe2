<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = fake()->numberBetween(2010, 2025);
        $date = $year . "-" . fake()->month() . "-" . fake()->dayOfMonth();

        return [
            "year" => $year,
            "date" => $date,
        ];
    }
}
