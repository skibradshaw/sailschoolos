<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ResponseScheduleScope;

class ResponseSchedule extends Model
{
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ResponseScheduleScope);
    }

    //
    protected $fillable = ['user_id','response_template_detail_id','most_recent_note_id','scheduled_date','status'];
    protected $dates = ['scheduled_date','sent_date'];
    //Active ResponseSchedules are scheduled responses that have yet to be sent
    public function scopeActive($query)
    {
        return $query->whereNull('sent_date');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact', 'user_id');
    }

    public function note()
    {
        return $this->belongsTo('App\Note', 'most_recent_note_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\ResponseTemplateDetail', 'response_template_detail_id');
    }

    public function template()
    {
        return $this->detail->belongsTo('App\ResponseTemplate', 'response_template_id');
    }
}
