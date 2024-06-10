<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$current_year = (int)date("Y");

        Conference::create([
            "year" => $current_year - 1,
            "date" => 
        ]);*/

        Conference::factory(3)->create();
    }
}
