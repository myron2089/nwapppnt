<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventSessionFavorite extends Model
{
    //

	protected $table = 'user_event_session_favorites';

	protected $primaryKey = 'id';

    protected $fillable = [
       'user_event_id', 'event_session_id'
    ];





}
