<?php

namespace Database\Factories;

use App\Models\CustomPage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomPage>
 */
class CustomPageFactory extends Factory
{
    private const HTML_CHOICES = [
        "<h1>Stránka</h1>Vitajte na našej stránke!</p><br/><p>nConnect24 <strong>:)</strong>",
        "<h1>Stránka</h1>Vitajte!",
        "<h1>Stránka</h1><em>italic</em>, <strong>bold</strong>",
        "<h1>Test stránky</h1><br>Obsah"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->text(10),
            "content" => fake()->randomElement($this::HTML_CHOICES),
            "display" => CustomPage::DISPLAY_NONE,
        ];
    }
}
