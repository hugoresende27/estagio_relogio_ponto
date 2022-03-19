<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([

            'tenant_id'=>$row[1],
            'company_id'=>$row[2],
            'department_id'=>$row[3],
            'schedule_id'=>$row[4],
      
            'image_id'=>$row[5],
            
            'name'=>$row[6],
            'email'=>$row[7],
            'role'=>$row[8],
            'nif'=>$row[9],
      
            'emer_contact'=>$row[10],
            'bi_cc'=>$row[11],

            'password'=>$row[13]
                     
        ]);
    }
}
