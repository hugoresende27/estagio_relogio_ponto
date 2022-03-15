<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //

    public function getEmpresas()
    {
        return response()->json(Empresa::all(), 200);
    }

    public function getEmpresasById($id)
    {

        $empresa = Empresa::find($id);
        if (is_null($empresa)){
            return response()->json(['message'=>'Empresa não encontrada',404] );
        }
        return response()->json($empresa = Empresa::find($id), 200);
    }

    public function addEmpresas(Request $request)
    {
        $fields = $request->validate([
            
            'nome'=>'required|string',
            'email'=>'required|string',
        ]);

       
        $empresa = Empresa::create($fields);
        
        return response($empresa, 201);
    }

    public function updateEmpresas(Request $request, $id)
    {

       
        $empresa = Empresa::find($id);
        if (is_null($empresa)){
            return response()->json(['message'=>'Empresa não encontrada',404] );
        }

        $fields = $request->validate([
            
            'nome'=>'required|string',
            'email'=>'required|string',
        ]);
        

        $empresa->update($fields);
        return response($empresa, 200);
    }

    public function deleteEmpresas(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        if (is_null($empresa)){
            return response()->json(['message'=>'Empresa não encontrada',404] );
        }
        $empresa->delete();
        return response($empresa, 200);
    }
}
