<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEvent extends Model
{
    //
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
     protected $table = 'user_events';
     protected $primaryKey = 'id';

     protected $fillable = [
       'id', 'event_id', 'user_id','user_type_id', 'role_id', 'registered_from_id', 'user_owner_id', 'company_id'
    ];

     public $timestamps = true;
    
}
