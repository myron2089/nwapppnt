<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventForm extends Model
{
    //

   protected $table = "user_event_forms";
   protected $primaryKey = 'id';
   protected $fillable = [
        'form_id', 'user_event'
    ];

   public $timestamps = "true";
}
