<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Employee;
use App\Models\Traits\Tenantable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function tenant()
    {
        return $this->belongsToMany(Tenant::class);
    }



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


   //////////////// RELATIONS //////////////////////

   public function location()
   {
       return $this-> hasOne(Location::class, 'id', 'location_id');
   }

   public function file()
   {
       return $this-> hasOne(File::class, 'id', 'file_id');
   }
   
}
