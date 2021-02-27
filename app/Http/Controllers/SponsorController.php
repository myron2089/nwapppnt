<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use File;
use App\User;
use App\UserRole;
use App\Event;
use App\UserEvent;
use DB;
use App\EventWebResource;
use Auth;
use Image;

class SponsorController extends Controller
{
    //

    /*
    * Sopnsor get view for register
    */

    public function getRegisterView(){

    	return view('auth.sponsor.register');
    }

    /*
    * Sponsor admin page (admin side)
    */

    public function getSponsorsView($evId){

        $sponsors = DB::table('event_web_resources')->where('event_id', $evId)->where('event_web_resource_element_id', 11)->get();
      /*  $brands = DB::table('brands')->orderBy('brandName','asc')->get();
        $currencies = DB::table('payment_currencies')->orderBy('id', 'asc')->get();
        */
        return view('backend.admin.sponsors.sponsors-admin', ['sponsors' => $sponsors,
                                                              'eventId'    => $evId
                                                            ]);
    }

    /*
    * Store sponsor
    */

    public function storeSponsor(Request $data){
        $imgurl = null;
        $filename="";
        $picture_path = "";

        //store
        if($data['action']== 1){
            try{
                
                
                $pId = mt_rand();

                $picture_path = 'images/events/webpage/sponsors';
                if ($data->hasFile('sponsorPicture')) {
                    $imageFile = $data->file('sponsorPicture');
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = $pId . '.' . $extension;
                   
                    $newfilename = str_replace(" ", "_", $data['sponsorName']) . '.' . $extension;
                   // $result = $imageFile->move($picture_path, $newfilename);
                    $imgurl = public_path($picture_path .'/' . $newfilename);
                    $image = Image::make($imageFile->getRealPath());
                    $image->save($imgurl);


                   // $imgurl = url($picture_path . $newfilename);
                }

                //$evResId = mt_rand();
                

                $evRes = new EventWebResource();
                $evRes->id = $pId;
                $evRes->event_id = $data['eventId'];
                $evRes->event_web_resource_element_id = 11;
                $evRes->eventWebResourceValue = $newfilename;
                $evRes->eventWebResourcePath = $picture_path;
                $evRes->eventWebResourcePosition = 6;
                $evRes->eventWebResourceOrder = 1;
                $evRes->save();
                
                

                

                

                $result =['status'  =>'success', 
                          'messsage' => 'El producto se registró con éxito.' ,
                          'sId'     => $pId,
                          'sPicture'=> url($picture_path .'/' . $newfilename), 
                          'sName'   => pathinfo($newfilename, PATHINFO_FILENAME),
                          ];




            }catch(exception $e){
                $result =['status'=>'error', 'messsage' => $e->getMessage()];
            }
        }

        //edit
        if($data['action']== 2){
            $picture_path = 'images/events/webpage/sponsors/';
                if ($data->hasFile('sponsorPicture')) {
                    $imageFile = $data->file('sponsorPicture');
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = $pId . '.' . $extension;
                   
                    $newfilename = str_replace(" ", "_", $data['sponsorName']) . '.' . $extension;
                    $result = $imageFile->move($picture_path, $newfilename);
                    
                    $imgurl = url($picture_path . $newfilename);
                }

            $sponsorId = EventWebResource::where('id', $data['sponsorId'])->pluck('id');

            $sponsor = EventWebResource::where('id',$data['sponsorId'])
                                    ->update(['eventWebResourceValue'=> $newfilename,
                                              'eventWebResourcePath' => $picture_path,
                                            ]);

             $result =['status'  =>'success', 
                          'messsage' => 'El patrocinador se actualizó con éxito.' ,
                          'sId'     => $pId,
                          'sPicture'=> $imgurl, 
                          'sName'   => str_replace("_", " ", $newfilename),
                          ];
        }

        
        return json_encode($result);
    }



     /*
    * Get data for edit
    */

    public function getSponsorEditData($pId){



        $sponsor = EventWebResource::where('id', $pId)->get();




        $pName = $sponsor[0]->eventWebResourceValue;
        $pId = $sponsor[0]->id;
        $pPicture = $sponsor[0]->eventWebResourcePath . $sponsor[0]->eventWebResourceValue;

        $result =['status'  =>'success', 
                      'pId'     => $pId,
                      'pPicture'=> $pPicture, 
                      'pName'   => $pName,
                      ];
    
        return json_encode($result);
    }


    /*
    * Delete sponsor
    */

    public function deleteSponsor($pId){
        try{

               $picture_path = 'images/events/webpage/sponsors/';
               $picture_name = EventWebResource::where('id', $pId)->pluck('eventWebResourceValue');

               EventWebResource::where('id', $pId)->delete();
               $delete = File::delete($picture_path . $picture_name[0]);


                }catch(exception $e){
                    $result =['status'  =>'error', 
                              'messsage' => $e->getMessage()];

                }

                $result =['status'  =>'success', 
                          'messsage' => 'El patrocinador se eliminó con éxito.' ,
                          'pId'     => $pId,
                          'pname' => $delete ];
        return json_encode($result);

    }



