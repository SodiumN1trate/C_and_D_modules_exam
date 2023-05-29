<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Runner;
use App\Models\Team;
use App\Models\User;
use Database\Factories\RunnerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => 'admin',
        ]);

        $team = Team::create([
            'name' => 'Test',
            'contactEmail' => 'test@gmail.com',
            'startingTime' => '2023-05-29 13:55:41',
            'accessCode' => rand(99999999, 999999999),
        ]);

        Runner::factory()->state(['teamId' => $team->id])->count(10)->create();

        $team = Team::create([
            'name' => 'Test1',
            'contactEmail' => 'test1@gmail.com',
            'accessCode' => rand(99999999, 999999999),
        ]);

        Runner::factory()->state(['teamId' => $team->id])->count(10)->create();

        $team = Team::create([
            'name' => 'Test2',
            'contactEmail' => 'test2@gmail.com',
            'accessCode' => rand(99999999, 999999999),
        ]);

        Runner::factory()->state(['teamId' => $team->id])->count(10)->create();
    }
}
