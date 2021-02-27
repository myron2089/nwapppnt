<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Lang;
use App\Event;
use App\UserEvent;
use App\User;
use App\UserRole;
use DB;
use Session;

use App\Http\Controllers\AdminController; //other controller
use App\Http\Controllers\HomeController; //other controller

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }



    /*
    # get login form
    */

    public function showLoginForm(Request $request)
    {

      //dd($request->all());
        
      $create = 0;
      $evUrl = null;
      $fromPublic = 0;

      if ($request->has('eventRegister') ) {
        if($request->eventRegister == 1 ){
          $create = 1;
        }

      } 


      if($request->has('from')){

        if($request->from == 'public' ){
          $fromPublic = 1;
        }

      }

      if ($request->has('evUrl') ) {
      
        $evUrl = $request->evUrl;

      } 



     // dd($create);




        return view('auth.login' ,['createEvent' => $create, 'evUrl' => $evUrl, 'fromPublic' => $fromPublic]);
    }


    /*
    * Custom login
    */
    public function login(Request $request)
    {
     

      $createEvent = 0;
      $evUrl = $request->evUrl;
      $fromPublic = $request->fromPublic;
      $data = [
            'type'      => 3
        ];

      $v = Validator::make($request->all(), [
        'userEmail' => 'required|email|max:255',
        'password' => 'required|max:255',  
       ]);


     if($v->passes()){
      
       if(Auth::attempt(['userEmail'=>$request->userEmail, 'password'=>$request->password])){
        $uId = \Auth::user()->id;
       // Session::put(['userPicture' => 'images/users/profiles/' . \Auth::user()->userPicture ]);

        //dd(Session::get('userPicture'));
        //$userRole = 3;

        //dd($evUrl);
        if($evUrl != null){

          $checkEv = Event::where('eventUrl', $evUrl)->get();

          

          if(count($checkEv)>0 && count($checkEv[0])>0){
            //Verificar si ya se está registrado en el evento
            $registered = 0;
            $chekRegister = UserEvent::where('user_id', $uId)->where('event_id', $checkEv[0]->id)->get();

            if(count($chekRegister) > 0){
              $registered = 1;
              $eventType = DB::table('event_types as et')->join('events as e', 'e.event_type_id', 'et.id')->where('e.id', $checkEv[0]->id)->select([\DB::raw('LOWER(et.eventTypeName) as TYPE')])->get();

              return redirect('eventos/'. $eventType[0]->TYPE . '/' . $evUrl);


            }
             
           // dd($registered);
            return redirect('eventos/'.$evUrl.'/registro/existente');
            
             
          }
          else{
            return redirect('error/1404');
          }

        }
        $userRole = UserRole::where('user_id', $uId)
                         ->pluck('role_id');

                        // dd($userRole[0]);

      //dd($userRole[0]);

        switch ($userRole[0]) {
            //Full Administrador
            case 1:
            //actualizar
                //return redirect()->route('full-admin-home');
              if($request->eventRegister == 1 ){
                $createEvent = 1;
                return redirect()->route('admin-home',['createEvent'=>$createEvent]);
              
              } else{

                return redirect()->route('admin-home');
              }
               
                break;

            //Super Administrador
            case 2:

                return redirect()->route('super-admin-home');
                break;
            
            //Basico
            case 3:

                $events = Event::from('events as EV')
                          ->join('user_events as UE', 'UE.event_id', 'EV.id')
                          ->where('user_id', Auth::user()->id)
                          ->get();

                //dd(count($events));
                $cevents = count($events);

                $data = array();

                /* 
                *Verificar que el usuario tenga permisos de (admin, subadmin, vendedor, speaker, personal de montaje, etc)
                * de no estar asignado a alguno de estos, se verifica que sea visitante y se redirecciona al portal de visitantes
                */
                $types = array(5,6);
                //dd($types);
                $userTypeEvents = UserEvent::whereNotIn('user_type_id', $types)->where('user_id', Auth::user()->id)->get();
                
                //dd($userTypeEvents);

                //Verificar si viene desde la creación de un evento
                if ($request->has('eventRegister') ) {
                    if($request->eventRegister == 1 ){
                      $createEvent = 1;
                    }

                  }  

                 // dd($createEvent);


                if(count($userTypeEvents)> 0){

                    return redirect()->route('admin-home',['createEvent'=>$createEvent]);
                    
                    //return redirect()->route('admin-home');
                }
                else{
                    //Verificar que sea visitante en algun envento
                    $checkVisitor = UserEvent::where('user_type_id', 5)->where('user_id', Auth::user()->id)->pluck('user_type_id');
                    $checkRol = UserRole::where('user_id', Auth::user()->id)->pluck('role_id');


                   // dd($checkRol);
                    if(count($checkVisitor) > 0 || $checkRol[0] == 3){

                        /*if($fromPublic==1)
                        {
                          return redirect()->route('visitor-events');
                        }
                        else{*/

                          return redirect()->route('admin-home',['createEvent'=>$createEvent]);
                        /*}*/
                    }
                  
                    //Verificar que sea personal de montaje y sacarlo
                    else{

                    	$checkAssembly = UserEvent::where('user_type_id', 6)->where('user_id', Auth::user()->id)->pluck('user_type_id');

                    	if(count($checkAssembly)>0){

                    		Auth::logout();
							return redirect(route('login'))->withInput(Input::except('password'))->withErrors(['email' => 'No cuenta con permisos para acceder!']);
                    	}

                    }
                }
            break;
        }

           
       }
       else
       {

        // dd($request->email);

        if($evUrl!=null){

          return redirect('login?evUrl='. $evUrl)->withInput(Input::except('password'))->withErrors([
                    'email' => Lang::get('auth.failed')  ]);
        }

         return redirect(route('login'))->withInput(Input::except('password'))->withErrors([
                    'email' => Lang::get('auth.failed'),
                ]);
       }

    

     }
     else
     {
       
     // dd($v->errors());
      return redirect(route('login'))->with('errors', $v->errors()); 
     }


    }

    public function username()
    {
    return 'userEmail';
    }


    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }
}
