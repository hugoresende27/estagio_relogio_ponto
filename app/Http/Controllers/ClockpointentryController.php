<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clockpointentry;
use Illuminate\Support\Facades\Auth;

class ClockpointentryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clockpointentrys =  Clockpointentry::orderBy('id')->paginate(10);

        return response()->json($clockpointentrys, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tenantId = Auth::user()->tenant_id;

        $fields = $request->validate([
            'employee_id'=>'required',
            'clock_in'=>'required',
            'clock_out'=>'required',
        ]);

        $entry = Clockpointentry::create([
            'tenant_id'=>$tenantId,
            'employee_id'=>$fields['employee_id'],
            'clock_in'=>$fields['clock_in'],
            'clock_out'=>$fields['clock_out'],
            
        ]);

        return response()->json($entry, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clockpointentrys = Clockpointentry::find($id);
        if (is_null($clockpointentrys)){
            return response()->json(['message'=>'Clockpoint not found',404] );
        }
        return response()->json($clockpointentrys = Clockpointentry::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clockpointentrys = Clockpointentry::find($id);
        if (is_null($clockpointentrys)){
            return response()->json(['message'=>'Clockpoint not found',404] );
        }
        $clockpointentrys->delete();
        return response()->json($clockpointentrys, 200);
    }
}
