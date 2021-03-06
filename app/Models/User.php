<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Tenant;
use App\Models\Company;
use App\Scopes\TenantScope;
use App\Models\Traits\Tenantable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Tenantable;

    
    use SoftDeletes;

    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['image'];

    
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

     
        //ENCRYPTED////////////
        'name' => 'encrypted',
        // 'password'=>'encrypted',
        'role' => 'encrypted',
        'nif' => 'encrypted',
       
        'iban' => 'encrypted',
        'details' => 'encrypted',
        'emer_contact' => 'encrypted',
        'bi_cc' => 'encrypted',
  
    ];

  

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


   public function image()
   {
       return $this-> hasOne(Image::class, 'id', 'image_id');
   }

 


    
}
