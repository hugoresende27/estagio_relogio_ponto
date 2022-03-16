<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::all();
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
            
            'name'=>'required|string',
            
        ]);
        
       
        $department = Department::create([
            'name'=>$fields['name'],
            'company_id'=>1,            //HARD CODED 
        ]);
        
        return response($department, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        if (is_null($department)){
            return response()->json(['message'=>'Department not found',404] );
        }
        return response()->json($department = Department::find($id), 200);
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
        $department = Department::find($id);
        if (is_null($department)){
            return response()->json(['message'=>'Department not found',404] );
        }

        $fields = $request->validate([
            
            'name'=>'required|string',
            
        ]);
        

        $department->update($fields);
        return response($department, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if (is_null($department)){
            return response()->json(['message'=>'Department not found',404] );
        }
        $department->delete();
        return response($department, 200);
    }
}
