<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\UserRole;
use App\User;
use App\Event;
use App\UserEvent;
use App\UserBadge;
use Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Image;

class UserController extends Controller
{
    
    /*
    * user store
    */
    public function userStore(array $data){
        try{

            $userPwd = Hash::make(str_random(8));
            $userId = mt_rand();
            $user = new User;
            $user->id = $userId;
            $user->userFirstName = $data['userFirstName'];
            $user->userLastName = $data['userLastName'];
            $user->userEmail = $data['userMail'];
            $user->userPassword = bcrypt($userPWd);
            $user->userPhoneNumber = $data['userPhone'];
            $user->userBirthDay = date('Y-m-d', strtotime($data['userDob']));
            $user->userAddress = $data['userAddress'];
            $user->save();
           
            //Assing basic role on user_roles
            $userRole = new UserRole();
            $userRole->id = mt_rand();
            $userRole->user_id = $userId;
            $userRole->role_id = $data['roleType'];
            $userRole->save();

            $userType = DB::table('roles')->where('id', $data['roleType'])->pluck('roleName');

            $msg='Usuario creado con éxito';
            $result = [ 'status'     => 'success', 
                    'msg'        => $msg, 
                    'uMail'      => $data['userMail'], 
                    'uName'      => $data['userFirstName'] . ' ' . $data['userLastName'],
                    'uPermission'=> $userType,
                    'uId'        => $userId
                   ];
        }
        catch(exception $e){
            $result = ['status'=> 'error', 'msg' => $e->getMessage ];
            
        }
        return $result;
    }

    /*
    * Editar usuario
    */
    public function userEdit(array $data, $roles){
    	$result = array();
        $role = null;
    	
    	try{
    		$user = User::find($data['userId']);
                    $user->userFirstName = $data['userFirstName'];
                    $user->userLastName = $data['userLastName'];
                    $user->userEmail = $data['userMail'];
                    $user->userPhoneNumber = $data['userPhone'];
                    $user->userBirthDay = date('Y-m-d', strtotime($data['userDob']));
                    $user->userAddress = $data['userAddress'];
                    $user->save();
                   
            if($roles){
                $roleAssign = UserRole::where('user_id', $data['userId'])
                                    ->update(['role_id' => $data['roleType']]);


                $role = DB::table('roles')->where('id', $data['roleType'])->pluck('roleName');
            }

             $result = ['status' => 'success',
                        'msg'    => 'Usuario editado con éxito', 
                        'uMail'  => $data['userMail'], 
                        'uName'  => $data['userFirstName'] . ' ' . $data['userLastName'],
                        'userFirstName' => $data['userFirstName'],
                        'userLastName' => $data['userLastName'],
                        'uPhone' => $data['userPhone'],
                        'uRole'  => $role,
                    ];

        } catch( exception $e ){
        	$result = ['status' =>'error',
        			   'msg' 	=> $e->getMessage()
        	];
        }
        
        return $result;
    }


    /*
    * Inhabilitar el usuario
    */

    public function userDisable(array $data){

    }

    /*
    * Eliminar Usuario
    */

    public function userDelete(array $data){


    }

    /*
    * Search user from ajax request
    */
    public function searchUser(Request $request){

        $result = array();
        if($request->has('q')){
            $search = $request->q;
            $data = User::from('users as U')
                        ->select('id', 'userEmail')
                        ->where('userEmail','LIKE',"%$search%")
                        ->get();
       
            return response()->json($data);
        }
    }


    /*
    * get my badge view
    */

