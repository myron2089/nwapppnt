<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
   protected $table = "companies";
   protected $primaryKey = 'id';
   protected $fillable = [
        'event_id', 'companyName','companyDescription', 'companyAddress', 'companyPhone', 'companyPicture'. 'companyPicturePath', 'companyCountryCode', 'companyWebSite', 'companyEmail'
    ];

   public $timestamps = "true";
}
