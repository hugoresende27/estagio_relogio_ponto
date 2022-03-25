<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
// use App\Scopes\TenantScope;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Exports\CompanyExport;
use App\Imports\CompanyImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   


    public function index()
    {
      
        $companies = Company::orderBy('created_at','DESC')->paginate(10);

        return response()->json($companies, 200);
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
            'nif'=>'required|string|unique:companies,nif',
            
            //////////LOCATION TABLE->ADRESS OF COMPANY/////////////
            'country'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
            'door_number'=>'required|string',
            'zip_code'=>'required|string',

            ////////////////FILE TABLE/////////////////////
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
                            
        ]);
        
        //TENANT_ID 
        $tenantId = Auth::user()->tenant_id;


        /////////////// LOCATION CREATE ////////////
        $company_location = Location::create([

        'tenant_id'=>$tenantId,          
        'country'=>$fields['country'], 
        'city'=>$fields['city'], 
        'street'=>$fields['street'], 
        'door_number'=>$fields['door_number'], 
        'zip_code'=>$fields['zip_code'], 

        ]);
       
        $company = Company::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'nif'=>$fields['nif'],
            'tenant_id'=>$tenantId,

            ////NON REQUIRED FIELDS
            'location_id'=>$company_location['id'],
        ]);

        ///////////// FILE CREATE //////////////////
        if (isset($fields['file'] ))
        {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->store('public/files');

            $company_file = File::create([
                'tenant_id'=>$tenantId,
                'type'=>'COMPANY FILE',
                'name'=>$file_name,
                'path'=>$file_path,
                'size'=>$request->file('file')->getSize(),
            ]);
            // dd($company_file);
            $company->file_id = $company_file['id'];
        };

        $company->save();

        //ATTACH TO PIVOT TABLE COMPANY_TENANT
        $company->tenant()->attach($tenantId);
        
        return response()->json($company, 201);
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
            'nif'=>'string|required',
            'location_id'=>'required',
        ]);
        
        
        $fields['location_id'] = $request['location_id'];
       
       

        $company->update($fields);
        return response()->json($company, 200);
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
        return response()->json($company, 200);
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

    
    public function export_xlsx() 
    {
        return Excel::download(new CompanyExport, 'companies.xlsx');
    }
    public function export_csv() 
    {
        return Excel::download(new CompanyExport, 'companies.csv');
    }

    public function import(Request $request) 
    {
        $file = $fields = $request->validate([
     
            'file'=>'required|mimes:xlsx,csv'
        ]);

        Excel::import(new CompanyImport, request()->file('file'));
        
        return response()->json('file imported');
    }
  
}
