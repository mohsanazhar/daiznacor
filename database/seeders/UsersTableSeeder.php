<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Nacor Diaz',
            'email' => 'desarrollo@m3anagency.com',
            'password' => Hash::make('pty2020*'),
            'email_verified_at' => now(),
            'avatar' => 'avatar-1.jpg',
            'created_at' => now()
        ]);

        \App\Models\User::create([
            'name' => 'Info',
            'email' => 'info@pantramites.com',
            'password' => Hash::make('panama2020'),
            'email_verified_at' => now(),
            'avatar' => 'avatar-1.jpg',
            'created_at' => now()
        ]);
    }
}
