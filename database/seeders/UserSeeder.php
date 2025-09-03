<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'driver@example.com')->exists()) {
            User::create([
                'name' => "Driver",
                'email' => "driver@example.com",
                'usertype' => "driver",
                'password' => "12345678"
            ]);
        }

        if (!User::where('email', 'passenger@example.com')->exists()) {
            User::create([
                'name' => "Passenger",
                'email' => "passenger@example.com",
                'usertype' => "passenger",
                'password' => "12345678"
            ]);
        }
    }
}
