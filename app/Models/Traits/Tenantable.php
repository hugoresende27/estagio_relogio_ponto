<?php

namespace App\Models\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;
use Illuminate\Support\Facades\Auth;



trait Tenantable 
{
    protected static function bootTenantable()
    {

        if (@Auth::user()->tenant_id) {
            static::addGlobalScope(new TenantScope);
   
        }
        // static::addGlobalScope(new TenantScope);
        
        if (session()->has('tenant_id') && !is_null(session()->get('tenant_id')))
        {
            //cada vez q vai adicionar um user vai chamar esta função e adicionar o tenant_id auto
            static::creating (function($model){
                $model->tenant_id = session()->get('tenant_id');
            });
        }
    }

    //função para usar para ir buscar departamentos, empresas, etc
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

}
