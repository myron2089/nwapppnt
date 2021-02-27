<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\UserRole;
use App\UserEvent;
use DB;
use App\FormSectionFieldAnswer;
use App\UserFormSectionAnswer;
use App\UserEventForm;
use App\UserBadge;
use Mail;
use App\EmailNotification;
use App\EmailNotificationRecipient;
use Illuminate\Support\Facades\Input;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Mail\UserRegisterMessage;
use App\Event;
use Lang;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $userId= mt_rand();  
        $userEventId = mt_rand(); 
        $userExists = 0;
        $email = $request->userEmail;
        $evName = null;
        //verificar si existe el email en la db
        $checkMail = User::where('userEmail', $request->userEmail)->pluck('userEmail');

        //Verificar que venga del registro de evento o registro de usuarios sin evento


        if($request->eventId != 0){

          $evUrl = Event::where('id', $request->eventId)->pluck('eventUrl');

          $eventType = DB::table('event_types as et')->join('events as e', 'e.event_type_id', 'et.id')->where('e.id', $request->eventId)->select([\DB::raw('LOWER(et.eventTypeName) as TYPE')])->get();
          
          $evData = Event::where('id', $request->eventId)->get();



          $evName = $evData[0]->eventName;
        }

        //dd(count($checkMail));

        //Verificar si existe el correo
        if(count($checkMail)>0){
          $userExists = 1;
          //return Redirect::back()->withInput(Input::all())->withErrors(['email' => 'El email que desea ingresar ya se encuentra registrado en NetWorkingApp!.']);

          $userId = User::where('userEmail', $request->userEmail)->first()->id;
        
          //dd($userId);
          
          $login = Auth::attempt(['userEmail'=> $request->userEmail, 'password'=>$request->userPassword]);


          //Si el usuario existe pero la contraseña ingresada es incorrecta, regresar al registro.
          if($login==false){
            return Redirect::back()->withInput(Input::except('password'))->withErrors(['incorrectpw' => 'Ya tienes una cuentra creada en NetWorkingApp, por favor ingresa la contraseña que tienes registrada.']);
          }
          else{
            //Si el usuario existe y se loguea correctamente

            //verificar que no esté registrado en el evento
            $checkRegister = UserEvent::where('user_id', Auth::user()->id)->where('event_id', $request->eventId)->get();

            

            if(count($checkRegister) > 0){
              //dd($eventType);
              return redirect('eventos/'. $eventType[0]->TYPE . '/' . $evUrl[0])->with('status', 'Ya te encuentras registrado en este evento.');
            }

          }
      

        }

       

        $validator = $this->validator($request->all());


        if($validator->passes()){
          event(new Registered($user = $this->create($request->all(), $userId, $userEventId, $userExists)));
        } else{
          return Redirect::back()->withInput(Input::except('password'))->withErrors($validator);
         
        //return redirect(route('registro'))->withErrors($validator)->withInput(Input::except('password'));
        }


        

       // $this->guard()->login($user);

        /*return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
*/
        //Visitor
       /* if($request->userType== 'v'){
            return redirect()->route('visitor-home');
        }

*/      
        

        //Verificar si el registro viene desde crear nuevo evento
          if($request->eventCreate==1){
              
              $login = Auth::attempt(['userEmail'=> $request->userEmail, 'password'=>$request->userPassword]);

              //dd($login);
              // return redirect()->route('admin-home',['createEvent'=>1]);
              
              
              if($login==true){
                return redirect()->route('admin-home',['createEvent'=>1]);
              }
              else
               {

                // dd($request->email);
                 return  Redirect::back()->withInput(Input::except('password'))->withErrors([
                            'email' => Lang::get('auth.failed'),
                        ]);
               }
          }
          else{
           // return view('frontend.users.register-status', ['qr'=>'USERS' . $userEventId, 'email' => $email, 'password' => $request->userPassword, 'eventName' => $evName]);

           // dd($userEventId);
            $login = Auth::attempt(['userEmail'=> $request->userEmail, 'password'=>$request->userPassword]);
            $welcome = 1; //desde un evento

            if($request->registerFrom == 'visitor'){
              $welcome = 2;
            }

            return redirect()->route('admin-home',['welcome'=> $welcome]);


         /*  return redirect('eventos/'. $eventType[0]->TYPE . '/' . $evUrl[0])->with(['status'     => 'Te has registrado correctamente a ' . $evName, 
                                                                                     'status-code' => 'registered', 
                                                                                     'qr'          => 'USERS' . $userEventId, 
                                                                                     'email'       => $email, 
                                                                                     'password'    => $request->userPassword, 
                                                                                     'register'    => 1]);
*/
          }




