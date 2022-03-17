<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Department;
use App\Scopes\TenantScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   


    public function index()
    {
        // dd(session());
        return Company::all();
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
            
            'name'=>'required|string|unique:companies,name',
            'email'=>'required|string',
            
        ]);
        
        //TENANT_ID 
        $tenantId = Auth::user()->tenant_id;
       
        $company = Company::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'tenant_id'=>$tenantId,

            ////NON REQUIRED FIELDS
            'location_id'=>$request['location_id'],
        ]);

        //ATTACH TO PIVOT TABLE COMPANY_TENANT
        $company->tenant()->attach($tenantId);
        
        return response($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if (is_null($company)){
            return response()->json(['message'=>'Company not found',404] );
        }
        return response()->json($company = Company::find($id), 200);
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
        $company = Company::find($id);
        if (is_null($company)){
            return response()->json(['message'=>'Company not found',404] );
        }

        $fields = $request->validate([
            
            'name'=>'string|required',
            'email'=>'string|required',
            'location_id'=>'required',
        ]);
        
        
        $fields['location_id'] = $request['location_id'];
       
       

        $company->update($fields);
        return response($company, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if (is_null($company)){
            return response()->json(['message'=>'Company not found',404] );
        }
        $company->delete();
        return response($company, 200);
    }

    public function showEmployees($id)
    {
        $employees = Employee::where('company_id',$id)->get();
        // dd($employees);
        if (is_null($employees)){
            return response()->json(['message'=>'No employees',404] );
        }
        return response()->json($employees, 200);
    }

    public function showDepartments($id)
    {
        $department = Department::where('company_id',$id)->get();
        // dd($employees);
        if (is_null($department)){
            return response()->json(['message'=>'No departments',404] );
        }
        return response()->json($department, 200);
    }

  
}
