<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\UserEvent;
use App\EventType;
use App\Event;
use App\User;
use App\Http\Controllers\UserController;
use DB;

class ExpositorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::from('events as EV')
                      ->join('user_events as UE', 'UE.event_id', 'EV.id')
                      ->where('user_id', Auth::user()->id)
                      ->get();

        $cevents = count($events);

        
       
        return view('backend.expositor.home', ['cevents' => $cevents]);
    }

   

    /**
    * View for create event
    */
    public function getCreateEventView(){
  
        return view('backend.expositor.events.create');
    }

     /**
    * Display expositor events
    */

    public function getListEventsView(){

        return view('backend.expositor.events.list');
    }
     
    /**
    * Display spectific event
    */
    public function displayEventView(Request $request, $eventId)
    {
        

        return view('backend.expositor.events.display' , ['event_name' => $request->input('ev_name'),
                                                          'event_date' => $request->input('ev_date'),
                                                          'event_hour' => $request->input('ev_hour')  
                                                          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /*
    * Store user and asign to event
    */

    public function userStore(Request $request){

        $result= array();
        $msg;
        // 1 stored,
        /*check if user exists*/ 
            
                if($request->action==1)
                {
                    $uCheck = User::where('userEmail', $request->userMail)->get();
                    if(count($uCheck) <= 0){

                        try{
                            $userId = mt_rand();
                            $user = new User;
                            $user->id = $userId;
                            $user->userFirstName = $request->userFirstName;
                            $user->userLastName = $request->userLastName;
                            $user->userEmail = $request->userMail;
                            $user->userPassword = Hash::make(str_random(16));
                            $user->userPhoneNumber = $request->userPhone;
                            $user->userBirthDay = date('Y-m-d', strtotime($request->userDob));
                            $user->userAddress = $request->userAddress;
                            $user->save();
                            $msg='Usuario creado con éxito';
                            $result = [ 'status'     => 'success', 
                                    'msg'        => $msg, 
                                    'uMail'      => $request->userMail, 
                                    'uName'      => $request->userFirstName . ' ' . $request->userLastName,
                                    'uPermission'=> $request->userEventPermission,
                                    'uId'        => $userId
                                   ];
                        }
                        catch(exception $e){
                            $result = ['status'=> 'error', 'msg' => $e->getMessage ];
                            return $result;
                        }
                    } else{

                        $result = ['status'=> 'exists', 'msg' => 'El correo que desea registrar ya existe'];
                    }
                }    
                else if($request->action==2)
                {
                    
                    $editUser= new UserController();
                    $data = $request->all();
                    $result = $editUser->userEdit($data);
                    
                }
                
           
        

        return json_encode($result);
    }


    /*
    * Get data for edit user
    */
    public function getUserEditData(Request $data){


        // Get user data for edit
        

        try{
         //   $userData = User::where('id', $data->uId)->get();

            $companyId = 0;
            $userData = DB::table('user_events as UE')
                          ->join('users as U', 'U.id', 'UE.user_id')
                          ->where('UE.id', $data->uId)
                           ->select([\DB::raw('U.id as ID, U.userFirstName as FNAME, U.userLastName as LNAME, UE.company_id as COMPANY, U.userBirthDay as DOB, U.userEmail as MAIL, U.userAddress as ADDRESS, U.userPhoneNumber as PHONE, UE.user_type_id as ROL,U.userPicture as PICTURE, userCountryCode as PHONECODE')])
                          ->get();


            $userType = UserEvent::from('user_events as UE')
                                        ->join('user_types as UT', 'UT.id', 'UE.user_type_id')
                                        ->where('UE.user_id', $data->uId)
                                        
                                        ->select('UT.id as TYPEID', 'UT.userTypeName')
                                        ->get();

            if($userData[0]->COMPANY != null){
                $companyId =$userData[0]->COMPANY;
            }

            $result = ['status'=> 'success', 'uId' => $userData[0]->ID, 
                       'uEventId' => $data->uId, 'uFName' => $userData[0]->FNAME, 'uLName' => $userData[0]->LNAME, 
                       'uCompanyId' => $companyId,
                       'uMail' => $userData[0]->MAIL,
                       'uDob' => $userData[0]->DOB,
                       'uAddress' => $userData[0]->ADDRESS,
                       'uPhone' => $userData[0]->PHONE,
                       'uRol' => $userData[0]->ROL,
                       'uPic' =>  'images/users/profiles/'.$userData[0]->PICTURE,
                       'cCode' => $userData[0]->PHONECODE
                    ];                              
          /*  $result = ['status'=> 'success', 
                       'msg' => 'El correo que desea registrar ya existe',
                       'uMail'      => $userData[0]->userEmail, 
                       'uFirstName' => $userData[0]->userFirstName,
                       'uLastName' =>  $userData[0]->userLastName,
                       'uDob'      =>  $userData[0]->userBirthDay,
                      
                       'uAddress' => $userData[0]->userAddress,
                       'uPhone'   => $userData[0]->userPhoneNumber,
                       'uTypeId'  => $userType[0]->TYPEID,
                       'uId'        => $data->uId
                   ];
*/
        } catch(exception $e){
        $result = ['status'=> 'error', 'msg' => $e->getMessage()];    
        }
       
         return json_encode($result);
          //'uOcupation' => $userData[0]->userOcupation,
                       //'uCompany'=>    $userData[0]->userCompany,
    }

    /*
    * Delete specific user
    */
    public function userDelete($uid){

        $result = $uid;

        try{

            $userData = User::from('users as U')
                            ->join('user_events as UE', 'UE.user_id' , 'U.id')
                            ->where('UE.id', $uid)
                            ->get();

            $delScanUserUsers = DB::table('scan_user_users')->where('scanUserSource', $uid)->orWhere('scanUserDestination', $uid)->delete();
                           // return $userData;
            $uName = $userData[0]->userFirstName . ' ' . $userData[0]->userLastName;

            $deleteUser = UserEvent::where('id', $uid)->delete();

            $result = ['status'=> 'success', 'message' => 'Se ha eliminado correctamente el usuario del evento!', 'uName' => $uName, 'uDeleted' => $deleteUser];
        } catch(exception $e){

            $result = ['status' => 'error', 'message' => 'Se ha producido un error al intentar eliminar el usuario, por favor contacte con el administrador del sitio.'];

        }


        return json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
