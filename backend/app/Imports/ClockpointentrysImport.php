<?php

namespace App\Imports;

use App\Models\Clockpointentry;
use Maatwebsite\Excel\Concerns\ToModel;

class ClockpointentrysImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Clockpointentry([
            'tenant_id'=>$row[1],
            'employee_id'=>$row[2],
            'clock_in'=>$row[3],
            'clock_out'=>$row[4],
            
        ]);
    }
}
