<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSectionField extends Model
{
    //

     protected $table = "form_section_fields";
   protected $primaryKey = 'id';
   protected $fillable = [
        'form_section_id', 'field_id'
    ];

   public $timestamps = "true";
}
