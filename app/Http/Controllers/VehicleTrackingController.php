<?php

namespace App\Http\Controllers;

use App\Events\NewTrade;
use App\Events\VehicleTracking as EventsVehicleTracking;
use App\Events\VehicleTrackingEvent;
use App\Http\Requests\TrackingRequest;
use App\Models\NonRouteTracking;
use App\Models\Transmitter;
use App\Models\VehicleRoute;
use App\Models\VehicleTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VehicleTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = VehicleTracking::with('vehicleRoute.vehicle')->latest()->simplePaginate(15);
        foreach($tracks as $track) {
            $track->date = $track->created_at->format('Y-m-d H:i:s');
        }

        return $tracks;
    }

    public function daily()
    {
        return VehicleTracking::selectRaw("COUNT(*) count, to_char(created_at, 'yyyy mm dd') date")->groupBy('date')
        ->orderBy('date', 'desc')->get();
    }

    public function weekly()
    {
        return VehicleTracking::selectRaw("COUNT(*) count, to_char(created_at, 'yyyy mm w') date")->groupBy('date')
        ->orderBy('date', 'desc')->get();
    }

    public function monthly()
    {
        return VehicleTracking::selectRaw("COUNT(*) count, to_char(created_at, 'yyyy mm') date")->groupBy('date')
        ->orderBy('date', 'desc')->get();
    }

    public function yearly()
    {
        return VehicleTracking::selectRaw("COUNT(*) count, to_char(created_at, 'yyyy') date")->groupBy('date')
        ->orderBy('date', 'desc')->get();
    }

    public function troubleshoots()
    {
        return "halo";
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

        if ($transmitter) {
            // get Route with that imei that status is on
            $route = VehicleRoute::where('transmitter_id', $transmitter->id)->where('status', 'on')->first();

            if ($route) {
                $requestData = $request->only('long', 'lat', 'speed', 'heading');
                $requestData['vehicle_route_id'] = $route->id;

                $vt = VehicleTracking::create($requestData);

                event(new VehicleTrackingEvent('incoming-data'));
                return $vt;
            } else {
                $requestData = $request->only('long', 'lat', 'speed', 'heading', 'imei');
                $vt = NonRouteTracking::create($requestData);

                return $vt;
            }
        } else {
            return response()->json([
                'message' => 'Imei Number ' . $request->imei . ' not Valid'
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

    public function exportCsv(Request $request)
    {
        $fileName = 'Tracking_Weekly.csv';
        $tracks = VehicleTracking::with(['vehicleRoute' => function($query) use ($request){
            return $query->where('team_id', $request->user()->currentTeam->id)->with('vehicle');
        }])->whereBetween(
            'created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )->get();

        // $tracks = VehicleTracking::with('vehicleRoute.vehicle')->whereBetween(
        //     'created_at',
        //     [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        // )->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Vehicle', 'Source', 'Destination', 'Longitude', 'Latitude', 'Date', 'Speed', 'Heading');

        $callback = function () use ($tracks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tracks as $track) {
                $row['Vehicle']  = $track->vehicleRoute->vehicle->name;
                $row['Source']    = $track->vehicleRoute->from;
                $row['Destination']    = $track->vehicleRoute->to;
                $row['Longitude']  = $track->long;
                $row['Latitude']  = $track->lat;
                $row['Date']  = $track->created_at;
                $row['Speed']  = $track->speed;
                $row['Heading']  = $track->heading;

                fputcsv($file, array($row['Vehicle'], $row['Source'], $row['Destination'], $row['Longitude'], $row['Latitude'], $row['Date'], $row['Speed'], $row['Heading']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
