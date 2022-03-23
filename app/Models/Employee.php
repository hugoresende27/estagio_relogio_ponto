<?php

namespace App\Models;


use App\Models\Traits\Tenantable;
use Illuminate\Support\Facades\Crypt;
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
        public function setEmercontactAttribute($value)
        {
            $this->attributes['emercontact'] = Crypt::encryptString($value);
        }
        public function setBiccAttribute($value)
        {
            $this->attributes['bicc'] = Crypt::encryptString($value);
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
        public function getNissAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getIbanAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getEmercontactAttribute($value) {
            return Crypt::decryptString($value);
        }
        public function getBiccAttribute($value) {
            return Crypt::decryptString($value);
        }
        
      

    //////////////// RELATIONS //////////////////////

       public function company()
       {
           return $this-> hasOne(Company::class, 'id', 'company_id');
       }

       public function department()
       {
           return $this-> hasOne(Department::class, 'id', 'department_id');
       }

       public function schedule()
       {
           return $this-> hasOne(Schedule::class, 'id', 'schedule_id');
       }

       
       public function location()
       {
           return $this-> hasOne(Location::class, 'id', 'location_id');
       }

       public function image()
       {
           return $this-> hasOne(Image::class, 'id', 'image_id');
       }

       public function file()
       {
           return $this-> hasOne(File::class, 'id', 'file_id');
       }
       
        
  


  
}
