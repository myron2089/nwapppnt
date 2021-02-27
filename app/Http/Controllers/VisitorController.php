<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Event;
use App\EventType;
use App\User;
use Auth;
use App\Http\Controllers\FieldTemplateController;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\UserEvent;
use App\FormSection;
use App\EventSession;
use App\FormSectionFieldAnswer;
use App\UserFormSectionAnswer;
use App\UserEventSessionFavorite;
use App\Product;
use App\Sale;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\UserRegisterMessage;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\VisitorsDinamicExportView;
use Maatwebsite\Excel\Facades\Excel;


class VisitorController extends Controller 
{
    //


	/*
	* Próximos eventos 
	*/
    public function getEventUpcomingView(){

    	//Seleccionar los próximos 5 eventos para mostrar al visitante

    	$events = Event::from('events as EV')
    	               ->join('event_locations as EL', 'EL.id', 'EV.event_location_id')
    	               ->join('event_types as ET', 'ET.id', 'EV.event_type_id')
    	               ->select([\DB::raw('EV.id as EVENTID, EV.eventName as NAME, EV.eventDescription as DESCRIPTION, EL.eventLocationName as LOCATION, CASE DAYOFWEEK(EV.eventStart)
   										    WHEN 1 THEN "Domingo"
    										WHEN 2 THEN "Lunes"
    										WHEN 3 THEN "Martes"
   											WHEN 4 THEN "Miércoles"
   											WHEN 5 THEN "Jueves"
										    WHEN 6 THEN "Viernes"
										    WHEN 7 THEN "Sábado"
										    END as DAY, EV.eventStart as EVENTSTART,
										    CONCAT(EV.eventPicturePath,"/", EV.eventPicture) as PICTURE,
										    ET.eventTypeName as TYPE')])
    	               ->orderBy('EV.eventStart', 'asc')
    	               ->take(10)->get();

    	$title = 'Net Working App';
    	//dd($events);
    	return view('frontend.pages.events.upcoming-events', ['events' => $events, 'page_title' => $title, 'rmsg' => 0
    			   ]);

    }

    /*
    * Mostrar evento seleccionado
    */

    public function getSpecificEventView($evType, $evUrl){



        $evUrlExtended = 'eventos/'.$evType.'/'.$evUrl;


        $evId = DB::table('events as E')->where('E.eventUrl', $evUrl)->pluck('E.id');


        //Verificar si se ha encontrado el evento

        if(count($evId) > 0)
        {

            $evId = $evId[0];  

            $eventAboutUs = null;
            $eventPhone = null;
            $eventWebSite = null;
            $eventFB = null;
            $eventTW = null;
            $eventLocation = null;
            $eventEmail = null;
            $evebtFullDescription=null;
            $aboutImage = "images/events/webpage/about/noAboutImage.jpg";


          $eventTypes = DB::table('event_types')->orderBy('eventTypeName', 'asc')->get();
        	$eventData = Event::from('events as E')
        	                  ->join('event_types as ET', 'ET.id', 'E.event_type_id')
        	                  ->join('event_locations as EL', 'EL.id', 'E.event_location_id')
        	                  ->join('payment_currencies as PC', 'PC.id', 'E.payment_currency_id')
        	                  ->where('E.id', $evId)
        	                  ->select([\DB::raw('E.id as EVENTID, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as DESCRIPTION, EL.eventLocationName as LOCATION, E.eventPrice as PRICE, PC.currencySymbol as CURRENCY, E.eventUrl as URL,
        	                  					  CASE DAYOFWEEK(E.eventStart)
    	   										    WHEN 1 THEN "Domingo"
    	    										WHEN 2 THEN "Lunes"
    	    										WHEN 3 THEN "Martes"
    	   											WHEN 4 THEN "Miércoles"
    	   											WHEN 5 THEN "Jueves"
    											    WHEN 6 THEN "Viernes"
    											    WHEN 7 THEN "Sábado"
    											  END as DAY, 
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
                                                    END AS monthNameStart, 
                              CASE WHEN month(E.eventFinish) = 1
                                                        THEN (select "ENE")
                                                        WHEN month(E.eventFinish) = 2
                                                        THEN (select "FEB")
                                                        WHEN month(E.eventFinish) = 3
                                                        THEN (select "MAR")
                                                        WHEN month(E.eventFinish) = 4
                                                        THEN (select "ABR")
                                                        WHEN month(E.eventFinish) = 5
                                                        THEN (select "MAY")
                                                        WHEN month(E.eventFinish) = 6
                                                        THEN (select "JUN")
                                                        WHEN month(E.eventFinish) = 7
                                                        THEN (select "JUL")
                                                        WHEN month(E.eventFinish) = 8
                                                        THEN (select "AGO")
                                                        WHEN month(E.eventFinish) = 9
                                                        THEN (select "SEP")
                                                        WHEN month(E.eventFinish) = 10
                                                        THEN (select "OCT")
                                                        WHEN month(E.eventFinish) = 11
                                                        THEN (select "NOV")
                                                        WHEN month(E.eventFinish) = 12
                                                        THEN (select "DIC")
                                                    END AS monthNameFinish, 
                                                    DATE_FORMAT(E.eventStart,"%h:%i %p") as eventTimeStart, DATE_FORMAT(E.eventFinish,"%h:%i %p") as eventTimeFinish, month(E.eventStart) as monthNumber, day(E.eventStart) as dayNumber, year(E.eventStart) as yearNumber, year(E.eventFinish) as yearNumberFinish, ET.eventTypeName as TYPE, eventDescription as DESCRIPTION, E.eventStart as EVENTSART, day(E.eventFinish) as dayNumberEnds, month(E.eventFinish) as monthNumberEnds')])->get();

                            //dd($eventData);
        	$eventTitle = $eventData[0]->eventName;
        	//$eventTopImg = $eventData[0]->PICTURE;
          $eventUrl = $eventData[0]->URL;
        	$dateDayName = $eventData[0]->DAY;
        	$dateMonthName = $eventData[0]->monthNameStart;
        	$dateMonthNumber = $eventData[0]->monthNumber; 
          $dateMonthNumberEnds = $eventData[0]->monthNumberEnds; 
          $dateMonthNameFinish = $eventData[0]->monthNameFinish;
          $dateDayNumber = $eventData[0]->dayNumber;
          $dateDayNumberEnds = $eventData[0]->dayNumberEnds;
        	$dateYearNumber = $eventData[0]->yearNumber;
          $dateYearNumberFinish = $eventData[0]->yearNumberFinish;
        	$eventHourStart =$eventData[0]->eventTimeStart;
        	$eventHourFinish = $eventData[0]->eventTimeFinish;
        	$eventDescription = $eventData[0]->DESCRIPTION;
        	$eventLocation = $eventData[0]->LOCATION;
        	$eventAdmision = $eventData[0]->PRICE;
        	$eventAdmisionCurrency = $eventData[0]->CURRENCY;


          $pageTitle = $eventTitle;
         // dd($eventTitle);

    //    	dd(date('h:i', strtotime($eventData[0]->EVENTSTART)));

        	$eventOtherData = DB::table('event_web_resources')
        					 ->where('event_id', $evId)
        					 ->whereIn('event_web_resource_element_id', array(2, 3, 4, 5, 6, 9, 10,12))
        					 ->groupBy('event_id' )
        					  ->select([\DB::raw('event_id, max(CASE WHEN (event_web_resource_element_id = 2) THEN (SELECT eventWebResourceValue) END) AS SUBTITLE,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 3) THEN (SELECT eventWebResourceValue) END) AS FULLDESCRIPTION,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 4) THEN (SELECT eventWebResourceValue) END) AS ABOUTUS,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 9) THEN (SELECT eventWebResourceValue) END) AS WEBSITELINK,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 10) THEN (SELECT eventWebResourceValue) END) AS PHONENUMBER,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 5) THEN (SELECT eventWebResourceValue) END) AS FBLINK,
        					  	                 max(CASE WHEN (event_web_resource_element_id = 6) THEN (SELECT eventWebResourceValue) END) AS TWLINK,
                                       max(CASE WHEN (event_web_resource_element_id = 12) THEN (SELECT eventWebResourceValue) END) AS EMAIL')]);

        /*  $eventSpeakers = DB::table('users as U')
                              ->join('user_events as UE' , 'UE.user_id', 'U.id')
                              //->join('user_event_badges as UEB', 'UEB.user_event_id', 'UE.id')
                              ->where('UE.event_id' , $evId)
                              ->where('UE.user_type_id' , 4)
                              ->select([\DB::raw('CONCAT(U.userFirstName , " " , U.userLastName) AS FULLNAME, CONCAT("images/users/profiles/", U.userPicture) as PICTURE')])
                              ->get();
    */


          

      		$eventOtherData = collect($eventOtherData->get());
        	//dd($eventOtherData);

        	$eventSubTitle = '$eventOtherData[0]->SUBTITLE';

          if($eventOtherData->count() >0){
          	$eventAboutUs = $eventOtherData[0]->ABOUTUS;
            $evebtFullDescription = $eventOtherData[0]->FULLDESCRIPTION;
          	$eventPhone = $eventOtherData[0]->PHONENUMBER;
          	$eventWebSite = $eventOtherData[0]->WEBSITELINK;
          	$eventFB = $eventOtherData[0]->FBLINK;
          	$eventTW = $eventOtherData[0]->TWLINK;
            $eventEmail = $eventOtherData[0]->EMAIL;
          }


        
        	//dd($eventActivities);    

        	$eventBanner = DB::table('event_web_resources')
        					 ->where('event_id', $evId)
        					 ->where('event_web_resource_element_id', 7)
        					 ->select([\DB::raw('CONCAT(eventWebResourcePath, "/", eventWebResourceValue) AS PICTURE')])
        					 ->get();

          if(count($eventBanner)> 0){

            $aboutImage = $eventBanner[0]->PICTURE;
          }


        	$eventGallery = DB::table('event_web_resources')
        					 ->where('event_id', $evId)
        					 ->where('event_web_resource_element_id', 8)
        					 ->select([\DB::raw('CONCAT(eventWebResourcePath, "/", eventWebResourceValue) AS PICTURE')])
        					 ->get();

          //Imagen principal del evento

          $eventTopImg = DB::table('event_web_resources')
                   ->where('event_id', $evId)
                   ->where('event_web_resource_element_id', 7)
                   ->where('eventWebResourceOrder', 1)
                   ->select([\DB::raw('CONCAT(eventWebResourcePath, "/", eventWebResourceValue) AS PICTURE')])
                   ->get();

          if(count($eventTopImg)>0){

            $eventTopImg = $eventTopImg[0]->PICTURE;
          }
          else{
            $eventTopImg = "images/events/webpage/banner/noBannerImage.jpg";
          }

          
          //dd($eventTopImg);


            $sponsors = DB::table('event_web_resources')
                             ->where('event_id', $evId)
                             ->where('event_web_resource_element_id', 11)
                             ->select([\DB::raw('CONCAT(eventWebResourcePath, "/", eventWebResourceValue) AS PICTURE, eventWebResourceValue as NAME')])
                             ->get();

            //dd($sponsors);

       	

          $register = 0;
          $userId = 0;
          //verificar si ya se está registrado en el evento
          if(Auth::check()){

            $chekReg = UserEvent::where('user_id', Auth::user()->id)
                                ->where('event_id', $evId)
                                ->get();


            $userId= Auth::user()->id;
            if(count($chekReg)>0){
              $register = 1;
            }
          }

          $eventActivities = $this->getActivitiesTemplate($evId, $register, $userId);

        // dd($aboutImage);

        	return view('frontend.pages.events.show-event', [//'rmsg' => $rmsg,
                                  'eventTypes' => $eventTypes,
                                  'eventData' => $eventData,
        													 'eventTitle' => $eventTitle, 
        													 'eventSubTitle' => '',
        													 'description' => $eventDescription,
                                   'fullDescription' => $evebtFullDescription,
                                   'eventUrl' => $eventUrl,
                                   'evUrlExtended' => $evUrlExtended ,
                                   'aboutImage' => $aboutImage,
        													 'eventAboutUs' => $eventAboutUs,
        													 'dateMonthName' => $dateMonthName,
                                   'dateMonthNameFinish' =>  $dateMonthNameFinish,
        													 'eventLocation' => $eventLocation,
        													 'dateDayName' => $dateDayName, 
        													 'dateDayNumber' => $dateDayNumber,
                                   'dateDayNumberEnds' => $dateDayNumberEnds,
                                   'dateMonthNumberEnds' => $dateMonthNumberEnds,
        													 'dateYearNumber' => $dateYearNumber,
                                   'dateYearNumberFinish' => $dateYearNumberFinish,
                                   'dateMonthNumber' => $dateMonthNumber,
        													 'eventHourStart' => $eventHourStart,
        													 'eventHourFinish' => $eventHourFinish,
        													 'eventPhone' => $eventPhone,
                                   'eventEmail' => $eventEmail,
        													 'eventWebSite' => $eventWebSite,
        													 'eventFB' => $eventFB,
        													 'eventTW' => $eventTW,
        													 'eventTopImg'=> $eventTopImg,
        													 'eventAdmision' => $eventAdmision,
        													 'eventAdmisionCurrency' => $eventAdmisionCurrency,
        													 'eventActivities' => $eventActivities,
        													// 'eventSpeakers' => $eventSpeakers,
                                  // 'speakersCount' => count($eventSpeakers),
        													 'eventInfo' => $eventData, 
                                   'eventOtherInfo' => $eventOtherData, 
                                   'eventBanner' =>$eventBanner, 
                                   'eventGallery' => $eventGallery,
                                   'eventSponsors' => $sponsors,
                                   'countSponsors' => count($sponsors),
                                   'pageTitle' => $pageTitle,
                                   'register' => $register,
                                   'eventId' => $evId
                                 
                                 ]);
        }
        //Si no se encuentra el evento
        else{

          return redirect('error/1404');

        }
    }



    /*
    #Activities template
    */

    public function getActivitiesTemplate($eventId, $register, $userId){

      $favorite=0;
      if($register==1){
        $favorite==1;
      }

      $eventActivities = DB::table('event_sessions as ES')
                 ->join('event_session_locations as EL', 'EL.id' , 'ES.event_session_location_id')
                 ->where('ES.event_id', $eventId)
                 ->orderBy('ES.eventSessionStart')
                 ->select([\DB::raw('ES.id as AID, DATE_FORMAT(ES.eventSessionStart, "%h:%i %p") as SESSIONSTART, DATE_FORMAT(ES.eventSessionFinish, "%h:%i %p") as SESSIONFINISH, ES.eventSessionTitle as TITLE, ES.eventSessionDescription AS DESCRIPTION, DATE_FORMAT(ES.eventSessionStart,"%d/%m/%y") as ACTDATE, ES.eventSessionStart as FULLDATE ')])
                 ->orderBy('ES.eventSessionStart', 'desc')->get()
                 ;


      if($eventActivities->count() <= 0){

        return null;

      }

     // $activitiesPerDay = $eventActivities->groupBy('FULLDATE')->orderBy('ES.eventSessionStart', 'desc')->get();


      $prev = '';
      $dayNumber = 1;

      $tmp = '<div class="tabs tabs-bb clearfix ui-tabs ui-corner-all ui-widget ui-widget-content" id="tab-9">';
      $tmp .=   '<ul class="tab-nav clearfix ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header custom-activities-tab">';
      $counter = 1;

      //Tab Header

      $tmp .= '<li class="activity-time-title" style="    width: 130px; padding-top: 10px;"><span style="font-size: 18px; font-weight:600; color: #000;">Horarios</span></li>';
      foreach ($eventActivities as $activity) {


        if($prev!=$activity->ACTDATE){
                $tmp .= '<li '; if($counter==1) $tmp .='style="margin-left: 20px;"';    
                $tmp .= '><a href="#tabs-'. $counter .'">Día '. $counter .'</a></li>';
                $counter++;
        }


        $prev = $activity->ACTDATE;
        
      } 
      
      $counter=1;  
      $dayNumber = 1;
      $prev = '';



      $tmp .=   '</ul> <!--end tab-nav -->';  


      //Tab Body
      $tmp .=   '<div class="tab-container" >';
      foreach ($eventActivities as $activity) {

        

        if($prev!=$activity->ACTDATE){
          //$tmp .= '<div class="tab-content clearfix" id="tabs-'.$counter.'" style="max-height: 500px; overflow-y: scroll;">';
          $tmp .= '<div class="tab-content clearfix" id="tabs-'.$counter.'">'; 

          $tmp .=   '<table class="table table table-hover table-striped table-custom-blue" style="width:100%; margin-top: -20px;">';
          $tmp .=       '<!--<thead>
                          <tr>
                            <th><i class="icon-clock"></i> Hora</th>
                            <th>Actividad</th>
                          </tr>
                        </thead>-->';

             $prevDay='';
            $tmp .=     '<tbody">';
             foreach ($eventActivities as $activityDay) {
            
             $tmp .=    '<tr>';
             $prevDay = $activityDay->ACTDATE;
              

             $favBtn = "";
             $activeFavClass ="";
             $starClass = "fa-star-o";


              if($prevDay==$activity->ACTDATE){


                if($register==1){
                  $iconClass = 'icon-star';
                  $buttonText = 'Agregar a Favoritos';
                  if($userId != 0){
                    $userEvent = UserEvent::where('event_id',$eventId)->where('user_id', $userId)->pluck('id');

                    $checkFav = UserEventSessionFavorite::where('user_event_id', $userEvent[0])->where('event_session_id', $activityDay->AID)->get();
                    //dd(count($checkFav));
                    if(count($checkFav)>0){
                      $iconClass = 'icon-trash2';
                      $buttonText ='Remover de Favoritos';
                      $activeFavClass ="active active-2 active-3";
                      $starClass = "fa-star";

                    }
                    $favBtn = '<div id="star-click-'. $activityDay->AID .'" class="star-click ' . $activeFavClass . '"><span id="span-'. $activityDay->AID .'" onclick="addFavorite('. $activityDay->AID .', '. $eventId .')" class="fa '. $starClass .'"></span><div class="ring"></div><div class="ring2"></div><p id="info-'. $activityDay->AID .'" class="info">Agregado a favoritos!</p></div>';
                  }


                }



                $tmp .=   '<td class="time text-center"><code>'. $activityDay->SESSIONSTART .' <!--<i class="icon-clock"></i>--></code></td>';
                $tmp .=   '<td  class="line">' . $favBtn . '<span class="activities-title" style="font-size: 16px">'. $activityDay->TITLE . '</span> <br> <p style="font-size:16px;margin-bottom: 5px;">' . $activityDay->DESCRIPTION . '</p>';

             /*   if($register==1){
                  $tmp .= '<a  href="javascript:;" onclick="addFavorite('. $activityDay->AID .', '. $eventId .')" class="button button-rounded button-reveal button-small button-dirtygreen"><i id="icon-'.$activityDay->AID.'" class="'.$iconClass.'"></i><span id="favorite-'.$activityDay->AID.'">'. $buttonText .'</span></a>';
                }*/



                $tmp .='</td>';
                
                 
              }

            $tmp .=     '</tr>';

             }
          $tmp .=     '</tbody><!--end tbody -->';
          $tmp .=   '</table> <!-- end table -->';
          $tmp .= '</div>';
          $counter++;
        }
        $prev = $activity->ACTDATE;
      
      }

      $tmp .=   '</div> <!--#end tab-container -->';


      $tmp .= '</div> <!-- #end tabs -->';

      return $tmp;

    }


    /*
    * Visitor Profile
    */

    public function getProfileView(){

        if (Auth::check())
        {
            
            $visitorData = User::where('id', Auth::user()->id)->get();
           
            
            $countFields=0;

            $myData = DB::table('users as U')->where('U.id', Auth::user()->id)
                        ->select([\DB::raw('CONCAT(U.userFirstName, " ", U.userLastName) as FULLNAME, CONCAT("images/users/profiles/", U.userPicture) AS PICTURE')])->get();
           // dd($myData);

             $visitorData = User::where('id', Auth::user()->id)->get();

            return view('frontend.users.my-profile', ['page_title' => 'Mi Perfil', 'myCardData' => $myData, 'pageTitle' => 'Mi Perfil', 'myData' => $visitorData, 'type'=>'profile']);

         //  dd($additionalData);


        } else{

            return redirect('error/0000');
        }

    }


    /*
    * Vista de la cuenta
    */

    public function getVisitorAccountView(){

       $myData = DB::table('users as U')->where('U.id', Auth::user()->id)
                        ->select([\DB::raw('CONCAT(U.userFirstName, " ", U.userLastName) as FULLNAME, CONCAT("images/users/profiles/", U.userPicture) AS PICTURE')])->get();
      return view('frontend.users.my-profile', ['page_title' => 'Mi Perfil', 'pageTitle' => 'Mi Perfil','myCardData' => $myData, 'type'=>'account']);

    }



    /*
    * Vista para ver los eventos
    */
    public function getVisitorEvents(){

      $myData = DB::table('users as U')->where('U.id', Auth::user()->id)
         ->select([\DB::raw('CONCAT(U.userFirstName, " ", U.userLastName) as FULLNAME, CONCAT("images/users/profiles/", U.userPicture) AS PICTURE')])->get();

      /*$events = Event::from('events as E')->select([\DB::raw('E.id as eventId, E.eventName as eventName, E.eventPicture as eventPicture, E.eventDescription as FULLDESCRIPTION, E.eventUrl as URL,
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
        ->join('user_events as ue', 'ue.event_id', 'E.id')
        ->orderBy('eventStart' , 'asc')
        ->where('ue.user_id', Auth::user()->id)->get(); */


        $events = Event::from('events as EV')
                       ->select([\DB::raw('EV.id as ID, EV.eventName as NAME, EV.eventStart as EVENTSTART, EV.eventFinish as EVENTFINISH, EV.eventDescription as DESCRIPTION, CONCAT(EV.eventPicturePath, "/", EV.eventPicture) as PICTUREPATH,
                           CASE
                  WHEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id > 0)
                    THEN (Select count(UE2.id) from user_events UE2 where UE2.event_id  = EV.id and UE2.user_type_id = 5)
                    ELSE (SELECT UE2.id from user_events as UE2 WHERE UE2.event_id  = EV.id )
                END as VISITORS ')])

                       ->groupBy('EV.id', 'EV.eventName', 'EV.eventStart', 'EV.eventDescription', 'EV.eventPicture', 'EV.eventPicturePath', 'EV.eventFinish')
                       ->join('user_events as ue', 'ue.event_id', 'EV.id')
                       ->where('ue.user_id', Auth::user()->id)
                       ->orderBy('EVENTSTART', 'asc')
                       ->get();


        
        return view('backend.user.my-profile', ['page_title' => 'Mi Perfil', 'pageTitle' => 'Mi Perfil','myCardData' => $myData, 'type'=>'events', 'events' => $events, 'checked' => 'events']);

    }

    /*
    * Vista de datos de usuario que se cargan via ajax
    */

    public function getVisitorDataView(){

      $visitorData = User::where('id', Auth::user()->id)->get();

      return view('frontend.users.partials.my-user-data',['myData' => $visitorData]);


    }



    /*
    # Vista para eventos de visitante (registrado)
    */

    public function getEventListView(){

      $events = Event::getEventsForCards(Auth::user()->id, 1)->get();
      $eventTypes = EventType::getEventTypes()->get();
      $pageTitle = 'Mis Eventos';

    //  dd($events);

      return view('frontend.events.my-events', ['events'=> $events, 'eventTypes' => $eventTypes, 'pageTitle' => $pageTitle]);
    }


        



    public function getUserRegisterCatalogTemplate($userType, $eventId, &$countFields){



        $fields = Field::from('fields as F')
                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
                      ->where('FS.form_id', 5) //form Visitantes
                      ->where('FS.section_id', 1) //section Registro
                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as PHOLDER, F.fieldRequired as FREQUIRED, F.fieldMaxLenght as MAXLENGHT, F.data_type_control_id as CONTROLTYPE')])->get();



         $questions  = DB::table('fields AS PRE')
                        ->join('form_section_fields AS APRE', 'APRE.field_id', '=', 'PRE.id')
                        ->join('form_sections AS ASEC', 'ASEC.id', '=', 'APRE.form_section_id')
                        ->join('data_type_controls AS ATIP', 'ATIP.id', '=', 'PRE.data_type_control_id')
                        ->join('data_types AS TDATO', 'TDATO.id', '=', 'ATIP.data_type_id')
                        ->join('controls AS TCON', 'TCON.id', '=', 'ATIP.control_id')
                     
                        ->where('ASEC.section_id', 1)
                        ->where('ASEC.form_id', $userType)  
                        ->orderBy('PRE.id', 'asc')
                          ->select([\DB::raw('PRE.data_type_control_id as CONTROLTYPE, TDATO.dataTypeName as TYPE, APRE.id as IDASIG, PRE.fieldText as TAG, PRE.fieldMaxLenght as MAXLENGHT, PRE.id as ID')])
                        ->get();     

                              

        $countFields = count($fields);
        $ftmp='';
        foreach ($questions as $field) {
            
     /*   $ftmp .=    '<div class="group" style="margin-top: 5px">';

        $control = $this->getControlTemplate($field->CONTROLTYPE, $field->ID, $field->MAXLENGHT, $field->FREQUIRED, $field->TAG, $field->PHOLDER );    

        $ftmp .=        $control;
       
        $ftmp .=    '</div>'; */

        $formAsigned = DB::table('user_event_forms as F')
                         ->join('user_events as UE', 'UE.id', 'F.user_event_id')
                         ->where('UE.user_id', Auth::user()->id)
                         ->where('F.form_id', $userType)
                         ->pluck('F.id');

        //dd($formAsigned);

       $idasigform = DB::table('user_form_section_answers AS ACUE')
                         ->join('forms as F', 'F.id', 'ACUE.form_id')
                         ->join('user_event_forms as EF', 'EF.form_id', 'F.id' )
                         ->join('user_events as UE', 'UE.id', 'EF.user_event_id')
                         ->where('UE.user_id', Auth::user()->id)
                         ->where('ACUE.user_id', Auth::user()->id)
                         ->where('UE.event_id', $eventId)
                         ->pluck('ACUE.id');

       
      //dd($idasigform);
        
        $ftmp .= '<div class="group">';
           
                $control = $this->getControlTemplate($field->CONTROLTYPE, $field->TYPE, $field->IDASIG, $field->TAG, $field->MAXLENGHT, $field->IDASIG, $idasigform, $field->ID  );  
                $ftmp .=        $control;
            $ftmp .=    '</div>';
       
          
                                                                                   

        }
        
        return $ftmp;
    }

    public function getControlTemplate($controlType, $dataType, $idAsig, $tag, $maxL, $aId, $idasigform, $fId){
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
         $answer = DB::table('form_section_field_answers AS RESP')
                     ->where('RESP.user_form_section_answer_id', $idasigform[0]) //STATUS 10 IS THE 'ENABLED O ACTIVE' STATUS
                     ->where('RESP.form_section_field_id', $aId)
                     ->pluck('RESP.answerValue');



                     

        $tmp ='';
        switch ($controlType) {
            case 1:
                # input text
            
            $tmp .= '<input id="'. $aId .'" name="'. $aId .'" type="text"  data-trigger="manual" value="'. $answer[0] .'" maxlenght="'. $maxL .'" ';
                       /* if($required == 1){
                            $tmp .= 'required';
                        }*/
            $tmp .= '>';
            /*
            $tmp .='<span class="highlight"></span><span class="bar"></span>

                        <label>'. $tag .'</label>
                        <div class="err-msg uemail">
                            <span>'. $placeH .'</span>
                        </div>';*/
/*
            $tmp = '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="'. $aId .'" name="'. $aId .'" value="' . $answer[0] . '">
                                <label class="mdl-textfield__label" for="'. $id .'">'. $tag .'</label>
                                <span class="mdl-textfield__error">Input is not a number!</span></div>';

  */                               
                break;
            
            case 8: 
                # dropdown list
                $options = $this->getDdListTemplate($fId, $answer[0]);
                $tmp .= '<select id="'. $aId .'" name="'. $aId .'">';
                    $tmp .= $options;
                $tmp .= '</select>';
              
              /*  $tmp .=    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">';
                $tmp .= '<input type="text" value="" class="mdl-textfield__input" id="'. $id .'" readonly>
                                <input type="hidden" value="" name="'. $id .'">
                                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                <label for="'. $id .'" class="mdl-textfield__label">'. $tag .'</label>';

               $tmp .= '<ul for="'. $id .'" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">';
               $tmp .= $options;
               $tmp .= '</ul>';
               $tmp .= '</div>';*/
                break;
        }

        return $tmp;



    }


    public function getDdListTemplate($fId, $ans){
        $options = FieldOption::where('field_id', $fId)
                              ->orderBy('optionValue', 'asc')
                              ->get();
        $tmp = '';
        foreach ($options as $option) {
            $tmp .= '<option'; if($option->optionValue == $ans ){ $tmp .= ' selected '; } $tmp .='value="'. $option->optionValue . '">' . $option->optionName . '</option>';


             // $tmp .= '<li class="mdl-menu__item" data-val="'. $option->optionValue . '">' . $option->optionName . '</li>';
        }

        return $tmp;
        

    }

    /*
    # actualizar datos dinámicos desde perfil de usuario
    */
    public function updateEventUserData(Request $data){


      $a=0;


      DB::beginTransaction();
      try{


        $eventData = Event::from('events as e')
                          ->join('event_types as et', 'et.id','e.event_type_id')
                          ->where('e.id', $data['evId'])
                          ->select([\DB::raw('e.eventName as NAME, e.eventUrl as URL, LOWER(et.eventTypeName) as TYPE, CONCAT("eventos/", LOWER(et.eventTypeName),"/", e.eventUrl) as  FULLURL')])
                          ->get();

        //verificar si está registrado en el evento
        $checkU = UserEvent::where('user_id', Auth::user()->id)
                           ->where('event_id', $data['evId'])
                           ->get();



        if(count($checkU)==0){
          //registrar
           $userEventId = mt_rand();
           $asign = UserEvent::create([
              'id' => $userEventId,
              'user_id' => Auth::user()->id,
              'event_id' => $data['evId'],
              'user_type_id' => 5,
              'role_id' => 3,
              'registered_from_id' => 1,  //Lugar de registro 1) portal web 2) App escritorio
          ]);

        }

        $userEventData = UserEvent::where('user_id', Auth::user()->id)
                           ->where('event_id', $data['evId'])
                           ->get();


         if($data['dinamicFields']>0){                 

           //Veriicar user_event_forms

            $checkF = UserEventForm::where('user_event_id', $userEventData[0]->id)->get();

            if(count($checkF) ==0 ){
              $eForm = new UserEventForm();
              $eForm->id = time();
              $eForm->form_id = 5;
              $eForm->user_event_id = $userEventData[0]->id;
              $eForm->save();
            }

          //return count($checkF);

          


            foreach ($data->all() as $key => $value) {
                //Verificar que los campos por defecto no se igresen, al agregar un campo por defecto se tendria que agregar en el if
                if($key != '_token' && $key != 'userType' && $key != 'userFirstName' && $key != 'userLastName' && $key != 'userDob' && $key != 'userCompany' && $key != 'dinamicFields' && $key != 'userEmail' && $key != 'userPassword' && $key != 'userPasswordConfirm' && $key != 'userCellPhoneNumber' && $key != 'userState' && $key != 'userTown' && $key != 'userAddress' && $key != 'eventCreate' && $key != 'evId'){
                    

                    //obtener las preguntas segun los id de los inputs
                    $vasign = DB::table('form_section_field_answers AS ANS')
                                ->join('user_form_section_answers AS AFORM', 'AFORM.id', '=', 'ANS.user_form_section_answer_id')
                                ->where('ANS.form_section_field_id', $key) //STATUS 10 IS THE 'ENABLED O ACTIVE' 
                                ->where('AFORM.user_id', Auth::user()->id)
                                ->pluck('ANS.form_section_field_id');
                         
                        $countvasign = count($vasign);
                        //dd($countvasign);
                        //Verificar que la respuesta no este asignada, de no estarlo, crear nuevam de lo contrario actualizar (else)
                        if($countvasign==0)
                        {      
                          //Traer la llave de la tabla td_asig_cuestionario para almacenarla en tm_respuesta, segun el usuario
                          $asigcuest= DB::table('user_form_section_answers AS ACUEST')
                                      ->where('ACUEST.form_id', 5) //VISITANTE FORM
                                      ->where('ACUEST.user_id', Auth::user()->id)
                                      ->pluck('ACUEST.id');



                          $ufsaId = mt_rand();
                          $ufsa = new UserFormSectionAnswer();
                          $ufsa->id = $ufsaId;
                          $ufsa->form_id = 5; //VISITANTE
                          $ufsa->user_id = Auth::user()->id;
                          $ufsa->save();


                             //dd($asigcuest[0]);
                          $fsfId= mt_rand();
                          $fsec = new FormSectionFieldAnswer();
                          $fsec->id = $fsfId;
                          $fsec->answerValue = $value;
                          $fsec->form_section_field_id = $key;
                          $fsec->user_form_section_answer_id = $ufsaId;
                          $fsec->save();
                          $a++;
                        }
                        else{
                            $resultans=FormSectionFieldAnswer::where('form_section_field_id', $vasign[0])
                                                             ->update(['answerValue' => $value
                                                                      ]);
                          $a--;
                        }
                    

                }
             
            } //end foreach 1

          }


          $userData = User::where('id', Auth::user()->id)->get();

          $qr = QrCode::format('png')->size(200)->generate('USERS' . $userEventData[0]->id);

          $mailData = ['fullname' => $userData[0]->userFirstName . " " . $userData[0]->userLastName, 'qr' => $qr, 'password' => "", 'email' => $userData[0]->userEmail, 'eventName' => $eventData[0]->NAME, 'fromEvent' => '1' ];

          $email = $userData[0]->userEmail;

          Mail::to($email)->send(new UserRegisterMessage($mailData));
          
         
          
          $result = ['status'=>'success', 'message'=>'Se ha actualizado la información con éxito!', 'eventUrl' => $eventData[0]->FULLURL];


        DB::commit();

      }catch(exception $e){
          DB::rollBack();
          $result = ['status'=>'error', 'message'=>'Ha ocurrido un error al intentar el registro.'];

          return json_encode($result);
      }


      return json_encode($result);

    }



     /*
    ** Vista de producto
    */
    public function getEventProductView(Request $request, $evType, $evUrl, $productId){


        $eventData = Event::where('eventUrl', $evUrl)->pluck('id');
        $saleExists = false;
        $sale = null;
        //Verificar evento
        if(count($eventData) > 0){
           $eventId = $eventData[0];


           //Obtener producto
           $productData = Product::from('products as p')
                                ->leftjoin('brands as b', 'b.id','p.brand_id')
                                ->join('payment_currencies as c', 'c.id', 'p.payment_currency_id')
                                ->where('p.event_id', $eventId)
                                ->where('p.id', $productId)
                                ->get();


          


           
          //Verificar producto
          if(count($productData) > 0){
           // dd($productData);


            //Generar listado de todos los productos del evento

            $products = Product::from('products as p')
                                ->join('brands as b', 'b.id','p.brand_id')
                                ->join('payment_currencies as c', 'c.id', 'p.payment_currency_id')
                                ->where('b.event_id', $eventId)
                                ->select('p.id as productId', 'p.productName as productName', 'p.productPrice', 'c.currencySymbol as currencySymbol', 'p.productPicture as productPicture')
                                ->get();

           // dd($products[0]);
            //Verificar si el producto tiene oferta
           $productSale = Sale::where('product_id', $productId)->pluck('saleDescription');
           if(count($productSale)>0){
            $sale = $productSale[0];
           }

           if(count($productSale)>0){
              $saleExists=true;
           }

            $eventName = Event::where('id', $eventId)->get();
            $evUrlExtended="eventos/".$evType."/".$evUrl."/productos/".$productId;


            return view('frontend.pages.products.show', ['pageTitle'=> $productData[0]->productName,
                                                         'productData' => $productData,
                                                         'evUrlExtended' => $evUrlExtended,
                                                         'products' => $products,
                                                         'eventName' => $eventName[0]->eventName,
                                                         'eventUrl' => $evUrl,
                                                         'eventType' => $evType,
                                                         'saleExists' => $saleExists,
                                                         'sale' => $sale,
                                                          'eventTitle' => $productData[0]->productName
                                                        ]);
           }
           else{
           
            return redirect()->to('error/1405');
           }




        } else{
          return redirect()->to('error/1405');
        }
        //$title = 'Registro de Visitantes';

        //return $title;

    }


    /*
    ** REPORTE GENERAL DE VISITANTES POR EVENTO, INCLUYENDO TODOS LOS CAMPOS DINAMICOS
    */

    public function getFullVisitorReport2(Request $request){

      $eventId = $request->eventId;


      $users = User::from('users as u')
                    ->join('user_events as ue', 'ue.user_id', 'u.id')
                    ->where('ue.user_type_id', 5)
                    ->where('ue.event_id', $eventId)
                    ->select(\DB::raw('u.id as userId, u.userFirstName,u.userLastName,ue.id as user_event_id'))
                   
                    ->get();


      return $users;


    }


    public function getFullVisitorReport(Request $request){
      set_time_limit(0);
      $eventId = $request->eventId;
      $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');


      $fileName = str_replace(' ', '', $eventName[0].".xls");

      libxml_use_internal_errors(true);

      return Excel::download(new VisitorsDinamicExportView($eventId),  $fileName); 

      libxml_use_internal_errors(false);

     /* return [
        'success' => true,
        'path' => $domain = Request::server('HTTP_HOST')."exports/ReporteVisitantes" . $file
      ];*/

     //funciona return Excel::download(new VisitorsDinamicExportView($eventId), "ReporteVisitantes" . $eventName[0] .".xls"); 

     // return (new VisitorsDinamicExportView($eventId))->view('referrerSheet.xlsx');
    }



    /* Mostrar respuesta segun tipo de campo de la pregunta*/
    public function getAnswerTemplate($form_section_field_id, $userId){


      /*
      * Obtener id del campo (field_id)
      */

      $fieldId= FormSectionField::where('id', $form_section_field_id)->pluck('field_id');

      /*Obtener el tipo de campo*/

      $fieldType = Field::from('fields as f')
                        ->join('data_type_controls as dc', 'dc.id', 'f.data_type_control_id')
                        ->join('controls as c', 'c.id', 'dc.control_id')
                        ->where('f.id', $fieldId)
                        ->pluck('c.id');

      /*
      * 1 Input
      * 2 Dropdown
      * 3 Radio Button
      * 4 Check Box
      * 5 Text Area
      */


      $answer = DB::table('form_section_field_answers as a')
                            ->join('user_form_section_answers as ua', 'ua.id', 'a.user_form_section_answer_id')        
                            ->where('a.form_section_field_id', $form_section_field_id)
                            ->where('ua.user_id', $userId)
                            ->select('a.answerValue as Value')
                            ->get();

      switch ($fieldType[0]) {
        // Input
        case "1":

          if((count($answer) > 0) &&  $answer[0]->Value != null){
            return ($answer[0]->Value);
          }
          else{
            return "N/A";
          }


           
          break;


        // Dropdown
        case "2":

          if((count($answer) > 0) &&  $answer[0]->Value != null && $answer[0]->Value != "0" ){
          $option = DB::table('field_options as fo')
                        ->where('fo.field_id', $fieldId)
                        ->where('fo.optionValue', $answer[0]->Value)
                        ->pluck('fo.optionName')
                        ;
                 return $option[0];
          }
          else{
            return "N/A";
          }
            


          break;


        case "3":

          break;


        case "4":

          break;

        case "5":

          break;
        
        default:
           return "N/A";
          break;
      }



     


    }


    public function excelExport() 
    {
        return Excel::download(new InvoicesExport, 'visitantes.xlsx');
    }



}
