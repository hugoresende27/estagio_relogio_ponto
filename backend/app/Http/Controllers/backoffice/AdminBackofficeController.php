<?php

namespace App\Http\Controllers\backoffice;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBackofficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at','DESC')->paginate(10);
  
        return view('backoffice.admin.index', compact ('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies['data'] = Company::all();
      
        return view ('backoffice.admin.create', compact ('companies'));
    }

     // Fetch records////////////POPULATE SELECT WITH DEPARTMENTS RELATED TO COMPANY
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

        $user = User::find($id);
        $companies['data'] = Company::all();
        return view ('backoffice.admin.edit', compact('user','companies'));
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
