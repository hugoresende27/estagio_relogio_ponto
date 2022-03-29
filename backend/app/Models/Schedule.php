<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    use Tenantable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

     //////////////// RELATIONS //////////////////////

     public function company()
     {
         return $this-> hasOne(Company::class, 'id', 'company_id');
     }

     public function department()
     {
         return $this-> hasOne(Department::class, 'id', 'department_id');
     }


     public function file()
     {
         return $this-> hasOne(File::class, 'id', 'file_id');
     }
}
