<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            
            'name'=>'required|string',
            'email'=>'required|string',
        ]);
        
       
        $company = Company::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
        ]);
        
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
            
            'name'=>'required|string',
            'email'=>'required|string',
        ]);
        

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
}
