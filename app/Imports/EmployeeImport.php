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
            
            'name'=>$row[1],
            'email'=>$row[2],
            'role'=>$row[5],
            'nif'=>$row[6],
            'niss'=>$row[7],
            'iban'=>$row[8],
            'details'=>$row[9],
            'emer_contact'=>$row[10],
            'bi_cc'=>$row[11],
            'start_date'=>$row[12],
            'tenant_id'=>$row[13],
            'company_id'=>$row[14],
            'department_id'=>$row[15],
            // 'schedule_id'=>$row[18],
            // 'image_id'=>$row[19],
            // 'location_id'=>$row[17],

            // 'name'=>$row['name'] ?? $row['client'] ?? $row['name'] ,
            // 'email'=>$row['email'],
            // 'role'=>$row['role'],
            // 'nif'=>$row['nif'],
            // 'niss'=>$row['niss'],
            // 'iban'=>$row['iban'],
            // 'details'=>$row['details'],
            // 'emer_contact'=>$row['emer_contact'],
            // 'bi_cc'=>$row['bi_cc'],
            // 'start_date'=>$row['start_date'],
            // 'tenant_id'=>$row['tenant_id'],
            // 'company_id'=>$row['company_id'],
            // 'department_id'=>$row['department_id'],
            // 'schedule_id'=>$row['schedule_id'],
            // 'image_id'=>$row['image_id'],
        ]);
    }
}
