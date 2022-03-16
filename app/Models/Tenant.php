<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;
    use Tenantable;

    protected $guarded = ['id'];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

     
}




