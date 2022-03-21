<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // return Employee::all();
        $items = Employee::all()->filter(function($record) 
        use($request) 
        {
            // dd($request->s);

            if (str_contains($record->name, ($request->s))){
                return $record;
            }
            if (str_contains($record->email, ($request->s))){
                return $record;
            }

        });


       
        return $items;
    }
}
