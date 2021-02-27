<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Invitation;
use App\User;
use Mail;
use PDF;
use Image;
use App\Event;

class InvitationController extends Controller
{
    //

    /*
    # Configuar imagen de fondo para la invitación (por evento)
    */

    public function configInvitationView(Request $data){

        $eventId = $data->eventId;
        $logoExists = 0;
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        if(count($userEventRoleAuth) <= 0){
            $userEventRoleAuth = null;
        }
       
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

        $eventData = Event::getSpecificEventData($eventId);

        $eventAdminStatus = $eventData[0]->event_open_for_admin;
        $logo = null;
       // dd($eventData);
        if($eventData[0]->INVITATIONPICTURE != null){
            $logoExists = 1;
            $logo = "images/events/invitations/templates/" . $eventData[0]->INVITATIONPICTURE;
        }
        else{

            $logo = "images/events/invitations/templates/ticket-template.jpg";
        }
        //dd($eventAdminStatus);
        return view('backend.admin.invitations.config-invitation', ['eventId' => $eventId, 'eventName' => $eventData[0]->NAME, 'logo' => $logo, 'logoExists' => $logoExists, 'permissions' => $userPermissions['permission'], 
                                                                      'typeName' => $userPermissions['typeName'], 'eventAdminStatus' => $eventAdminStatus ]);

    }

    /*
    # Guardar la plantilla para la invitación
    */

    public function storeInvitationTemplate(Request $request, $evId){

        if($request->hasFile('file')){
            $imgpath="images/events/invitations/templates/";
            $imgpathBlank="images/events/invitations/templates/blank/";

            try{
                $name = mt_rand();

                $imageFile = $request->file('file');

                $size = getimagesize($imageFile);

                
                if($size[0] != 775 || $size[1] != 1280){

                    return response()->json(['status' => 'sizeerror', 'message' => 'El tamaño de la imagen no es el adecuado', 'wt' => $size[0], 'hg' => $size[1] ]);



                }
              
                $extension = $imageFile->getClientOriginalExtension();
                
                $filename = $name . '.' . $extension;
                

               // return $imgpath . $blankFilename;
                $result =      $imageFile->move($imgpath, $filename);

                copy($imgpath.$filename, $imgpathBlank.$filename);

                $imgurl = url($imgpath . $filename);

                    $update = Event::where('id', $evId)
                                   ->update(['eventInvitationPicture' => $filename] );


                    return response()->json(['status'=> 'success', 'msg'=>'Se ha actualizado la plantilla de ticket!', 'imgsrc'=> $imgurl, 'imgId' => $evId]);

                } catch(exception $ex)
                {
                    return ($ex->getMessage);
                }  
            
            
        }
    }


	/*
	* get invitation view
	*/
    public function getInvitationView(Request $data){

    	//	dd($data->all());
        $checkInvitation = Event::where('id',$data->eventId)->pluck('eventInvitationPicture');
        $invitationConfigured = 0;

        if($checkInvitation[0] != null){
            $invitationConfigured = 1;
        }
        

    	$eventData = DB::table('events')->where('id', $data->eventId)->get();

    	$eventName = $eventData[0]->eventName;
        $eventAdminStatus = $eventData[0]->event_open_for_admin;
    	// Check roles to show/not show products
        

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $data->eventId)->pluck('UE.user_type_id');

