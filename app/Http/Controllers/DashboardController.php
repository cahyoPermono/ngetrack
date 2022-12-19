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
        $mapProps->token=env('maptoken');
        $mapProps->user=env('mapuser');
        $mapProps->style=env('mapstyle');

        return Inertia::render('Dashboard', ['vehicles' => $vehicles, 'mapProps' => $mapProps]);
    }
}
