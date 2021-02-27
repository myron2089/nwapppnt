<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    //
	 protected $table = 'email_notifications';
     protected $fillable = [
       'emailNotificationFrom', 'emailNotificationTitle', 'emailNotificationBody', 'isSent',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     protected $primaryKey = 'id';
	 
    public $timestamps = true;
  
}
