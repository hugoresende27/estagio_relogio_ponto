<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;

class CompanyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Company([
            'tenant_id'=>$row[1],
            'location_id'=>$row[2],
            'name'=>$row[3],
            'email'=>$row[4],
            'nif'=>$row[5],
        ]);
    }
}
