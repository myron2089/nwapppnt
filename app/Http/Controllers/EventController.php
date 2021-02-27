<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Event;
use App\UserEvent;
use App\EventLocation;
use App\EventType;
use App\Permission;
use Mail;
use App\User;
use App\UserRole;
use App\Sale;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\FormSection;
use App\Company;
use App\CompanyForm;
use App\FormSectionFieldAnswer;
use App\Http\Controllers\UserController;
use App\UserBadge;
use Image;
use Illuminate\Support\Facades\Input;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use App\Code;
use SimpleXMLElement;

class EventController extends Controller
{




    /*
    * Get data for specific event
    */

    public function getEventData($eventId){
        
        $eventData =  Event::where('id', $eventId)->get();  

        return $eventData; 
    }


    /*
    * Get create event page view
    */



    public function getCreateEventView(){
        $userId = Auth::user()->id;
        $eventTypes = DB::table('event_types')->orderBy('eventTypeName', 'asc')->get();
        $currencies = DB::table('payment_currencies')->orderBy('id', 'asc')->get();
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $permission = 0;

        if($roleAuth[0]==1){

            $permission=1;
        }
        return view('backend.admin.events.create-event', ['eventTypes'=> $eventTypes,
                                                          'userId' => $userId,
                                                          'currencies'=> $currencies,
                                                          'permissions' => $permission ] );
    }




    /*
    # check event name
    */

    public function checkEventName(Request $data){

        $checkName = Event::where('eventName', $data->evName)->get();
        $count = count($checkName);

        $result = ['status'=> 'available', 'eventName'=> $data->evName, 'found' => $count];

        return json_encode($result);

    }


    /*
    * event store
    */

    public function storeEvent(Request $data){
        $data = $data->all();
        $result = array();
        $eventId= mt_rand();

        try
        {
            $evLocation = new EventLocation();
            $evLocation->id = $eventId;
            $evLocation->eventLocationName = $data['eventPlace'];
            $evLocation->eventLocationAddress = $data['eventAddress'];
            $evLocation->save();


            $event = new Event();
            $event->id = $eventId;
            $event->eventName = $data['eventName'];
            $event->eventDescription = $data['eventDescription'];
            $event->event_type_id = $data['eventType'];
            $event->eventStart = date('Y-m-d H:i:s', strtotime($data['eventDateStart'] . ' ' . $data['eventTimeStart']));
            $event->eventFinish = date('Y-m-d H:i:s', strtotime($data['eventDateEnd'] . ' ' . $data['eventTimeEnd']));
            $event->eventPrice = $data['eventPrice'];
            $event->payment_currency_id = $data['eventCurrency'];
            $event->event_location_id = $eventId;
            $event->event_status_id = 1;
            $event->eventUrl = $data['eventUrlStore'];
            $event->save();

            $userEvent = new UserEvent();
            $userEvent->id = mt_rand();
            $userEvent->user_id = $data['uId'];
            $userEvent->event_id = $eventId;
            $userEvent->user_type_id = 1;
            $userEvent->role_id = 2;
            $userEvent->save();

            $code = Code::where('id', $data['eventCode'])->update(['codeStatus'=>0]);
            

            $result = ['status'=>'success', 'message'=>'Evento creado con éxito', 'evId' => $eventId];
        } catch(exception $e){
        
        $result = ['status'=>'error', 'message'=> $e->getMessage()];

        }

        return json_encode($result);
    }


    /*
    # Get event edit data view (ajax)
    */

