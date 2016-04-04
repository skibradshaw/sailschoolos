<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudentScope implements ScopeInterface
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('types', function ($q) {
            $q->where('name', '=', 'Student');
        });
        
    }

    public function remove(Builder $builder, Model $model)
    {
    }
}
