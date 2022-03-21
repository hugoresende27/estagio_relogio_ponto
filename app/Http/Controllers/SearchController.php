<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $s = $request->input('s');

        $res = Employee::whereEncrypted('name', $s)->get();
        // dd($s);
        return response()->json($res,200);
    }
}
