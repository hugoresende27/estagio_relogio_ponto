<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;
    use Tenantable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    // public function companies()
    // {
    //     return $this->belongsToMany(Company::class);
    // }

    protected $casts = [
       

        //ENCRYPTED////////////
        'name' => 'encrypted',
     
    ];

     
}




