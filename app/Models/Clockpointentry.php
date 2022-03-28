<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clockpointentry extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;

    use CascadeSoftDeletes;
    protected $cascadeDeletes = [ 'employee'];

    
    protected $dates = ['deleted_at'];
 

    // public $timestamps = false;

    protected $guarded = ['id'];

 



     //////////////// RELATIONS //////////////////////

   public function employee()
   {
       return $this-> hasOne(Employee::class, 'id', 'employee_id');
   }

   public function file()
   {
       return $this-> hasOne(File::class, 'id', 'file_id');
   }


}
