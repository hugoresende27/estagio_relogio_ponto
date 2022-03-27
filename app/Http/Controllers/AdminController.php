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

        $inputData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            // 'password'=>'required|string|confirmed',

       
            'image'=>'mimes:png,jpg,jpeg',
      
        ]);

        // $inputData = $request->all();
        $inputData['password'] = bcrypt($request->password);
        $user_employee = User::create($inputData);

        // $user_employee = User::create([

        //     'tenant_id'=>$tenantId,

        //     'name' => $fields['name'],
        //     'email'=>$fields['email'],
        //     'password'=>$password,          
        //     // 'password'=>($fields['password']),          
        //     'email_verified_at'=>now(),

        //     //REQUEST NON REQUIRED
        //     'nif'=>$request['nif'],       
          
            
        //     'emer_contact'=>$request['emer_contact'],
        //     'bi_cc'=>$request['bi_cc'],
        //     'role'=>'USER-TENANT-'.$tenantId,            //HARD CODED USER-EMPLOYEE ROLE
        //     'image'=>$request['image'],
 
        // ]);

        $user_employee->role = 'USER-TENANT-'.$tenantId;            //HARD CODED USER-EMPLOYEE ROLE
        $user_employee->tenant_id = $tenantId;

        if ($request['company_id']!=0)
        {
            $inputData['company_id'] = $request['company_id'];
        }
        if ($request['department_id']!=0)
        {
            $inputData['department_id'] = $request['department_id'];
        }

        //////////TODO///////////////////
        // if ($request['schedule_id']!=0)
        // {
        //     $fields['schedule_id'] = $request['schedule_id'];
        // }

        $user_employee->update($inputData);
        ///////////// IMAGE CREATE //////////////////
        if (isset($inputData['image'] ))
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
       
        $fields = $request->validate([
            
            'name'=>'required|string',
            'email'=>'string',
            // 'password'=>'required|string|confirmed',
            // 'nif'=>'string',     
            // 'emer_contact'=>'string',
            // 'bi_cc'=>'string',
            'image'=>'mimes:png,jpg,jpeg',
        ]);

        ///////NON REQUIRED FIELDS ///////////////
        $fields['nif'] = $request['nif'];
        $fields['emer_contact'] = $request['emer_contact'];
        $fields['bi_cc'] = $request['bi_cc'];
        $fields['image'] = $request['image'];
        
        ////REQUEST ID'S/////////////
  
        if ($request['company_id']!=0)
        {
            $fields['company_id'] = $request['company_id'];
        }
        if ($request['department_id']!=0)
        {
            $fields['department_id'] = $request['department_id'];
        }
        //////////TODO///////////////////
        // if ($request['schedule_id']!=0)
        // {
        //     $fields['schedule_id'] = $request['schedule_id'];
        // }
      

        

        if (isset($fields['image'] ))
        {
            $image = Image::where('user_id',$id)->first();
            
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
                'user_id'=>$user_employee['id'],
            ]);

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
            return response()->json(['message'=>'Cannot delete yourself',405] );
        }
        
    }

    

    
    
}
