<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplateTask extends Model
{
    //
    protected $fillable = ['name','position'];
    
    public function tasklist()
    {
    	return $this->belongsTo('App\ProjectTemplateTaskList');
    }
}
