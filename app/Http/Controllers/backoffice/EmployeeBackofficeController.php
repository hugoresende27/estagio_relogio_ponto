<?php

namespace App\Http\Controllers\backoffice;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeBackofficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at','DESC')->paginate(10);

    
        return view('backoffice.employees.index', compact ('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = Company::all();
      
        return view ('backoffice.employees.create', compact ('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $tenantId = Auth::user()->tenant_id;

        // $fields = $request->validate([
        //     'name'=>'required|string',
        //     'email'=>'required|string|',
            
        //     'nif'=>'required|string',
        //     'niss'=>'required|string',
        //     'emercontact'=>'required|string',
        //     'bicc'=>'required|string',
        //     'company_id'=>'required',     
        //     'start_date'=>'required',  

        //     // 'image'=>'mimes:png,jpg,jpeg',
        //     // 'role'=>'string',

        //     //////////LOCATION TABLE->ADRESS OF EMPLOYEE/////////////
        //     // 'country'=>'required|string',
        //     // 'city'=>'required|string',
        //     // 'street'=>'required|string',
        //     // 'door_number'=>'required|string',
        //     // 'zip_code'=>'required|string',
                       
        // ]);

        // $employee = Employee::create([

        //     'tenant_id'=>$tenantId,

        //     'name' => $fields['name'],
        //     'email'=>$fields['email'],
            
                     
        //     'nif'=>$fields['nif'],
        //     'niss'=>$fields['niss'],
        //     'emercontact'=>$fields['emercontact'],
        //     'bicc'=>$fields['bicc'],
        //     'start_date'=>$fields['start_date'],
        //     'company_id'=>$fields['company_id'],

        //     //REQUEST NON REQUIRED
            
        //     // 'iban'=>$request['iban'],
        //     // 'details'=>$request['details'],
        //     // 'department_id'=>$request['department_id'],
        //     // 'schedule_id'=>$request['schedule_id'],
        //     // 'file_id'=>$request['file_id'],
            
        //     // 'role'=>$request['role'],  
        //     'role'=>'EMPLOYEE',                 //HARD CODED ROLE EMPLOYEE  
            
        // ]);

        // $employee->location_id = 1;
        // $employee->save();

        // return view ('backoffice.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
