<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    /**
     * Get the schedule associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function schedule()//: HasOne
    // {
    //     return $this->hasOne(Schedule::class);
    // }

  
}
