<?php

namespace App\Http\Controllers;

use App\Models\Transmitter;
use App\Models\Vehicle;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Illuminate\Support\Str;

class VehicleRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VehicleRoute::with('vehicle', 'transmitter')->get();
        $vehicles = Vehicle::all();
        $transmitters = Transmitter::all();
        return Inertia::render('Vehicle/VehicleRoute', ['data' => $data, 'vehicles' => $vehicles, 'transmitters' => $transmitters]);
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
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'vehicle_id' => ['required'],
            'transmitter_id' => ['required'],
            'from' => ['required'],
            'from_long' => ['required'],
            'from_lat' => ['required'],
            'to' => ['required'],
            'to_long' => ['required'],
            'to_lat' => ['required'],
            'driver' => ['required'],
        ])->validate();

        $requestData = $request->all();

        // check vehicle avaibility for new route
        $activeVehicle = VehicleRoute::where('vehicle_id', $request->vehicle_id)->where('status', 'on')->get();

        // check if transmitter is active in another route
        $activeTransmitter = VehicleRoute::where(['transmitter_id' => $request->transmitter_id, 'status' => 'on'])->first();

        if($activeTransmitter){
            return redirect()->back()->withErrors([
                'message' => 'Cannot create a new route because Transmitter is already used in active routes'
            ]);
        }

        if(count($activeVehicle) > 0){
            return redirect()->back()->withErrors([
                'message' => 'Cannot create a new route because there is still an active route on the vehicle'
            ]);
        }

        // add noreg from ulid
        $requestData['reg_no'] = (string) Str::ulid();
        $requestData['status'] = 'on';

        error_log($request);

        VehicleRoute::create($requestData);

        return redirect()->back()
            ->with('message', 'Routes Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleRoute  $vehicleRoute
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleRoute $vehicleRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleRoute  $vehicleRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleRoute $vehicleRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleRoute  $vehicleRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleRoute $vehicleRoute)
    {
        Validator::make($request->all(), [
            'from' => ['required'],
            'from_long' => ['required'],
            'from_lat' => ['required'],
            'to' => ['required'],
            'to_long' => ['required'],
            'to_lat' => ['required'],
            'driver' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            VehicleRoute::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Route Updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleRoute  $vehicleRoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleRoute $vehicleRoute, Request $request)
    {
        if ($request->has('id')) {
            VehicleRoute::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
