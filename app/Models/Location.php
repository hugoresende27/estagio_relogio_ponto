<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use Tenantable;

    protected $guarded = ['id'];

    protected $casts = [
       

        //ENCRYPTED////////////
        'country' => 'encrypted',
        'city' => 'encrypted',
        'street' => 'encrypted',
        'zip_code' => 'encrypted',
 
    ];
}
