<?php

namespace Database\Seeders;

use Database\Seeders\SpeakerSeeder;
use Database\Seeders\StageSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->call(SpeakerSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(ConferenceSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(CustomPageSeeder::class);
    }
}