        if(count($userEventRoleAuth) <= 0){
            $userEventRoleAuth = array(0);
        }

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
        }

        $tickets = DB::table('invitations as I')->join('users as U', 'U.id', 'I.userFrom')->select('I.id as CODE', 'U.userFirstName as FFNAME', 'U.userLastName as FLNAME', 'I.status as STATUS', 'I.recipientEmail as RECIPIENT', 'I.created_at as DATE')->where('event_id', $data->eventId)->get();
        $countTickets = count($tickets);

        //dd($tickets);

    	return view('backend.admin.invitations.admin-invitations', ['eventId' => $data->eventId, 'eventName' => $eventName, 
                                                                    'permissions' => $permissions, 'invitations' => $tickets, 
                                                                    'cTickets' => $countTickets,
                                                                    'invitationConfigured' => $invitationConfigured,
                                                                     'eventAdminStatus' => $eventAdminStatus]);
    }

    /*
    * Send/store invitations
    */

    public function storeInvitation(Request $request){
    	try{

            $result = array();
            $errors = 0;
            $data = $request->all();

            $checkInvitation =Event::where('id',$data['eventId'])->pluck('eventInvitationPicture');

            if($checkInvitation[0] == null){
                $result =['status' => 'no_configure', 'message' => 'La plantilla de invitación no ha sido configurada.'];

                return json_encode($result);
            }


    		

	        $emails = $data['emails'];

	        $eventData = DB::table('events')->where('id', $data['eventId'])->get();
	        $eventName = $eventData[0]->eventName;
	 		
	 		$customPaper = array(0,0,215.00,145.00);
	 		$path = public_path('images/events/invitations');
	        foreach ($emails as $email) {
	        	# code...	        ->setPaper($customPaper, 'portrait')
		        $mailTo = $email;
		        $codeNumber = mt_rand();

		        //Save in table invitations

		        $invitation = new Invitation();
		        $invitation->id = $codeNumber;
		        $invitation->event_id = $data['eventId'];
		        $invitation->subject = 'TICKET DE INGRESO EXPOMOTRIZ 2018';
		        $invitation->body = 'Ticket especial para el evento';
		        $invitation->userFrom = Auth::user()->id;
		        $invitation->recipientEmail = $email;
		        $invitation->status = 1; //1 = Ticket enviado
		        $invitation->save();

                $picture_name = Event::where('id', $data['eventId'])->pluck('eventInvitationPicture');
                $eventData = Event::getSpecificEventData($data['eventId']);
		      
		        $picture_path = 'images/events/invitations/templates/' . $picture_name[0];



		        $img = Image::make($picture_path);

		        $img->text($codeNumber, 400, 780, function($font) {

		        	$font->file(public_path('fonts/Oswald-Regular.ttf'));				  
				    $font->size(40);
				    $font->color('#000000');
				    $font->align('center');
				    $font->valign('center');
				    
				});
                
                $img->save($picture_path);
		     
		        $mailData = ['fullname' => $mailTo, 'eventName' => strtoupper($eventData[0]->NAME), 'codeNumber' => $codeNumber, 'img' => $codeNumber, 'picture_path' => $picture_path, 'URL' => $eventData[0]->URL ];
		        $mailSubject = 'TICKET DE INGRESO ' . strtoupper($eventData[0]->NAME);

		        Mail::send('emails.event-invitation', $mailData, function($message) use($mailData, $email, $mailSubject, $mailTo, $picture_path, $codeNumber){
		           $message->to($email,  $mailTo);
		           $message->subject($mailSubject);
		           $message->from('info@networkingapp.net', 'NetworkingApp');
		           $message->attach($picture_path);
		        });

		        //Change to clean image
		        $picture_path_blank = 'images/events/invitations/templates/blank/'.$picture_name[0];
		        $img->insert($picture_path_blank , 'bottom-right', 0, 0);
				$img->save($picture_path);


				//user from

				$userFrom = DB::table('users')->where('id', Auth::user()->id)->select('userFirstName as FNAME', 'userLastName as LNAME')->get();
				$invData = DB::table('invitations')->where('id', $codeNumber)->get();

				$date = date_create($invData[0]->created_at);
				$invDate = date_format($date, 'd/m/Y');

				$result=['id' => $codeNumber, 'recipient' => $email, 'status'=> 'success', 'from'=> $userFrom[0]->FNAME . ' ' . $userFrom[0]->LNAME, 'date' => $invDate];
	        } //end foreach

    	} catch(exception $e){

    		return $e->getMessage();
    	}




    	return json_encode($result);

    }

    public function getTicketReceptionView(Request $data){
    	try{
    	$eventId = $data->eventId;
    	$eventData = DB::table('events')->where('id', $data->eventId)->get();

    	$eventName = $eventData[0]->eventName;
    	
    	return view('backend.admin.invitations.ticket-receptions', ['eventName' => $eventName, 'eventId' => $eventId, 'countTickets' => 0]);

    	} catch(exception $e){

    		return 0;
    	}
    }

    public function searchTicketsForRecept(Request $data){
    	$eventId = $data->eventId;
        //dd($eventId);
    	$eventData = DB::table('events')->where('id', $data->eventId)->get();

    	$permission = $this->getPermissionsForUserAuth($eventId);

    	$permissions = $permission['permission'];

    	$textFilter = $data->searchParams;
    	$eventName = $eventData[0]->eventName;

        $eventAdminStatus = $eventData[0]->event_open_for_admin;
     

    	$tickets = DB::table('invitations as I')->join('users as U', 'U.id', 'I.userFrom')->select('I.id as CODE', 'U.userFirstName as FFNAME', 'U.userLastName as FLNAME', 'I.status as STATUS', 'I.recipientEmail as RECIPIENT', 'I.created_at as DATE')->where('event_id', $data->eventId)->where(function ($query)  use ($textFilter){
                                 $query->where('I.id',  'like', '%' . $textFilter . '%')
                                 ->orWhere('I.recipientEmail',  'like', '%' . $textFilter . '%');
                             });

    	$tickets = $tickets->paginate(10);

    	$countTickets = count($tickets);

		return view('backend.admin.invitations.ticket-receptions', ['eventName' => $eventName, 'eventId' => $eventId, 'countTickets' => $countTickets, 'tickets' => $tickets, 'permissions' => $permissions,
            'eventAdminStatus' => $eventAdminStatus]);    	
    }













    /*
    * get user permissions
    */

   public function getPermissionsForUserAuth($eventId){

   		$permissionsData = array();
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');


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
        }


        $permissionsData = ['permission'=> $permissions, 'typeName' => $typeName];

        return $permissionsData;
   }

   public function changeTicketStatus(Request $request){
    $result = array();
    try{
        $ticketId = $request['ticketId'];

        $ticketStt = DB::table('invitations')->where('id', $ticketId)->update(['status' => 0]);

        $result = ['status' => 'success', 'message' => 'Ticket Recibido con éxito', 'ticketId' => $ticketId, 'cTickets' => $ticketStt];
    } catch(exception $e){

        $result = ['status'=>'error', 'message' => $e->getMessage()];
    }

    return json_encode($result);

   }



}
