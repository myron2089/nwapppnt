<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    //

    protected $table = "user_event_badges";
   protected $primaryKey = 'id';
   protected $fillable = [
        'user_event_id', 'userFirstName','userLastName', 'userTitle', 'userEmail', 'userCompanyName', 'userAddress', 'userPhoneNumber', 'userFacebook', 'userTwitter', 'userPicture', 'userPicturePath', 'userPosition', 'userOccupation'
    ];

   public $timestamps = "true";
}
