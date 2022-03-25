<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;

use App\Models\Company;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $users =  User::orderBy('created_at','DESC')->paginate(10);

        return response()->json($users, 200);

       
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
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',

       
            'image'=>'mimes:png,jpg,jpeg',
            
         
            
        ]);

        $user_employee = User::create([

            'tenant_id'=>$tenantId,

            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),          
         

            //REQUEST NON REQUIRED
            'nif'=>$request['nif'],       
          
            
            'emer_contact'=>$request['emer_contact'],
            'bi_cc'=>$request['bi_cc'],
            'role'=>'USER-TENANT-'.$tenantId,            //HARD CODED USER-EMPLOYEE ROLE
            'image'=>$request['image'],
            
            
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],
          
            
            
            
        ]);
        ///////////// IMAGE CREATE //////////////////
        if (isset($fields['image'] ))
        {
            $image_name = $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->store('public/images');

            $user_image = Image::create([
                'tenant_id'=>$tenantId,
                'name'=>$image_name,
                'image_path'=>$image_path,
                'size'=>$request->file('image')->getSize(),
                'user_id'=>$user_employee['id'],
            ]);

            $user_employee->image_id = $user_image['id'];
        };


        $user_employee->save();

        
        $token = $user_employee->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user_employee,
            'token' => $token
        ];


        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        if (is_null($users)){
            return response()->json(['message'=>'User not found',404] );
        }
        return response()->json($users = User::find($id), 200);
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

        $user_employee = User::find($id);
        if (is_null($user_employee)){
            return response()->json(['message'=>'Employee-User not found',404] );
        }
        // dd($employee);
        $fields = $request->validate([
            
            'name'=>'required|string',
            'email'=>'string',
            'password'=>'required|string|confirmed',
            'nif'=>'string',     
            'emer_contact'=>'string',
            'bi_cc'=>'string',
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        ///////NON REQUIRED FIELDS ///////////////
        $fields['nif'] = $request['nif'];
        $fields['emer_contact'] = $request['emer_contact'];
        $fields['bi_cc'] = $request['bi_cc'];
        $fields['image'] = $request['image'];
        
        ////REQUEST ID'S/////////////
        $fields['schedule_id'] = $request['schedule_id'];
        $fields['department_id'] = $request['department_id'];
        $fields['company_id'] = $request['company_id'];
      

        

        if (isset($fields['image'] ))
        {
            $image = Image::where('user_id',$id)->first();
            
            if (empty($image)){
               ///////////// IMAGE CREATE //////////////////
                $image_name = $request->file('image')->getClientOriginalName();
                $image_path = $request->file('image')->store('public/images');

                $employee_image = Image::create([
                    'tenant_id'=>$tenantId,
                    'name'=>$image_name,
                    'image_path'=>$image_path,
                    'size'=>$request->file('image')->getSize(),
                    'user_id'=>$user_employee['id'],
                ]);
            } else{
                $image->delete();
                ///////////// IMAGE CREATE //////////////////
                $image_name = $request->file('image')->getClientOriginalName();
                $image_path = $request->file('image')->store('public/images');

                $employee_image = Image::create([
                    'tenant_id'=>$tenantId,
                    'name'=>$image_name,
                    'image_path'=>$image_path,
                    'size'=>$request->file('image')->getSize(),
                    'user_id'=>$user_employee['id'],
                ]);
               
            }

            $user_employee->image_id = $employee_image['id'];
         
        }

        $user_employee->update($fields);


        return response()->json($user_employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)){
            return response()->json(['message'=>'User not found',404] );
        }
        // dd(Auth::user()->id);
        if (Auth::user()->id != $id){
            $user->delete();
            return response($user, 200);
        }
        else {
            return response()->json(['message'=>'Cannot delete yourself',666] );
        }
        
    }

    

    
    
}
