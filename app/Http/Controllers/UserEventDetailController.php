<?php

namespace App\Http\Controllers;

use App\Event;
use App\UserEvent;
use App\UserBadge;
use App\UserUserNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEventDetailController extends Controller
{
    public function  show($id)
    {
        $user = Auth::user();

        dd($user);

        $usereventbadges = UserBadge::where('user_event_id',$id)->first();

        $event_id = UserEvent::find($id)->event_id;

        $user_event_id = UserEvent::where('user_id',$user->id)

            ->where('event_id',$event_id)

            ->first()->id;


        $userusernote = UserUserNote::where('user_event_id',$user_event_id)

            ->where('user_event_note_id',$id)

            ->first();

        if(!$userusernote)
        {
            $note = "Agregar nota";
        }
        else
        {
            $note = $userusernote->note;
        }


        if(!$usereventbadges)
        {
            return ([
                'user' => $user,
                'event_id' => $event_id
            ]);
        }

        return ([
            'usereventbadges' => $usereventbadges,
            'event_id' => $event_id,
            'note' => $note
        ]);
    }
}
