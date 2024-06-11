<?php

namespace Database\Factories;

use App\Models\CustomPage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomPage>
 */
class CustomPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->text(10),
            "content" => fake()->randomHtml(),
            "display" => CustomPage::DISPLAY_NONE,
        ];
    }
}
