<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventForm extends Model
{
   protected $table = "event_forms";
   
   protected $primaryKey = 'id';
   
   protected $fillable = [
        'event_id', 'form_id'
    ];

   public $timestamps = "true";
}
