<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SellerScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('types', function ($q) {
            $q->where('name', '=', 'Seller');
        });
    }

    public function remove(Builder $builder, Model $model)
    {
    }
}
