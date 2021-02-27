<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventSession;
use App\EventLocation;
use App\EventSessionLocation;
use DB;
use App\Event;
use App\User;
use App\UserEvent;
use App\UserEventSessionFavorite;
use Auth;

class SessionController extends Controller
{
    //

    /*
	* get Schedule View
    */
    public function getSessionView($evId){
    	$sessionTypes = DB::table('event_session_types')->orderBy('eventSessionTypeName', 'asc')->get();
    	$eventId = $evId;


        $eventData = Event::from('events as EV')
                           ->where('EV.id', $eventId)
                           ->select('EV.eventStart as EVENTSTART')
                           ->get();
        $eventDateStart = date('Y-m-d', strtotime($eventData[0]->EVENTSTART));
        $eventHourStart = date('h:i', strtotime($eventData[0]->EVENTSTART));

    	$sessions = EventSession::from('event_sessions as ES')
    	                        ->join('event_session_locations as SL', 'SL.id', 'ES.event_session_location_id')
    	                        ->join('event_session_types as ST', 'ST.id', 'ES.event_session_type_id')
    	                        ->where('ES.event_id', $eventId)
                                ->orderBy('ES.eventSessionStart', 'desc')
    	                        ->select([\DB::raw('ES.id AS ID, ES.eventSessionTitle AS TITLE, ST.eventSessionTypeName as TYPE, SL.eventSessionLocationName AS LOCATION, DATE_FORMAT(ES.eventSessionStart, "%d/%m/%Y %h:%i %p")  AS STARTS, ES.eventSessionFinish as FINISH')]);

    	$sessions = $sessions->get();
    	//dd($sessions->toSql() , $eventId);
    	$speakers = DB::table('users as U')
    	                ->select('U.id as USERID','U.userFirstName as USERFNAME', 'U.userLastName as USERLNAME')
    					->join('user_events as UE', 'UE.user_id', 'U.id')
    					->join('user_types as UT', 'UT.id', 'UE.user_type_id')
    					->where('UE.event_id', $evId)
    					->where('UE.user_type_id', 4)
    					->get();
    	
    	return view('backend.admin.schedules.schedule-admin', ['sessions'     => $sessions,
    		 												   'sessionTypes' => $sessionTypes, 
    		 												   'speakers'     => $speakers, 
    		 												   'eventId'      => $eventId,
                                                                'eventDateStart' => $eventDateStart,
                                                               'eventHourStart' => $eventHourStart]);
    }


    /*
    * store session (save and update)
    */

