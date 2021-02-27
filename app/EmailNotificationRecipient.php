<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailNotificationRecipient extends Model
{
    //

    protected $table = 'email_notification_recipients';
     protected $fillable = [
       'email_notification_id', 'user_event_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     protected $primaryKey = 'id';
	 
    public $timestamps = true;
}
