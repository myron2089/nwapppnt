<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyForm extends Model
{
    //
   protected $table = "company_forms";
   protected $primaryKey = 'id';
   protected $fillable = [
        'company_id', 'form_id'
    ];

   public $timestamps = "true";
}
