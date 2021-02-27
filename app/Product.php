<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

   protected $table = "products";
   protected $primaryKey = 'id';
   protected $fillable = [
        'productName', 'productDescription','productPicture', 'productPicturePath', 'productPrice', 'event_id', 'user_id', 'payment_currency_id'
    ];

   public $timestamps = "true";
}
