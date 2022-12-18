<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackingRequest;
use App\Models\VehicleRoute;
use App\Models\VehicleTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrackingRequest $request)
    {

        $route = VehicleRoute::where('reg_no', $request->reg_no)->first();

        if (!$route) {
            return response()->json([
                'message' => 'Route Not Found'
            ], 404);
        }

        if ($route->status != 'on') {
            return response()->json([
                'message' => 'Route Already Finished'
            ], 400);
        }

        $requestData = $request->only('long', 'lat');
        $requestData['vehicle_route_id'] = $route->id;

        return VehicleTracking::create($requestData);

        // return redirect()->back()
        //     ->with('message', 'Routes Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleTracking  $vehicleTracking
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleTracking $vehicleTracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleTracking  $vehicleTracking
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleTracking $vehicleTracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleTracking  $vehicleTracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleTracking $vehicleTracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleTracking  $vehicleTracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleTracking $vehicleTracking)
    {
        //
    }
}
