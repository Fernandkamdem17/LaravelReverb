<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\User;
use App\Models\Travel;
use App\Enums\TravelStatus; // si tu utilises un Enum
use App\Notifications\SendNotificationToDriver;
use Illuminate\Support\Facades\Auth;

class TravelController extends BaseAPIController
{
    public function store(Request $request): JsonResponse
    {
        // Récupération de l’utilisateur connecté
        $user = Auth::user();


        // Récupération du driver par son email
        $driver = User::whereEmail('driver@example.com')->firstOrFail();

        // Création du voyage
        $travel = Travel::create([
            'passenger_id'  => $user->id,
            'driver_id'     => $driver->id,
            'tracking_code' => Str::uuid(),
            'status'        => TravelStatus::Pending,
        ]);

        // Envoi de la notification au driver
        Notification::send($driver, new SendNotificationToDriver($travel));

        // Réponse JSON
        return $this->respondWithResource(
            resource: new JsonResource($travel),
            message: __('base::http_message.entity.created', ['entity' => 'travel'])
        );
    }

    public function show()
    {
        // Vérifier le rôle de l'utilisateur connecté
        if (Auth::user()->usertype === 'driver') {                 // Si l’utilisateur est un chauffeur
            return view('driver.home');        // Affiche la vue driver/home avec la variable $travel
        }

        if (Auth::user()->usertype === 'passenger') {              // Si l’utilisateur est un passager
            return view('passenger.home');     // Affiche la vue passenger/home avec la variable $travel
        }
    }
}
