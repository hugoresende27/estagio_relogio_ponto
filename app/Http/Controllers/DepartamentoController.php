<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public function getDepartamentos()
    {
        return response()->json(Departamento::all(), 200);
    }

    public function getDepartamentosById($id)
    {

        $departamento = Departamento::find($id);
        if (is_null($departamento)){
            return response()->json(['message'=>'Departamento não encontrada',404] );
        }
        return response()->json($departamento = Departamento::find($id), 200);
    }

    public function addDepartamentos(Request $request)
    {

        $fields = $request->validate([
            
            'nome'=>'required|string',
            'empresa_id'=>'required',
        ]);


        $departamento = Departamento::create($fields);
        return response($departamento, 201);
    }

    public function updateDepartamentos(Request $request, $id)
    {

        $fields = $request->validate([
            
            'nome'=>'required|string',
            'empresa_id'=>'required',
        ]);

        $departamento = Departamento::find($id);
        if (is_null($departamento)){
            return response()->json(['message'=>'Departamento não encontrada',404] );
        }
        
        $departamento->update($fields);
        return response($departamento, 200);
    }

    public function deleteDepartamentos(Request $request, $id)
    {
        $departamento = Departamento::find($id);
        if (is_null($departamento)){
            return response()->json(['message'=>'Departamento não encontrada',404] );
        }
        $departamento->delete();
        return response($departamento, 200);
    }
}
