<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use App\Event;
use App\EventType;
use App\User;
use Mail;
use App\EmailNotification;
use App\EmailNotificationRecipient;
use App\Field;
use Hash;
use App\UserRole;

class AdminController extends Controller
{
    //

	/*
	* My profile view
	*/

	public function getMyProfileView(){
		/*$roleEvent = User::getUserEventPermissions(Auth::user()->id)->max('UE.user_type_id');
		$eventTypes = EventType::getEventTypes()->get();

		$myData = User::where('id', Auth::user()->id)->get();
		//dd($roleEvent);
		return view('backend.user.my-profile', ['myData' => $myData, 'eventRole' => $roleEvent, 'eventTypes' => $eventTypes, 'pageTitle' => 'Mi Perfil']);*/


		if (Auth::check())
        {

            $visitorData = User::where('id', Auth::user()->id)->get();
           	$roleEvent = User::getUserEventPermissions(Auth::user()->id)->max('UE.user_type_id');

            $countFields=0;

            $myData = DB::table('users as U')->where('U.id', Auth::user()->id)
                        ->select([\DB::raw('CONCAT(U.userFirstName, " ", U.userLastName) as FULLNAME, CONCAT("images/users/profiles/", U.userPicture) AS PICTURE')])->get();
           // dd($myData);

             $visitorData = User::where('id', Auth::user()->id)->get();

            return view('backend.user.my-profile', ['page_title' => 'Mi Perfil', 'myCardData' => $myData, 'pageTitle' => 'Mi Perfil', 'myData' => $visitorData, 'type'=>'profile', 'eventRole' => $roleEvent, 'checked' => 'profile']);

         //  dd($additionalData);


        } else{

            return redirect('error/0000');
        }
	}


	/*
    * Vista de la cuenta
    */

    public function getAccountView(){

       $myData = DB::table('users as U')->where('U.id', Auth::user()->id)
                        ->select([\DB::raw('CONCAT(U.userFirstName, " ", U.userLastName) as FULLNAME, CONCAT("images/users/profiles/", U.userPicture) AS PICTURE')])->get();
      	return view('backend.user.my-profile', ['page_title' => 'Mi Perfil', 'pageTitle' => 'Mi Perfil','myCardData' => $myData, 'type'=>'account', 'checked' => 'account']);

    }

	/*
	* update my profile data
	*/

	public function updateMyProfileData(Request $data){

		$message = 'Se ha actualizado correctamente tu información!';
		$status = 'success';
		try{

			$updateUser = User::where('id', Auth::user()->id)->update(['userFirstName'=>$data->userFirstName, 'userLastName'=> $data->userLastName, 'userCountryCode' => $data->userCountryCode, 'userAddress' => $data->userAddress, 'userBirthDay' => $data->userDob, 'userPhoneNumber' => $data->userPhoneNumber]);

			if($updateUser == 0){

				$message = 'No se ha actualizado tu información';
				$status = 'noupdated';

			}

			$result = ['status' => $status, 'message' => $message];


		}catch(exception $e){

			$result = ['status' => 'error', 'message' => $e->getMessage()];
		}

		return json_encode($result);
	}


	/*
	* update my password
	*/

	public function updateMyPassword(Request $data){
		try{

			$user = User::where('id', Auth::user()->id)->first();

			if(Hash::check($data->userCurrentPassword, $user->userPassword)) {


				$changePwd = User::where('id', Auth::user()->id)->update(['userPassword'=> bcrypt($data->userNewPassword)]);




    		}

			$result = ['status' => 'success', 'message' => 'Se ha actualizado la contraseña correctamente!'];


		} catch(exception $e){
			$result = ['status' => 'error', 'message' => $e->getMessage()];

		}
		return json_encode($result);
	}


	/*
	* Full admin home view
	*/

	public function fullAdminHome(){

		$lastevents = Event::from('events as EV')
		                   ->join('user_events as UE', 'UE.event_id', 'EV.id')
		                   ->join('users as U', 'U.id', 'UE.user_id')
		                   ->where('user_type_id', 1)

		                   ->orderBy('EV.created_at', 'desc')->take(10)->get();
		//dd($lastevents);
		return view('backend.admin.full-home', ['rol'=>1,
											'lastevents' => $lastevents
										  ]);
	}



	/*
	* Super admin home view
	*/

	public function superAdminHome(){

		$lastevents = Event::from('events as EV')
						   ->orderBy('EV.created_at', 'desc')
						   ->join('user_events as UE', 'UE.event_id', 'EV.id')
		                   ->join('users as U', 'U.id', 'UE.user_id')
		                   ->where('user_type_id', 1)
		                   ->select([\DB::raw('EV.id as EVENTID, CONCAT(U.userFirstName, " ", U.userLastName) as SPONSOR, CONCAT(EV.eventPicturePath, "/", EV.eventPicture) AS PICTURE, DATE_FORMAT(EV.created_at, "%d/%m/%Y") as CREATED, EV.eventName as ENAME')])
						   ->take(10)->get();


		$allEvents = Event::from('events as EV')
						  ->get();

	    $userAdmins = User::from('users as U')
	                      ->join('user_events as UE', 'UE.user_id', 'U.id')
	                      ->get();


		//dd($lastevents);
		return view('backend.admin.super-home', ['rol'=>2,
												 'lastevents' => $lastevents,
												 'allevents'  => $allEvents,

										  ]);
	}


	/*
	* Normal home view, (adminmistrador de evento, vendedor, conferencista)
	*/

