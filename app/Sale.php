<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
   protected $table = "sales";
   protected $primaryKey = 'id';
   protected $fillable = [
        'product_id', 'fieldRequired','saleDescription'
    ];

   public $timestamps = "true";
}
