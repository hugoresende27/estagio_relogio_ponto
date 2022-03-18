<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clockpointentry extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $timestamps = false;

    protected $guarded = ['id'];
}