	public function adminHome(Request $request){

		//dd($request->all());
		$eventsActives = 0;
		$countEvents = 0;
		//dd($request->all());

		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');
		$permissions = 0;
		$roleEvent = 0;
		$isNewUser = false;

		$fromEvent = true;



        //$userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');


		if($request->createEvent == 1){

        	 return redirect()->route('create-event');
        }

        if($request->welcome==1){
        	$isNewUser = true;

        }

        if($request->welcome == 2){

        	$isNewUser = true;
        	$fromEvent = false;
        }


		/*$myEvents = Event::from('events as EV')

		                   ->select([\DB::raw('EV.id as ID, EV.eventName as NAME, EV.eventStart as EVENTSTART, EV.eventFinish as EVENTFINISH, EV.eventDescription as DESCRIPTION, CONCAT(EV.eventPicturePath, "/", EV.eventPicture) as PICTUREPATH,
		                       CASE
									WHEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id > 0)
								    THEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id and UE2.user_type_id = 5)
								    ELSE (SELECT UE2.id from user_events as UE2 WHERE UE2.event_id  = EV.id )
								END as VISITORS ')])

		                   ->groupBy('EV.id', 'EV.eventName', 'EV.eventStart', 'EV.eventDescription', 'EV.eventPicture', 'EV.eventPicturePath', 'EV.eventFinish')
		                   ->take(10)
		                   ->orderBy('EV.eventStart', 'asc');*/

		$myEvents = Event::getAllEventData();

		$allEvents = $myEvents->where('EV.event_status_id', 1)->get();

		//dd($myEvents);


		//Si es un super o full admin
		if($roleAuth[0] == 1 || $roleAuth[0] == 2){
			$myEventList = $myEvents->get();
			$roleEvent = 1;

			$permissions = 1;

			$active = Event::from('events as EV')->join('user_events as UE', 'UE.event_id', 'EV.id')->where('UE.user_id', Auth::user()->id)->whereDate('EV.eventFinish', '>=', date('Y-m-d') )->get();
			$finished = Event::from('events as EV')->join('user_events as UE', 'UE.event_id', 'EV.id')->where('UE.user_id', Auth::user()->id)->whereDate('EV.eventFinish', '<', date('Y-m-d') )->get();

			//dd($finished->whereDate('EVENTFINISH', '<', date('Y-m-d') )->get());

			//dd($finished);

			$activeEvents = count($active);


			$finishedEvents = count($finished);

			$countEvents = count($myEventList);


		}
		elseif ($roleAuth[0] == 3){
			$permissions = 2;
			$eventData = $myEvents->join('user_events as UE', 'UE.event_id', 'EV.id')->where('UE.user_id', Auth::user()->id);



			$rolEventType = DB::table('user_events')->where('user_id', Auth::user()->id)->pluck('user_type_id');

			$myEventList = $eventData->get();

			//dd(Auth::user()->id);

			$active = Event::from('events as EV')->join('user_events as UE', 'UE.event_id', 'EV.id')->where('UE.user_id', Auth::user()->id)->whereDate('EV.eventFinish', '>=', date('Y-m-d') )->get();
			$finished = Event::from('events as EV')->join('user_events as UE', 'UE.event_id', 'EV.id')->where('UE.user_id', Auth::user()->id)->whereDate('EV.eventFinish', '<', date('Y-m-d') )->get();

			//dd($finished->whereDate('EVENTFINISH', '<', date('Y-m-d') )->get());

			$activeEvents = count($active);


			$finishedEvents = count($finished);

		//	dd($finishedEvents->get());

		//	dd(date('Y-m-d'));

		    //dd($activeEvents);


			$countActives= $activeEvents;
			$countFinished = $finishedEvents;

			$countEvents = count($myEventList);

			if($roleEvent>0){
				$roleEvent = $rolEventType[0];
			}
			else{
				$roleEvent=0;
			}
		}



 		// Obtener la lista de otros eventos a los que no se está registrado

		$otherEvents = null;
 		if(count($myEvents->get())> 0){

 			$evIds = array();
 			foreach ($myEvents->get() as $key) {
 				
 				$evIds = ['id' => $key['ID']];
 			}

 			$otherEvents = $myEvents->whereNotIn('EV.id', $evIds)->toSql();

 			
 		}



		$eventsActives = Event::from('events as EV')
		                 ->where('EV.eventStart', '>=', time())
		                 ->get();

        $eventsFinished = Event::from('events as EV')
		                 ->where('EV.eventStart', '<', time())
		                 ->get();

        $countActives = count($eventsActives);

        $countAll = count($myEventList);


        $lastEventId = null;
        $lastEventName = null;

        //Seleccionar el último evento al que se registró el usuario para mostrar el link al perfin electronico (badge)
        //if($isNewUser==true && $fromEvent == true){
        
        if(count($myEventList)>0){
	        $lastEvent = Event::from('events as e')
	                          ->join('user_events as ue', 'ue.event_id', 'e.id')
	                          ->where('ue.user_id', Auth::user()->id)
	                          ->select('e.id as eventId', 'e.eventName as eventName')
	                          ->orderBy('e.created_at', 'desc')
	                          ->first();

	        $lastEventId =  $lastEvent->eventId;
	        $lastEventName =  $lastEvent->eventName;
	    }
        //}
		//dd($lastEvent->eventId);
		return view('backend.admin.normal-home', ['rol'=>3,
												  'myEvents' => $myEventList,
												  'eventsActives' => $activeEvents,
												  'finishedEvents' => $finishedEvents,
												  'eventsAll' => $countAll,
												  'roleAuth' => $roleAuth[0],
												  'roleEvent' => $roleEvent,
												  'permissions' => $permissions,
												  'countEvents' => $countEvents,
												  'isNewUser' => $isNewUser,
												  'fromEvent' => $fromEvent,
												  'lastEventId' => $lastEventId,
												  'lastEventName' => $lastEventName,
												  'allEvents' => $allEvents

										  ]);
	}




	/*
	* get users admin view
	*/

	public function getUsersCreateView(Request $request){
		 $input = $request->all();



		//Input::has('city') && $input['city'] != "0"¿
		// Obtener el rol del usuario logueado
		$currrol = DB::table('user_roles')->where('user_id', Auth::user()->id)->pluck('role_id');
		$rolesfilter = array();
		//Full full
		if($currrol[0]==1){
			$rolesfilter = array(1,2,3,4,5);
		}

		//Super Administrador
		if($currrol[0]==2){
			$rolesfilter = array(2,3,4,5);
		}

		$users = User::from('users as U')
		             ->join('user_roles as UR', 'UR.user_id', 'U.id')
		             ->join('roles as RL', 'RL.id' ,'UR.role_id')
		             ->whereIn('role_id', $rolesfilter)
		             ->select([\DB::raw('U.id as ID, U.userFirstName as FName, U.userLastName as LName, U.userEmail as Email, RL.roleName as Role, RL.id as ROLID')]);



		if(Input::has('roleFilter') && $input['roleFilter'] != "0"){

			$users = $users->where('RL.id', $input['roleFilter'] );
		}

	/*	if(Input::has('statusFilter') && $input['statusFilter'] != "0"){

			$users = $users->where('RL.id', $input['roleFilter'] );
		}
    */

		if(Input::has('textFilter') && $input['textFilter']){
			$textFilter = $input['textFilter'];
			//dd($textFilter);
			$users= $users->where(function ($query)  use ($textFilter){
                                 $query->where('userFirstName',  'like', '%' . $textFilter . '%')
                                       ->orWhere('userLastName', 'like', '%' . $textFilter . '%')
                                       ->orWhereRaw('(CONCAT(userFirstName, " ", userLastName ) like "%' . $textFilter . '%")')
                                       ->orWhereRaw('(CONCAT(userLastName, " ", userFirstName) like "%' . $textFilter . '%")')
                                       ->orWhere('userEmail', 'like', '%' . $textFilter . '%');

                               });
		}

		 $users = $users->paginate(10);
		 //dd($users);
		$roles = DB::table('roles')->whereIn('id', $rolesfilter)->get();
		return view('backend.admin.users.users-admin', ['users' => $users,
														'roles' => $roles]);

	}

