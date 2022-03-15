<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    //
    public function getFuncionarios()
    {
        $empresa_user = (Auth::user()->empresa_id);
        $funcionarios = User::where('empresa_id',$empresa_user)->get();
        
        return response()->json($funcionarios, 200);
    }

    public function getFuncionariosById($id)
    {

        $empresa_user = Auth::user()->empresa_id;
        $funcionario = User::where('id', $id)->first();

        if ($empresa_user == $funcionario['empresa_id']){
            return response()->json($func = User::find($id), 200);
            
        }

        return response()->json(['message'=>'Funcionario não encontrada',404] );
    }

    public function addFuncionarios(Request $request)
    {

        $empresa_user = Auth::user()->empresa_id;

        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string',
            'role'=>'required',
            'nif'=>'required',
            'contato_eme'=>'required',
            'bi_cc'=>'required',
            
            'departamento_id'=>'required',
            
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
            'role'=>$fields['role'],
            'nif'=>$fields['nif'],
            'contato_eme'=>$fields['contato_eme'],
            'bi_cc'=>$fields['bi_cc'],
            'empresa_id'=>$empresa_user,
            'departamento_id'=>$fields['departamento_id'],
            
        ]);


        // $user = User::create($fields);
        return response($user, 201);
    }

    public function updateFuncionarios(Request $request, $id)
    {

        $empresa_user = Auth::user()->empresa_id;
        $funcionario = User::where('id', $id)->first();

        if ($empresa_user == $funcionario['empresa_id']){

            $fields = $request->validate([
                'name'=>'required|string',
                'email'=>'required|string|unique:users,email',
                'password'=>'required|string',
                'role'=>'required',
                'nif'=>'required',
                'contato_eme'=>'required',
                'bi_cc'=>'required',
                
                'departamento_id'=>'required',
                
            ]);
    
            $user = User::where('id',$id)->update([
                'name' => $fields['name'],
                'email'=>$fields['email'],
                'password'=>bcrypt($fields['password']),
                'role'=>$fields['role'],
                'nif'=>$fields['nif'],
                'contato_eme'=>$fields['contato_eme'],
                'bi_cc'=>$fields['bi_cc'],
                'empresa_id'=>$empresa_user,
                'departamento_id'=>$fields['departamento_id'],
                
            ]);
            return response()->json($func = User::find($id), 200);
            
        }
        return response()->json(['message'=>'Funcionario não encontrada',404] );
        

       
    }

    public function deleteFuncionarios(Request $request, $id)
    {
        $departamento = Departamento::find($id);
        if (is_null($departamento)){
            return response()->json(['message'=>'Departamento não encontrada',404] );
        }
        $departamento->delete();
        return response($departamento, 200);
    }
}
