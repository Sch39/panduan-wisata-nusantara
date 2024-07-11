<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RegenciesSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(DestinationsSeeder::class);
        $this->call(DestinationDetailsSeeder::class);
    }
}
