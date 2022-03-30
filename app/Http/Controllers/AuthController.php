<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Tenant;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
            
            // 'role'=>'string',
            // 'nif'=>'string',
            // 'emer_contact'=>'string',
            // 'bi_cc'=>'string',

            'image'=>'mimes:png,jpg,jpeg',
            
            
        ]);

     
        $tenant = Tenant::create([
            'name'=> $fields['name'].'.tenant'
        ]);
        // $tenantId = $tenant['id'];
     
        $user = User::create([
            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
            // 'password'=>($fields['password']),
            'email_verified_at'=>now(),

            //REQUEST NON REQUIRED
            // 'role'=>$request['role'],  
            'role'=>'TENANT-ADMIN',         //HARD CODED TENANT ADMIN  
            'nif'=>$request['nif'],                    
            'emer_contact'=>$request['emer_contact'],  
            'bi_cc'=>$request['bi_cc'],                
            'company_id'=>$request['company_id'],
            'department_id'=>$request['department_id'],
            'schedule_id'=>$request['schedule_id'],
            'tenant_id'=>$tenant['id'],
       
            
        ]);
        
        
         ///////////// IMAGE CREATE //////////////////
         if (isset($fields['image'] ))
         {
             $image_name = $request->file('image')->getClientOriginalName();
             $image_path = $request->file('image')->store('public/images');
 
             $user_image = Image::create([
                 'tenant_id'=>$tenant['id'],
                 'name'=>$image_name,
                 'image_path'=>$image_path,
                 'size'=>$request->file('image')->getSize(),
                 'user_id'=>$user['id'],
             ]);
 
             $user->image_id = $user_image['id'];
         };

        
     
        $user->save();

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
      
       
        $fields = $request->validate([
            
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        $user = User::where('email', $request['email'])->first();
        
        if (!$user ||!Hash::check($request['password'], $user->password))
        {
            // dd(get_defined_vars());
            return response([
                'message' => 'Login not valid'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token' => $token
        ];
        
        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        
        return [
            'message' => 'Logged out'
        ];
    }


   ////////////teste frontend///////////
   public function me(Request $request)
   {
       return response()->json([
           'data'=>$request->user
       ]);
   }
 
}
