<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    //
	protected $table = 'event_locations';

    protected $fillable = [
       'eventLocationName', 'eventLocationPicture', 'eventLocationPicturePath', 'eventLocationAddress'
    ];

    protected $primaryKey = 'id';
	 
    public $timestamps = true;
}
