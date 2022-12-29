<?php

namespace App\Http\Controllers;

use App\Events\NewTrade;
use App\Events\VehicleTracking as EventsVehicleTracking;
use App\Events\VehicleTrackingEvent;
use App\Http\Requests\TrackingRequest;
use App\Models\Transmitter;
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
        // check if transmitter with requested imei exsist
        $transmitter = Transmitter::where('imei_number', $request->imei)->first();

        if($transmitter){
            // get Route with that imei that status is on
            $route = VehicleRoute::where('transmitter_id',$transmitter->id)->where('status','on')->first();

            if($route){
                $requestData = $request->only('long', 'lat');
                $requestData['vehicle_route_id'] = $route->id;

                $vt = VehicleTracking::create($requestData);

                event(new VehicleTrackingEvent('incoming-data'));
                return $vt;
            } else {
                return response()->json([
                    'message' => 'Active Route Not Found'
                ], 404);
            }
        }else {
            return response()->json([
                'message' => 'Imei Number '.$request->imei.' not Valid'
            ], 404);
        }
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
