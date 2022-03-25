<?php

namespace App\Http\Controllers\backoffice;


use App\Models\Company;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleBackofficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::orderBy('created_at','DESC')->paginate(10);

    
        return view('backoffice.schedules.index', compact ('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $companies ['data'] = Company::orderby("name","asc")
        // ->select('name')
        // ->get();
        
        // return view ('backoffice.schedules.create')->with("companies",$companies);

        $companies['data'] = Company::all();
        return view('backoffice.schedules.create', compact('companies'));
    }

    // Fetch records
    public function getDepartments($company_id=0)
    {

        // Fetch Departments by Company_id
        $departsData['data'] = Department::orderby("company_id","asc")
            ->select('id','company_id','name')
            ->where('company_id',$company_id)
            ->get();

            
        return response()->json($departsData);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
