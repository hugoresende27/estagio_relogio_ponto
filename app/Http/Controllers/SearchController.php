<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SearchController extends Controller
{


    public function searcht (Request $request)
    {
        $haystack = Employee::all();
        $needle   = $request->s;

        $pos      = strripos($haystack, $needle);

        if ($pos === false) {
            echo "Not found";
        } else {
         
            echo "Nós encontramos a última ($needle)  na posição ($pos)";
        }
        return response()->json($needle, 200);
    }
    
    public function search(Request $request)
    {
        

        $search_employees_table = Employee::all()->filter(function($record) 
        
        use($request) 
        {
            // dd($request->s);

            if (str_contains($record->name, ($request->s))){
                return $record;
           
            }
            if (str_contains($record->email, ($request->s))){
                return $record;
            }
            if (str_contains($record->details, ($request->s))){
                return $record;
            }
            if (str_contains($record->nif, ($request->s))){
                return $record;
            }
            if (str_contains($record->niss, ($request->s))){
                return $record;
            }
            if (str_contains($record->bicc, ($request->s))){
                return $record;
            }
            if (str_contains($record->emercontact, ($request->s))){
                return $record;
            }

        });

        $search_companies_table = Company::all()->filter(function($record) 
        
        use($request) 
        {
            // dd($request->s);

            if (str_contains($record->name, ($request->s))){
                return $record;
            }
            if (str_contains($record->email, ($request->s))){
                return $record;
            }
            if (str_contains($record->nif, ($request->s))){
                return $record;
            }
            

        });

        $search_locations_table = Location::all()->filter(function($record) 
        
        use($request) 
        {
            // dd($request->s);

            if (str_contains($record->country, ($request->s))){
                return $record;
            }
            if (str_contains($record->city, ($request->s))){
                return $record;
            }
            if (str_contains($record->street, ($request->s))){
                return $record;
            }
            if (str_contains($record->door_number, ($request->s))){
                return $record;
            }
            if (str_contains($record->zip_code, ($request->s))){
                return $record;
            }
            

        });


        $record = collect([$search_employees_table, $search_companies_table, $search_locations_table]);
        return response()->json($record, 200);
    }

 


}
