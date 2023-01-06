<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use stdClass;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // get all vehicle with latest tracking
        // $vehicles = Vehicle::with('activeRoutes.lastTracking')->get();

        //get all map properties from env
        $mapProps = new stdClass();
        $mapProps->token='pk.eyJ1IjoiY2FoeW9wZXJtb25vIiwiYSI6ImNsYmVxcTJmczAwaTczcGtjYnMzdmN5OHMifQ.gCywMV3PCFvmHx9HyZbraQ';
        $mapProps->user='cahyopermono';
        $mapProps->style='clbiqwbm4000b14nytxkvrv3j';

        // not using env for hosting cause
        // $mapProps->token=env('maptoken');
        // $mapProps->user=env('mapuser');
        // $mapProps->style=env('mapstyle');

        // get all tracking from latest route vehicle
        $vehiclesTrack = Vehicle::with('activeRoutes.vehicleTracking')->where('team_id', $request->user()->currentTeam->id)->get();

        // return Inertia::render('Dashboard', ['vehicles' => $vehicles, 'mapProps' => $mapProps, 'canLogin' => Route::has('login'), 'canRegister' => Route::has('register'), "vehicleTrack" => $vehiclesTrack]);
        return Inertia::render('Dashboard', ['mapProps' => $mapProps, 'canLogin' => Route::has('login'), 'canRegister' => Route::has('register'), "vehicleTrack" => $vehiclesTrack]);
    }
}
