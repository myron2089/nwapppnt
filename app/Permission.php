<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //

    protected $table = "permissions";

    protected $fillable = [
        'permissionName', '	permissionDescription',
    ];

    public $timestamps = "true";

}
