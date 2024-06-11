<?php

namespace Database\Seeders;

use App\Models\CustomPage;
use Illuminate\Database\Seeder;

class CustomPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomPage::factory(3)->create();
    }
}
