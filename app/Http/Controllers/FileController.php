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

        $validatedData  = $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
            'type'=>'required|string'
    
           ]);

        

        $name = $request->file('file')->getClientOriginalName();
 
        $path = $request->file('file')->store('public/files');
 
        $file = new File;
 
        $file->tenant_id = $tenantId;
        $file->type = $validatedData['type'];
        $file->name = $name;
        $file->path = $path;
        $file->size = $request->file('file')->getSize();
       

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
