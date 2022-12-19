<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        // get all vehicle with latest tracking
        $vehicles = Vehicle::with('activeRoutes.lastTracking')->get();

        //get all map properties from env
        $mapProps = new stdClass();
        $mapProps->token='pk.eyJ1IjoiY2FoeW9wZXJtb25vIiwiYSI6ImNsYmVxcTJmczAwaTczcGtjYnMzdmN5OHMifQ.gCywMV3PCFvmHx9HyZbraQ';
        $mapProps->user='cahyopermono';
        $mapProps->style='clbiqwbm4000b14nytxkvrv3j';
        // $mapProps->token=env('maptoken');
        // $mapProps->user=env('mapuser');
        // $mapProps->style=env('mapstyle');

        return Inertia::render('Dashboard', ['vehicles' => $vehicles, 'mapProps' => $mapProps, 'canRegister' => Route::has('register')]);
    }
}