    /*
    * Store Sponsor
    */
    public function sponsorStore(Request $request){
    	$data = $request->all();
    	//dd($data);


    	try{

    		$validator = $this->validator($data);

        	if($validator->passes()){
	    		$userId = mt_rand();
	            $user = new User;
	            $user->id = $userId;
	            $user->userFirstName = $data['fname'];
	            $user->userLastName = $data['lname'];
	            $user->userEmail = $data['userEmail'];
	            $user->userPassword = bcrypt($data['password']);
	            $user->userPhoneNumber = $data['phone'];
	            $user->userBirthDay = date('Y-m-d', strtotime($data['dob']));
	            $user->userAddress = $data['address'];
	            $user->save();
	            dd('Éxito');
	        }
	        else{
	        	 return redirect(route('sponsor-register'))->withErrors($validator)->withInput(Input::except('password'));
	        }

    	} catch (exception $e){

    		dd($e->getMessage());
    	}
    }

    /*
    * Get list of sponsor events
    */

    public function getSponsorEventListView(){
    	$uId = \Auth::user()->id;
        $userRole = UserRole::where('user_id', $uId)
                         ->pluck('role_id');

        $userEvents = Event::from( 'events as EV' )
         				   ->join('user_events as UE', 'UE.event_id', '=', 'EV.id')
        				   ->join('event_locations as EL', 'EL.id', '=', 'EV.event_location_id')
        				   ->where('UE.user_id', $uId)
        				   ->get();
        

        return view('backend.sponsor.events.list', ['events' => $userEvents]);
    }

    /*
    * Display specific event
	*/

	public function displayEventView($eventId){

		// Check roles to show/not show products
        /*

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');


        //Mostrar los usuarios segun el tipo de  ususario logueado
        $permissions="";

       

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
        } */



        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');




        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        
       
        if(count($userEventRoleAuth) <= 0){
            $userEventRoleAuth = null;
            
            // Verificar que el usuario logueado sea un super Admin y de no estar registrado, registrarlo.
            if($roleAuth[0] == 1){

                $userEvent = new UserEvent();
                $userEvent->id = mt_rand();
                $userEvent->user_id = Auth::user()->id;
                $userEvent->event_id = $eventId;
                $userEvent->user_type_id = 1;
                $userEvent->role_id = 1;
                $userEvent->save();
                $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
            }

        }


         

        
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

        $permissions = $userPermissions['permission'];

        $typeName = $userPermissions['typeName'];
        

		//Get event data

		$eventData = Event::where('id', (int)$eventId)->get();
        //dd($eventData);
		// Set eventId 
		session(['eventId' => $eventData[0]->id]);
        $eventId = $eventData[0]->id;
		$eventName = $eventData[0]->eventName;
		$eventStart = $eventData[0]->eventStart; 
		$eventDate= date('d-m-Y', strtotime( $eventStart));
    	$eventTime = date('H:m:s A',strtotime( $eventStart));
        $eventDateFinish = date('d-m-Y', strtotime( $eventData[0]->eventFinish));
        $eventTimeFinish = date('H:m:s A', strtotime( $eventData[0]->eventFinish));
        //$eventBackground = $eventData[0]->eventPicturePath . "/" . $eventData[0]->eventPicture; 
       
        $eventAdminStatus =  $eventData[0]->event_open_for_admin;
		//dd($eventData[0]->eventName);

         $eventBackground = DB::table('event_web_resources')
                   ->where('event_id', $eventId)
                   ->where('event_web_resource_element_id', 7)
                   ->where('eventWebResourceOrder', 1)
                   ->select([\DB::raw('CONCAT(eventWebResourcePath, "/", eventWebResourceValue) AS PICTURE')])
                   ->get();

        if(count($eventBackground)>0){
            $eventBackground = $eventBackground[0]->PICTURE;
        }
        else{
            $eventBackground = "images/events/webpage/banner/noBannerImage.jpg";
        }


        /*Mi empresa*/
        $myCompanyName = "";
        $myCompany = DB::table('companies as c')
                       ->join('user_events as ue', 'ue.company_id', 'c.id')
                       ->where('ue.user_id', Auth::user()->id)
                       ->where('ue.event_id', $eventId)
                       ->pluck('c.companyName');
    

        if(count($myCompany)>0){
            $myCompanyName = $myCompany[0];
        }
        //dd($eventAdminStatus);


		return view('backend.sponsor.events.display', ['eventId'=> $eventId, 'eventName' => $eventName, 'eventTime' => $eventTime, 'eventDate' => $eventDate, 'eventDateFinish' => $eventDateFinish, 'eventTimeFinish' => $eventTimeFinish, 'background' =>$eventBackground, 'permissions' => $permissions, 'typeName' => $typeName, 'eventAdminStatus' => $eventAdminStatus,
                                                       'myCompany' => $myCompanyName  ]);
	}



    protected function validator(array $data)
    {
        $messages = [
        'fname.required' => 'El Nombre es obligatorio',
        'lname.required' => 'El apellido es obligatorio',
       // 'mname.required' => 'The Middle Name field is required',
        'userEmail.unique'   => 'El correo que desea registrar ya se encuentra en uso.',
         ];

        return Validator::make($data, [
            'fname' => 'required|max:255',
            'userEmail' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ], $messages);
    }
}
