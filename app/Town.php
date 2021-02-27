<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
   protected $table = "towns";
   protected $primaryKey = 'id';
   protected $fillable = [
        'townName', 'country_state_id'
    ];

   public $timestamps = "true";
}
