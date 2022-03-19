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
            'name'=>$row[1],
            'email'=>$row[2],
            'nif'=>$row[3],
            'tenant_id'=>$row[6],
            'location_id'=>$row[8],
        ]);
    }
}
