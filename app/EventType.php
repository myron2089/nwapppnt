<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{

	protected $table = "event_types";

    protected $fillable = [
        'eventTypeName', 'eventTypeDescription',
    ];

    public $timestamps = "true";
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
    //Get event types
    public function scopeGetEventTypes($query){

        $query = EventType::orderBy('eventTypeName', 'asc');


        return $query;
    }
    
}
