<?php

namespace App\Models;

use App\Enums\TravelStatus;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';
    protected $fillable = [
        'passenger_id',
        'driver_id',
        'status',
        'tracking_code'
    ];
    protected $casts = [
        'status' => TravelStatus::class,
    ];
}
