<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Schedule::factory()->create(['time' => '08:00']);
        Schedule::factory()->create(['time' => '09:00']);
        Schedule::factory()->create(['time' => '10:00']);
        Schedule::factory()->create(['time' => '11:00']);
        Schedule::factory()->create(['time' => '13:00']);
        Schedule::factory()->create(['time' => '14:00']);
        Schedule::factory()->create(['time' => '15:00']);
        Schedule::factory()->create(['time' => '16:00']);
    }
}
