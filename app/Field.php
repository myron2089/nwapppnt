<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //

   protected $table = "fields";
   protected $primaryKey = 'id';
   protected $fillable = [
        'fieldText', 'fieldRequired','fieldMaxLenght', 'fieldPlaceHolder', 'data_type_control_id'
    ];

   public $timestamps = "true";
}
