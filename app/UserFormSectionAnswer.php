<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormSectionAnswer extends Model
{
    //
   protected $table = "user_form_section_answers";
   protected $primaryKey = 'id';
   protected $fillable = [
        'for_id','user_id'
    ];

   public $timestamps = "true";
}
