<?php

namespace App\Http\Controllers;

use App\Models\Troubleshoot;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TroubleshootController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = troubleshoot::where('team_id', $request->user()->currentTeam->id)->get();
        return Inertia::render('Troubleshoot/Troubleshoot', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Troubleshoot::selectRaw("source, imei, description, created_at, to_char(created_at, 'yyyy-mm-dd HH24:MI:SS') data")->latest()->simplePaginate(15);
    }

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
            'description' => ['required'],
        ])->validate();

        $requestData=$request->all();
        $requestData['source']='web';
        $requestData['team_id']=$request->user()->currentTeam->id;
  
        Troubleshoot::create($requestData);
  
        return redirect()->back()
                    ->with('message', 'Input Troubleshoot Successfully.');
    }

    public function storeDevice(Request $request)
    {
        Validator::make($request->all(), [
            'imei' => ['required'],
        ])->validate();

        $requestData=$request->all();
        $requestData['source']='device';
        $requestData['description']='Panic button pressed on device with IMEI '.$requestData['imei'];

        Troubleshoot::create($requestData);
        return 'sukses';
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Troubleshoot  $troubleshoot
     * @return \Illuminate\Http\Response
     */
    public function show(Troubleshoot $troubleshoot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Troubleshoot  $troubleshoot
     * @return \Illuminate\Http\Response
     */
    public function edit(Troubleshoot $troubleshoot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Troubleshoot  $troubleshoot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Troubleshoot $troubleshoot)
    {
        Validator::make($request->all(), [
            'description' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Troubleshoot::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Troubleshoot Updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Troubleshoot  $troubleshoot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Troubleshoot::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
