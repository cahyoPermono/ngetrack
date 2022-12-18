<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // get all vehicle with latest tracking
        $vehicles = Vehicle::with('activeRoutes.lastTracking')->get();
        return Inertia::render('Dashboard', ['vehicles' => $vehicles]);
    }
}
