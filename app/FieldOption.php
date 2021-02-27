<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldOption extends Model
{
    //

protected $table = "field_options";
   protected $primaryKey = 'id';
   protected $fillable = [
        'optionValue', 'optionName','field_id'
    ];

   public $timestamps = "true";
}
