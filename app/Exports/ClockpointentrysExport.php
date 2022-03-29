<?php

namespace App\Exports;

use App\Models\Clockpointentry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClockpointentrysExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Clockpointentry::all();
    }
}
