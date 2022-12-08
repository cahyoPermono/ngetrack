<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VesselController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Vessel::all();
        return Inertia::render('Vessel/vessel', ['data' => $data]);
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'type' => ['required'],
            'plate' => ['required'],
            'driver' => ['required'],
        ])->validate();
  
        Vessel::create($request->all());
  
        return redirect()->back()
                    ->with('message', 'Vessels Created Successfully.');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'type' => ['required'],
            'plate' => ['required'],
            'driver' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Vessel::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Vessel Updated Successfully.');
        }
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Vessel::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
