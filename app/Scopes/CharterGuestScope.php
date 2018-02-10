<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CharterGuestScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('types', function ($q) {
            $q->where('name', '=', 'Charter Guest');
        });
    }

    public function remove(Builder $builder, Model $model)
    {
    }
}