    public function getMyBadgeView(Request $request){

       // dd($request->all());

        $userId = 0;

        if($request['allUsersBadge']==1){

            $userId = $request['userBId'];
            $eventId = $request['eventBId'];
        }
        else{

            $userId = Auth::user()->id;
            $eventId =$request['eventId'];
        }

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');


        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        
        if(count($userEventRoleAuth) <= 0){
            $userEventRoleAuth = null;
        }

        
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

       // dd($userPermissions);


        $picture = "images/users/badge/noUserPicture.png";

        $userInfo = User::from('users as U')
                        ->join('user_events as UE' , 'UE.user_id', 'U.id')
                        ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
                        ->where('UE.event_id', $eventId)
                        ->where('U.id', $userId)
                        ->select([\DB::raw('UE.id as UEID, U.userFirstName as FNAME, U.userLastName as LNAME, U.userEmail as EMAIL, U.userCountryCode as PHONECODE, U.userPhoneNumber as PHONE, UT.userTypeName as TYPE, UT.id as TYPEID')])
                        ->get();


        ///////////////////////////// Si es un full administrador y aun no está asignado al evento ///////////////////////////////
        if(count($userInfo)<=0){
           
            // Verificar que sea un full admin para asignarlo, de lo contrario (sin acceso)
            if($userPermissions['permission']==1){

                
                
                $userEventId = mt_rand();
                 
                $asign = UserEvent::create([
                        'id' => $userEventId,
                        'user_id' => $userId,
                        'event_id' => $eventId,
                        'user_type_id' => 1,
                        'role_id' => 2
                    ]);

                 $userInfo = User::from('users as U')
                            ->join('user_events as UE' , 'UE.user_id', 'U.id')
                            ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
                            ->where('UE.event_id', $eventId)
                            ->where('U.id', $userId)
                            ->select([\DB::raw('UE.id as UEID, U.userFirstName as FNAME, U.userLastName as LNAME, U.userEmail as EMAIL, U.userCountryCode as PHONECODE, U.userPhoneNumber as PHONE, UT.userTypeName as TYPE, UT.id as TYPEID')])
                            ->get();
            }
            else{
                return redirect('admin/home');
            }

        }
        //////////////////////////////////////////////////////////////////////

        //dd($eventId);                        
        $uFName = $userInfo[0]->FNAME;
        $uLName = $userInfo[0]->LNAME;
        $uMail = $userInfo[0]->EMAIL;
        $userPhoneCode = $userInfo[0]->PHONECODE;
        $userPhone = $userInfo[0]->PHONE;
        $userTitle="";
        $userOccupation = "";
        $userCompany = "";
        $userPosition = "";
        $userFacebookLink = "";
        $userTwitterLink = "";
        $userAddress = "";
        $badgeId = null;

        $userEventId = $userInfo[0]->UEID;

        $userType = $userInfo[0]->TYPE;

        if($userInfo[0]->TYPEID == 1 || $userInfo[0]->TYPEID == 2){
            $userType= 'Expositor';
        }

            


        $eventInfo = Event::where('id',$eventId)->get();

        $eventAdminStatus = $eventInfo[0]->event_open_for_admin;

        $myBadgeInfo = UserBadge::from('user_event_badges as EB')
                                ->join('user_events as UE' , 'UE.id', 'EB.user_event_id')
                                ->where('UE.user_id', $userId)
                                ->where('UE.event_id', $eventId)
                                ->select([\DB::raw('EB.userFirstName as FNAME, EB.userLastName as LNAME, EB.userEmail as EMAIL, EB.userPhoneNumber as PHONE, CONCAT(EB.userPicturePath, "/", EB.userPicture) as PICTURE, EB.userTitle as TITLE, EB.userOccupation as OCCUPATION, EB.userCompanyName AS COMPANY, EB.userPosition as POSITION, EB.userFacebook as FACEBOOK, EB.userTwitter AS TWITTER, EB.id as BADGEID, EB.userAddress as ADDRESS, EB.userCountryCode as PHONECODE, EB.id as id')])
                                ->get();

        //dd($myBadgeInfo[0]->id);

        ///////////////////////////// Agregando //////////////////////////
        if(count($myBadgeInfo)<=0){


            $badge = new UserBadge();
            $badge->id = mt_rand();
            $badge->user_event_id = $userEventId;
            $badge->userEmail = $userInfo[0]->EMAIL;
            $badge->userCompanyName = "";
            $badge->userFirstName = $userInfo[0]->FNAME;
            $badge->userLastName = $userInfo[0]->LNAME;
            $badge->userPhoneNumber = $userInfo[0]->PHONE;
            $badge->save(); 

        }

        //////////////////////////////////////////////////////////////////


        $userEvent = DB::table('user_events')->where('event_id',$eventId )->where('user_id', $userId )->get();

        ///////
       /* dd($userEvent[0]);
        $usereventbadges = UserBadge::where('user_event_id',$userEvent[0]->id)->first();
        dd($usereventbadges);*/
        /////////

        /*dd($userEvent[0]->id);
        dd($myBadgeInfo);*/
        $qrC = QrCode::size(400)->generate('USERS'. $userEvent[0]->id);
        $eventName = $eventInfo[0]->eventName;
        

        if(count($myBadgeInfo)>0){
            $picture = $myBadgeInfo[0]->PICTURE;
            $uFName = $myBadgeInfo[0]->FNAME;
            $uLName = $myBadgeInfo[0]->LNAME;
            $uMail = $myBadgeInfo[0]->EMAIL;
            $userPhoneCode = $myBadgeInfo[0]->PHONECODE;
            $userPhone = $myBadgeInfo[0]->PHONE;
            $userTitle=$myBadgeInfo[0]->TITLE;
            $userOccupation = $myBadgeInfo[0]->OCCUPATION;
            $userCompany = $myBadgeInfo[0]->COMPANY;
            $userPosition = $myBadgeInfo[0]->POSITION;
            $userFacebookLink = $myBadgeInfo[0]->FACEBOOK;
            $userTwitterLink = $myBadgeInfo[0]->TWITTER;
            $userAddress = $myBadgeInfo[0]->ADDRESS;   


            $badgeId = $myBadgeInfo[0]->BADGEID;




        }

       // dd($picture);

        $view='backend.user.my-badge';
        //dd($eventInfo);
        $eventTypes=null;
        if($request['userType']=='visitor'){
            $view='frontend.users.my-badge';
            $eventTypes = DB::table('event_types')->orderBy('eventTypeName', 'asc')->get();
        }
        else if($request['userType']=='admin'){
            $view='backend.user.my-badge';
        }

       // dd($request['userType'] . ' ' . $view);

        if($picture==null){

            $picture = "images/users/badge/noUserPicture.png";
        }



        return view('backend.user.my-badge' , ['eventName' => $eventInfo[0]->eventName, 
                                               'badgeData' => $myBadgeInfo,
                                               'userPic'   => $picture,
                                               'firstName'    => $uFName,
                                               'lastName'  => $uLName,
                                               'userType'  => $userType,
                                               'userEmail' => $uMail,
                                               'userAddress' => $userAddress,
                                               'userPhoneCode' => $userPhoneCode,
                                               'userPhone' => $userPhone,
                                               'userTitle' => $userTitle,
                                               'userOccupation' => $userOccupation,
                                               'userCompany' => $userCompany,
                                               'userPosition' => $userPosition,
                                               'userFacebookLink' => $userFacebookLink,
                                               'userTwitterLink' => $userTwitterLink,
                                               'badgeId' => $badgeId,
                                               'eventId' => $eventId,
                                               'myQr' => $qrC,
                                               'eventName' => $eventName,
                                               'userEventId' => $userEventId,
                                               'userId' => $userId,
                                               'pageTitle' => 'My Badge',
                                               'eventTypes' => $eventTypes,
                                               'permissions' => $userPermissions['permission'], 
                                               'typeName' => $userPermissions['typeName'],
                                               'eventAdminStatus' => $eventAdminStatus

                                           ]);

    }

