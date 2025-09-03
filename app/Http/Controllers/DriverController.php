<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $travel = Travel::first();
        return view('driver.index', compact('travel'));
    }
}