//        return  redirect()->route('show-event', ['evId' => 2108692359, 'rmsg '=>1 ]);
        //$qr = QrCode::format('png')->size(200)->generate('USERS' . $userEventId);

       return view('frontend.users.register-status', ['qr'=>'USERS' . $userEventId, 'email' => $email, 'password' => $request->userPassword]);
        

        //return redirect(route('registrado'))->with('status', 'Please check your email inbox for activate your account!', 'qr' => $userId);


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'userFirstName' => 'required|string|max:255',
            'userLastName' => 'required|string|max:255',
            
            'userEmail' => 'required|string|email|max:255', //|unique:users
            'userPassword' => 'required|string|min:8',
            //'userPasswordConfirm' => 'required|same:userPassword'
        ]);
    }


    /*
    * Get register view
    */

    public function getRegister(){

        return view('auth.register', ['type' => 'ad']);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $userId, $userEventId, $userExists)
    {
        //Dinamic fields
       
        /*foreach ($data as $key => $value) {
            print_r($value);
        }
       dd($data);*/ 

       //dd($data);
        DB::beginTransaction();
        try{

            $login = false;
          
            $typeId = 5; // visitante, necesario cambiarlo
            //$eventId = 21643667;

            $eventId = $data['eventId'];
            $townId = null;


            $eventName = null;
            if($data['userTown'] && $data['userTown'] != "0" ){

               $townId = $data['userTown'];
            }
              
           // dd('no comprobó');
          
            if($userExists == 0){
              $result = User::create([
                  'id' => $userId,
                  'userFirstName' => $data['userFirstName'],
                  'userLastName' => $data['userLastName'],
                 // 'userBirthDay' => date('Y-m-d', strtotime($data['userDob'])),
                  'userEmail' => $data['userEmail'],
                  'userPassword' => bcrypt($data['userPassword']),
                  'town_id' => $townId,
                  'userAddress' => $data['userAddress'],
                  'userPhoneNumber' => $data['userCellPhoneNumber'],
                  'user_status_id' => 1,
              ]);


              $roleId = mt_rand();
            
              $roles = UserRole::create([
                'id' => $roleId,
                'user_id' => $userId,
                'role_id' => 3
              ]);


            } // if exists
            
           // dd($data['registerFrom']);
            if($data['eventCreate'] != 1 && $data['registerFrom'] == 'event'){
                //dd($data['eventId']);
                $eventId = $data['eventId'];
           
                $asign = UserEvent::create([
                    'id' => $userEventId,
                    'user_id' => $userId,
                    'event_id' => $eventId,
                    'user_type_id' => $typeId,
                    'role_id' => 3,
                    'registered_from_id' => 1,  //Lugar de registro 1) portal web 2) App escritorio
                ]);


                $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');

                $badge = new UserBadge();
                $badge->id = mt_rand();
                $badge->user_event_id = $userEventId;
                $badge->userEmail = $data['userEmail'];
                $badge->userCompanyName = $data['userCompany'];
                $badge->userFirstName = $data['userFirstName'];
                $badge->userLastName = $data['userLastName'];
                $badge->userPhoneNumber = $data['userCellPhoneNumber'];
                $badge->save();

                $eForm = new UserEventForm();
                $eForm->id = time();
                $eForm->form_id = 5;
                $eForm->user_event_id = $userEventId;
                $eForm->save();

                if($data['dinamicFields']>0) {

                    $ufsaId = mt_rand();
                    $ufsa = new UserFormSectionAnswer();
                    $ufsa->id = $ufsaId;
                    $ufsa->form_id = 5; //VISITANTE
                    $ufsa->user_id = $userId;
                    $ufsa->save();

                   // dd($data);

                    foreach ($data as $key => $value) {
                        //Verificar que los campos por defecto no se igresen, al agregar un campo por defecto se tendria que agregar en el if
                        if($key != '_token' && $key != 'userType' && $key != 'userFirstName' && $key != 'userLastName' && $key != 'userDob' && $key != 'userCompany' && $key != 'dinamicFields' && $key != 'userEmail' && $key != 'userPassword' && $key != 'userPasswordConfirm' && $key != 'userCellPhoneNumber' && $key != 'userState' && $key != 'userTown' && $key != 'userAddress' && $key != 'eventCreate' && $key != 'cityValue' && $key != 'townValue' && $key != 'eventId' && $key != 'registerFrom'){
                            
                            $vasign = DB::table('form_section_field_answers AS ANS')
                                    ->join('user_form_section_answers AS AFORM', 'AFORM.id', '=', 'ANS.user_form_section_answer_id')
                                    ->where('ANS.form_section_field_id', $key) //STATUS 10 IS THE 'ENABLED O ACTIVE' 
                                    ->where('AFORM.user_id', $userId)
                                    ->pluck('ANS.form_section_field_id');
                             
                            $countvasign = count($vasign);
                            //dd($countvasign);
                            //Verificar que la respuesta no este asignada, de no estarlo, crear nuevam de lo contrario actualizar (else)
                            if($countvasign==0)
                            {      


                                //Asignar el usuario al cuestianrio user_form_section_answer
                                
                               

                               //Traer la llave de la tabla td_asig_cuestionario para almacenarla en tm_respuesta, segun el usuario
                                $asigcuest= DB::table('user_form_section_answers AS ACUEST')
                                            ->where('ACUEST.form_id', 5) //VISITANTE FORM
                                            ->where('ACUEST.user_id', $userId)
                                            ->pluck('ACUEST.id');

                                   //dd($asigcuest[0]);
                           // dd($asigcuest);
                           /* print_r('IDPRE ' .$key . ' => Respuesta ' . $value . '  Cuestionario ' . $asigcuest[0] . ' Usuario: ' . $userId . '<br/>');
        */
                                $fsfId= mt_rand();
                                $fsec = new FormSectionFieldAnswer();
                                $fsec->id = $fsfId;
                                $fsec->answerValue = $value;
                                $fsec->form_section_field_id = $key;
                                $fsec->user_form_section_answer_id = $ufsaId;
                                $fsec->save();
                                

                              //dd($key . ' ' .$value . ' ' . $asigcuest[0]);
                                //$resasign = "N0";
                            }
                            else
                            {
                                //Actualizar respuestas ya ingresadas
                                
                                
                                $resultans=FormSectionFieldAnswer::where('form_section_field_id', $vasign[0])
                                                 ->update(['answerValue' => $value
                                                          ]);

                                //print_r($vasign[0] . $value . '<br/>');
                                 //print_r('Actualizando......   IDPRE ' .$key . ' => Respuesta ' . $value . '  Cuestionario: No asignado Usuario: ' . \Auth::user()->PE_FIRST_NAME . '<br/>');

                            }


                            

                        }
                    }
                    
                    
                }

                $email = $data['userEmail'];
                    

                $mailTo = $data['userFirstName'] . ' ' . $data['userLastName'];
                

                $qr = QrCode::format('png')->size(200)->generate('USERS' . $userEventId);
                $mailData = ['fullname' => $mailTo, 'qr' => $qr, 'password' => $data['userPassword'], 'email' => $data['userEmail'], 'eventName' => $eventName[0], 'fromEvent' => '1' ];
                $mailSubject = 'Cuenta Registrada';

                //if($userExists==0){

                //$data = $mailData;
                /*Mail::send('emails.welcome', $mailData, function($message)
                {
                    $message->to('myron2089@gmail.com', 'John Smith')
                        ->from('info@networkingapp.net')
                        ->subject('Welcome!');
                }); */
                 


                 /*Descomentar*/
                 
                 Mail::to($email)->send(new UserRegisterMessage($mailData));

                 


                 /* Mail::send('emails.accountregistered', $data, function($message) use($data, $email, $mailSubject, $mailTo){
                     $message->to($email,  $mailTo);
                     $message->subject($mailSubject);
                     $message->from('info@networkingapp.com', 'NetWorkingApp');
                  }); 
  */                
                  

                //}
        
          
          }

       
           // Usuarios sin evento
           if($data['registerFrom'] == 'visitor' ){

              //dd($data['registerFrom']);
              $email = $data['userEmail'];
              $mailTo = $data['userFirstName'] . ' ' . $data['userLastName'];
              $mailData = ['fullname' => $mailTo,  'password' => $data['userPassword'], 'email' => $data['userEmail'], 'eventName' => '0', 'fromEvent' => '0' ];
              $mailSubject = 'Registro NetworkingApp';

              Mail::to($email)->send(new UserRegisterMessage($mailData));



           }
       


            DB::commit();

        }catch(exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }


        
    }

    protected function redirectTo()
    {
        
        return '/home';
    }



    public function username()
    {
        return 'userEmail';
    }

    
}
