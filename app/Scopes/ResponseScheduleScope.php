<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ResponseScheduleScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
      //Excludes all Web Inquiry Scheduled Responses
        $builder->where('response_template_detail_id', '!=', 0);
    }
}