    public function getEventEditDataView(Request $request, $evId){

        $eventData = Event::from('events as E')
                          ->join('event_types as ET', 'ET.id', 'E.event_type_id')
                          ->where('E.id', $evId) 
                          ->select([\DB::raw('E.id AS ID, E.eventName as NAME, CONCAT(E.eventPicturePath,"/",E.eventPicture) as PICTURE, DATE_FORMAT(E.eventStart, "%Y-%m-%d")  
                                              AS DATESTART, DATE_FORMAT(E.eventStart, "%T")  AS TIMESTART,  DATE_FORMAT(E.eventFinish, "%Y-%m-%d")  AS DATEFINISH, 
                                              DATE_FORMAT(E.eventFinish, "%T")  AS TIMEFINISH, LOWER(ET.eventTypeName) AS BASEURL,  E.eventUrl as URL, event_type_id as EVENTTYPE, 
                                              (CASE WHEN E.eventLogo is not null THEN CONCAT("images/events/logos/", E.eventLogo) ELSE "images/icons/productAvatar.png" END) as logoUrl,
                                              E.payment_currency_id as CURRENCY, E.eventPrice as PRICE')])
                        ->get();

        $eventTypes = EventType::select('id as ID', 'eventTypeName as NAME')->get();

      //  dd($eventData);
        return view('backend.admin.events.event-data-edit', ['eventData' => $eventData, 'eventId' => $evId, 'eventTypes' => $eventTypes]);
    }


    /*
    # editar los datos del evento
    */

    public function storeEventEditData(Request $request){

        $data = $request->all();
        $logo = 0;
        $logoUpdated = 0;
        $pictureUpdated = 0;


        try{

            $oldLogoName = Event::where('id', $data['evId'])->pluck('eventLogo');
            $logoName = $oldLogoName[0];
            
            $oldImageName = Event::where('id', $data['evId'])->pluck('eventPicture');
            $imageName = $oldImageName[0];


            //Actualizar el logo
            if ($request->hasFile('eventLogo')) {
                $picture_path = "images/events/logos";

                $picId = mt_rand();
                $logoFile = $request->file('eventLogo');
                $extension = $logoFile->getClientOriginalExtension();
                $filename = $picId . '.' .$extension;

                //$result = $imageFile->move($picture_path, $filename);
                    
                $imgurl = public_path($picture_path .'/' . $filename);
                $image = Image::make($logoFile->getRealPath());
                $image->save($imgurl);

                $logoName = $filename;
            }
            //Actualizar imagen principal del evento
            if($request->hasFile('eventImage')){

                $picture_path = "images/events/previews";

                $picId = mt_rand();
                $logoFile = $request->file('eventImage');
                $extension = $logoFile->getClientOriginalExtension();
                $filename = $picId . '.' .$extension;

                //$result = $imageFile->move($picture_path, $filename);
                    
                $imgurl = public_path($picture_path .'/' . $filename);
                $image = Image::make($logoFile->getRealPath());
                $image->save($imgurl);

                $imageName = $filename;


                $pictureChanged = 1;
            }


            $update = Event::where('id', $data['evId'])
                           ->update(['eventLogo' => $logoName, 'eventPicture' => $imageName,
                                     'eventStart' => date('Y-m-d H:i:s', strtotime($data['eventDateStart'] . ' ' . $data['eventTimeStart'])),
                                     'eventFinish' => date('Y-m-d H:i:s', strtotime($data['eventDateEnd'] . ' ' . $data['eventTimeEnd'])),
                                     'event_type_id' => $data['eventType'], 'eventPrice' => $data['eventPrice'], 'payment_currency_id' => $data['eventCurrency']
                                    ]);

            $result = ['status' => 'success', 'message' => 'Datos del evento actualizados correctamente'];

        } catch(exception $e){



            $result = ['status' => 'error', 'message' => $e->getMessage()];

        }


        return json_encode($result);

    }




    /*
    * event list for specific user (admin)
    */

    public function getEventListView(){
        $uId = \Auth::user()->id;
        $userRole = UserRole::where('user_id', $uId)
                         ->pluck('role_id');


        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        //$userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        $title = 'Mis eventos';

       /* $userEvents = Event::from( 'events as EV' )
                           ->join('user_events as UE', 'UE.event_id', '=', 'EV.id')
                           ->join('event_locations as EL', 'EL.id', '=', 'EV.event_location_id')
                           ->where('UE.user_id', $uId)
                           ->paginate(8);
        */
        /* $userEvents = Event::from('events as E')->select([\DB::raw('E.id as eventId, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as FULLDESCRIPTION, E.eventUrl as URL,
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
                            ->join('event_types as ET', 'ET.id', 'E.event_type_id')->orderBy('eventStart' , 'asc')
                            ->join('user_events as UE', 'UE.event_id', '=', 'E.id')
                            ->where('UE.user_id', $uId)
                            ->paginate(8);

        */
        $userEvents = Event::getAllEventData();
        $userFinishedEvents = Event::getAllEventData();

        if($roleAuth[0]==3){

            $userEvents = $userEvents->join('user_events as UE', 'UE.event_id', '=', 'EV.id')->where('UE.user_id', $uId)->where('event_status_id', 1)->paginate(8);
        }
        else{
            $userEvents = $userEvents->where('event_status_id', 1)->paginate(8);   
        }
        
        $countEvents = count($userEvents);

        return view('backend.admin.events.events-list', ['myEvents' => $userEvents,
                                                         'roleEvent' => $userRole[0],
                                                         'title' => $title, 'countEvents' => $countEvents,
                                                         'roleAuth' => $roleAuth[0],
                                                         'type' => 'cards']);
    }


    /*Listado de eventos con opciones avanazadas*/
    public function getEventAdvancedListView(){

         $uId = \Auth::user()->id;
        $userRole = UserRole::where('user_id', $uId)
                         ->pluck('role_id');


        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        //$userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        $title = 'Mis eventos';

        $userEvents = Event::getAllEventData();

        if($roleAuth[0]==3){

            $userEvents = $userEvents->join('user_events as UE', 'UE.event_id', '=', 'EV.id')->where('UE.user_id', $uId)->paginate(8);
        }
        else{
            $userEvents = $userEvents->paginate(8);   
        }
        

       // dd($userEvents);
        $countEvents = count($userEvents);

        return view('backend.admin.events.events-list', ['myEvents' => $userEvents,
                                                         'roleEvent' => $userRole[0],
                                                         'roleAuth' => $roleAuth[0],
                                                         'title' => $title, 'countEvents' => $countEvents,
                                                         'type' => 'advanced']);

    }

    /*
    ** Obtener eventos según usuario logueado para datatables
    */
    public function getEventsByUserRole(){
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $events = Event::getAllEventData();

        if($roleAuth[0] > 2){

            $events=$events->join('user_events as UE', 'UE.event_id', '=', 'EV.id')->where('UE.user_id', $uId);
        }

         return datatables()->of($events)
                            ->filterColumn('NAME', function($query, $keyword) {
                                $sql = 'eventName  like ?';
                                $query->whereRaw($sql, ["%{$keyword}%"]);
                            })
                            ->toJson();


    }


    /*
    ** Cambiar el estado del evento para la visualizacion en la parte pública
    */

    public function changeEventStatus(Request $request){

        try{
            $newStatus=1;
            $newStatusText="Activo";

            if($request->eventStatus==1){
                $newStatus=2;
                $newStatusText="Inactivo";
            }


            $event = Event::where('id',$request->eventId)->update([                            
                            'event_status_id' => $newStatus]);
             $data = ['status' => 'success', 'message' => 'Se ha actualizado el estado del evento con éxito.', 'newStatusId'=> $newStatus, 'newStatusText' => $newStatusText];

        }catch(exception $e){
            $data = ['status' => 'error', 'message' => $e->Message()];
             
        }

       

        return json_encode($data);


    }

    /*
    ** Cambiar el estado del evento para su administracion
    */

    public function changeEventAdminStatus(Request $request){


        //return $request->all();
        try{
            $newStatus=1;
            $newStatusText="Abierto";

            if($request->eventStatus==1){
                $newStatus=0;
                $newStatusText="Cerrado";
            }


            $event = Event::where('id',$request->eventId)->update([                            
                            'event_open_for_admin' => $newStatus]);

            $data = ['status' => 'success', 'message' => 'Se ha actualizado el estado del evento con éxito.', 'newStatusId'=> $newStatus, 'newStatusText' => $newStatusText];

        }catch(exception $e){
            $data = ['status' => 'error', 'message' => $e->Message()];
             
        }

       

        return json_encode($data);


    }


   

    /*
    * Get asigned users to current event (session variable)
    */
     public function getAdminEventUsersPageView($evId){


         

          $eventId = $evId;
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
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        //dd($userEventRoleAuth[0]);                         


      

        $userTypes = DB::table('user_types as UT')
                        ->where('UT.id', '!=', 5)
                        ->orderBy('UT.userTypeName', 'asc');

        $userAsigned = User::from( 'users as U' )
                           ->join('user_events as UE', 'UE.user_id', 'U.id')
                           ->join('events as EV', 'EV.id', 'UE.event_id')
                           ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
                           ->where('EV.id', $eventId)
                           ->where('UE.user_id', '!=', Auth::user()->id)
                           ->where('UE.user_type_id', '!=', 5)
                           ->whereNull('UE.deleted_at')
                           ->select([\DB::raw('UE.id as ASIGID, U.id as ID, U.userFirstName as FIRSTNAME, U.userLastName as LASTNAME, U.userEmail as EMAIL,  UT.userTypeName as TYPENAME, UT.id as TYPEID,U.userPicture as PICTURE,
                               CASE 
                                   WHEN (UE.company_id IS NOT NULL)

                                   THEN (Select C.companyName from companies as C where C.id = UE.company_id)

                                   ELSE "Sin Especificar"
                                END AS COMPANY')])
                           ->orderBy('UE.created_at', 'asc');

        //Mostrar los usuarios segun el tipo de  ususario logueado
                           //dd($userAsigned->toSql());
        
        // user_role = super administrador, full administrador o user_type = Administrador
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            $userAsigned = $userAsigned->get();
            $userTypes = $userTypes->get();
        }
        // user_role = basico
        else if($roleAuth[0] == 3){
            //user_type = subadmin(2)
            if($userEventRoleAuth[0] == 2){
                //filter access and types for create
                $userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->get();
                //filter for create spakers (Conferencistas) and sellers (Representantes)
                $userTypes = $userTypes->where('UT.id', '!=', 1)->where('UT.id', '!=', 2)->get();
            }
        }


        //get companies from events

        $companies = DB::table('companies as C')
                       ->where('C.event_id', $eventId)
                       ->select('C.id', 'C.companyName')
                       ->get();
       // dd($roleAuth[0] . '  ' . $userEventRoleAuth[0]);
                       //dd($eventId);
        return view('backend.expositor.users-admin', ['userAsigned'=> $userAsigned, 'uTypes' => $userTypes, 'companies' => $companies, 'eventId' => $eventId]);
    }

    /*
    * Store user and asign to event
    */

    public function userStore(Request $request){


       //    return $request->userCompany;
        $eventId = $request->eventId;
        $result= array();
        $msg;

        $imgurl = null;
        $filename="";
        $picture_path = "";
        $userCompanyName = "Sin Especificar";

        $pId = mt_rand();

        $userPhone = $request->userPhone;

        if($request->userPhone != null){
            $userPhone = preg_replace('/[^0-9]/','',$request->userPhone);
        }

            $picture_path = 'images/users/profiles/';
            if ($request->hasFile('userProfileImage')) {
                $imageFile = $request->file('userProfileImage');
                $extension = $imageFile->getClientOriginalExtension();
                $filename = $pId . '.' . $extension;
              
               // $result = $imageFile->move($picture_path, $filename);
                
                $imgurl = public_path($picture_path .'/' .  $filename);
               // return $imgurl;
                $image = Image::make($imageFile->getRealPath());
                $image->save($imgurl);


               // $imgurl = url($picture_path . $filename);
            }


            if (strlen($filename)==0){
                $filename="noPicture.png";
            }
            //return json_encode($filename);
        // 1 stored,
        /*check if user exists*/ 
            
                if($request->action==1)
                {

                    //Check if user exists in current event
                        $uEventCheck = UserEvent::from('user_events as UE')
                                                ->join('users as U', 'U.id', 'UE.user_id')
                                                ->where('U.userEmail', $request->userMail)
                                                ->where('UE.event_id', $eventId)
                                                ->get();
                        //If user exists in curr event

                        //return $uEventCheck;
                        if(count($uEventCheck) > 0){

                             $result = ['status'=> 'ueexists', 'msg' => 'El usuario con el correo que desea registrar ya existe en este evento',
                                   'uId' =>     $uEventCheck[0]->id,
                                   'uMail'       => $request->userMail, 
                                    'uFName'     => $uEventCheck[0]->userFirstName,
                                    'uLName'     => $uEventCheck[0]->userLastName,

                                    'uPic'       => "images/users/profiles/".$uEventCheck[0]->userPicture,
                                    'eventId' => $eventId];

                        }
                        else {
                            $uCheck = User::where('userEmail', $request->userMail)->get();
                            if(count($uCheck) <= 0){

                                $userPass = bcrypt('Net@1234'); //Es necesario cambiar
                                try{
                                    $userId = mt_rand();
                                    $user = new User;
                                    $user->id = $userId;
                                    $user->userFirstName = $request->userFirstName;
                                    $user->userLastName = $request->userLastName;
                                    $user->userEmail = $request->userMail;
                                    $user->userPassword = $userPass;
                                    $user->userPhoneNumber = $userPhone;
                                    $user->userBirthDay = date('Y-m-d', strtotime($request->userDob));
                                    $user->userAddress = $request->userAddress;
                                    $user->user_status_id = 1;
                                    $user->userPicture = $filename;
                                    $user->userCountryCode = $request->userPhoneCode;
                                    $user->save();
                                   
                                    //Assing basic role on user_roles
                                    $userRole = new UserRole();
                                    $userRole->id = mt_rand();
                                    $userRole->user_id = $userId;
                                    $userRole->role_id = 3; //Basico
                                    $userRole->save();

                                    // Assign user to event  (user_events)
                                    $userEventId= mt_rand();
                                    $userEvent = new UserEvent();
                                    $userEvent->id = $userEventId;
                                    $userEvent->user_id = $userId;
                                    $userEvent->event_id = $eventId;
                                    $userEvent->user_type_id = $request->userEventType;
                                    $userEvent->role_id = 3;
                                    $userEvent->user_owner_id = Auth::user()->id;

                                    if($request->userCompany != 0){

                                        $userEvent->company_id = $request->userCompany;
                                        $userCompanyName = DB::table('companies')->where('id', $request->userCompany)->pluck('companyName');
                                        $userCompanyName = $userCompanyName[0];
                                    }else{

                                        $userCompanyName = '.';
                                    }
                                    $userEvent->save();

                                    $uData = DB::table('users')->where('id', $userId)->get();

                                    $userPic = $uData[0]->userPicture;
                                    //Select the user_type asigned
                                    $userType = DB::table('user_types')->where('id', $request->userEventType)->pluck('userTypeName');
                                   

                                    $eventData = Event::where('id', $eventId)->get();
                                   
                                    $badge = new UserBadge();
                                    $badge->id = mt_rand();
                                    $badge->user_event_id = $userEventId;
                                    $badge->userEmail = $request->userMail;
                                    $badge->userPicturePath = 'images/users/badge';
                                    $badge->userCompanyName = $userCompanyName;
                                    $badge->userFirstName = $request->userFirstName;
                                    $badge->userLastName = $request->userLastName;
                                    $badge->userAddress = $request->userAddress;
                                    $badge->userPhoneNumber = $userPhone;
                                    $badge->userCountryCode = $request->userPhoneCode;

                                    $badge->save();
                                    
                                     //Send Message with info for login when the user is not personal de montaje 6
                                   

                                     //Descomentar al arreglar problema de correos

                                    if($request->userEventType != 6){
                                        $email = $request->userMail;
                
                                        $mailTo = $request->userFirstName . ' ' . $request->userLastName;
                                        $qr = QrCode::format('png')->size(400)->generate('USERS' . $userEventId);
                                        $mailData = ['fullname' => $mailTo, 'qr' => $qr, 'userType' => $userType[0], 'eventName' => $eventData[0]->eventName, 'userPass' => 'Net@1234', 'userEmail' => $email ];
                                        $mailSubject = 'Cuenta Registrada';
                                       
                                       Mail::send('emails.user-create', $mailData, function($message) use($mailData, $email, $mailSubject, $mailTo){
                                           $message->to($email,  $mailTo);
                                           $message->subject($mailSubject);
                                           $message->from('info@networkingapp.net', 'NetWorkingApp');
                                        });
                                    }
                                        

                                   

                                    $msg='Usuario creado con éxito';
                                    $result = [ 'status'     => 'success', 
                                            'msg'        => $msg, 
                                            'uMail'      => $request->userMail, 
                                            'uName'      => $request->userFirstName . ' ' . $request->userLastName,
                                            'uPermission'=> $userType,
                                            'uPhone'     => $request->userPhone,
                                            'uId'        => $userEventId,
                                            'uPic'       => "images/users/profiles/".$userPic,
                                            'uCompany' => $userCompanyName
                                           ];
                                }
                                catch(exception $e){
                                    $result = ['status'=> 'error', 'msg' => $e->getMessage ];
                                    return $result;
                                }
                            }
                            else{

                                $result = [
                                        'status'=> 'exists', 'msg' => 'El correo que desea registrar ya existe',
                                        'uId' =>     $uCheck[0]->id,
                                        'uMail'       => $request->userMail, 
                                        'uFName'     => $uCheck[0]->userFirstName,
                                        'uLName'     => $uCheck[0]->userLastName,
                                        'uLPhone'    => $uCheck[0]->userPhoneNumber,
                                        'uPhoneCode' => $uCheck[0]->userCountryCode,
                                        'uPic'       => "images/users/profiles/".$uCheck[0]->userPicture,
                                        'eventId' => $eventId
                                    ];
                            }
                        }  

                } else if($request->action==2){
                    $uCheck = User::where('userEmail', $request->userMail)->where('id', '=!' , $request->userId)->get();
                    //return $request->userId;
                    if(count($uCheck) <= 0){
                        try{
                            // $request->userId is (user_event) id or id
                            //Get the user id from user_events table
                            $getUser = UserEvent::where('id', $request->userId)->get();
                            $getUserData = User::where('id', $getUser[0]->user_id)->get();
                            $company_id = null;

                            $euID = $getUser[0]->user_id;
                            $upicture = $filename;
                           // return $uID;

                            if($request->pictureChanged == 0)
                            {
                                $upicture = $getUserData[0]->userPicture;
                            }   

                            //return $getUserData;

                            $user = User::where('id',$euID)->update([                            
                            'userFirstName' => $request->userFirstName,
                            'userLastName'  => $request->userLastName,
                            'userEmail' => $request->userMail,
                          
                            'userPhoneNumber' => $userPhone,
                            'userBirthDay' => date('Y-m-d', strtotime($request->userDob)),
                            'userAddress' => $request->userAddress,
                            'user_status_id' => 1,
                            'userPicture' => $upicture,
                            'userCountryCode'=> $request->userPhoneCode]);
                            
                             if($request->userCompany != 0){

                                $company_id = $request->userCompany;
                                $userCompanyName = DB::table('companies')->where('id', $request->userCompany)->pluck('companyName');
                            }


                            $userEvent = UserEvent::where('id', $request->userId)->where('user_id', $euID )
                            ->update(['user_type_id' => $request->userEventType, 'company_id' => $company_id]);

                           


                            $permissionName = DB::table('user_types')->where('id',$request->userEventType)->pluck('userTypeName');


                            $checkBadge = UserBadge::where('user_event_id', $request->userId)->get();

                            //If badge not exists, create new badge
                            if(count($checkBadge) == 0)
                            {
                                $badge = new UserBadge();
                                $badge->id = mt_rand();
                                $badge->user_event_id = $request->userId;
                                $badge->userPicturePath = 'images/users/badge';
                                $badge->userEmail = $request->userMail;
                                $badge->userCompanyName = $userCompanyName[0];
                                $badge->userFirstName = $request->userFirstName;
                                $badge->userLastName = $request->userLastName;
                                $badge->userAddress = $request->userAddress;
                                $badge->userPhoneNumber = $userPhone;
                                $badge->userCountryCode = $request->userPhoneCode;
                                $badge->save();
                            }
                            //If badge exists, update
                            else{

                                $updateBadge = UserBadge::where('user_event_id', $request->userId)
                                                        ->update(['userEmail'=>$request->userMail, 'userCompanyName' => $userCompanyName[0], 
                                                                  'userFirstName' =>$request->userFirstName, 'userLastName' => $request->userLastName, 
                                                                  'userAddress' => $request->userAddress, 'userPhoneNumber' => $request->userPhone,
                                                                  'userCountryCode' => $request->userPhoneCode ]);

                            }

                            $result = [ 'status'     => 'success', 
                                    'msg'        => 'Se ha actualizado el usuario correctamente', 
                                    'uMail'      => $request->userMail, 
                                    'uName'      => $request->userFirstName . ' ' . $request->userLastName,
                                    'uPermission'=> $permissionName[0],
                                    'uPhone'     => $request->userPhone,
                                    'uId'        => $request->userId,
                                    'uPic'       => "images/users/profiles/".$upicture,
                                    'uCompany' => $userCompanyName
                                   ];

                        } catch(exception $e){
                            $result = ['status'=> 'error',  'message' => $e->getMessage()];
                        }
                    } else{

                        $result = ['status'=> 'exists', 'msg' => 'El correo que desea registrar ya existe',
                                   'uId' =>     $uCheck[0]->id,
                                   'uMail'       => $request->userMail, 
                                    'uFName'     => $uCheck[0]->userFirstName,
                                    'uLName'     => $uCheck[0]->userLastName,
                                    'uLPhone'    => $uCheck[0]->userPhoneNumber,
                                    'uPhoneCode' => $uCheck[0]->userCountryCode,
                                    'uPic'       => "images/users/profiles/".$uCheck[0]->userPicture,
                                    'eventId' => $eventId];
                    }



                    
                 /*   $editUser= new UserController();
                    $data = $request->all();
                    $result = $editUser->userEdit($data, false);
                   */ 
                }
                
           
        

        return json_encode($result);
    }


    /*
    * asignar usuario ya creado en el evento
    */

    public function userEventAssign(Request $request){

        //return $request->all();
        $userPhone = $request->userPhone;

        if($request->userPhone != null){
            $userPhone = preg_replace('/[^0-9]/','',$request->userPhone);
        }

        try{
           // $uData = DB::table('users')->where('id', $request->userAsignedId)->get();
            $userCompanyName = 'Sin Especificar';
            $ueId = mt_rand();
            $userEvent = new UserEvent();
            $userEvent->id = $ueId;
            $userEvent->user_id = $request->userAsignedId; 
            $userEvent->event_id = $request->uAsignedEventId;
            $userEvent->user_type_id = $request->userAsignedEventType;
            $userEvent->role_id = 3;
            $userEvent->user_owner_id = Auth::user()->id;
            if($request->userAsignedCompany != 0){
                $userEvent->company_id = $request->userAsignedCompany;
                $userCompanyName = DB::table('companies')->where('id', $request->userAsignedCompany)->pluck('companyName');
            }
           
            $userEvent->save();


            $badge = new UserBadge();
            $badge->id = mt_rand();
            $badge->user_event_id = $ueId;
            $badge->userPicturePath = 'images/users/badge';
            $badge->userEmail = $request->userAsignedEmail;
            $badge->userCompanyName = $userCompanyName[0];
            $badge->userFirstName = $request->userAsignedFirstName;
            $badge->userLastName = $request->userAsignedLastName;
            $badge->userAddress = $request->userAddress;
            $badge->userPhoneNumber = $userPhone;
            $badge->userCountryCode = $request->userAsignedPhoneCode;
            $badge->save();


            $getData = User::where('id', $request['userAsignedId'])
                           ->get();
            $userPic = $getData[0]->userPicture;
            $permissionName = DB::table('user_types')->where('id',$request->userAsignedEventType)->pluck('userTypeName');


            $result = ['status'     => 'success', 
                        'msg'        => 'Se ha registrado el usuario correctamente en el evento.', 
                        'uMail'      => $getData[0]->userEmail, 
                        'uName'      => $getData[0]->userFirstName . ' ' . $getData[0]->userLastName,
                        'uPermission'=> $permissionName[0],
                        'uPhone'     => $getData[0]->userPhone,
                        'uId'        => $ueId,
                        'uPic'       => "images/users/profiles/".$userPic,
                        'uCompany'   => $userCompanyName ];

        } catch(exception $e){

            $result = ['status'=> 'error', 'msg' => 'Ha ocurrido un error al intentar registrar al usuario.'];
        }

          
        return json_encode($result);

    }


    //
	// Buscar usuarios para asignar al evento //
    public function getUsersForEvent(Request $request, $evId){
        $eventId = $evId;
      //  return $eventId;
       
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('users as U')
                     ->select([\DB::raw('U.id as ID, U.userEmail')])
                   
            		->where('U.userEmail','LIKE',"%$search%")
                    ->whereRaw('U.id NOT IN  (SELECT UE.user_id from user_events as UE where UE.event_id = ' . $eventId . ' and U.id = UE.user_id)')
            		->get();
        }

        return response()->json($data);

    }


    /*
    * Search users by Specific Event
    */

    public function getUsersFromEvent(Request $request){
        $eventId = session('eventId');

       
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('users as U')
                    ->join('user_events as UE', 'UE.user_id', 'U.id')
                    ->select('U.id', 'U.userEmail')
                    ->where('UE.event_id', $request->evId)
                    ->where('userEmail','LIKE',"%$search%")

                    ->get();
        }

        return response()->json($data);
    }



    /*
    * get visitors view
    */

    public function getVistiorsView($evId){

        /*

        $visitors = User::from( 'users as U' )
                   ->join('user_events as UE', 'UE.user_id', 'U.id')
                   ->join('events as EV', 'EV.id', 'UE.event_id')
                   ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
                   ->select('U.id as USERID','UE.id as ASIGID', 'U.userFirstName as FIRSTNAME', 'U.userLastName as LASTNAME', 'U.userEmail as EMAIL',  'UT.userTypeName as TYPENAME', 'UT.id as TYPEID', 'U.userPhoneNumber as PHONE')
                   ->where('EV.id', $evId)
                   ->where('UE.user_type_id', '=', 5)
                   ->orderBy('UE.created_at', 'asc')->get();
        */


          $eventId = $evId;
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
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        //dd($userEventRoleAuth[0]);                         


      

        $userTypes = DB::table('user_types as UT')
                        ->where('UT.id', '!=', 5)
                        ->orderBy('UT.userTypeName', 'asc');

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
                           ->orderBy('UE.created_at', 'asc');

        //Mostrar los usuarios segun el tipo de  ususario logueado
                           //dd($userAsigned->toSql());
        
        // user_role = super administrador, full administrador o user_type = Administrador
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            $userAsigned = $userAsigned->get();
            $userTypes = $userTypes->get();
        }
        // user_role = basico
        else if($roleAuth[0] == 3){
            //user_type = subadmin(2)
            if($userEventRoleAuth[0] == 2){
                //filter access and types for create
                $userAsigned = $userAsigned->where('UE.user_owner_id', Auth::user()->id)->get();
                //filter for create spakers (Conferencistas) and sellers (Representantes)
                $userTypes = $userTypes->where('UT.id', '!=', 1)->where('UT.id', '!=', 2)->get();
            }
        }


        //get companies from events

        $companies = DB::table('companies as C')
                       ->where('C.event_id', $eventId)
                       ->select('C.id', 'C.companyName')
                       ->get();
       // dd($roleAuth[0] . '  ' . $userEventRoleAuth[0]);
                       //dd($eventId);
        return view('backend.admin.visitors.visitors-admin', ['userAsigned'=> $userAsigned, 'uTypes' => $userTypes, 'companies' => $companies, 'eventId' => $eventId]);
      /*  return view('backend.admin.visitors.visitors-admin', ['visitors' => $visitors, 'eventId' => $evId]);*/

    }

    /*
    * delete event visitor
    */

    public function deleteEventVisitor($uId, $evId){

       $unasign = UserEvent::where('event_id', $evId)
                           ->where('user_id', $uId)
                           ->delete(); 

       $result = ['status'=> 'success', 'msg' => 'El visitante ha sido eliminado del Evento.'];
       return json_encode($result); 
    }



    /*
    * get offers view
    */

    public function getOffersView($evId){

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');





        $offer2 = Sale::from('sales as S')
                      ->join('products as P', 'P.id', 'S.product_id')
                      ->where('event_id', $evId)
                      ->select([\DB::raw('S.id as ID, P.productName as PRODUCT, S.saleDescription as DESCRIPTION')]);


        $offers = DB::table('sales as S')
                       ->join('products as P', 'P.id', 'S.product_id')
                       ->where('P.event_id', $evId)
                       ->where('UE.event_id', $evId)
                       ->join('payment_currencies as CR', 'CR.id', 'P.payment_currency_id')
                       ->join('users as U', 'U.id', 'P.user_id')
                       ->join('user_events as UE', 'UE.user_id', 'U.id')
                       ->leftJoin('companies as C', 'C.id', 'UE.company_id')
                       ->leftJoin('brands as B', 'B.id', 'P.brand_id')
                       ->select([\DB::raw('S.id as ID, P.id as PRODUCTID, P.productName as productName, S.saleDescription as saleDescription, P.productDescription as productDescription, P.productPrice as productPrice, CR.currencySymbol as currencySymbol, P.productPicturePath AS productPicturePath, P.productPicture AS productPicture, CONCAT(U.userFirstName, " ", U.userLastName) as USER, IF(C.companyName is not null,C.companyName, "Sin Especificar") as COMPANY, IF(B.brandName is not null, B.brandName, "Sin Especificar") as BRAND')]);




        $products = DB::table('products')->where('event_id', $evId);

         //Mostrar las ofertas segun el tipo de  ususario logueado

        //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            $offers = $offers->get();

            $products = $products->get();
        }
        //basico
        else if($roleAuth[0] == 3){

            //Sub Admin Speaker o vendedor 
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2){

                $offers = $offers->where('P.user_id', Auth::user()->id)->get();
                $products = $products->where('user_id', Auth::user()->id)->get();
            }

            
        }

        
                      

        

        return view('backend.admin.offers.offers-admin', ['offers' => $offers, 'eventId' => $evId, 'products'=>$products]);

    }

