<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplate extends Model
{
    //
    protected $fillable = ['name','description'];

    public function tasklists()
    {
        return $this->hasMany(\App\ProjectTemplateTaskList::class, 'project_template_id');
    }
}
