<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ThetaLabs\DbEncryption\HasEncryptedAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    use HasEncryptedAttributes;


    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $casts = [
       

        //ENCRYPTED////////////
        // 'name' => 'encrypted',
        // 'email' => 'encrypted',
        // 'role' => 'encrypted',
        // 'nif' => 'encrypted',
        // 'niss' => 'encrypted',
        // 'iban' => 'encrypted',
        // 'details' => 'encrypted',
        // 'emer_contact' => 'encrypted',
        // 'bi_cc' => 'encrypted',
    ];
    protected static $encrypted = [
        'name' => 'bi',
        // 'email' => 'bi',
        // 'role' => 'bi',
        // 'nif' => 'bi',
        // 'niss' => 'bi',
        // 'iban' => 'bi',
        // 'details' => 'bi',
        // 'emer_contact' => 'bi',
        // 'bi_cc' => 'bi',
 
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