    /*
    * offer sotre
    */

    public function offerStore(Request $data){

        $sId= mt_rand();
        try{
            // 1 = create
            $userId = Auth::user()->id;

            $userData = User::where('id', $userId)->get();

            $userName = $userData[0]->userFirstName . ' ' . $userData[0]->userLastName; 
                
            $companyData = DB::table('companies as C')
                              ->join('user_events as UE', 'UE.company_id', 'C.id')
                              ->where('UE.event_id', $data['eventId'])
                              ->where('UE.user_id', $userId)
                              ->pluck('C.companyName');

            if($companyData->count() <= 0){
                $companyData = 'Sin Especificar';
            }


            $brandName = DB::table('products as P')
                             ->join('brands as B', 'B.id', 'P.brand_id')
                             ->where('P.id', $data['offerProduct'])
                             ->pluck('brandName');

            if($brandName->count() <= 0){
                $brandName = 'Sin Especificar';
            }


            if($data['action']==1){
                $sale = new Sale();
                $sale->id = $sId;
                $sale->saleDescription = $data['offerDescription'];
                $sale->product_id = $data['offerProduct'];
                $sale->save(); 

                $product = DB::table('products')
                             ->where('id', $data['offerProduct'])
                             ->pluck('productName');

                $result =['status'=>'success', 
                          'messsage' => 'Se ha guardado correctamente la oferta',
                          'oId' => $sId, 
                          'oProduct' => $product[0], 
                          'oDescription' => $data['offerDescription'],
                          'userName' => $userName,
                          'companyName' => $companyData,
                          'brandName' => $brandName
                      ];
            }
            else if ($data['action']==2){

                $sale = Sale::where('id', $data['offerId'])
                            ->update(['saleDescription' => $data['offerDescription'], 'product_id' => $data['offerProduct']]);

                
                $product = DB::table('products')
                             ->where('id', $data['offerProduct'])
                             ->pluck('productName');

                $result =['status'=>'success', 
                          'messsage' => 'Se ha actualizado correctamente la oferta',
                          'oId' => $sId, 
                          'oProduct' => $product[0], 
                          'oDescription' => $data['offerDescription'],
                          'userName' => $userName,
                          'companyName' => $companyData,
                          'brandName' => $brandName]; 
            }
        } catch(exception $e){
            $result =['status'=>'error', 'messsage' => $e->getMessage()];
        }
        return json_encode($result);
    }

