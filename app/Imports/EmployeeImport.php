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
            'file_id'=>$row[7],
            
            'name'=>$row[8],
            'email'=>$row[9],
            'role'=>$row[10],
            'nif'=>$row[11],
            'niss'=>$row[12],
            'iban'=>$row[13],
            'details'=>$row[14],
            'emercontact'=>$row[15],
            'bicc'=>$row[16],
            'start_date'=>$row[17],


       
        ]);
    }
}
