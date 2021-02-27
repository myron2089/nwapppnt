<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    //
    protected $table = "event_sessions";
    protected $primaryKey = 'id';
    protected $fillable = [
        'event_id', 'user_id','event_session_location_id', 'event_session_type_id', 'eventSessionTitle', 'eventSessionDescription', 'eventSessionStart', 'eventSessionFinish'
    ];

    public $timestamps = "true";
    
}
