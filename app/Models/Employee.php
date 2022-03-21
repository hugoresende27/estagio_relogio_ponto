<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Traits\Tenantable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use ThetaLabs\DbEncryption\HasEncryptedAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    // use HasEncryptedAttributes;


    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    // protected $casts = [
       

    //     //ENCRYPTED////////////
    //     // 'name' => 'encrypted',
    //     // 'email' => 'encrypted',
    //     // 'role' => 'encrypted',
    //     // 'nif' => 'encrypted',
    //     // 'niss' => 'encrypted',
    //     // 'iban' => 'encrypted',
    //     // 'details' => 'encrypted',
    //     // 'emer_contact' => 'encrypted',
    //     // 'bi_cc' => 'encrypted',
    // ];
    // protected static $encrypted = [
    //     // 'name' => 'bi',
    //     // 'email' => 'bi',
    //     // 'role' => 'bi',
    //     // 'nif' => 'bi',
    //     // 'niss' => 'bi',
    //     // 'iban' => 'bi',
    //     // 'details' => 'bi',
    //     // 'emer_contact' => 'bi',
    //     // 'bi_cc' => 'bi',
 
    // ];

        ////////// TO ENCRYPT DATA STORE IN TABLE /////////////
        public function setNameAttribute($value)
        {
            $this->attributes['name'] = Crypt::encryptString($value);
        }
        public function setEmailAttribute($value)
        {
            $this->attributes['email'] = Crypt::encryptString($value);
        }
        public function setNifAttribute($value)
        {
            $this->attributes['nif'] = Crypt::encryptString($value);
        }
        public function setNissAttribute($value)
        {
            $this->attributes['niss'] = Crypt::encryptString($value);
        }
        public function setIbanAttribute($value)
        {
            $this->attributes['iban'] = Crypt::encryptString($value);
        }
        // public function setEmer_contactAttribute($value)
        // {
        //     $this->attributes['emer_contact'] = Crypt::encryptString($value);
        // }
        // public function setBi_ccAttribute($value)
        // {
        //     $this->attributes['bi_cc'] = Crypt::encryptString($value);
        // }


        ////////// TO DECRYPT DATA STORE IN TABLE /////////////
        public function getNameAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getEmailAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getNifAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getNissAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getIbanAttribute($value) {
            return Crypt::decryptString($value);
        }
        // public function getEmer_contactAttribute($value) {
        //     return Crypt::decryptString($value);
        // }
        // public function getBi_ccAttribute($value) {
        //     return Crypt::decryptString($value);
        // }
        
      
       
        
  


  
}