	/*
	* Guardar datos del usuario
	*/

	public function userStore(Request $data){

		//dd($data->userFirstName);
		$result = array();
		$createUser= new UserController();
        $data = $data->all();
        if($data['action'] ==1){
        $result = $createUser->userStore($data);
		}
		else if($data['action'] == 2){
		$result = $createUser->userEdit($data, true);
		}

		return json_encode($result);
	}

	/*
	* Obtener datos del usuario para editar
	*/

	public function getUserEditData($uId){


		$result = array();
		try{

			$userData = User::where('id', $uId)->get();

			$userRole = DB::table('user_roles')->where('user_id', $uId)->pluck('role_id');

			$result = ['status'=>'success',

			           'userFirstName' => $userData[0]->userFirstName,
			           'userLastName'  => $userData[0]->userLastName,
			           'userEmail'     => $userData[0]->userEmail,
			           'userDob'       => $userData[0]->userBirthDay,
			           'userAddress'   => $userData[0]->userAddress,
			           'userPhone'     => $userData[0]->userPhoneNumber,
			           'userRole'	   => $userRole[0],
 			          ];
		}
		catch(exception $ex){
			$result = ['status'=>'error', 'message' => $ex->getMessage()];
		}

		return json_encode($result);
	}




	/*
	* Obtener vista para listado de catalogos
	*/

	public function getCatalogsListView(){


		return view('backend.admin.catalogs.catalog-list');
	}

	/*
	* Vista para creación de catálogos
	*/

	public function getCatalogCreateView(Request $request){

		$permissions=0;

		$eventId = $request->eventId;

		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        if($roleAuth[0] == 1  || $roleAuth[0] == 2 ){

            $permissions = 1;
            $typeName = 'Administrador';
        }
        

		$eventName = Event::where('id', $eventId)->pluck('eventName');

		return view('backend.admin.catalogs.catalog-create', ['eventId' => $eventId, 'eventName' => $eventName[0], 'permissions' => $permissions ]);

	}


	/*
	* View for List of catalogs for users
	*/

	public function getUserCatalogsListView(){

		dd("En construcción...");
	}

	/*
	* View Create catalog for users
	*/

	public function getCreateUserCatalogFieldsView(Request $request){

		//dd($request->all());
		$eventId = $request->eventId;
		$formId = $request->formId;
		$eventData = Event::where('id', $eventId)->get();


		$eventAdminStatus = $eventData[0]->event_open_for_admin;

		$eventName = $eventData[0]->eventName;


		$userRole = User::from('users as U')
						->join('user_roles as UR', 'UR.user_id', 'U.id')
						->where('U.id', Auth::user()->id)
						->pluck('UR.role_id');

		$userType = DB::table('user_events as UE')
		              ->where('UE.user_id', Auth::user()->id)
		              ->pluck('UE.user_type_id');



		$myEvents = Event::from('events as EV')
		                 ->join('user_events as UE', 'UE.event_id', 'EV.id');

		$fields = Field::from('fields as F')
                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
                      ->join('forms as FO', 'FO.id', 'FS.form_id')
                      ->join('event_forms as EF', 'EF.form_id', 'FO.id')
                      ->join('data_type_controls as DTC', 'DTC.id', 'F.data_type_control_id')
                      ->join('controls as C', 'C.id', 'DTC.control_id')
                      ->join('data_types as DT', 'DT.id', 'DTC.data_type_id')
                      ->where('EF.event_id', $eventId)
                      ->where('FS.form_id', $formId) //form Visitantes
                      ->where('FS.section_id', 1) //section Registro
                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as PHOLDER, F.fieldRequired as FREQUIRED, F.fieldMaxLenght as MAXLENGHT, F.data_type_control_id as CONTROLTYPE, C.controlName as CONTROLNAME, DT.dataTypeName as TYPENAME, C.id as controlId')])
                      ->orderBy('FSF.fieldOrder' , 'F.created_at', 'desc')
                      ->get();

                      //dd($fields);

        if($userRole[0]==1 || $userRole[0]==2){
        	$myEvents = $myEvents->get();
        }
        else if($userRole[0] > 2 && $userType[0] < 3 ){

        	$myEvents = $myEvents->where('UE.user_id', Auth::user()->id)
        						 ->get();
        }
        else{
        	dd("No tiene permisos para ingresar a la pagina");
        }

        $userTypes = DB::table('user_types')->get();


        $controls = DB::table('controls')->get();
		//dd($formId);

       return view('backend.admin.catalogs.create-user-catalog',
       	          	[ 	'events' => $myEvents,
       					'userTypes' =>$userTypes,
      					'controls' => $controls,
      					'eventId' => $eventId,
      					'formId' => $formId,
      					'eventName' => $eventName,
      					'fields' => $fields,
      					'eventAdminStatus' => $eventAdminStatus
		]);

	}




	/*
	* View Create field catalog for companies
	*/

	public function getCreateCompanyCatalogFieldsView(){
		$userRole = User::from('users as U')
						->join('user_roles as UR', 'UR.user_id', 'U.id')
						->where('U.id', Auth::user()->id)
						->pluck('UR.role_id');

		$userType = DB::table('user_events as UE')
		              ->where('UE.user_id', Auth::user()->id)
		              ->pluck('UE.user_type_id');



		$myEvents = Event::from('events as EV')
		                 ->join('user_events as UE', 'UE.event_id', 'EV.id')
		                 ->select('EV.id as ID', 'EV.eventName as EVENTNAME', 'UE.user_id as UID');

        if($userRole[0]==1 || $userRole[0]==2){
        	$myEvents = $myEvents->get();
        }
        else if($userRole[0] > 2 && $userType[0] < 3 ){

        	$myEvents = $myEvents->where('UE.user_id', Auth::user()->id)
        						 ->get();
        }
        else{
        	dd("No tiene permisos para ingresar a la pagina");
        }

        $userTypes = DB::table('user_types')->get();


        $controls = DB::table('controls')->get();
		//dd($myEvents);

       return view('backend.admin.catalogs.companies.create-company-catalog', ['events' => $myEvents, 'userTypes' =>$userTypes,
      															  'controls' => $controls]);

	}






