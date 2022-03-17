<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'company_id'=>'required', 
            
        ]);
        
        $tenantId = Auth::user()->tenant_id;

  
    //    $tenant_companies = Company::all();
    
    //    dd($tenant_companies);
       
        $department = Department::create([
            'name'=>$fields['name'],
            'company_id'=>$fields['company_id'],            
            'tenant_id'=>$tenantId
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
            
            'name'=>'string|required',
            'company_id'=>'required|string', 
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

    public function showEmployees($id)
    {
        $employees = Employee::where('department_id',$id)->get();
        // dd($employees);
        if (is_null($employees)){
            return response()->json(['message'=>'No employees',404] );
        }
        return response()->json($employees, 200);
    }

    
}
