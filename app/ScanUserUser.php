<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScanUserUser extends Model
{
    //
   	protected $table = "scan_user_users";

   	protected $primaryKey = 'id';

    protected $fillable = [
       'scanUserSource', 'scanUserDestination'
    ];

    public $timestamps = "true";
}
