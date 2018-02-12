<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTemplateDetail extends Model
{
    //
    protected $fillable = ['number_of_days','template'];
    
    public function setTemplateAttribute($value)
    {
            $this->attributes['template'] = $value;
        switch ($value) {
            case 'Web Inquiry - 3 Day Reminder':
                $this->attributes['template_file_name'] = '3_day_reminder';
                break;
            case 'Web Inquiry - 7 Day Reminder':
                $this->attributes['template_file_name'] = '7_day_reminder';
                break;
            case 'Web Inquiry - 14 Day Reminder':
                $this->attributes['template_file_name'] = '14_day_reminder';
                break;
            case 'Web Inquiry - 30 Day Reminder':
                $this->attributes['template_file_name'] = '30_day_reminder';
                break;
        }
    }

    //Relationships
    public function template()
    {
        return $this->belongsTo(\App\ResponseTemplate::class, 'response_template_id');
    }

    public function schedules()
    {
        return $this->hasMany(\App\ResponseSchedule::class, 'response_template_detail_id');
    }
}
