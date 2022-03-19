<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $casts = [
       

        //ENCRYPTED////////////
        'country' => 'encrypted',
        'city' => 'encrypted',
        'street' => 'encrypted',
        'door_number' => 'encrypted',
        'zip_code' => 'encrypted',
 
    ];
}
