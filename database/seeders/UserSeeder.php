<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin@sch39.dev',
            'password' => Hash::make('admin12345')
        ])->assignRole(RolesEnum::ADMIN->value);

        User::create([
            'name' => 'user 1',
            'email' => 'user@sch39.dev',
            'password' => Hash::make('user12345')
        ])->assignRole(RolesEnum::USER->value);
    }
}
