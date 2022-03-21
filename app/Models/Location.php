<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Support\Facades\Crypt;
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

////////// TO ENCRYPT DATA STORE IN TABLE /////////////
public function setCountryAttribute($value)
{
    $this->attributes['country'] = Crypt::encryptString($value);
}
public function setCityAttribute($value)
{
    $this->attributes['city'] = Crypt::encryptString($value);
}
public function setStreetAttribute($value)
{
    $this->attributes['street'] = Crypt::encryptString($value);
}
public function setDoorNumberAttribute($value)
{
    $this->attributes['door_number'] = Crypt::encryptString($value);
}
public function setZipCodeAttribute($value)
{
    $this->attributes['zip_code'] = Crypt::encryptString($value);
}

 ////////// TO DECRYPT DATA STORE IN TABLE /////////////
 public function getCountryAttribute($value) {
   return Crypt::decryptString($value);
   }
 public function getCityAttribute($value) {
   return Crypt::decryptString($value);
   }
 public function getStreetAttribute($value) {
   return Crypt::decryptString($value);
   }
 public function getDoorNumberAttribute($value) {
   return Crypt::decryptString($value);
   }
 public function getZipCodeAttribute($value) {
   return Crypt::decryptString($value);
   }
}
