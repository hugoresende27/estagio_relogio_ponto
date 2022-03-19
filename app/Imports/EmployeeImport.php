<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            
            'tenant_id'=>$row[1],
            'company_id'=>$row[2],
            'department_id'=>$row[3],
            'schedule_id'=>$row[4],
            'location_id'=>$row[5],
            'image_id'=>$row[6],
            
            'name'=>$row[7],
            'email'=>$row[8],
            'role'=>$row[9],
            'nif'=>$row[10],
            'niss'=>$row[11],
            'iban'=>$row[12],
            'details'=>$row[13],
            'emer_contact'=>$row[14],
            'bi_cc'=>$row[15],
            'start_date'=>$row[16],
            
            // 'company_id'=>$row[14],
            // 

       
        ]);
    }
}
