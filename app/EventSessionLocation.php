<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSessionLocation extends Model
{
    //

    protected $table = 'event_session_locations';

    protected $fillable = [
       'eventSessionLocationName', 'event_location_id',
    ];

    protected $primaryKey = 'id';
	 
    public $timestamps = true;
}
