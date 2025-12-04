<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (app()->bound('tenant_id')) {
            $tenantId = app()->make('tenant_id');

            if ($tenantId) {
                $builder->where($model->getTable() . '.organization_id', $tenantId);
            }
        }
    }
}