    public function sessionStore(Request $data){

    	$data = $data->all();
        $result = array();


      //  dd($data['sessionTimeFinish']);

        $sessionSpeaker = null;

        $getLocation = EventSessionLocation::where('eventSessionLocationName', $data['sessionLocation']);
       // return $getLocation;

        $sStart =  $data['sessionDateStart'];
        $dateFinish =  null;
        $sTStart = $data['sessionTimeStart'];
      
       
        if($data['sessionTimeFinish'] != null && $data['sessionDateFinish'] != null ){
           $dateFinish = date('Y-m-d H:i:s', strtotime($data['sessionDateFinish'] . ' ' . $data['sessionTimeFinish'] ));
        }
        else if($data['sessionDateFinish'] != null && $data['sessionTimeFinish'] == null){
            $dateFinish = date('Y-m-d H:i:s', strtotime($data['sessionDateFinish']));
        }

        if($data['sessionSpeaker'] != 0){

            $sessionSpeaker = $data['sessionSpeaker'];
        }
        //store
        if($data['action']== 1){
	        try{
	        	$evLocation = Event::where('id', $data['evId'])->pluck('event_location_id');
	        	$sesLocId = mt_rand();

                if($getLocation->count() == 0){
    	        	$sesLoc = new EventSessionLocation();
    	        	$sesLoc->id= $sesLocId;
    	        	$sesLoc->eventSessionLocationName = $data['sessionLocation'];
    	        	$sesLoc->event_location_id = $evLocation[0];
    	        	$sesLoc->save();
                }
                else{
                    $getLocation = $getLocation->get();
                    //return $getLocation[0];
                    $sesLocId = $getLocation[0]->id;
                }

	        	$sesId= mt_rand();
	        	$evSes = new EventSession();
	        	$evSes->id = $sesId;
	        	$evSes->event_id = $data['evId'];
	        	$evSes->user_id = $sessionSpeaker;
	        	$evSes->event_session_location_id = $sesLocId;
	        	$evSes->event_session_type_id = $data['sessionType'];
	        	$evSes->eventSessionTitle = $data['sessionName'];
	        	$evSes->eventSessionDescription = $data['sessionDescription'];
	        	$evSes->eventSessionStart = date('Y-m-d H:i:s', strtotime($sStart . ' ' . $sTStart));
	        	$evSes->eventSessionFinish = $dateFinish;
	        	$evSes->save();

	        	$sessionType = DB::table('event_session_types')->where('id', $data['sessionType'] )->pluck('eventSessionTypeName');
	        	$sessionLocation = EventSessionLocation::where('id', $sesLocId)->pluck('eventSessionLocationName');

	        	$result = ['status'=> 'success', 'message' => 'Sesión creada con éxito', 'sId' => $sesId, 'sName'=>$data['sessionName'], 'sType' => $sessionType[0], 'sDateStart' => date('d-m-Y H:i A', strtotime($data['sessionDateStart'] . ' ' . $data['sessionTimeStart'])) , 'sLocation' => $sessionLocation[0], 'eventSessionFinish' => $dateFinish, 'sTimeStart' => $data['sessionTimeStart']  ];

	        }catch(exception $e){
	        	$result = ['status'=> 'error', 'message' => $e->getMessage()];
	        }
    	}
    	//update
    	if($data['action']==2){
    		try{
    			$evLocation = Event::where('id', $data['evId'])->pluck('event_location_id');

    			$sesLocId = EventSession::where('id', $data['sessionId'])->pluck('event_session_location_id');

    			$sesLoc = EventSessionLocation::where('id', $sesLocId)
    							             ->update(['eventSessionLocationName' => $data['sessionLocation']]);

                
                $evSes = EventSession::where('id',$data['sessionId'])
                					->update(['user_id'=> $sessionSpeaker,
                					          'event_session_type_id' => $data['sessionType'],
                					          'eventSessionTitle' => $data['sessionName'],
                					          'eventSessionDescription' => $data['sessionDescription'],
                					          'eventSessionStart' => date('Y-m-d H:i:s', strtotime($sStart . ' ' . $sTStart)),
	        							  	  'eventSessionFinish' => $dateFinish,
                					        ]);

                $sessionData = EventSession::from('event_sessions as ES')
    	                        ->join('event_session_locations as SL', 'SL.id', 'ES.event_session_location_id')
    	                        ->join('event_session_types as ST', 'ST.id', 'ES.event_session_type_id')
    	                        ->where('ES.event_id', $data['evId'])
    	                        ->where('ES.id', $data['sessionId'])
    	                        ->select([\DB::raw('ES.id AS ID, ES.eventSessionTitle AS TITLE, ST.eventSessionTypeName as TYPE, SL.eventSessionLocationName AS LOCATION, ES.eventSessionStart AS STARTS, ES.eventSessionFinish as FINISH')])->get();
    	                       

	            $result = ['status'		=> 'success', 'action'=>'update', 'message' => 'Se ha actualizado la sesión.',
	            		   'sId'		=> $sessionData[0]->ID,
	        			   'sName' 		=> $data['sessionName'],
	        			   'sDesc' 		=> $data['sessionDescription'],
	        			   'sType' 		=> $sessionData[0]->TYPE,
	        			   'sLocation' 	=> $sessionData[0]->LOCATION,
	        			   'sDateStart' => date('d-m-Y H:i:s', strtotime($sessionData[0]->STARTS)), 
                           'sDateFinish' => $sessionData[0]->FINISH,
                           'sTimeStart' => $data['sessionTimeStart']];
    		} catch(exception $e){
    			$result = ['status'=> 'error', 'action', 'Update', 'message' => $e->getMessage()];
    		}



    		
    	}
    	return json_encode($result);

    }

    /*
    * get data for edit
    */

