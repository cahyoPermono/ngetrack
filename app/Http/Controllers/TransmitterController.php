<?php

namespace App\Http\Controllers;

use App\Models\Transmitter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TransmitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = transmitter::all();
        return Inertia::render('Transmitter/Transmitter', ['data' => $data]);
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
            'imei_number' => ['required'],
            'gsm_number' => ['required'],
            
        ])->validate();
  
        Transmitter::create($request->all());
  
        return redirect()->back()
                    ->with('message', 'GPS Transmitter Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transmitter  $transmitter
     * @return \Illuminate\Http\Response
     */
    public function show(Transmitter $transmitter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transmitter  $transmitter
     * @return \Illuminate\Http\Response
     */
    public function edit(Transmitter $transmitter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transmitter  $transmitter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transmitter $transmitter)
    {
        Validator::make($request->all(), [
            'imei_number' => ['required'],
            'gsm_number' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Transmitter::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'GPS Transmitter Updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transmitter  $transmitter
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        if ($request->has('id')) {
            Transmitter::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
