<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
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
        
        
        $employees = User::all();

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
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string',
            'nif'=>'string',
            'emer_contact'=>'string',
            'bi_cc'=>'string',
            
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
            'role'=>'user',           
            'nif'=>$request['nif'],
            'emer_contact'=>$request['emer_contact'],
            'bi_cc'=>$request['bi_cc'],

            'tenant_id'=>$tenantId,
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            
            
        ]);


        return response($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::find($id);
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
        $employee = User::find($id);
        if (is_null($employee)){
            return response()->json(['message'=>'Employee not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string',
            'nif'=>'string',
            'emer_contact'=>'string',
            'bi_cc'=>'string',
        ]);
        

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
        //
    }
}
