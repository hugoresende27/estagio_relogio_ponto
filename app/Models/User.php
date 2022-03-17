<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Company;
use App\Scopes\TenantScope;
use App\Models\Traits\Tenantable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Tenantable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'tenant_id'
    // ];

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
    ];

  

    public function companies() 
    {
		return $this->belongsToMany(Company::class, );
	}

    
    //função para usar para ir buscar departamentos, empresas, etc
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

  
    public function image()
    {
        return $this->hasOne(Image::class);
    }


    
}
