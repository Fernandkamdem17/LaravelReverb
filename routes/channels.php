<?php

use App\Models\Travel;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('travel-live-location.{tracking_code}', function (User $user, string $trackingCode) {
    $travel = Travel::where('tracking_code', $trackingCode)->first();
    return in_array($user->id, [$travel->passenger_id, $travel->driver_id]);
});

Broadcast::channel('users.{id}', fn($user, $id) => (int) $user->id === (int) $id);
