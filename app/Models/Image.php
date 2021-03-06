<?php

namespace App\Models;

use App\Models\User;
use App\Models\Employee;
use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    use Tenantable;
    use SoftDeletes;
  

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $casts = [
        'email_verified_at' => 'datetime',

     //ENCRYPTED////////////
    //  'image_path' => 'encrypted',
    
    ];
    /**
     * Get the user associated with the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()//: HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the employee associated with the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee()//: HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
