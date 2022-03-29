<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Exports\LocationExport;
use App\Imports\LocationImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('created_at','DESC')->paginate(10);

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
            'door_number'=>'required|string',
            'zip_code'=>'required|string',
           
            ////////////////FILE TABLE/////////////////////
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
        ]);
        
        $tenantId = Auth::user()->tenant_id;
       
        $location = Location::create([
                                 
            'tenant_id'=>$tenantId,          
            'country'=>$fields['country'], 
            'city'=>$fields['city'], 
            'street'=>$fields['street'], 
            'door_number'=>$fields['door_number'], 
            'zip_code'=>$fields['zip_code'], 
          

        ]);

        ///////////// FILE CREATE //////////////////
        if (isset($fields['file'] ))
        {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->store('public/files');

            $location_file = File::create([
                'tenant_id'=>$tenantId,
                'type'=>'LOCATION FILE',
                'name'=>$file_name,
                'path'=>$file_path,
                'size'=>$request->file('file')->getSize(),
            ]);
            
            $location->file_id = $location_file['id'];
        };

        $location->save();
        
        return response()->json($location, 201);
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
            'door_number'=>'required|string',
            'zip_code'=>'required|string',

            ////////////////FILE TABLE/////////////////////
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
            
         
        ]);

 
        

        $location->update($fields);
        return response()->json($location, 200);
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
        return response()->json($location, 200);
    }

    public function export_xlsx() 
    {
        return Excel::download(new LocationExport, 'locations.xlsx');
    }
    public function export_csv() 
    {
        return Excel::download(new LocationExport, 'locations.csv');
    }

    public function import(Request $request) 
    {
        $file = $fields = $request->validate([
     
            'file'=>'required|mimes:xlsx,csv'
        ]);

        Excel::import(new LocationImport, request()->file('file'));
        
        return response()->json('file imported');
    }
    
}
