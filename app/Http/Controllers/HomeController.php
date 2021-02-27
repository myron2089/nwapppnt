<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Event;
use App\UserEvent;
use App\EventType;
use App\Field;
use App\User;
use Auth;
use App\CountryState;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\FormSection;
use Illuminate\Support\Facades\Input;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $eventTypes;

    public function __construct()
    {
        $this->eventTypes =EventType::getEventTypes()->get();
    }


    /*
    * Home page for public side
    */

    public function getHomePageView(){
        $events = Event::from('events as E')->select([\DB::raw('E.id as eventId, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as FULLDESCRIPTION, E.eventUrl as URL,
                                               CASE WHEN month(E.eventStart) = 1
                                                    THEN (select "Ene")
                                                    WHEN month(E.eventStart) = 2
                                                    THEN (select "Feb")
                                                    WHEN month(E.eventStart) = 3
                                                    THEN (select "Mar")
                                                    WHEN month(E.eventStart) = 4
                                                    THEN (select "Abr")
                                                    WHEN month(E.eventStart) = 5
                                                    THEN (select "May")
                                                    WHEN month(E.eventStart) = 6
                                                    THEN (select "Jun")
                                                    WHEN month(E.eventStart) = 7
                                                    THEN (select "Jul")
                                                    WHEN month(E.eventStart) = 8
                                                    THEN (select "Ago")
                                                    WHEN month(E.eventStart) = 9
                                                    THEN (select "Sep")
                                                    WHEN month(E.eventStart) = 10
                                                    THEN (select "Oct")
                                                    WHEN month(E.eventStart) = 11
                                                    THEN (select "Nov")
                                                    WHEN month(E.eventStart) = 12
                                                    THEN (select "Dic")
                                                END AS monthName,

                                                CASE WHEN month(E.eventFinish) = 1
                                                    THEN (select "Ene")
                                                    WHEN month(E.eventFinish) = 2
                                                    THEN (select "Feb")
                                                    WHEN month(E.eventFinish) = 3
                                                    THEN (select "Mar")
                                                    WHEN month(E.eventFinish) = 4
                                                    THEN (select "Abr")
                                                    WHEN month(E.eventFinish) = 5
                                                    THEN (select "May")
                                                    WHEN month(E.eventFinish) = 6
                                                    THEN (select "Jun")
                                                    WHEN month(E.eventFinish) = 7
                                                    THEN (select "Jul")
                                                    WHEN month(E.eventFinish) = 8
                                                    THEN (select "Ago")
                                                    WHEN month(E.eventFinish) = 9
                                                    THEN (select "Sep")
                                                    WHEN month(E.eventFinish) = 10
                                                    THEN (select "Oct")
                                                    WHEN month(E.eventFinish) = 11
                                                    THEN (select "Nov")
                                                    WHEN month(E.eventFinish) = 12
                                                    THEN (select "Dic")
                                                END AS monthNameFinish,

                                                CASE
                                                    WHEN month(E.eventStart) = month(E.eventFinish) AND  year(E.eventStart) = year(E.eventFinish)
                                                    THEN (select CONCAT( day(E.eventStart), " al ", day(E.eventFinish), " de ", monthName,  " ", year(E.eventStart) ))

                                                    WHEN month(E.eventStart) != month(E.eventFinish) AND  year(E.eventStart) =  year(E.eventFinish)
                                                    THEN (Select CONCAT("del ", day(E.eventStart), " de ", monthName, " al ", day(E.eventFinish), " de ", monthNameFinish,  " ", year(E.eventStart) ))

                                                    WHEN year(E.eventStart) !=  year(E.eventFinish)
                                                    THEN (Select CONCAT("del ", day(E.eventStart), " de ", monthName,  " ", year(E.eventStart), " al ", day(E.eventFinish), " de ", monthNameFinish, " de ",  " ", year(E.eventFinish)  ))


                                                END AS extendedDate,


                                                DATE_FORMAT(E.eventStart,"%h:%i %p") as eventTimeStart, day(E.eventStart) as dayNumber, year(E.eventStart) as yearNumber, day(E.eventFinish) as dayNumberFinish,  LOWER(ET.eventTypeName) as TYPE, substring(E.eventDescription, 1,100) as DESCRIPTION
                                                    ')])
                            ->join('event_types as ET', 'ET.id', 'E.event_type_id')
                            ->limit(10)
                            ->orderBy('E.eventStart' , 'desc')
                            ->where('event_status_id',1);



   // dd($events->get());

    $nextEvents = $events->get();
    $nextEvent = $events->limit(1)->get();

    $pageTitle = 'Próximos Eventos';

     //dd($nextEvent[0]->eventPicture);

        return view('frontend.pages.home', ['nextEvents' => $nextEvents,
                                            'nextEvent' => $nextEvent,
                                            'eventTypes' => $this->eventTypes,
                                            'pageTitle' => $pageTitle]);

    }



    /*
    ** Calendario de Eventos
    */

    public function getCalendarPageView(){


        // Obtner dias de los eventos
        $evDays = Event::from('events as e')
                       ->select([\DB::raw('DATE_FORMAT(e.eventStart,"%d/%m/%Y") as eventStart,
                                            CASE WHEN DAYNAME(e.eventStart) = "Sunday"
                                                    THEN (select "Domingo")
                                                    WHEN DAYNAME(e.eventStart) = "Monday"
                                                    THEN (select "Lunes")
                                                    WHEN DAYNAME(e.eventStart) = "Tuesday"
                                                    THEN (select "Martes")
                                                    WHEN DAYNAME(e.eventStart) = "Wednesday"
                                                    THEN (select "Miercoles")
                                                    WHEN DAYNAME(e.eventStart) = "Thursday"
                                                    THEN (select "Jueves")
                                                    WHEN DAYNAME(e.eventStart) = "Friday"
                                                    THEN (select "Viernes")
                                                    WHEN DAYNAME(e.eventStart) = "Saturday"
                                                    THEN (Select "Sabado")
                                            END  as dayName,
                                            CASE WHEN month(e.eventStart) = 1
                                                    THEN (select "ENE")
                                                    WHEN month(e.eventStart) = 2
                                                    THEN (select "FEB")
                                                    WHEN month(e.eventStart) = 3
                                                    THEN (select "MAR")
                                                    WHEN month(e.eventStart) = 4
                                                    THEN (select "ABR")
                                                    WHEN month(e.eventStart) = 5
                                                    THEN (select "MAY")
                                                    WHEN month(e.eventStart) = 6
                                                    THEN (select "JUN")
                                                    WHEN month(e.eventStart) = 7
                                                    THEN (select "JUL")
                                                    WHEN month(e.eventStart) = 8
                                                    THEN (select "AGO")
                                                    WHEN month(e.eventStart) = 9
                                                    THEN (select "SEP")
                                                    WHEN month(e.eventStart) = 10
                                                    THEN (select "OCT")
                                                    WHEN month(e.eventStart) = 11
                                                    THEN (select "NOV")
                                                    WHEN month(e.eventStart) = 12
                                                    THEN (select "DIC")
                                                END AS monthName,
                                            day(e.eventStart) as dayNumber')])
                       ->groupBy('e.eventStart')
                       ->where('e.event_status_id',1)
                       ->orderBy('e.eventStart' , 'asc')
                       ->get();




        $eventsData = [];
       // foreach ($evDays as $day) {


            $events = Event::from('events as E')
                           ->select([\DB::raw('DATE_FORMAT(E.eventStart,"%d/%m/%Y") as eventStart,E.id as eventId, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as FULLDESCRIPTION, E.eventUrl as URL, EL.eventLocationAddress as eventAddress,
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
                                            DATE_FORMAT(E.eventStart,"%h:%i %p") as eventTimeStart, day(E.eventStart) as dayNumber, year(E.eventStart) as yearNumber, LOWER(ET.eventTypeName) as TYPE, substring(E.eventDescription, 1,100) as DESCRIPTION,
                                             CASE WHEN DAYNAME(E.eventStart) = "Sunday"
                                                    THEN (select "Domingo")
                                                    WHEN DAYNAME(E.eventStart) = "Monday"
                                                    THEN (select "Lunes")
                                                    WHEN DAYNAME(E.eventStart) = "Tuesday"
                                                    THEN (select "Martes")
                                                    WHEN DAYNAME(E.eventStart) = "Wednesday"
                                                    THEN (select "Miercoles")
                                                    WHEN DAYNAME(E.eventStart) = "Thursday"
                                                    THEN (select "Jueves")
                                                    WHEN DAYNAME(E.eventStart) = "Friday"
                                                    THEN (select "Viernes")
                                                    WHEN DAYNAME(E.eventStart) = "Saturday"
                                                    THEN (Select "Sabado")
                                            END  as dayName
                                                ')])
                           ->join('event_types as ET', 'ET.id', 'E.event_type_id')
                           ->join('event_locations as EL', 'EL.id', 'E.event_location_id')
                          // ->whereRaw('DATE_FORMAT(E.eventStart, "%d/%m/%Y") = ' . '"' .$day->eventStart . '"')
                           ->where('E.event_status_id',1)
                           ->get();

            $eventData[] = array(
                'eventName' => $events[0]->eventName,
                'eventUrl'  => $events[0]->URL,
                'eventDayName' => $events[0]->dayName,
                'eventDayNumber' => $events[0]->dayNumber,
            );
      //  }

       //dd($eventData);

        $pageTitle = 'NetWorkingApp | Calendario de Eventos';
        return view('frontend.pages.events.event-calendar',[
                    'pageTitle' => $pageTitle,
                    'evDays' => $evDays,
                    'events' => $events
        ]);

    }

    public function getHomeView(){

        $types = array(5,6);
        $userTypeEvents = UserEvent::whereNotIn('user_type_id', $types)->where('user_id', Auth::user()->id)->get();

        //dd($userTypeEvents);

        if(count($userTypeEvents)> 0){
            return redirect()->route('admin-home');

            //return redirect()->route('admin-home');
        }
        else{
            //Verificar que sea visitante en algun envento
            $checkVisitor = UserEvent::where('user_type_id', 5)->where('user_id', Auth::user()->id)->pluck('user_type_id');

            if(count($checkVisitor[0]) > 0){

                return redirect()->route('visitor-profile');
            }
            else{
                return redirect()->route('upcoming-events');
            }
        }


        //return view('frontend.pages.home');
    }

    /*
    # Pagina de eventos por categoría
    */

    public function getEventCategories(Request $request, $category){

        $events = Event::getEventsForCards(0,0)->where('ET.eventTypeName', $category)->where('event_status_id', 1)->get();



        return view('frontend.events.event-categories', ['pageTitle'=> 'Eventos | ' . $category,
                                                         'events' => $events,
                                                         'eventTypes' => $this->eventTypes,
                                                         'eventType' => $category
    ]);

    }

/*    public function __construct()
    {
     //   $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
         return redirect()->route('admin-home');
    }


    public function getContactPageView(){
        $pageTitle = 'Contacto';

        return view('frontend.pages.contact', ['pageTitle' => $pageTitle, 'eventTypes'=> $this->eventTypes]);
    }

    public function sendContactEmail(Request $request){

        try{

            $data = $request->all();

            Mail::send('emails.contact', [
                    'data' => $data
            ], function ($message) use ($data){
                $message->from($data['email']);
                $message->to('myron2089@gmail.com');
                $message->subject($data['subject']);
            });
        }
        catch (exception $e){
            return  redirect()->back()->with('error');

        }

        $data=['status'=>'success', 'message' => 'Se ha enviado correctamente el correo al administrador.'];
        return  json_encode($data);

    }

    public function getTermsPoliticsPageView(){

        return view('frontend.pages.terms-privacy',['pageTitle' => 'Política de Privacidad', 'eventTypes'=>$this->eventTypes]);

    }

    /*
    ** Descargar qr despues del registro de visitantes
    */

    public function dowloadVisitorQr(Request $request){

        $qr = $request->qr;
        $qrc = QrCode::size(300)->generate($qr);
        return json_encode($request->all());

    }



    public function registeredStatus(Request $data){

        dd($data->all());

        return view('frontend.users.register-status');
    }

    public function getVisitorRegisterView(Request $data, $evUrl, $user_exists){
       
        
        $place=1;
        // 0 No registrado, 1 Registrado (se verifica si el usuario está logueado)
        $userRegistered = 0;

        /*Verificar 1 que en la url venga el parametro existente..... 2 Que un usuario logueado ingrese la url de registro/nuevo como tal */
        if($user_exists=='existente' ){
            $place=2;
        }

       
        /**/

       //dd($place);

        $eventCreate =0;
        $input = $data->all();
        $fields = null;
        $countFields=0;
        $eventName = 'NetWorkingApp';
        $title = 'Registro de Usuarios';

        $baseLogo = 'images/events/previews/';
        $eventLogo = $baseLogo .'eventNotPicture.jpg';

        //Verificar que sea un registro para crear un nuevo evento
        if ($data->has('crear') ) {



            if($data->crear==1){

                $eventCreate = 1;
            }
        }

        else{





            $eventData = Event::where('eventUrl', $evUrl)->pluck('id');


            //Verificar si se entro a la url desde un usuario logueado
            if($user = Auth::user()){

                $checkRegister = UserEvent::where('user_id', Auth::user()->id)->where('event_id' , $eventData[0])->get();

                //
                $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');


                $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventData[0])->pluck('UE.user_type_id');
                
                if(count($userEventRoleAuth) <= 0){
                    $userEventRoleAuth = null;
                }

                // Verificar que el usuario logueado sea un super Admin y de no estar registrado, registrarlo.
                $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

                 if($userPermissions['permission']==1){

                
                    $checkRegister = UserEvent::where('user_id', Auth::user()->id)->where('event_id' , $eventData[0])->get();

                    if(count($checkRegister)<=0){
                        $userEventId = mt_rand();
                         
                        $asign = UserEvent::create([
                                'id' => $userEventId,
                                'user_id' => Auth::user()->id,
                                'event_id' =>  $eventData[0],
                                'user_type_id' => 1,
                                'role_id' => 2
                            ]);
                    }

                    
                    $checkRegister = UserEvent::where('user_id', Auth::user()->id)->where('event_id' , $eventData[0])->get();

                    
                }
                //

                if(count($checkRegister) > 0){

                    $evType = Event::from('events as e')
                                   ->join('event_types as et', 'et.id', 'e.event_type_id')
                                   ->where('e.id', $eventData[0])
                                   ->pluck('et.eventTypeName');
                   return redirect('eventos/' . strtolower($evType[0]) . '/' . $evUrl);
                }
               

            }


            if(count($eventData) > 0){
               $eventId = $eventData[0];
            } else{
                $eventId=21643667; //Guatetur
            }
            $title = 'Registro de Visitantes';


            $eventData = DB::table('events')->where('id', $eventId)->get();
            $eventName = $eventData[0]->eventName;



            $fields = $this->getUserRegisterCatalogTemplate(5, $eventId, $countFields, $place);
            
           // $eventLogo = $baseLogo . $eventData[0]->eventPicture;


            //Imagen de evento
            $eventLogo = 'images/events/register_forms/no_register_image.jpg';

            $formImage = DB::table('event_web_resources as WR')
                          ->where('WR.event_id', $eventId)
                          ->select([\DB::raw('CONCAT( WR.eventWebResourcePath, "/", WR.eventWebResourceValue) as PATH, WR.id as ID')])
                          ->whereIn('WR.event_web_resource_element_id',  array(13))
                          ->orderBy('WR.event_web_resource_element_id', 'asc')->get();

            if(count($formImage) > 0){
                $eventLogo = $formImage[0]->PATH;
            }




        }



        //dd($eventName);

        $ufname= null;
        $ulname = null;
        $uemail = null;
        $ucellphone = null;
        $uaddress = null;
        $ustate = null;
        $utown = null;

        $register=1;




        if($data->input('userFirstName'))
            $ufname = $data->input('userFirstName');

        if($data->input('userLastName'))
            $ulname = $data->input('userLastName');

        if($data->input('userRemail'))
            $uemail = $data->input('userRemail');

        if($data->input('userCellPhone'))
            $ucellphone = $data->input('userCellPhone');

        if($data->input('userAddress'))
            $uaddress = $data->input('userAddress');

         if($data->input('userState'))
            $ustate = $data->input('userState');

        if($data->input('userTown'))
            $utown = $data->input('userTown');

        $states = CountryState::get();


        //dd($fields);

        if($user_exists=='nuevo' && !Auth::check()){
        return view('auth.register', ['type'=> 'v', 'title' => $title, 'ufname' => $ufname, 'ulname' => $ulname, 'uemail' => $uemail, 'ucellphone' => $ucellphone, 'uaddress' => $uaddress, 'states' => $states, 'ustate' => $ustate, 'utown' => $utown, 'fields' => $fields, 'countFields' => $countFields, 'register' => $register,
                                      'eventName' => $eventName, 'eventLogo' => $eventLogo, 'eventCreate' => $eventCreate, 'evUrl'=>$evUrl, 'eventId' => $eventId, 'regFrom' => 'event'

        ]);
        }
        else if(($user_exists=='existente' || $user_exists=='nuevo') && Auth::check() ){
            $roleEvent = User::getUserEventPermissions(Auth::user()->id)->max('UE.user_type_id');


            $dataEvent = Event::from('events as e')
                              ->join('event_locations as el', 'el.id', 'e.event_location_id')
                              ->join('payment_currencies as pc', 'pc.id', 'e.payment_currency_id')
                              ->select('e.id as eventId','e.eventName as eventName', 'el.eventLocationName as eventLocationName', 'e.eventStart as eventStart', 'e.eventPrice as eventPrice', 'pc.currencySymbol as currencySymbol')
                              ->where('e.id', $eventId)
                              ->get();

            $date = date_create($dataEvent[0]->eventStart);

            return view('frontend.users.event-specific-data', ['type'=> 'v', 'title' => $title, 'ufname' => $ufname, 'ulname' => $ulname, 'uemail' => $uemail, 'ucellphone' => $ucellphone, 'uaddress' => $uaddress, 'states' => $states, 'ustate' => $ustate, 'utown' => $utown, 'fields' => $fields, 'countFields' => $countFields, 'register' => $register,
                                      'eventName' => $eventName, 'eventLogo' => $eventLogo, 'eventCreate' => $eventCreate, 'eventRole' => $roleEvent, 'eventTypes' => $this->eventTypes, 'pageTitle' => 'Registro', 'eventPlace' => $dataEvent[0]->eventLocationName, 'eventStarts' => date_format( $date, 'd-m-Y H:i A'), 'eventPrice' => $dataEvent[0]->currencySymbol . '. ' . $dataEvent[0]->eventPrice, 'eventId'=>$dataEvent[0]->eventId

        ]);


        } else{

            return redirect('error/401');
        }

    }


    public function getUserRegisterForEvent(Request $data){

        $eventCreate =0;
        $input = $data->all();
        $fields = null;
        $countFields=0;
        $eventName = 'NetWorkingApp';
        $title = 'Registro de Usuarios';

        $baseLogo = 'images/events/logos/';
        $eventLogo = $baseLogo .'nw-icon.svg';

        //Verificar que sea un registro para crear un nuevo evento
        if ($data->has('crear') ) {



            if($data->crear==1){

                $eventCreate = 1;
            }
        }

              //dd($eventName);

        $ufname= null;
        $ulname = null;
        $uemail = null;
        $ucellphone = null;
        $uaddress = null;
        $ustate = null;
        $utown = null;

        $register=1;




        if($data->input('userFirstName'))
            $ufname = $data->input('userFirstName');

        if($data->input('userLastName'))
            $ulname = $data->input('userLastName');

        if($data->input('userRemail'))
            $uemail = $data->input('userRemail');

        if($data->input('userCellPhone'))
            $ucellphone = $data->input('userCellPhone');

        if($data->input('userAddress'))
            $uaddress = $data->input('userAddress');

         if($data->input('userState'))
            $ustate = $data->input('userState');

        if($data->input('userTown'))
            $utown = $data->input('userTown');

        $states = CountryState::get();


        return view('auth.register', ['type'=> 'v', 'title' => $title, 'ufname' => $ufname, 'ulname' => $ulname, 'uemail' => $uemail, 'ucellphone' => $ucellphone, 'uaddress' => $uaddress, 'states' => $states, 'ustate' => $ustate, 'utown' => $utown, 'fields' => $fields, 'countFields' => $countFields, 'register' => $register,
                                      'eventName' => $eventName, 'eventLogo' => $eventLogo, 'eventCreate' => $eventCreate

        ]);
    }


    /*Registro normal de usuarios (sin evento)*/
    public function getUserRegisterNoEvent(Request $data){

        $eventCreate =0;
        $input = $data->all();
        $fields = null;
        $countFields=0;
        $eventName = 'NetworkingApp';
        $title = 'Registro de Visitantes';

        $baseLogo = 'images/backgrounds/';
        $eventLogo = $baseLogo .'diagonal-header.png';

        $eventId = 0;

        //Verificar que sea un registro para crear un nuevo evento
        if ($data->has('crear') ) {



            if($data->crear==1){

                $eventCreate = 1;
            }
        }

              //dd($eventName);

        $ufname= null;
        $ulname = null;
        $uemail = null;
        $ucellphone = null;
        $uaddress = null;
        $ustate = null;
        $utown = null;

        $register=1;




        if($data->input('userFirstName'))
            $ufname = $data->input('userFirstName');

        if($data->input('userLastName'))
            $ulname = $data->input('userLastName');

        if($data->input('userRemail'))
            $uemail = $data->input('userRemail');

        if($data->input('userCellPhone'))
            $ucellphone = $data->input('userCellPhone');

        if($data->input('userAddress'))
            $uaddress = $data->input('userAddress');

         if($data->input('userState'))
            $ustate = $data->input('userState');

        if($data->input('userTown'))
            $utown = $data->input('userTown');

        $states = CountryState::get();


        return view('auth.register', ['type'=> 'v', 
                                      'title' => $title, 
                                      'ufname' => $ufname, 
                                      'ulname' => $ulname, 
                                      'uemail' => $uemail, 
                                      'ucellphone' => $ucellphone, 
                                      'uaddress' => $uaddress, 
                                      'states' => $states, 
                                      'ustate' => $ustate, 
                                      'utown' => $utown, 
                                      'fields' => $fields, 
                                      'countFields' => $countFields, 
                                      'register' => $register,
                                      'eventName' => $eventName, 
                                      'eventLogo' => $eventLogo, 
                                      'eventCreate' => $eventCreate,
                                      'eventId' => $eventId,
                                      'regFrom' => 'visitor'

        ]);
    }


    public function getUserRegisterCatalogTemplate($userType, $eventId, &$countFields, $template_place){


        $formData= DB::table('event_forms as ef')
                     ->join('forms as f', 'f.id', 'ef.form_id')
                     ->where('f.form_type_id', 5)
                     ->where('ef.event_id', $eventId)
                     ->pluck('ef.form_id');

        if(count($formData) ==0){

            $countFields = 0;
            $fields = null;
            return $fields;
        }

        

        $formId = $formData[0];
        //dd($formId);

        $fields = Field::from('fields as F')
                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
                      ->join('forms as FO', 'FO.id', 'FS.form_id')
                      ->join('event_forms as EF', 'EF.form_id', 'FO.id')
                      ->where('EF.event_id', $eventId)
                      //->where('FS.form_id', $formId) //form Visitantes
                      ->where('FSF.fieldStatus', 1) //Estado habilitado 1, deshabilitado 0
                      ->where('FS.section_id', 1) //section Registro
                      ->where('FO.form_type_id', 5) //5 pertenece a visitantes
                      //->orderBy('FSF.fieldOrder', 'F.created_at', 'asc')
                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as PHOLDER, F.fieldRequired as FREQUIRED, F.fieldMaxLenght as MAXLENGHT, F.data_type_control_id as CONTROLTYPE, FS.form_id')])
                      ->orderBy('FSF.fieldOrder' , 'F.created_at', 'desc')
                      ->get();

                     // dd($fields);
                     // dd($fields[0]);

        $countFields = count($fields);
        //dd($fields);

        $ftmp='';
        foreach ($fields as $field) {

     /*   $ftmp .=    '<div class="group" style="margin-top: 5px">';

        $control = $this->getControlTemplate($field->CONTROLTYPE, $field->ID, $field->MAXLENGHT, $field->FREQUIRED, $field->TAG, $field->PHOLDER );

        $ftmp .=        $control;

        $ftmp .=    '</div>'; */
        if($template_place==1){
            $ftmp .= '<div class="group">';
        }
        else{

            $ftmp .= '<div class="form-group">';

        }


                $control = $this->getControlTemplate($field->CONTROLTYPE, $field->IDA, $field->MAXLENGHT, $field->FREQUIRED, $field->TAG, $field->PHOLDER, $field->ID, $template_place );
                $ftmp .=        $control;
            $ftmp .=    '</div>';



        }

        return $ftmp;
    }

    //template_place (solo registro 1  o actualizar datos en perfil 2 (logueado))
    public function getControlTemplate($controlType, $id, $maxL, $required, $tag, $placeH, $fId, $template_place){
        /*
        * ControlType se utiliza para obtener el id del control y tipo asignados al control
        * 1 input text
        * 2
        * 3
        *
        *
        *
        * 8 dropdown list
        *
        */
        $req=null;
        if($required == 1){
            $req = "required";
        }



        $tmp ='';
        switch ($controlType) {
            case 1:
                # input text

                if($template_place==1){
                    $tmp = '<!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">-->
                                <input class="form-control custom-form-control" type="text" id="'. $id .'" name="'. $id .'" placeholder="'.$tag.'" maxlength="' . $maxL .'" '. $req .'  >
                                <!--<label class="mdl-textfield__label" for="'. $id .'">'. $tag .'</label>-->
                                <span class="mdl-textfield__error">Input is not a number!</span>
                            <!--</div>-->';
                            //dd($tmp);
                }
                else{

                     $tmp = '<label class="col-md-12 control-label">' . $tag . '</label>
                             <div class="col-md-12">
                                <input type="text" id="'. $id .'" name="'. $id .'" class="form-control" maxlength="' . $maxL .'" />
                             </div>';


                }

            break;

            case 2:
                # input number
                if($template_place==1){
                    $tmp = '<!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">-->
                                <input class="form-control custom-form-control" type="number" id="'. $id .'" name="'. $id .'" placeholder="'.$tag.'" max="' . $maxL .'">
                                <!--<label class="mdl-textfield__label" for="'. $id .'">'. $tag .'</label>-->
                                <span class="mdl-textfield__error">Input is not a number!</span>
                                <!--</div>-->';
                }

                else{

                     $tmp = '<label class="col-md-12 control-label">' . $tag . '</label>
                             <div class="col-md-12">
                                <input type="number" id="'. $id .'" name="'. $id .'" class="form-control" max="' . $maxL .'" />
                             </div>';
                    }


                break;

            case 8:
                # dropdown list
                $options = $this->getDdListTemplate($fId, $tag);
                if($template_place==1){
                    $tmp .=    '<!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">-->';
                        $tmp .= '<select id="'. $id .'" name="'. $id .'" class="form-control custom-form-control" type="text" ata-trigger="manual" value="{{ old('. $id .') }}" '. $req .'>';
                            $tmp .= $options;
                        $tmp .= '</select>';
                        $tmp .=    '<!--<label class="mdl-textfield__label" for="userLastName">'. $tag .'</label>-->';
                        $tmp .=    '<span class="mdl-textfield__error">Es necesario ingresar una dirección</span>';
                        $tmp .=    '<div class="err-msg ulname">';
                                $tmp .=    '<span>Es necesario ingresar número de celular.</span>';
                            $tmp .=  '</div>';
                    $tmp .= '<!--</div>-->';
                }
                else{

                     $tmp = '<label class="col-md-12 control-label">' . $tag . '</label>
                             <div class="col-md-12">
                                <select  id="'. $id .'" name="'. $id .'" class="form-control" value="{{ old('. $id .') }}" '. $req .' />';
                            $tmp .= $options;
                    $tmp .= '</select>
                             </div>';


                }




                break;
        }

        return $tmp;



    }


    public function getDdListTemplate($fId, $tag){

        $optionSel = FieldOption::where('field_id', $fId)->where('optionValue', 0)->get();


        $options = FieldOption::where('field_id', $fId)
                              ->where('optionValue', '!=', 0)
                              ->orderBy('optionName', 'asc')->get();



        $options = $optionSel->merge($options);



        $tmp = '';
        foreach ($options as $option) {
        //    echo $option->optionValue;
            //$tmp .= '<option value="'. $option->optionValue . '">' . $option->optionName . '</option>';

            $selectOptionName = $option->optionName;
            //  $tmp .= '<li class="mdl-menu__item" data-val="'. $option->optionValue . '">' . $option->optionName . '</li>';
              if($option->optionName=='Selecciona'){

                $selectOptionName = $tag;
                //dd($tag);

              }


              $tmp .= '<option value="'. $option->optionValue . '">' . $selectOptionName . '</option>';
        }

        return $tmp;


    }

    /*
    * Fast password reset
    */

    public function getPasswordResetView(){



        return view('backend.admin.visitors.change-password');
    }

    public function updateVisitorPassword(Request $request){

        $data = $request->input();

        $email = $data['userEmail'];
        $password = $data['userPassword'];

        



        try{


            $getData = DB::table('users')->where('userEmail', $email)->get();

            if(count($getData) > 0){

                DB::table('users')
                ->where('userEmail', $email)
                ->update([ 'userPassword' => bcrypt($password) ]);


                $stt = 'updated';
            }
            else{
                $stt = 'not-found';
            }
        } catch(exception $e){

            $stt = 'error';
        }



         return view('backend.admin.visitors.change-password', ['status'=> $stt]);
    }




    /*
    # Vista de errores
    */

    public function getErrorView(Request $request, $errorCode){


        $message = 'error';
        $code = '1404';
        switch ($errorCode) {
            case 1404:
                $message = 'El evento que estas solicitado no se ha encontrado.';
                $code ='Error :(';
            break;
            case 1405:
                $message = 'El producto que estas solicitado no se ha encontrado.';
                $code ='Error :(';
            break;
            case 404:
                $message = 'No se ha encontrado la página solicitada.';
                $code ='404';
            break;

            case 0000:
                $message = 'No tienes permiso para acceder a esta página.';
                $code ='401';
            break;

            default:
                $message = 'No se encuentra la página solicitada.';
                $code = '404';
            break;
        }



        return view('messages.not-found', ['pageTitle' => 'Página no encontrada', 'message' => $message, 'errorCode' => $code, 'eventTypes' => $this->eventTypes]);
    }

}