	/*
    * View for mail admin
    */
    public function getMailView($evId){


    	$mailSent = EmailNotificationRecipient::from('email_notification_recipients as ER')
    	                             ->join('user_events as UE', 'UE.id', 'ER.user_event_id')
    	                             ->join('users as U', 'U.id', 'UE.user_id')
    	                             ->join('email_notifications as EN', 'EN.id', 'ER.email_notification_id')
    	                             ->join('user_events as UE2', 'UE2.id', 'EN.emailNotificationFrom')
    	                             ->join('users as U2', 'U2.id', 'UE2.user_id')
    	                             ->where('UE.event_id', $evId)
    	                             ->where('UE2.event_id', $evId)
    	                             ->where('UE2.user_id', Auth::user()->id)
    	                             ->select([\DB::raw('EN.id as ID, DATE_FORMAT(EN.created_at,  "%d/%m/%Y %p") as DATE,  GROUP_CONCAT(U.userEmail) as DESTINATIONS, EN.emailNotificationTitle AS SUBJECT, EN.emailNotificationBody as BODY , U2.userEmail')])
    	                              ->groupBy('ER.email_notification_id', 'EN.id', 'EN.created_at', 'EN.emailNotificationTitle', 'EN.emailNotificationBody', 'U2.userEmail')
    	                             ->get();



    	return view('backend.all.mail', ['eventId' => $evId, 'mails' =>$mailSent]);
    }

    public function getProductView(){

    	return view('backend.all.product');
    }

    /*
    * Get all events
    */

    public function getEventsList(Request $data, $get){



    	$events = Event::from('events as EV')
    				->join('user_events as UE', 'UE.event_id', 'EV.id')
    				->join('users as U', 'U.id', 'UE.user_id')
    				->where('UE.user_type_id', 1)
    	            ->orderBy('EV.created_at', 'asc');


    	switch ($get) {
    		case 'all':
    			$events = $events->get();
    			break;

    		case 'actives':
    			$events = $events->where('event_status_id', 1)->get();
    			break;

    		case 'finished':	# code...
    			$events = $events->where('event_status_id', 2)->get();
    			break;


    	}
    	//dd($events);
    	return view('backend.admin.events.events-list', ['events' => $events]);
    }




    /*
    * Get list of events by status
    */

    public function getEventsByStatus($stt){


    	$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');
    	 $userRole = UserRole::where('user_id', Auth::user()->id)
                         ->pluck('role_id');
       // $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');
    	$now = \Carbon\Carbon::now();

    	/*$events = Event::from('events as EV')
    				->join('user_events as UE', 'UE.event_id', 'EV.id')
    				->join('users as U', 'U.id', 'UE.user_id')
    				->where('UE.user_type_id', 1)
    				->where('UE.user_id', Auth::user()->id)
    	            ->orderBy('EV.created_at', 'asc'); */

    	$events = Event::getAllEventData();

    	$title = 'Todos los eventos';
    	switch ($stt) {
    		case 'todos':
    			$events = $events;
    			break;

    		case 'activos':
    			$events = $events->whereDate('eventFinish', '>=', date('Y-m-d') );
    			$title = 'Eventos activos';
    			break;

    		case 'finalizados':	# code...
    			$events = $events->whereDate('eventFinish', '<', date('Y-m-d') );
    			$title = 'Eventos finalizados';
    		//	dd($events );
    			break;

    		/*case 'proximo':	# code...
    			$events = $events->where('eventFinish', '>', time())->orderBy('eventStart', 'asc')->first()->get();
    			$title = 'Eventos finalizados';
    			break;
    		*/



    	}


    	if($roleAuth[0]==3){

            $events = $events->join('user_events as UE', 'UE.event_id', '=', 'EV.id')->where('UE.user_id', Auth::user()->id)->paginate(8);
        }
        else{
            $events = $events->paginate(8);
        }
    	//dd($events);
    	$countEvents = count($events);

    	return view('backend.admin.events.events-list', ['myEvents' => $events,
                                                         'title' => $title, 'countEvents' => $countEvents, 'stt' => $stt,
                                                         'type' => 'cards', 'roleAuth' => $roleAuth[0],
                                                         'roleEvent' => $userRole[0]]);


    }





    /*
    * Event home page
    */

