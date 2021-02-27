<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventBadge extends Model
{
    protected $fillable = [
        'id',
        'user_event_id',
        'userFirstName',
        'userLastName',
        'userEmail',
        'userFacebook',
        'userTwitter',
        'userPicture',
        'userPicturePath',
        'userPosition',
        'userOccupation',
        'userTitle',
        'userCompanyName',
        'userAddress',
        'userPhoneNumber'
    ];
}