    public function getSessionEditData($sId){

		
		try{

            $sDateFinish = null;
            $sTimeFinish = null;
			$sessionData = EventSession::where('id', $sId)
                                       ->select([\DB::raw('eventSessionTitle, eventSessionDescription, eventSessionStart, DATE_FORMAT(eventSessionStart, "%T") as sessionTimeStart, eventSessionFinish, DATE_FORMAT(eventSessionFinish, "%T") as sessionTimeFinish, event_session_type_id, user_id')])
                                       ->get();
			$sessionLocation = DB::table('event_session_locations as SL')
							     ->join('event_sessions as ES', 'ES.event_session_location_id', 'SL.id')
							    ->where('ES.id', $sId)
							     ->pluck('eventSessionLocationName');



			$sesionType =  DB::table('event_session_types')->where('id', $sessionData[0]->event_session_type_id)->pluck('id');
			$sessionSpeaker = DB::table('event_sessions as ES')
							    ->pluck('user_id');

            $sDateStart = date('Y-m-d', strtotime($sessionData[0]->eventSessionStart));
            $sTimeStart = $sessionData[0]->sessionTimeStart;
            if($sessionData[0]->eventSessionFinish != null){
                $sDateFinish = date('Y-m-d', strtotime($sessionData[0]->eventSessionFinish));
                $sTimeFinish = $sessionData[0]->sessionTimeFinish;
            }

            //dd($sTimeFinish);

			$result = ['status'		=> 'success', 
			           'sName' 		=> $sessionData[0]->eventSessionTitle,
			           'sDesc'  	=> $sessionData[0]->eventSessionDescription,
			           'sDateStart' => $sDateStart,
			           'sTimeStart' => $sTimeStart,
			           'sDateFinish'=> $sDateFinish,
			           'sTimeFinish'=> $sTimeFinish,
			           'sLocation'	=> $sessionLocation[0],
			           'sType'	    => $sessionData[0]->event_session_type_id,
			           'sSpeak'		=> $sessionData[0]->user_id,
 			          ];
		}
		catch(exception $ex){
			$result = ['status'=>'error', 'message' => $ex->getMessage()];
		}

		return json_encode($result);
	}


    /*
    * delete session
    */

    public function sessionDelete($sId){

    	try{
    		EventSession::where('id', $sId)->delete();
    		$result = ['status' => 'success', 'message' => 'Se ha eliminado la sesión.', 'session' => $sId];

    	}catch(exception $e){
    		$result = ['status' => 'error', 'message' => $e->getMessage()];
    	}

    	

    	return json_encode($result);
    }

    /*
    # Agregar sesion a favoritos desde la pagina web del evento
    */

    public function sessionAddFavorite(Request $request){

      // $data = $request->all(); // This will get all the request data.

        //return json_encode($request->eventId); // This will dump and die
        DB::beginTransaction();
        try{

            $userId= Auth::user()->id;

            $userEvent = UserEvent::where('user_id', $userId)->where('event_id', $request->eventId)->pluck('id');

            //Verificar si existe la actividad en favoritos
            $checkFav = UserEventSessionFavorite::where('user_event_id',$userEvent[0])->where('event_session_id', $request->sessionId )->get();
            if(count($checkFav) > 0){

                $delFav = UserEventSessionFavorite::where('user_event_id', $userEvent[0])->where('event_session_id', $request->sessionId)->delete();

                $result = ['status' => 'success', 'action' => 'remove', 'message' => 'Se ha eliminado la actividad a favoritos!.', 'btnText' => 'Agregar a favoritos'];
            }
            else{

                $fav = new UserEventSessionFavorite();
                $fav->id = mt_rand();
                $fav->user_event_id = $userEvent[0];
                $fav->event_session_id = $request->sessionId;
                $fav->save();
            
                $result = ['status' => 'success', 'action' => 'add', 'message' => 'Se ha agregado la actividad a favoritos!.', 'btnText' => 'Eliminar de favoritos'];

            }
            
            DB::commit();
        } catch (exception $e ){

            $result = ['status' => 'error', 'message' => 'Ha ocurrido un error al intentar agregar la actividad a favoritos.' ];

            DB::rollBack();
        }

        

        return json_encode($result);

    }
}
