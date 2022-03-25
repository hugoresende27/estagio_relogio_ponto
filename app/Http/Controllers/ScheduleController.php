<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\File;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::orderBy('created_at','DESC')->paginate(10);

        return response()->json($schedules, 200);
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
            
            'company_id'=>'required',
            // 'department_id'=>'required',
            'shift_start'=>'required',
            'shift_end'=>'required',
            'shift_type'=>'required',
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
            
        ]);
 

        
        $shift_start = strtotime($fields['shift_start']);
        $shift_end = strtotime($fields['shift_end']);

        $total_shift = $shift_end - $shift_start; 
        $time = date("his",$total_shift);
    
        $schedule = Schedule::create([
                                 
            'tenant_id'=>$tenantId,          
            
            'company_id'=>$fields['company_id'],
           
            'shift_start'=>$fields['shift_start'],
            'shift_end'=>$fields['shift_end'],
            'shift_type'=>$fields['shift_type'],
            'shift_total'=>$time,
        

        ]);

        if (isset($request['department_id']))
        {
            $schedule->department_id = $request['department_id'];
        }

        ///////////// FILE CREATE //////////////////
        if (isset($fields['file'] ))
        {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->store('public/files');

            $schedule_file = File::create([
                'tenant_id'=>$tenantId,
                'type'=>'SCHEDULE FILE',
                'name'=>$file_name,
                'path'=>$file_path,
                'size'=>$request->file('file')->getSize(),
            ]);

            $schedule->file_id = $schedule_file['id'];
        };

        $schedule->save();


        
        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        if (is_null($schedule)){
            return response()->json(['message'=>'Location not found',404] );
        }
        return response()->json($schedule = Schedule::find($id), 200);
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
        $schedule = Schedule::find($id);
        if (is_null($schedule)){
            return response()->json(['message'=>'Schedulle not found',404] );
        }
    
        $fields = $request->validate([

            'company_id'=>'required',
            'department_id'=>'required',
            'shift_start'=>'required',
            'shift_end'=>'required',
            'shift_type'=>'required'
           
         
        ]);
        

        $schedule->update($fields);
        return response()->json($schedule, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if (is_null($schedule)){
            return response()->json(['message'=>'Location not found',404] );
        }
        $schedule->delete();
        return response()->json($schedule, 200);
    }
}