   public function getEventHomePage($evId){

   		$hideall=0;
   		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');

        $sponsorsV = 1;
        $speakersV = 1;
        $activitiesV = 1;
        $pageV = 1;
        $visitorsV = 1;


        //dd(Auth::user()->id);

   		$eventData = Event::from('events as EV')
    	                  ->join('event_types as ET', 'ET.id', 'EV.event_type_id')
    	                  ->join('event_locations as EL', 'EL.id', 'EV.event_location_id')
    	                  ->join('payment_currencies as PC', 'PC.id', 'EV.payment_currency_id')
    	                  ->where('EV.id', $evId)
    	                  ->select([\DB::raw('EV.id as EVENTID, EV.eventName as NAME, EV.eventDescription as DESCRIPTION, EL.eventLocationName as LOCATION, EV.eventPrice as PRICE, PC.currencySymbol as CURRENCY, EV.event_open_for_admin adminStatus,
    	                  					  CASE DAYOFWEEK(EV.eventStart)
	   										    WHEN 1 THEN "Domingo"
	    										WHEN 2 THEN "Lunes"
	    										WHEN 3 THEN "Martes"
	   											WHEN 4 THEN "Miércoles"
	   											WHEN 5 THEN "Jueves"
											    WHEN 6 THEN "Viernes"
											    WHEN 7 THEN "Sábado"
											  END as DAY,
											  CASE DAYOFWEEK(EV.eventFinish)
	   										    WHEN 1 THEN "Domingo"
	    										WHEN 2 THEN "Lunes"
	    										WHEN 3 THEN "Martes"
	   											WHEN 4 THEN "Miércoles"
	   											WHEN 5 THEN "Jueves"
											    WHEN 6 THEN "Viernes"
											    WHEN 7 THEN "Sábado"
											  END as DAYFINISH,
										      CASE MONTH(EV.eventStart)
										    	WHEN 1 THEN "Enero"
										    	WHEN 2 THEN "Febrero"
										    	WHEN 3 THEN "Marzo"
										    	WHEN 4 THEN "Abril"
										    	WHEN 5 THEN "Mayo"
										    	WHEN 6 THEN "Junio"
										    	WHEN 7 THEN "Julio"
										    	WHEN 8 THEN "Agosto"
										    	WHEN 9 THEN "Septiembre"
										    	WHEN 10 THEN "Octubre"
										    	WHEN 11 THEN "Noviembre"
										    	WHEN 12 THEN "Diciembre"
										      END AS MONTH,
										      CASE MONTH(EV.eventFinish)
										    	WHEN 1 THEN "Enero"
										    	WHEN 2 THEN "Febrero"
										    	WHEN 3 THEN "Marzo"
										    	WHEN 4 THEN "Abril"
										    	WHEN 5 THEN "Mayo"
										    	WHEN 6 THEN "Junio"
										    	WHEN 7 THEN "Julio"
										    	WHEN 8 THEN "Agosto"
										    	WHEN 9 THEN "Septiembre"
										    	WHEN 10 THEN "Octubre"
										    	WHEN 11 THEN "Noviembre"
										    	WHEN 12 THEN "Diciembre"
										      END AS MONTHFINISH,
										      	EV.eventStart as EVENTSTART,
										      	EV.eventFinish as EVENTFINISH,
												LOWER(ET.eventTypeName)	 as TYPE,
												CONCAT(EV.eventPicturePath,"/", EV.eventPicture) as PICTURE, EV.eventPicture as ePict,
												CONCAT("images/events/logos/", EV.eventLogo) as LOGO, EV.eventLogo as eLogo,
												EV.eventInvitationPicture as INVITATIONPICTURE, EV.eventUrl as URL')])->get();

    	$eventLocation = $eventData[0]->LOCATION;
    	$eventTitle = $eventData[0]->NAME;
    	$eventTopImg = $eventData[0]->PICTURE;
    	$eventLogoImg = $eventData[0]->LOGO;
    	$eventUrl = $eventData[0]->URL;


    	$eventType = $eventData[0]->TYPE;

    	$invitationPicture = $eventData[0]->INVITATIONPICTURE;

    	$eventDateFull = $eventData[0]->DAY . ' ' . date('d', strtotime($eventData[0]->EVENTSTART)) . ' de ' . $eventData[0]->MONTH . ' de ' . date('Y', strtotime($eventData[0]->EVENTSTART));

    	$eventDateFullFinish = $eventData[0]->DAYFINISH . ' ' . date('d', strtotime($eventData[0]->EVENTFINISH)) . ' de ' . $eventData[0]->MONTHFINISH . ' de ' . date('Y', strtotime($eventData[0]->EVENTFINISH));
    	$dateMonthName = $eventData[0]->MONTH;

    	$dateYearNumber = date('Y', strtotime($eventData[0]->EVENTSTART));
    	$eventHourStart = date('h:i A', strtotime($eventData[0]->EVENTSTART));
    	$eventHourFinish = date('h:i A', strtotime($eventData[0]->EVENTFINISH));
    	$eventDescription = $eventData[0]->DESCRIPTION;
    	$eventLocation = $eventData[0]->LOCATION;
    	$eventAdmision = $eventData[0]->PRICE;
    	$eventAdmisionCurrency = $eventData[0]->CURRENCY;
    	$eventAdminStatus =  $eventData[0]->adminStatus;

    	//dd($eventAdminStatus);

      	$users = DB::table('user_events as ue')
			           ->where('ue.user_type_id', '!=', 5)
								 ->where('ue.event_id', $evId)
								 ->get();

			$countUsers = count($users);

   		$speakers = DB::table('user_events as UE')
   		              ->where('UE.user_type_id', 4)
   		              ->where('UE.event_id', $evId)
   		              ->get();

   		$countSpeakers = count($speakers);

   		$visitors = DB::table('user_events as UE')
   		              ->where('UE.user_type_id', 5)
   		              ->where('UE.event_id', $evId)
   		              ->get();

   		$countVisitors = count($visitors);


   		$allRegisters = DB::table('user_events as ue')
   		                  ->where('ue.user_type_id', 5)
   		                  ->where('ue.event_id', $evId);

   		$preRegisters = $allRegisters->where(function ($query){
                                 $query->where('ue.registered_from_id', 1)
                                 	   ->orWhere('ue.registered_from_id', null);
                             	 })
   		                         ->get();

   		$countPreRegisters = count($preRegisters);


   		$eventRegisters = DB::table('user_events as ue')
   		                  ->where('ue.user_type_id', 5)
   		                  ->where('ue.event_id', $evId)
   		                  ->where('ue.registered_from_id', 2)->get();

   		$countEventRegisters = count($eventRegisters);            


   	


   		

   		$products = DB::table('products as PR')
   		              ->where('PR.event_id', $evId)
   		              ->get();

   		$countProducts = count($products);

   		$offers = DB::table('sales as S')
   				    ->join('products as PR', 'PR.id', 'S.product_id')
   				    ->where('PR.event_id', $evId)
   				    ->get();

   		$countOffers = count($offers);

   		$activities = DB::table('event_sessions as ES')
   					->where('ES.event_id', $evId)
   		              ->get();

   		$countActivities = count($activities);

   		if($roleAuth[0] == 3){

            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4){

                    $sponsorsV = 0;
			        $speakersV = 0;
			        $activitiesV = 0;
			        $pageV = 0;
			        $visitorsV = 0;

	   		$products = DB::table('products as PR')
	   		              ->where('PR.event_id', $evId)
	   		              ->where('PR.user_id', Auth::user()->id)
	   		              ->get();

	   		$countProducts = count($products);

	   		$offers = DB::table('sales as S')
   				    ->join('products as PR', 'PR.id', 'S.product_id')
   				    ->where('PR.user_id', Auth::user()->id)
   				    ->where('PR.event_id', $evId)
   				    ->get();
		   		$countOffers = count($offers);
            }


            //subadministrador
            if($userEventRoleAuth[0] == 2){
            	$sponsorsV = 0;
            	$activitiesV = 0;
            	$pageV = 0;
            	$visitorsV = 0;


		   		$products = DB::table('products as PR')
		   		              ->where('PR.event_id', $evId)
		   		              ->where('PR.user_id', Auth::user()->id)
		   		              ->get();

		   		$countProducts = count($products);

		   		$offers = DB::table('sales as S')
   				    ->join('products as PR', 'PR.id', 'S.product_id')
   				    ->where('PR.user_id', Auth::user()->id)
   				    ->where('PR.event_id', $evId)
   				    ->get();
		   		$countOffers = count($offers);


            }

            if($userEventRoleAuth[0]==5){
            	$sponsorsV = 0;
            	$activitiesV = 0;
            	$pageV = 0;
            	$visitorsV = 0;
            	$speakersV = 0;
            	$hideall=1;

            }
        }



   		$sponsors = DB::table('event_web_resources')->where('event_id', $evId)->where('event_web_resource_element_id', 11)->get();
   		$countSponsors = count($sponsors);

   		/*Mi empresa*/

   		

   		//dd($sponsorsV);
   		return view('backend.admin.events.event-home-page', [
																 'countUsers' => $countUsers,
																 'countSpeakers' => $countSpeakers,
																 'countProducts' => $countProducts,
																 'countOffers' => $countOffers,
																 'countActivities' => $countActivities,
																 'countSponsors' => $countSponsors,
																 'countVisitors' => $countVisitors,
																 'countPreRegisters' => $countPreRegisters,
																 'countEventRegisters' => $countEventRegisters,
																 'eventLocation' => $eventLocation,
   															 	 'eventDateFull' => $eventDateFull,
	   															 'eventHourStart' => $eventHourStart,
	   															 'eventHourFinish' => $eventHourFinish,
	   															 'eventDateFullFinish' => $eventDateFullFinish,
	   															 'eventId' => $evId,
	   															 'sponsorsV' => $sponsorsV,
	   															 'activitiesV' => $activitiesV,
	   															 'speakersV' => $speakersV,
	   															 'pageV' => $pageV,
	   															 'visitorsV' => $visitorsV,
	   															 'hideall' => $hideall,
	   															 'eventPic' => $eventData[0]->ePict,
	   															 'eventPictureUrl' => $eventTopImg,
	   															 'eventLogoUrl' => $eventLogoImg,
	   															 'eventLogo' => $eventData[0]->eLogo,
	   															 'invitationPicture' => $invitationPicture,
	   															 'eventUrl' => $eventUrl,
	   															 'eventType' => $eventType,
	   															 'eventAdminStatus' => $eventAdminStatus,
	   															 'userEventRoleAuth' => $userEventRoleAuth[0]

   															  ]);
   }


   /*
   * get Events list for badge
   */

   public function getEventsForBadgeView(){



   	    $utypes = array(1,2);


   		// get events by user Admin

 ; 		$events = Event::from('events as EV')
   						 ->join('user_events as UE', 'UE.event_id', 'EV.id')
   						 ->where('UE.user_id', Auth::user()->id)
   						 ->whereIn('UE.user_type_id', $utypes)
   						 ->get();

   		//dd($events);
   		return view('backend.admin.badges.event-list', ['events' => $events]);

   }


   /*
   * view for scan QR Code
   */

   public function getCodeScanView($id){

   	return view('backend.admin.badges.scan-code', ['eventId' => $id]);

   }

   /*
   * get data by QRCOde scanned
   */

   public function getDataScanned($code, $evId){



   	$userData = User::from('users as U')
   				 	->join('user_events as UE', 'UE.user_id', 'U.id')
   				 	->where('U.id', $code)
   					->get();




   	$result = [
   			'status' => 'success',
   	        'code' => $code,
   			'uFname' => $userData[0]->userFirstName,
   			'uLname' => $userData[0]->userLastName,
   			'uAddress' => $userData[0]->userAddress,
   			'uPhone' => $userData[0]->userPhoneNumber,
   			'uEmail' => $userData[0]->userEmail
   			];

   	return json_encode($result);
   }



   public function sendEmail(Request $data){

   		$dataSent = array();
   		$mailRecipients = User::whereIn('id', $data->Recipients)->get();

   		$mailData = array();
   		$emails = array();







   		$mailData['emailBody'] = $data->Body;
   		$mailSubject = $data->Subject;


   		foreach ($mailRecipients as $email) {

   			$mailData['fullname'] = $email->userFirstName . ' ' . $email->userLastName;

            Mail::send('emails.my-users-mail', $mailData, function($message) use($mailData, $email, $mailSubject){
               $message->to($email->userEmail, 'Net Working App');
               $message->subject($mailSubject);
               $message->from('nuntechs@gmail.com', 'Nun Technologies Test');
            });
        }

        $notificationFrom = DB::table('user_events')->where('user_id',Auth::user()->id )->pluck('id');
        $nId=time();
		$notification = new EmailNotification();
		$notification->id = $nId;
		$notification->emailNotificationFrom = $notificationFrom[0];
		$notification->emailNotificationTitle = $mailSubject;
		$notification->emailNotificationBody = $data->Body;
		$notification->isSent = 1;
		$notification->save();

		$sent = EmailNotification::where('id', $nId)->pluck('created_at');


		/*Save notificaction recipients*/
		foreach ($data->Recipients as $mailTo) {
			$notificationTo = DB::table('user_events')->where('user_id', (int)$mailTo )->pluck('id');

			$recipient = new EmailNotificationRecipient();
			$recipient->id = mt_rand();
			$recipient->email_notification_id = $nId;
			$recipient->user_event_id = $notificationTo[0];
			$recipient->save();
		}


		$stringRecipients = '';
		$c=0;
		$comma ='';
		foreach ($mailRecipients as $mrecipient) {
			if($c>0){
				$comma = ', ';
			}
			$stringRecipients .= $comma . $mrecipient['userEmail'];
			$c++;
		}

		$dataSent = ['notId'=> $nId ,'date'=> date('d/m/Y h:i A', strtotime($sent[0])), 'mails' => $stringRecipients, 'subject' => $mailSubject, 'message' => $data->Body ];


   	   return response()->json($dataSent);
   }


   /*
   * delete email
   */
	public function deleteEmail($mailId){
		$result = array();

		try{


			$recipientDelete = EmailNotificationRecipient::where('email_notification_id', $mailId)->delete();
			$mailDelete = EmailNotification::where('id', $mailId)->delete();

			$result = ['status'=> 'success', 'message' => 'Se ha eliminado el correo con éxito'];
		} catch(exception $e){

			$result = ['status' => 'error', 'message' => $e->getMessage()];
		}

   	return response()->json($result);

   }


   /*
   * View for full users admin for search
   */

   public function getFullUsersSeacrh(Request $data){

   		$eventId = $data->eventId;
   		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        $tableHeaderText = 'Mostrando 15 visitantes de ';

        //Mostrar los usuarios segun el tipo de  ususario logueado
        $permissions="";

        /*
        *  Permissions
        *  1: access to all functions in event (supera admins, full admins, admins(event owner))
        *  2: subadmin
        *  3: sellers and speakers (Create products, offers, generate badge)
        */


        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1 ){

            $permissions = 1;
            $typeName = 'Administrador';
        }
        else if($roleAuth[0] == 3){
            //subadmin
            if($userEventRoleAuth[0] ==2){
                $permissions = 2;
                $typeName = 'Subadministrador';
            }
            //sellers, speakers
            else if($userEventRoleAuth[0] == 3){
                $permissions = 3;
                $typeName = 'Representante';
            }
            else if($userEventRoleAuth[0] == 4){
                $permissions = 3;
                $typeName = 'Conferencista';
            }
            else if($userEventRoleAuth[0] == 5){
                $permissions = 5;
                $typeName = 'Visitante';
            }
        }








  		$textFilter = $data->searchParams;
  		//dd($textFilter);

   		$eventInfo = DB::table('events')->where('id', $eventId)->get();


        $eventAdminStatus = $eventInfo[0]->event_open_for_admin;

   		$eventName = $eventInfo[0]->eventName;

		$userTypes = DB::table('user_types as UT')
	                ->where('UT.id', '!=', 5)
	                ->orderBy('UT.userTypeName', 'asc');

	    //Mostrar los usuarios segun el tipo de  ususario logueado
                           //dd($userAsigned->toSql());

        // user_role = super administrador, full administrador o user_type = Administrador
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            //$userAsigned = $userAsigned->get();
            $userTypes = $userTypes->get();
        }
        // user_role = basico
        else if($roleAuth[0] == 3){
            //user_type = subadmin(2)
            if($userEventRoleAuth[0] == 2){
                //filter access and types for create
                //$userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->get();
                //filter for create spakers (Conferencistas) and sellers (Representantes)
                $userTypes = $userTypes->where('UT.id', '!=', 1)->where('UT.id', '!=', 2)->get();
            }
        }

   		 $userAsigned = User::from( 'users as U' )
	       ->join('user_events as UE', 'UE.user_id', 'U.id')
	       ->join('events as EV', 'EV.id', 'UE.event_id')
	       ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
	       ->where('EV.id', $eventId)
	       ->where('UE.user_id', '!=', Auth::user()->id)
	       ->where('UE.user_type_id', '=', 5)
	       ->whereNull('UE.deleted_at')
	       ->select([\DB::raw('UE.id as ASIGID, U.id as ID, U.userFirstName as FIRSTNAME, U.userLastName as LASTNAME, U.userEmail as EMAIL,  UT.userTypeName as TYPENAME, UT.id as TYPEID,U.userPicture as PICTURE,
	           CASE
	               WHEN (UE.company_id IS NOT NULL)

	               THEN (Select C.companyName from companies as C where C.id = UE.company_id)

	               ELSE "Sin Especificar"
	            END AS COMPANY')])
	       ->where(function ($query)  use ($textFilter){
                                 $query->where('U.userEmail',  'like', '%' . $textFilter . '%')
                                 ->orWhere('U.userFirstName',  'like', '%' . $textFilter . '%')
                                 ->orWhere('U.userLastName',  'like', '%' . $textFilter . '%')
                                 ->orWhereRaw('(CONCAT(U.userFirstName, " ", U.userLastName ) like "%' . $textFilter . '%")')
                                 ->orWhereRaw('(CONCAT(U.userLastName, " ", U.userFirstName ) like "%' . $textFilter . '%")');
                             })
	       ->orderBy('UE.created_at', 'desc');

	       $countAllUsers = count($userAsigned->get());

	       //dd($countAllUsers);

	       if($data->searchParams != null){
	       		$countUsers = $countAllUsers;
	       		$userAsigned = $userAsigned->paginate(15);

	       		$tableHeaderText = 'Se han encontrado '. $countUsers . ' visitantes';
	       }
	       else{

	       	 $userAsigned = $userAsigned->take(15)->get();
	       	 $countUsers = 15;
	       	 if($countAllUsers < $countUsers){
	       	 	$tableHeaderText = 'Mostrando ' . $countAllUsers . ' visitantes de ' . $countAllUsers;
	       	 }
	       	 else{
				$tableHeaderText .= $countAllUsers;
			}
	       }





	        $companies = DB::table('companies as C')
                       ->where('C.event_id', $eventId)
                       ->select('C.id', 'C.companyName')
                       ->get();


   		return view('backend.admin.users.full-visitors-admin', ['eventName' => $eventName, 'userAsigned' => $userAsigned, 'eventId' => $eventId, 'companies' => $companies, 'uTypes' => $userTypes, 'countUsers' => $countUsers, 'countAllUsers' => $countAllUsers, 'permissions' => $permissions, 'tableHeaderText' => $tableHeaderText, 'eventAdminStatus' => $eventAdminStatus ]);

   }

   /*
   * get view for full users admin
   */

   public function getFullUsersAdmin(Request $data, $eventId){

   		
   		$permissionsFilter = $data->permissionsFilter;
        $eventId = $data->eventId;
        $textFilter = $data->searchParams;
        //Roles principales
      /*  $roleAuth = User::from('users as U')
                        ->join('user_roles as UR', 'UR.user_id', 'U.id')
                        ->where('U.id', Auth::user()->id)
                        ->pluck('UR.role_id');

        //Roles sobre evento
        $userEventRoleAuth = User::from('users as U')
                                 ->join('user_events as UE', 'UE.user_id', 'U.id')
                                 ->where('U.id', Auth::user()->id)
                                 ->where('UE.event_id', $eventId)
                                 ->pluck('UE.user_type_id');
        //dd($userEventRoleAuth[0]);
        */
		$eventInfo = DB::table('events')->where('id', $eventId)->get();

   		$eventName = $eventInfo[0]->eventName;

   		$eventAdminStatus = $eventInfo[0]->event_open_for_admin;

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        //dd($userEventRoleAuth[0]);





        //Mostrar los usuarios segun el tipo de  ususario logueado
        $permissions="";

        /*
        *  Permissions
        *  1: access to all functions in event (supera admins, full admins, admins(event owner))
        *  2: subadmin
        *  3: sellers and speakers (Create products, offers, generate badge)
        */


        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1 ){

            $permissions = 1;
            $typeName = 'Administrador';
        }
        else if($roleAuth[0] == 3){
            //subadmin
            if($userEventRoleAuth[0] ==2){
                $permissions = 2;
                $typeName = 'Subadministrador';
            }
            //sellers, speakers
            else if($userEventRoleAuth[0] == 3){
                $permissions = 3;
                $typeName = 'Representante';
            }
            else if($userEventRoleAuth[0] == 4){
                $permissions = 3;
                $typeName = 'Conferencista';
            }
            else if($userEventRoleAuth[0] == 5){
                $permissions = 5;
                $typeName = 'Visitante';
            }
        }

        $userTypes = DB::table('user_types as UT')
                        ->where('UT.id', '!=', 5)
                        ->orderBy('UT.userTypeName', 'asc');
			//	dd(Auth::user()->id);
        $userAsigned = User::from( 'users as U' )
                           ->join('user_events as UE', 'UE.user_id', 'U.id')
                           ->join('events as EV', 'EV.id', 'UE.event_id')
                           ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
													 ->leftJoin('companies', function($join) {
														  $join->on('UE.company_id', '=', 'companies.id');
														})
                           ->where('EV.id', $eventId)
                           ->where('UE.user_id', '!=', Auth::user()->id)
                           ->where('UE.user_type_id', '!=', 5)
                           ->whereNull('UE.deleted_at')
                           ->select([\DB::raw('UE.id as ASIGID, U.id as ID, U.userFirstName as FIRSTNAME, U.userLastName as LASTNAME, U.userEmail as EMAIL,  UT.userTypeName as TYPENAME, UT.id as TYPEID,U.userPicture as PICTURE,
                               CASE
                                   WHEN (UE.company_id IS NOT NULL)

                                   THEN (Select C.companyName from companies as C where C.id = UE.company_id)

                                   ELSE "Sin Especificar"
                                END  as "COMPANY", companies.companyName as CompanyName')])
                           ->where(function ($query)  use ($textFilter){
                                 $query->where('U.userEmail',  'like', '%' . $textFilter . '%')
                                 ->orWhere('U.userFirstName',  'like', '%' . $textFilter . '%')
                                 ->orWhere('U.userLastName',  'like', '%' . $textFilter . '%')

                                 ->orWhereRaw('(CONCAT(U.userFirstName, " ", U.userLastName ) like "%' . $textFilter . '%")')
                                 ->orWhereRaw('(CONCAT(U.userLastName, " ", U.userFirstName ) like "%' . $textFilter . '%")')

																 ->orWhere('companies.companyName', 'like',  '%' . $textFilter . '%')
																 ->orWhereRaw('"COMPANY" like  "%' . $textFilter . '%"');
                             })
														  //->orWhere(function ($newquery)  use ($textFilter){
																 //$words = explode(' ', $textFilter);

																		 //$newquery->orWhereRaw('"COMPANY" like "%'. $textFilter . '%"');
																	//	 dd($word);


																 //$query->whereRaw('("COMPANY" like "%' . $textFilter . '%")');
														//	})
                           ->orderBy('U.userFirstName', 'asc')
													 ->orderBy('COMPANY', 'asc');

													 //dd($userAsigned->take(20)->get());
        

        if($permissionsFilter != 0)
        {
        	$userAsigned = $userAsigned->where('UE.user_type_id', $permissionsFilter);
        }
        else{
        	$permissionsFilter = 0;
        }

         $countAllUsers = count($userAsigned->get());

         //dd($userAsigned->get());

        //Mostrar los usuarios segun el tipo de  ususario logueado
                           //dd($userAsigned->toSql());

        // user_role = super administrador, full administrador o user_type = Administrador
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){


            $userTypes = $userTypes->get();
            if($data->searchParams != null){
	       	$userAsigned = $userAsigned->paginate(15);
	       	$countUsers = count($userAsigned);
	       }
	       else{

	       	// $userAsigned = $userAsigned->take(15)->get();
					 $userAsigned = $userAsigned->paginate(15);
	       	 $countUsers = 15;

	       }
        }
        // user_role = basico
        else if($roleAuth[0] == 3){
            //user_type = subadmin(2)
            if($userEventRoleAuth[0] == 2){
                //filter access and types for create
               // $userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->get();
                if($data->searchParams != null){
		       	$userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->paginate(15);
		       	$countUsers = count($userAsigned);
		       }
		       else{

		       	// $userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->take(15)->get();
						 $userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->paginate(15);
		       	 $countUsers = 15;

		       }
                //filter for create spakers (Conferencistas) and sellers (Representantes)
                $userTypes = $userTypes->where('UT.id', '!=', 1)->where('UT.id', '!=', 2)->get();
            }
        }


        //get companies from events

        $companies = DB::table('companies as C')
                       ->where('C.event_id', $eventId)
                       ->select('C.id', 'C.companyName')
                       ->orderBy('C.companyName')
                       ->get();
       // dd($roleAuth[0] . '  ' . $userEventRoleAuth[0]);
                       //dd($eventId);
        return view('backend.admin.users.full-users-admin', ['userAsigned'=> $userAsigned, 'uTypes' => $userTypes, 'companies' => $companies, 'eventId' => $eventId, 'eventName' => $eventName, 'permissions' => $permissions, 'countUsers'=>$countUsers, 'eventAdminStatus' => $eventAdminStatus, 'permissionsFilter' => $permissionsFilter, 'filter' => $textFilter]);

   }

   public function getFullSuperAdmin(){



   		$superAdmins = User::from('users as u')
   		                   ->join('user_roles as r', 'r.user_id', 'u.id')
   		                   ->join('roles as ro', 'ro.id', 'r.role_id')
   		                   ->where('r.role_id', 1)
   		                   ->select([\DB::raw('u.id as ID, u.userFirstName as FIRSTNAME, u.userLastName as LASTNAME, u.userEmail as EMAIL, ro.roleName as Role')])
   		                   ->get();

   		//dd($superAdmins);
   		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

   		if($roleAuth[0] == 1  || $roleAuth[0] == 2 ){

            $permissions = 1;
            $typeName = 'Administrador';
        }
        else if($roleAuth[0] == 3){
            //subadmin
           return redirect('admin/home');
        }

   		return view('backend.admin.users.full-super-users-admin', ['users'=> $superAdmins,   'permissions' => $permissions]);


   }


   public function restoreToDefaultPassword(Request $request){

   		$stt =null;
   		try{
   			 $getData = DB::table('users')->where('id', $request->id)->get();

            if(count($getData) > 0){

                DB::table('users')
                ->where('id', $request->id)
                ->update([ 'userPassword' => bcrypt('Net@1234') ]);


                $stt = 'updated';
            }
            else{
                $stt = 'not-found';
            }

   			$result = ['status' => $stt, 'message'=>'Contraseña reestablecida con éxito', 'changed'=>count($getData)];

   		} catch(exception $e){

   			$result = ['status'=>'error', 'message'=>$e->getMessage()];
   		}


   	return json_encode($result);

   }

}
