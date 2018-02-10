<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ResponseScheduleScope implements ScopeInterface
{

    public function apply(Builder $builder, Model $model)
    {
      //Excludes all Web Inquiry Scheduled Responses
        $builder->where('response_template_detail_id', '!=', 0);
    }

    public function remove(Builder $builder, Model $model)
    {
    }
}
