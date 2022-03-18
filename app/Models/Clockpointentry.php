<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clockpointentry extends Model
{
    use HasFactory;
    use Tenantable;

    public $timestamps = false;

    protected $guarded = ['id'];
}
