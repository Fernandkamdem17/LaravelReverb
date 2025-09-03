<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        $travel = Travel::first();
        return view('passenger.index', compact('travel'));
    }
}
