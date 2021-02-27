<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
     protected $table = 'events';




    public function scopeGetAllEventData(){

		$query = Event::from('events as EV')   
                      ->join('event_types as et', 'et.id' , 'EV.event_type_id')
		              ->select([\DB::raw('EV.id as ID, EV.eventName as NAME, EV.eventStart as EVENTSTART, EV.eventFinish as EVENTFINISH, EV.eventDescription as DESCRIPTION, CONCAT(EV.eventPicturePath, "/", EV.eventPicture) as PICTUREPATH, EV.event_status_id as eventStatus, EV.event_open_for_admin as adminStatus, et.eventTypeName as eventType, EV.eventUrl as eventUrl,
		           CASE
						WHEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id > 0)
					    THEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id and UE2.user_type_id = 5)
					    ELSE (SELECT UE2.id from user_events as UE2 WHERE UE2.event_id  = EV.id )
					END as VISITORS ')])

		       ->groupBy('EV.id', 'EV.eventName', 'EV.eventStart', 'EV.eventDescription', 'EV.eventPicture', 'EV.eventPicturePath', 'EV.eventFinish', 'EV.event_status_id' , 'EV.event_open_for_admin', 'et.eventTypeName', 'EV.eventUrl')
		       //->take(10)
		       ->orderBy('EV.eventStart', 'desc');

		return $query;
	}

	public function scopeGetSpecificEventData($query, $eventId){

		$query = Event::from('events as EV')   
		       ->select([\DB::raw('EV.id as ID, EV.eventName as NAME, EV.eventStart as EVENTSTART, EV.eventFinish as EVENTFINISH, EV.eventDescription as DESCRIPTION, CONCAT(EV.eventPicturePath, "/", EV.eventPicture) as PICTUREPATH, EV.eventLogo as LOGO, EV.eventInvitationPicture as INVITATIONPICTURE, EV.eventUrl as URL, EV.event_open_for_admin as event_open_for_admin, 
		           CASE
						WHEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id > 0)
					    THEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id and UE2.user_type_id = 5)
					    ELSE (SELECT UE2.id from user_events as UE2 WHERE UE2.event_id  = EV.id )
					END as VISITORS ')])

		       
		       ->where('EV.id', $eventId)
		       ->get();
		      

		return $query;


	}

	public function scopeGetEventsForCards($query, $userId, $userFilter){


		$query = Event::from('events as E')->select([\DB::raw('E.id as eventId, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as FULLDESCRIPTION, E.eventUrl as URL,
                                               CASE WHEN month(E.eventStart) = 1
                                                    THEN (select "ENE")
                                                    WHEN month(E.eventStart) = 2
                                                    THEN (select "FEB")
                                                    WHEN month(E.eventStart) = 3
                                                    THEN (select "MAR")
                                                    WHEN month(E.eventStart) = 4
                                                    THEN (select "ABR")
                                                    WHEN month(E.eventStart) = 5
                                                    THEN (select "MAY")
                                                    WHEN month(E.eventStart) = 6
                                                    THEN (select "JUN")
                                                    WHEN month(E.eventStart) = 7
                                                    THEN (select "JUL")
                                                    WHEN month(E.eventStart) = 8
                                                    THEN (select "AGO")
                                                    WHEN month(E.eventStart) = 9
                                                    THEN (select "SEP")
                                                    WHEN month(E.eventStart) = 10
                                                    THEN (select "OCT")
                                                    WHEN month(E.eventStart) = 11
                                                    THEN (select "NOV")
                                                    WHEN month(E.eventStart) = 12
                                                    THEN (select "DIC")
                                                END AS monthName, 
                                                DATE_FORMAT(E.eventStart,"%h:%i %p") as eventTimeStart, day(E.eventStart) as dayNumber, year(E.eventStart) as yearNumber, LOWER(ET.eventTypeName) as TYPE, substring(E.eventDescription, 1,100) as DESCRIPTION
                                                    ')])
                            ->join('event_types as ET', 'ET.id', 'E.event_type_id')

                            ->orderBy('eventStart' , 'desc');

        if($userFilter==1){

        	$query = $query->join('user_events as ue', 'ue.event_id', 'E.id')->where('ue.user_id', $userId);
        }

        return $query;

	}
}




