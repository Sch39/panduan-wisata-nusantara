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
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@sch39.dev',
                'password' => Hash::make('JohnDoe12345'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@sch39.dev',
                'password' => Hash::make('JaneSmith12345'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@sch39.dev',
                'password' => Hash::make('AliceJohnson12345'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob@sch39.dev',
                'password' => Hash::make('BobBrown12345'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user)->assignRole(RolesEnum::USER->value);
        }
    }
}
