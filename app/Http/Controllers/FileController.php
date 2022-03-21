<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files =  File::orderBy('created_at','DESC')->paginate(10);

        return response()->json($files, 200);
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
        // dd($tenantId);

        $fields = $request->validate([
            'file_path'=>'required|string',
           
        ]);

        $file = File::create([

            'tenant_id'=>$tenantId,

            'employee_id' => $request['employee_id'],
            'company_id' => $request['company_id'],
            'file_path' => $fields['file_path'],

        ]);

        $file->save();

        return response()->json($file,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $file = File::find($id);
      
        if (is_null($file)){
            return response()->json(['message'=>'File not found',404] );
        }

        //GET EMPLOYEE SHIFT
        // $shift = Schedule::where('id', $employee->schedule_id)->get();
        // return response()->json($shift, 200);

        return response()->json($file = File::find($id), 200);
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
        $tenantId = Auth::user()->tenant_id;

        $file = File::find($id);
        if (is_null($file)){
            return response()->json(['message'=>'File not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            'file_path'=>'required|string',
        ]);

        $fields['employee_id']=$request['employee_id'];
        $fields['company_id']=$request['company_id'];
        $file->update($fields);

        return response()->json($file, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        if (is_null($file)){
            return response()->json(['message'=>'File not found',404] );
        }
        $file->delete();
        return response()->json($file, 200);
    }
}