    /*
    * get data for edit
    */

    public function getOfferEditData($oId){

        $offer = Sale::where('id', $oId)->get();

        $oId = $offer[0]->id;
        $oName = $offer[0]->saleDescription;
        $oProduct = $offer[0]->product_id;


        $result =['status'  =>'success', 
                      'oId'     => $oId,
                      'oDescription'=> $oName, 
                      'oProduct'   => $oProduct
                      ];
    
        return response()->json($result);
    }

    /*
    * delete offer
    */

    public function offerDelete($oId){

        try{
            $deletedRows = Sale::where('id', $oId)->delete();
            $result =['status'=>'success', 'messsage' => 'Se ha eliminado correctamente la oferta!'];
        } catch(exception $e){
            $result =['status'=>'error', 'messsage' => $e->getMessage()]; 
        }
        return response()->json($result);
    }

    /*
    * view for companies
    */

    public function getCompaniesView($evId){

        $companies = Company::where('event_id', $evId)
                            ->get();


         return view('backend.admin.companies.companies-admin', ['companies' => $companies, 'eventId' => $evId]);
    }

    /*
    * create and edit company
    */
    public function companyStore(Request $data){
        $sId= mt_rand();
        $picture_path = 'images/events/companies/logos';
        $picId = 'noCompanyPicture.png';
        $filename = 'noCompanyPicture.png';

        $companyPhone = $data['companyPhone'];

        if($data['companyPhone'] != null){
            $companyPhone = preg_replace('/[^0-9]/','',$data['companyPhone']);
        }

        $pictureChanged = 0;
        if ($data->hasFile('companyLogo')) {
            $picId = mt_rand();
            $imageFile = $data->file('companyLogo');
            $extension = $imageFile->getClientOriginalExtension();
            $filename = $picId . '.' .$extension;
              
            //$result = $imageFile->move($picture_path, $filename);
                
            $imgurl = public_path($picture_path .'/' . $filename);
            $image = Image::make($imageFile->getRealPath());
            $image->save($imgurl);

            $pictureChanged = 1;

         }
       


        try{
            // 1 = create
            if($data['action']==1){
                $company = new Company();
                $company->id = $sId;
                $company->companyName = $data['companyName'];
                $company->companyDescription = $data['companyDescription'];
                $company->companyAddress = $data['companyAddress'];
                $company->companyPhone = $companyPhone;
                $company->event_id = $data['eventId'];
                $company->companyPicturePath = $picture_path;
                $company->companyCountryCode = $data['companyCountryCode'];
                $company->companyWebSite = $data['companyWebSite'];
                $company->companyEmail = $data['companyEmail'];
                $company->companyPicture = $filename;
                $company->save(); 


                // check if dinamic fields
                if($data['countDinamicFields'] > 0){
                     //company_forms create new
                   //  $cformId = mt_rand();
                     $cform = new CompanyForm();
                     $cform->id = $sId;
                     $cform->form_id = 7; //Empresa
                     $cform->company_id = $sId;
                     $cform->save();

                      

                    foreach ($data->input() as $key => $value) {
                    //Verificar que los campos por defecto no se igresen, al agregar un campo por defecto se tendria que agregar en el if
                    if($key != '_token' && $key != 'companyName' && $key != 'companyDescription' && $key != 'companyAddress' && $key != 'companyPhone' && $key != 'userEventType' && $key != 'countDinamicFields' && $key != 'action' && $key != 'companyId' && $key != 'tableRow' && $key != 'eventId' && $key != 'companyCountryCode' && $key != 'companyWebSite' && $key != 'companyEmail'  ){
                            //Asignar el usuario al cuestianrio user_form_section_answer

                           //Traer la llave de la tabla td_asig_cuestionario para almacenarla en tm_respuesta, segun el usuario
                           /* $asigcuest= DB::table('company_forms AS ACUEST')
                                        ->where('ACUEST.form_id', 5) //VISITANTE FORM
                                        ->where('ACUEST.company_id', $sId)
                                        ->pluck('ACUEST.id');
                            */
                               //dd($asigcuest[0]);

                            $fsfId= mt_rand();
                            $fsec = new FormSectionFieldAnswer();
                            $fsec->id = $fsfId;
                            $fsec->answerValue = $value;
                            $fsec->form_section_field_id = $key;
                            $fsec->user_form_section_answer_id = null;
                            $fsec->company_form_id = $sId;
                            $fsec->save();
                        

                        } // end if
                    } // end foreach
                } // en if dinamicFields
                 if($data['companyAddress']==null){
                    $data['companyAddress'] = 'Sin especificar';
                }

                
                $imgurl = url($picture_path .'/' . $filename );

                if($companyPhone==null){
                    $companyPhone = '';
                }

                $result =['status'=>'success', 'messsage' => 'Se ha guardado correctamente la empresa',
                          'cId' => $sId, 'cName' => $data['companyName'], 'cDescription' => $data['companyDescription'], 'cAddress' => $data['companyAddress'], 'cPhone' => $data['companyCountryCode'] . ' ' . $companyPhone , 'cPic' => $imgurl];
            }
            else if ($data['action']==2){

                //Previus data from company to set new picture if pictureChanged = 1

                $getCompanyData = Company::where('id', $data['companyId'])->get();
                $cpicture = $filename;
               // return $uID;

                if($pictureChanged == 0)
                {
                    $cpicture = $getCompanyData[0]->companyPicture;
                } 

                $imgurl = url($picture_path . '/'. $cpicture);


                if($data['companyAddress']==null){
                    $data['companyAddress'] = 'Sin especificar';
                }

                $sale = Company::where('id', $data['companyId'])
                            ->update(['companyName' => $data['companyName'], 'companyDescription' => $data['companyDescription'], 'companyAddress' => $data['companyAddress'], 'companyCountryCode' => $data['companyCountryCode'] , 'companyPhone' =>  $companyPhone, 'companyPicture' => $cpicture, 'companyWebSite' => $data['companyWebSite'], 'companyEmail' => $data['companyEmail'] ]);

                 // check if dinamic fields
                if($data['countDinamicFields'] > 0){
                     //company_forms create new
                   //  $cformId = mt_rand();

                    //check if company form exists
                    $sId = null;
                    $checkCForm = CompanyForm::where('company_id', $data['companyId'])->pluck('id');
                    
                    if(count($checkCForm)==0){
                        $sId= mt_rand();
                        $cform = new CompanyForm();
                        $cform->id = $sId;
                        $cform->form_id = 7; //Empresa
                        $cform->company_id = $data['companyId'];
                        $cform->save();
                    } else if (count($checkCForm)>0){

                        $sId = $checkCForm[0];


                    }

                   // return $sId . ' ' . count($checkCForm);

                    

                    foreach ($data->input() as $key => $value) {
                    //Verificar que los campos por defecto no se igresen, al agregar un campo por defecto se tendria que agregar en el if
                        if($key != '_token' && $key != 'companyName' && $key != 'companyDescription' && $key != 'companyAddress' && $key != 'companyPhone' && $key != 'userEventType' && $key != 'countDinamicFields' && $key != 'action' && $key != 'companyId' && $key != 'tableRow' && $key != 'eventId' && $key != 'companyCountryCode' && $key != 'companyWebSite' && $key != 'companyEmail'   ){
                                //Asignar el usuario al cuestianrio user_form_section_answer

                                // Update Dinamic Fields
                            $vasign = DB::table('form_section_field_answers AS RESP')
                                        ->join('company_forms AS ACUE', 'ACUE.id', '=', 'RESP.company_form_id')
                                        ->where('RESP.form_section_field_id', $key) //STATUS 10 IS THE 'ENABLED O ACTIVE' 
                                        ->where('ACUE.company_id', $data['companyId'])
                                        ->select('RESP.form_section_field_id as FSID', 'RESP.company_form_id as CFID', 'RESP.id as FID')
                                        ->get();
                                        
                            $countvasign = count($vasign);
                            //dd($countvasign);
                            //Verificar que la respuesta no este asignada, de no estarlo, crear nuevam de lo contrario actualizar (else)
                            if($countvasign==0)
                            {
                                $fsfId= mt_rand();
                                $fsec = new FormSectionFieldAnswer();
                                $fsec->id = $fsfId;
                                $fsec->answerValue = $value;
                                $fsec->form_section_field_id = $key;
                                $fsec->user_form_section_answer_id = null;
                                $fsec->company_form_id = $sId;
                                $fsec->save();
                            }
                            else{
                                

                                $updateAnswer = FormSectionFieldAnswer::where('form_section_field_id', $key)->where('id', $vasign[0]->FID)->where('company_form_id', $vasign[0]->CFID)->update(['answerValue'=>$value]);



                            }
               

                                
                            

                        } // end if
                    } // end foreach
                } // en if dinamicFields            

               


                if($companyPhone==null){
                    $companyPhone = '';
                }

                $result =['status'=>'success', 'messsage' => 'Se ha actualizado correctamente la empresa',
                          'cId' => $sId, 'cName' => $data['companyName'], 'cDescription' => $data['companyDescription'], 'cAddress' => $data['companyAddress'], 'cPhone' => $companyPhone, 'cPic' => $imgurl ]; 
            }
        } catch(exception $e){
            $result =['status'=>'error', 'messsage' => $e->getMessage()];
        }
        return json_encode($result);
    }