    /*
    * store my Badge Info
    */

    public function storeMyBadge(Request $request){

        //Check Badge Exists

       // $cBadge = UserBadge::where()

        $data = $request->all();

        $badgeId = $data['badgeId'];
        $userId = $data['userId'];




        //create
        if($badgeId == null){


            $userEventId = DB::table('user_events as UE')
                             ->where('UE.event_id' , $data['eventId'])
                             ->where('UE.user_id', $userId)
                             ->pluck('UE.id');

            //print_r($userEventId);
            $badgeId = mt_rand();
            $badge = new UserBadge();
            $badge->id = $badgeId;
            $badge->user_event_id = $userEventId[0];
            
            $badge->userFirstName = $data['userFirstName'];
            $badge->userLastName = $data['userLastName'];
            $badge->userEmail = $data['userEmail'];
            $badge->userCountryCode = $data['userPhoneCode'];
            $badge->userPhoneNumber = $data['userPhone'];
            $badge->userAddress = $data['userAddress'];
            $badge->userCompanyName = $data['userCompany'];
            $badge->userTitle = $data['userTitle'];
            $badge->userOccupation = $data['userOccupation'];
            $badge->userPosition = $data['userPosition'];
            $badge->userTwitter = $data['userTwitterLink'];
            $badge->userFacebook = $data['userFacebookLink'];
            $badge->userPicturePath = "images/users/badge";
            $badge->save();

            $result = ['status' => 'success', 'action' => 'registro', 'eventId' => $data['eventId'], 'badgeId' => $badgeId];

        } //update
        else if($badgeId != null){

            $userPhoneNumber = $data['userPhone'];
            if($userPhoneNumber){
                $userPhoneNumber = preg_replace('/[^0-9]/','', $data['userPhone']);
            }

            $update =UserBadge::where('id', $badgeId)
                            ->update(['userFirstName' => $data['userFirstName'],
                                     'userLastName' => $data['userLastName'],
                                     'userEmail' => $data['userEmail'],
                                     'userCountryCode'=> $data['userPhoneCode'],
                                     'userPhoneNumber' => $userPhoneNumber ,
                                     'userAddress' => $data['userAddress'],
                                     'userCompanyName' => $data['userCompany'],
                                     'userTitle' => $data['userTitle'],
                                     'userOccupation' => $data['userOccupation'],
                                     'userPosition' => $data['userPosition'],
                                     'userTwitter' => $data['userTwitterLink'],
                                     'userFacebook' => $data['userFacebookLink']
                                    ]);


            //return json_encode($update);
            $result = ['status' => 'success', 'action' => 'actualización', 'eventId' => $data['eventId'], 'badgeId' =>    $badgeId];
        }



         return json_encode($result);
    }



    /*update avatar image*/
    public function updateBagdeAvatar(Request $data){


        try{
            $pictureChanged = 0;
            $picture_path = 'images/users//badge';
            $picId = 'noCompanyPicture.png';
            $filename = 'noUserPicture.png';

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

             if($pictureChanged == 1){
                $update =UserBadge::where('id', $data->bgId)
                            ->update(['userPicture' => $filename,
                                      'userPicturePath' => $picture_path ]);



             }



              $result = ['status' => 'success', 'message' => "Se ha actualizado exitosamente la imagen de gafete!.", 'changed' => $pictureChanged, 'img' =>  $filename];
        }
        catch(Exception $e){
            $result = ['status' => 'error', 'message' => $e->getMessage()];
        }

        

        return json_encode($result);

    }
    

   

}
