<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Traits\Tenantable;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $employees = Employee::all();

        return response()->json($employees, 200);

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
            'name'=>'required|string',
            'email'=>'required|string|unique:employees,email',
            'password'=>'required|string|confirmed',
            'nif'=>'required|string',
            'emer_contact'=>'required|string',
            'bi_cc'=>'required|string',
            'company_id'=>'required',       //REQUIRED ATM, CAN BE CHANGED

            'image_path'=>'string',
            
         
            
        ]);

        $employee = Employee::create([

            'tenant_id'=>$tenantId,

            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
            'role'=>'user',           
            'nif'=>$fields['nif'],
            'emer_contact'=>$fields['emer_contact'],
            'bi_cc'=>$fields['bi_cc'],
            'company_id'=>$fields['company_id'],

            //REQUEST
            
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],
            'start_date'=>$request['start_date'],
            
            
            
        ]);
        // dd($employee['id']);
           
        $image = Image::create([
            'tenant_id'=>$tenantId,
            'image_path'=>$request['image_path'],
            'employee_id'=>$employee['id'],
        ]);

        $employee->image_id = $image['id'];
        $employee->save();


        return response($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)){
            return response()->json(['message'=>'Employee not found',404] );
        }
        return response()->json($employee = User::find($id), 200);
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
        $employee = Employee::find($id);
        if (is_null($employee)){
            return response()->json(['message'=>'Employee not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
            'nif'=>'required|string',
            'emer_contact'=>'required|string',
            'bi_cc'=>'required|string',
            'company_id'=>'required',       //REQUIRED ATM, CAN BE CHANGED
        ]);
        
        $fields['schedule_id'] = $request['schedule_id'];
        $fields['department_id'] = $request['department_id'];

        $employee->update($fields);


        return response($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)){
            return response()->json(['message'=>'Employee not found',404] );
        }
        $employee->delete();
        return response($employee, 200);
    }
}