    /*
    * get data for edit company
    */

    public function getCompanyEditData($cId){
        $company = Company::where('id', $cId)->get();


        $fields = null;
        $cId = $company[0]->id;
        $cName = $company[0]->companyName;
        $cDescription = $company[0]->companyDescription;
        $cAddress = $company[0]->companyAddress;
        $cPhone = preg_replace('/[^0-9]/','',$company[0]->companyPhone);
        $cCode = $company[0]->companyCountryCode;
        $cPic =  url($company[0]->companyPicturePath . '/' . $company[0]->companyPicture);
        $cWebSite = $company[0]->companyWebSite;
        $cEmail = $company[0]->companyEmail;
       

          //Get company_form id by company_id

          $companyFormId = DB::table('company_forms')->where('company_id', $cId)->pluck('id');


        if(count($companyFormId)>0){

          $fields = Field::from('fields as F')
              ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
              ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
              ->join('form_section_field_answers as FSFA', 'FSFA.form_section_field_id', 'FSF.id')
              ->where('FS.form_id', 7) //form Visitantes
              ->where('FS.section_id', 1) //section Registro
              ->where('FSFA.company_form_id', $companyFormId[0])
              ->select([\DB::raw('FSF.id as IDA, F.id as FIELDID, F.fieldText as TAG,  F.data_type_control_id as CONTROLTYPE, FSFA.answerValue as ANSWER')])->orderBy('FSF.fieldOrder', 'asc')->get();  
        }
        //dd($fields);

        if($fields){

            $countFields = count($fields);            
        
        } else{
            $countFields = 0;
        }

        $result =['status'  =>'success', 
                      'cId'     => $cId,
                      'cDescription'=> $cDescription, 
                      'cName'   => $cName,
                      'cAddress' => $cAddress,
                      'cCode' =>  $cCode,
                      'cPhone' => $cPhone,
                      'cEmail' => $cEmail,
                      'cWebSite' => $cWebSite,
                      'cPic' => $cPic,
                      'countDinamics' => $countFields,
                      'dFields' => $fields,
                      'act' =>'scss'
                      ];
        return response()->json($result);

    }


