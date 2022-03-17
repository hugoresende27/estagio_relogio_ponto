<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
            
            'role'=>'string',
            'nif'=>'string',
            'emer_contact'=>'string',
            'bi_cc'=>'string',
            'image_path'=>'string',
            
            
        ]);


       $tenant = Tenant::create([
            'name'=> $fields['name'].'.tenant'
        ]);
 
       
        $user = User::create([
            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
          

            //REQUEST
            'role'=>$request['role'],  
            'nif'=>$request['nif'],                    
            'emer_contact'=>$request['emer_contact'],  
            'bi_cc'=>$request['bi_cc'],                
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],

           

            'tenant_id'=>$tenant['id'],
       
            
        ]);

        
        $image = Image::create([
            'tenant_id'=>$tenant['id'],
            'image_path'=>$request['image_path'],
            'user_id'=>$user['id'],

        ]);

        
        $user->image_id = $image['id'];
        $user->save();

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
      
       // session_start();
       
        $fields = $request->validate([
            
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        $user = User::where('email', $request['email'])->first();
        
        if (!$user ||!Hash::check($request['password'], $user->password))
        {
            return response([
                'message' => 'Login not valid'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token' => $token
        ];
        
        // dd(session()->tenant_id);
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
