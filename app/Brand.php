<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   protected $table = "brands";
   protected $primaryKey = 'id';
   protected $fillable = [
        'brandName', 'brandDescription','event_id'
    ];

   public $timestamps = "true";
}
