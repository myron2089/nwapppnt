<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
   protected $table = "invitations";
   protected $primaryKey = 'id';
   protected $fillable = [
       'subject', 'body','status', 'event_id', 'userFrom', 'recipientEmail'
    ];

   public $timestamps = "true";
}
