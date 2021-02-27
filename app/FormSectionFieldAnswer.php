<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSectionFieldAnswer extends Model
{
    //
   protected $table = "form_section_field_answers";
   protected $primaryKey = 'id';
   protected $fillable = [
        'form_section_field_id', 'answerValue'
    ];

   public $timestamps = "true";
}
