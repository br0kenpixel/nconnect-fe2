<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => bcrypt("admin")
        ]);

        $this->call(SpeakerSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(ConferenceSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(CustomPageSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
