<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
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

            'tenant_id'=>$request['tenant_id'],
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            
            
        ]);


        return response($response, 201);
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
