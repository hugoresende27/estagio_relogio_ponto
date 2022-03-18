<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Tenantable;

    protected $guarded = ['id'];

    public function tenant()
    {
        return $this->belongsToMany(Tenant::class);
    }

    protected $casts = [
       

        //ENCRYPTED////////////
        'name' => 'encrypted',
        'email' => 'encrypted',
 
    ];
}
