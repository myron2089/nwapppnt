<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSection extends Model
{
    //
     protected $table = "form_sections";
   protected $primaryKey = 'id';
   protected $fillable = [
        'section_id', 'form_id'
    ];

   public $timestamps = "true";
}
