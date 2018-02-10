<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplate extends Model
{
    //
    protected $fillable = ['name','description'];

    public function lists()
    {
        return $this->hasMany('App\ProjectTemplateTaskList', 'project_template_id');
    }
}