    /*
    * delete company
    */

    public function companyDelete($cId){

        try{
            //Set null in user_events table the company_id for delete

            $companyUserEvents = UserEvent::where('company_id', $cId)->update(['company_id' => null]);

            //Get the company_forms id for delete form_section_field_anwswers and company_forms 

            $companyForms = DB::table('company_forms')->where('company_id', $cId)->get();

            if(count($companyForms)>0){


                $companyFormId= $companyForms[0]->id;
                



                //Delete form_section_field_answers of company to delete

                $fieldAnswer = DB::table('form_section_field_answers')->where('company_form_id', $companyFormId)->delete();


                //Delete company_forms

                $companyForm = DB::table('company_forms')->where('id', $companyFormId)->delete();



            }

            //Delete scan_user_companies   scanCompanyDestination

            $scanCompany = DB::table('scan_user_companies')->where('scanCompanyDestination', $cId)->delete();

            $deletedRows = Company::where('id', $cId)->delete();
            $result =['status'=>'success', 'messsage' => 'Se ha eliminado correctamente la empresa!'];
        } catch(exception $e){
            $result =['status'=>'error', 'messsage' => $e->getMessage()]; 
        }
        return response()->json($result);
    }

    

    public function generateQrForPrint(Request $data){
        $customPaper = array(0,0,567.00,842.00);
        
        $pageHeight = "150.01mm";
        $pageWidth = "222.78mm";
        $companyName = '';
        $companyPosition =null;
        $sdesc = '';

        try{
            $qr=null;
            $name = '';
            $company = '';
            switch ($data->type) {
                case 'company':
                    # code...
                    $qr = 'STAND' . $data->id;
                    $getComp = DB::table('companies as C')->where('C.id', $data->id)->pluck('C.companyName');
                    
                    $customPaper = array(0,0,290.00,435.00);
                    $pageHeight = "76.72mm";
                    $pageWidth = "115.09mm";

                    $type = 'STAND'; 
                    if(count($getComp) > 0){
                        $name= $getComp[0];
                    }
                    
                    break;
                    
                case 'product':
                    $qr = 'PRODU' . $data->id;
                    $name = DB::table('products')->where('id', $data->id)->pluck('productName');
                    $name = $name[0];
                    $type = 'PRODUCTO';
                    $customPaper = array(0,0,290.00,435.00);
                    $pageHeight = "76.72mm";
                    $pageWidth = "115.09mm";
                break;

                case 'sale':
                    $qr = 'SALES' . $data->id;
                    $uData = DB::table('sales as S')->join('products as P', 'P.id', 'S.product_id')->where('S.id', $data->id)->select('P.productName as PRODUCT', 'S.saleDescription as SALE')->get();
                   
                    $name = $uData[0]->PRODUCT;
                    $sdesc = $uData[0]->SALE;
                    $type ='oferta';
                    $customPaper = array(0,0,290.00,435.00);   
                    $pageHeight = "76.72mm";
                    $pageWidth = "115.09mm";


                break;

                case 'user':
                    $qr = 'USERS' . $data->id;
                    
                    /*check if badge data exists*/
                    $checkBadge = DB::table('user_event_badges')->where('user_event_id', $data->id)->get();

                    //dd($checkBadge);

                    if(count($checkBadge)>0){

                        $name = $checkBadge[0]->userFirstName . ' ' . $checkBadge[0]->userLastName;
                        $companyName = $checkBadge[0]->userCompanyName;
                        $companyPosition = $checkBadge[0]->userPosition;

                        if($checkBadge[0]->userCompanyName == '' || $checkBadge[0]->userCompanyName == null)
                        {
                            $getComp = DB::table('user_events as UE')->join('companies as C', 'C.id', 'UE.company_id')->where('UE.id', $data->id)->pluck('C.companyName');
                            if(count($getComp) > 0){
                                $companyName = $getComp[0];
                            }
                            else{
                                $companyName = '';
                            } 
                        }


                       // dd($checkBadge[0]);
                    }
                    else{

                        $uData = DB::table('user_events as UE')->join('users as U', 'U.id', 'UE.user_id')->where('UE.id', $data->id)->select('U.userFirstName as FNAME', 'userLastName as LNAME')->get();
                   
                        $name = $uData[0]->FNAME . ' ' . $uData[0]->LNAME;

                        //Company Data
                        $getComp = DB::table('user_events as UE')->join('companies as C', 'C.id', 'UE.company_id')->where('UE.id', $data->id)->pluck('C.companyName');
                        if(count($getComp) > 0){
                            $companyName = $getComp[0];
                        }
                        else{
                            $companyName = '';
                        }

                    }

                    $type = DB::table('user_events as UE')->join('user_types as UT', 'UT.id', 'UE.user_type_id')->where('UE.id', $data->id)->pluck('UT.userTypeName');
                    $type = $type[0];

                    //dd($type);
                  
                    $customPaper = array(0,0,215.00,145.00);
                    $pageHeight = "56.88mm";
                    $pageWidth = "38.36mm";
                    

                    if($type=='Administrador' || $type=='Sub Administrador'){
                        $type = 'Expositor';
                    }

                    

                break;

                

                default:
                    # code...
                    break;
            }

          
            $qrC = QrCode::size(300)->generate($qr);
            
            
            $pdf = PDF::loadView('backend.admin.qrs.get-qr', ['qr'=> $qr, 'name' => $name, 'type' => strtoupper ($type), 'companyName' => $companyName, 'sdesc' => $sdesc, 'companyPosition' =>$companyPosition])->pageHeight($pageHeight)->pageWidth($pageWidth)->marginTop('2mm')->marginLeft('2mm')->marginRight('2mm')->marginBottom('2mm')->orientation('Landscape');

            //setPaper($customPaper, 'portrait')

           //return view('backend.admin.qrs.get-qr', ['qr'=> $qr, 'name' => $name, 'type' => strtoupper ($type), 'companyName' => $companyName]);

            return $pdf->stream();

            $qrC = QrCode::size(300)->generate($qr);
            
            $html = '<div id="qr-content" style="border: 0px solid  #919191; width: 99%; margin: 0 auto; position: relative" ><div class="row">';
            $html .=    '<div id="qr-name" style="width: 100%; float: left; position: relative; text-align: center">';
            $html .=        '<span style="color: #000; font-size: 50px; font-weight: 800; width: 100%; text-transform: uppercase; text-align: center; position: relative;">'. $name[0] .  '</span>';
            $html .=    '</div>';
            $html .=    '<div id="qr-area" style="margin-top: 15px; width: 100%; float:left; padding-top: 20px; padding-bottom: 20px; text-align: center; position: relative">';
            $html .=        $qrC;
            $html .=    '</div>';
            $html .=    '<div id="qr-type" style="width: 100%; float: left; position: relative; text-align: center">';
            $html .=        '<span style="color: #000; font-size: 50px; font-weight: 800; width: 100%; text-transform: uppercase; text-align: center; position: relative;">'. $type .  '</span>';
            $html .=    '</div>';
            $html .= '</div></div>';

            $result = ['status' => 'success', 'html' => $html];
            return $result;
        }catch(exception $e){

            return $e->getMessage();
        }


        //return view('backend.admin.qrs.qr-print-preview', ['qr' => $qr]);   
    }
    


