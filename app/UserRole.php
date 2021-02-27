<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //


	 protected $table = 'user_roles';

	 protected $primaryKey = 'id';
	 
	 protected $fillable = [
       'id','user_id', 'role_id'
    ];

     public $timestamps = true;
    
}
