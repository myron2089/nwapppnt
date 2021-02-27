<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventWebResource extends Model
{
    //
    protected $table = 'event_web_resources';

    protected $fillable = [
       'event_id', 'eventWebResourceName', 'eventWebResourceValue', 'eventWebResourcePosition', 'eventWebResourceTag', 'eventWebResourcePath', 'eventWebResourceOrder'
    ];

    protected $primaryKey = 'id';
	 
    public $timestamps = true;
}
