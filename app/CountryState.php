<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    //
   protected $table = "country_states";
   protected $primaryKey = 'id';
   protected $fillable = [
        'countryStateName'
    ];

   public $timestamps = "true";
}
