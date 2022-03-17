<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();

        return response()->json($locations, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            
            'country'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
            'zip_code'=>'required|string',
            'company_id'=>'required', 
            
        ]);
        
        $tenantId = Auth::user()->tenant_id;
       
        $location = Location::create([
                                 
            'tenant_id'=>$tenantId,          
            'country'=>$fields['country'], 
            'city'=>$fields['city'], 
            'street'=>$fields['street'], 
            'zip_code'=>$fields['zip_code'], 
            'company_id'=>$fields['company_id'], 
            'department_id'=>$request['department_id'], 

        ]);
        
        return response($location, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        if (is_null($location)){
            return response()->json(['message'=>'Location not found',404] );
        }
        return response()->json($location = Location::find($id), 200);
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
        $location = Location::find($id);
        if (is_null($location)){
            return response()->json(['message'=>'Location not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            
            'country'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
            'zip_code'=>'required|string',
            'company_id'=>'required', 
         
        ]);
        

        $location->update($fields);
        return response($location, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        if (is_null($location)){
            return response()->json(['message'=>'Location not found',404] );
        }
        $location->delete();
        return response($location, 200);
    }
}
