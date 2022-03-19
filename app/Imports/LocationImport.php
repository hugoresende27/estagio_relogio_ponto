<?php

namespace App\Imports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\ToModel;

class LocationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Location([
            'tenant_id'=>$row[1],
            'country'=>$row[2],
            'city'=>$row[3],
            'street'=>$row[4],
            'door_number'=>$row[5],
            'zip_code'=>$row[6],
        ]);
    }
}
