<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Employee::query();
        // $name = Employee::get('name');
        // $name_decrypt = Crypt::decrypt($name);

        // dd($name_decrypt);

        if ($s = $request->input('name')){
            // $query->where()
            // $query->whereRaw("name LIKE '%".$s."%' ");
            $query->whereRaw("name LIKE '%".$s."%' ", Crypt::encrypt($s));
                // ->orWhereRaw("role LIKE '%".$s."%' ");
        }

        return $query->get();
    }
}
