<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
   protected $table = "inventories";
   protected $primaryKey = 'id';
   protected $fillable = [
        'productName', 'productDescription','productQuantity', 'company_id'
    ];

   public $timestamps = "true";
}