    /*
    # vista para generar codigos para nuevos eventos
    # Los códigos son generados por un administrador y enviados por correo electrónico
    */

    public function getCodesView(Request $request){

        $codes = Code::getCodes();

        //dd($codes);

        return view('backend.admin.codes.generate-event-code', ['codes' => $codes]);

    }

    /*
    # almacenar código
    */

    public function storeCode(Request $request){

        $data = $request->all();
        $userId = Auth::user()->id;
        $codeId = mt_rand();

        try{
            $code = new Code();
            $code->id = $codeId;
            $code->code = $codeId;
            $code->codeRecipient = $data['emails'][0];
            $code->user_id = $userId;
            $code->codeStatus = 1;
            $code->save();

            $userData = User::getUserData($userId);
           
            $userName = $userData[0]->userFirstName . ' ' . $userData[0]->userLastName;
            $email =$data['emails'][0];

            $mailData =['email' => $email , 'codeFrom' => $userName, 'code' => $codeId];

            Mail::send('emails.event-code', $mailData, function($message) use($mailData, $email){
                   $message->to($email);
                   $message->subject('Código para crear Evento');
                   $message->from('info@networkingapp.net', 'NetWorkingApp');
                });


            $result = ['status'=>'success', 'messsage' => 'Se ha generado y enviado el código con éxito',
                       'codeId' => $codeId,
                       'codeRecipient' => $data['emails'][0],
                       'codeUserName' => $userName,
                       'codeStatus' => 'Enviado',
                       'codeDate' =>  date('d-m-Y', strtotime($code->created_at)),
                   ];

        } catch(exception $e){

            $result = ['status'=>'error', 'messsage' => $e->getMessage()];
        }

        return json_encode($result);


    }

    public function checkEventCode(Request $request){

        $status = 'used';
        $data = $request->all();
        try{

            $check = Code::where('id', $data['code'])->pluck('codeStatus');

            if(count($check) > 0){
                
                if($check[0] == 1){
                    $status = 'free';
                }


                
            }
            else{
                $status = 'notfound';
            }

            $result = ['status' => $status ];

        } catch(exception $e){

            $result=['status' => 'error'];

        }


        return json_encode($result);
    }


}
