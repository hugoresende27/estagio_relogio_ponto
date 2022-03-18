<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use Tenantable;

    protected $guarded = ['id'];

    protected $casts = [
       

        //ENCRYPTED////////////
        'name' => 'encrypted',
        'email' => 'encrypted',
        'role' => 'encrypted',
        'nif' => 'encrypted',
        'niss' => 'encrypted',
        'iban' => 'encrypted',
        'details' => 'encrypted',
        'emer_contact' => 'encrypted',
        'bi_cc' => 'encrypted',
     
      
       
        
    ];
}
