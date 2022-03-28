<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SearchController extends Controller
{





    public function search(Request $request){

       
        $searchValue = $request->input('search');
     
        
        $search_employees_table = Employee::all()->filter(function(Employee $employee) use($searchValue) {
         
         if(str_contains( $employee->name, $searchValue)) {          
            return $employee;        
         }
         if(str_contains($employee->nif , $searchValue)) {          
            return $employee;     
         }
         if(str_contains($employee->niss , $searchValue)) {          
            return $employee;     
         }
         if(str_contains($employee->location->country , $searchValue)) {          
            return $employee;     
         }
         if(str_contains($employee->company->name , $searchValue)) {          
            return $employee;     
         }
        
   
       });

        $search_companies_table = Company::all()->filter(function(Company $company) use($searchValue) {
         
         if(str_contains( $company->name, $searchValue)) {          
            return $company;        
         }
         if(str_contains($company->nif , $searchValue)) {          
            return $company;     
         }
         if(str_contains($company->location->country , $searchValue)) {          
            return $company;     
         }
        
   
       });

        $search_locations_table = Location::all()->filter(function(Location $location) use($searchValue) {
         
         if(str_contains( $location->country, $searchValue)) {          
            return $location;        
         }
         if(str_contains( $location->city, $searchValue)) {          
            return $location;        
         }
         if(str_contains($location->street , $searchValue)) {          
            return $location;     
         }
         if(str_contains($location->zip_code, $searchValue)) {          
            return $location;     
         }
        
   
       });


       $results = collect([$search_employees_table, $search_companies_table, $search_locations_table ]);
       return response()->json($results, 200);
      
    }

    
   
    

 


}
