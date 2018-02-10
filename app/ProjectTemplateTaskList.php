<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplateTaskList extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($taskList) {
             $taskList->tasks()->delete();
        });
    }
    //
    protected $fillable = ['name'];
    public function tasks()
    {
        return $this->hasMany('App\ProjectTemplateTask')->orderBy('position');
    }
}
