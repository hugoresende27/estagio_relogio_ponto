<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Image;
use App\Models\Tenant;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Schedule;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
// use App\Models\Traits\Tenantable;
use App\Models\Clockpointentry;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $employees = Employee::orderBy('created_at','DESC')->paginate(10);

        return response()->json($employees, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     //////////////////////////  CRUD     ////////////////////////////
    public function store(Request $request)
    {

        
        $tenantId = Auth::user()->tenant_id;
        // dd($tenantId);

        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|',
            
            'nif'=>'required|string',
            'niss'=>'required|string',
            'emercontact'=>'required|string',
            'bicc'=>'required|string',
            'company_id'=>'required',     
            'start_date'=>'required',  

            'image'=>'mimes:png,jpg,jpeg',
            'file' => 'mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',
            'role'=>'string',

            //////////LOCATION TABLE->ADRESS OF EMPLOYEE/////////////
            'country'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
            'door_number'=>'required|string',
            'zip_code'=>'required|string',
                       
        ]);

        $employee = Employee::create([

            'tenant_id'=>$tenantId,

            'name' => $fields['name'],
            'email'=>$fields['email'],
            
                     
            'nif'=>$fields['nif'],
            'niss'=>$fields['niss'],
            'emercontact'=>$fields['emercontact'],
            'bicc'=>$fields['bicc'],
            'start_date'=>$fields['start_date'],
            // 'company_id'=>$fields['company_id'],

            //REQUEST NON REQUIRED
            
            'iban'=>$request['iban'],
            'details'=>$request['details'],
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],
            
            // 'role'=>$request['role'],  
            'role'=>'EMPLOYEE',                 //HARD CODED ROLE EMPLOYEE  
        
            
        ]);

        if($fields['company_id'] != 0)
        {
            $employee->company_id = $fields['company_id'];
        }
        
        ///////////// IMAGE CREATE //////////////////
        if (isset($fields['image'] ))
        {
            $image_name = $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->store('public/images');

            $employee_image = Image::create([
                'tenant_id'=>$tenantId,
                'name'=>$image_name,
                'image_path'=>$image_path,
                'size'=>$request->file('image')->getSize(),
                'employee_id'=>$employee['id'],
            ]);

            $employee->image_id = $employee_image['id'];
        };

        ///////////// FILE CREATE //////////////////
        if (isset($fields['file'] ))
        {
            $file_name = $request->file('file')->getClientOriginalName();
            $file_path = $request->file('file')->store('public/files');

            $employee_file = File::create([
                'tenant_id'=>$tenantId,
                'type'=>'EMPLOYEE FILE',
                'name'=>$file_name,
                'path'=>$file_path,
                'size'=>$request->file('file')->getSize(),
            ]);

            $employee->file_id = $employee_file['id'];
        };

        /////////////// LOCATION CREATE ////////////
        $employee_location = Location::create([

            'tenant_id'=>$tenantId,          
            'country'=>$fields['country'], 
            'city'=>$fields['city'], 
            'street'=>$fields['street'], 
            'door_number'=>$fields['door_number'], 
            'zip_code'=>$fields['zip_code'], 

        ]);

        
        $employee->location_id = $employee_location['id'];
        $employee->save();


        return response()->json($employee, 201);
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

        //GET EMPLOYEE SHIFT
        // $shift = Schedule::where('id', $employee->schedule_id)->get();
        // return response()->json($shift, 200);

        return response()->json($employee = Employee::find($id), 200);
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

        $employee = Employee::find($id);
        if (is_null($employee)){
            return response()->json(['message'=>'Employee not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            
            'name'=>'required|string',
            'email'=>'required|string',
            
            'nif'=>'required|string',
            'niss'=>'required|string',
            'emercontact'=>'required|string',
            'bicc'=>'required|string',     
            'start_date'=>'required',  
            'image'=>'mimes:png,jpg,jpeg',
    

        ]);

        ////FOREIGN ID'S/////////////
        if ($request['company_id']!=0)
        {
            $fields['company_id'] = $request['company_id'];
        }
        if ($request['department_id']!=0)
        {
            $fields['department_id'] = $request['department_id'];
        }
        if ($request['schedule_id']!=0)
        {
            $fields['schedule_id'] = $request['schedule_id'];
        }



        ///////NON REQUIRED FIELDS ///////////////
        $fields['iban'] = $request['iban'];
        $fields['details'] = $request['details'];
        $fields['image'] = $request['image'];
        $fields['start_date'] = $request['start_date'];

       

        
        if (isset($fields['image'] ))
        {
            $image = Image::where('employee_id',$id)->first();

               
            if(!empty($image))
            {
                $image->delete();
            }
              
            ///////////// IMAGE CREATE //////////////////
            $image_name = $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->store('public/images');

            $employee_image = Image::create([
                'tenant_id'=>$tenantId,
                'name'=>$image_name,
                'image_path'=>$image_path,
                'size'=>$request->file('image')->getSize(),
                'employee_id'=>$employee['id'],
            ]);
        
            $employee->image_id = $employee_image['id'];
         
        }

        

        $employee->update($fields);

        return response()->json($employee, 200);
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
       $clockpoints = Clockpointentry::where('employee_id',$id);
       $clockpoints->delete();
        $employee->delete();

       

       
        return response()->json($employee, 200);
    }


    //////////////////////////IMPORT/EXPORT////////////////////////////

    public function export_xlsx() 
    {
        return Excel::download(new EmployeeExport, 'employees.xlsx');
    }
    public function export_csv() 
    {
        return Excel::download(new EmployeeExport, 'employees.csv');
    }

    public function import(Request $request) 
    {
        $file = $fields = $request->validate([
     
            'file'=>'required|mimes:xlsx,csv'
        ]);

        Excel::import(new EmployeeImport, request()->file('file'));
        
        return response()->json('file imported');
    }

   

  

  
}
