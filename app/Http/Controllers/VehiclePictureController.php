<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehiclePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclePictureController extends Controller
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
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'vehicle_id' => ['required'],
            'pictures' => ['required'],
        ])->validate();

        $vehicle = Vehicle::find($request->vehicle_id);

        if(!$vehicle){
            return redirect()->back()->withErrors([
                'message' => 'Vehicle Not Found'
            ]);
        }

        $pictures = [];

        foreach ($request->pictures as $picture) {
            $fileName = uniqid() . '.' . $picture->getClientOriginalExtension();
            $image_path =  $picture->storeAs('vehicle-picture', $fileName, 'public');

            array_push($pictures, new VehiclePicture([
                'vehicle_id' => $request->vehicle_id,
                'url' => $image_path
            ]));
        }

        $vehicle->vehiclePictures()->saveMany($pictures);

        return redirect()->back()
            ->with('message', 'Pictures Uploaded Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehiclePicture  $vehiclePicture
     * @return \Illuminate\Http\Response
     */
    public function show(VehiclePicture $vehiclePicture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehiclePicture  $vehiclePicture
     * @return \Illuminate\Http\Response
     */
    public function edit(VehiclePicture $vehiclePicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehiclePicture  $vehiclePicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehiclePicture $vehiclePicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehiclePicture  $vehiclePicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehiclePicture $vehiclePicture)
    {
        //
    }
}
