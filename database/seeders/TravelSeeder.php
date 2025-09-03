<?php

namespace Database\Seeders;

use App\Enums\TravelStatus;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        if (0 === DB::table((new Travel())->getTable())->count()) {
            $driver = User::where('email', 'driver@example.com')->first();
            $passenger = User::where('email', 'passenger@example.com')->first();
            Travel::create(
                [
                    'passenger_id'  => $passenger->id,
                    'driver_id'     => $driver->id,
                    'tracking_code' => Str::uuid(),
                    'status'        => TravelStatus::Accepted,
                ],
            );
        }
    }
}
