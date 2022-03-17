<?php

namespace App\Http\Controllers;

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
        $schedules = Schedule::all();

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
        $fields = $request->validate([
            
            'company_id'=>'required',
            'department_id'=>'required',
            'shift_start'=>'required',
            'shift_end'=>'required',
            'shift_type'=>'required'
           
            
        ]);
        
        $tenantId = Auth::user()->tenant_id;

        $total_shift = $fields['shift_end']-$fields['shift_start'];

        if ($total_shift<0)
        {
            $total_shift = $fields['shift_start']-240000-$fields['shift_end'];
        }
       
        $schedules = Schedule::create([
                                 
            'tenant_id'=>$tenantId,          
            
            'company_id'=>$fields['company_id'],
            'department_id'=>$fields['department_id'],
            'shift_start'=>$fields['shift_start'],
            'shift_end'=>$fields['shift_end'],
            'shift_type'=>$fields['shift_type'],
            'shift_total'=>abs($total_shift),

        ]);
        
        return response($schedules, 201);
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
        return response($schedule, 200);
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
        return response($schedule, 200);
    }
}
