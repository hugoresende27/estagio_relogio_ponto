<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // $x = User::where('id',3)->first();
        // // dd($x);
        $users =  User::orderBy('created_at','DESC')->paginate(10);

        return response()->json($users, 200);

        // return User::all();
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

            'nif'=>'string',
            'iban'=>'string',
            'details'=>'string',
            'niss'=>'string',
            'emer_contact'=>'string',
            'bi_cc'=>'string',
            'role'=>'string',
            'image_path'=>'string',
            
         
            
        ]);

        $user_employee = User::create([

            'tenant_id'=>$tenantId,

            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),          
         

            //REQUEST NON REQUIRED
            'nif'=>$request['nif'],       
            'iban'=>$request['iban'],
            'details'=>$request['details'],  
            'niss'=>$request['niss'],  
            'emer_contact'=>$request['emer_contact'],
            'bi_cc'=>$request['bi_cc'],
            'role'=>'USER-EMPLOYEE',            //HARD CODED USER-EMPLOYEE ROLE
            // 'role'=>$request['role'], 
            'image_path'=>$request['image_path'],
            
            
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],
          
            
            
            
        ]);
        // dd($user_employee['id']);
           
        $image = Image::create([
            'tenant_id'=>$tenantId,
            'image_path'=>$request['image_path'],
            'user_id'=>$user_employee['id'],
        ]);

        $user_employee->image_id = $image['id'];
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
            'iban'=>'string',
            'details'=>'string',
            'niss'=>'string',
            'emer_contact'=>'string',
            'bi_cc'=>'string',
            'role'=>'string',
            'image_path'=>'string', 
        ]);

        ///////NON REQUIRED FIELDS ///////////////
        $fields['nif'] = $request['nif'];
        $fields['iban'] = $request['iban'];
        $fields['details'] = $request['details'];
        $fields['niss'] = $request['niss'];  
        $fields['emer_contact'] = $request['emer_contact'];
        $fields['bi_cc'] = $request['bi_cc'];
        $fields['role'] = $request['role'];
        $fields['image_path'] = $request['image_path'];
        
        ////REQUEST ID'S/////////////
        $fields['schedule_id'] = $request['schedule_id'];
        $fields['department_id'] = $request['department_id'];
        $fields['company_id'] = $request['company_id'];
      

        $user_employee->update($fields);

        if ($fields['image_path'] != null)
        {
            $image_update = Image::where('user_id',$id)->first();
            // dd(empty($image_update));
            if (empty($image_update)){
                $image_update = Image::create([
                    'tenant_id'=>$tenantId,
                    'image_path'=>$request['image_path'],
                    'user_id'=>$user_employee['id'],
                ]);
            } else{
                $image_update = Image::where('employee_id',$id)->update([
                    'image_path'=>$fields['image_path']
                ]);
            }
         
        }


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

    public function export_xlsx() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function export_csv() 
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    public function import(Request $request) 
    {
        $file = $fields = $request->validate([
     
            'file'=>'required|mimes:xlsx,csv'
        ]);

        Excel::import(new UsersImport, request()->file('file'));
        
        return response()->json('file imported');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function web_home()
    {
        $users = User::all();
        return view ('backend.login', compact('users'));
    }
    // public function web_login(Request $request)
    // {
    //         $fields = $request->validate([
                
    //             'email'=>'required|string',
    //             'password'=>'required|string',
    //         ]);
    
    //         $user = User::where('email', $request['email'])->first();
            
    //         if (!$user ||!Hash::check($request['password'], $user->password))
    //         {
    //             return 'not login!';
    //         }
    
            
    //         // dd(session()->tenant_id);
    //         return 'ok';
    // }

    
}
