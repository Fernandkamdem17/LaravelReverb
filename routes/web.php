<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/driver/index', [DriverController::class, 'index'])->middleware('role:driver');
Route::get('/passenger/index', [PassengerController::class, 'index'])->middleware('role:passenger');



Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/travel', [TravelController::class, 'show'])->name('travel');
});

Route::post('/travel-request', [TravelController::class, 'store'])->name('travel.request');



Route::prefix('v1/travel')
    ->middleware('auth')
    ->as('api.v1.travel.')
    ->group(function (): void {
        // POST pour créer une nouvelle demande
        Route::post('store', [TravelController::class, 'store'])->name('store');

        // Optionnel : route pour accepter le voyage côté chauffeur
        Route::post('accept/{trackingCode}', [TravelController::class, 'accept'])->name('accept');
    });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
