<?php

namespace App\Http\Controllers;

use App\Models\File;
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

        $departments = Department::orderBy('created_at','DESC')->paginate(10);
        return response()->json($departments, 200);
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
            
            'name'=>'required|string',
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
            'company_id'=>'required', 
           
        ]);
        

       
        $department = Department::create([
            'name'=>$fields['name'],
            'company_id'=>$fields['company_id'],            
            'tenant_id'=>$tenantId
        ]);

        if(isset($fields['email']))
        {
            $department->email = $request['email'];
        }

        ///////////// FILE CREATE //////////////////
        if (isset($fields['file'] ))
        {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->store('public/files');

            $department_file = File::create([
                'tenant_id'=>$tenantId,
                'type'=>'DEPARTMENT FILE',
                'name'=>$file_name,
                'path'=>$file_path,
                'size'=>$request->file('file')->getSize(),
            ]);

            $department->file_id = $department_file['id'];
        };

        $department->save();
        
        return response()->json($department, 201);
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
            'email'=>'string',
            'company_id'=>'required|string', 
        ]);
        

        $department->update($fields);
        return response()->json($department, 200);
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
        return response()->json($department, 200);
    }

    public function showEmployees($id)
    {
        $employees = Employee::where('department_id',$id)->get();
        // dd($employees);
        if (empty($employees)){
            return response()->json(['message'=>'No employees',404] );
        }
        return response()->json($employees, 200);
    }

    
}
