<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Event;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    use ResetsPasswords;

    protected $username = 'userEmail';
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function getEmailForPasswordReset()
    {
        return $this->username;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


     public function showResetForm(Request $request, $token = null)
    {
        $userFirstName = null;
        $userLastName = null;
        $userCellPhoneNumber = null;
        $eventId = null;
        $fromEventRegister = null;

        if($request->fromEventRegister && $request->fromEventRegister==1){
            $userFirstName = $request->userFirstName;
            $userLastName = $request->userLastName;
            $userCellPhoneNumber = $request->userCellPhoneNumber;
            $eventId = $request->eventId;
            $fromEventRegister = 1;

        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'userEmail' => $request->userEmail, 
             'userFirstName' => $userFirstName, 
             'userLastName' => $userLastName, 
             'userCellPhoneNumber' => $userCellPhoneNumber, 
             'eventId' => $eventId,
             'fromEventRegister' => $fromEventRegister

            ]
        );
    }


     public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /////////////////  add  /////////////////

    public function reset(Request $request)
    {

        //$val = $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $validate = $this->validateRequest($request->all());
        
        
        



        if($validate->passes()){

            $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {

                    $this->resetPassword($user, $password);
                }
            );

           // dd($response);

            //Si la recuperación viene desde el registro de un evento, regresarlo al mismo
            if($request->fromEventRegister && $request->fromEventRegister==1){
            
                $eventUrl = Event::where('id', $request->eventId)->pluck('eventUrl');
                $userFirstName = $request->userFirstName;
                $userLastName = $request->userLastName;
                $userCellPhoneNumber = $request->userCellPhoneNumber;
                $userEmail = $request->userEmail;

                if($request->eventId==0){
                    return redirect('visitantes/registro')->withInput(['userFirstName' => $userFirstName, 
                                                                                           'userLastName' => $userLastName, 
                                                                                           'userCellPhoneNumber' => $userCellPhoneNumber, 
                                                                                           'userEmail' => $userEmail ]);
                }
                else{
                    return redirect('eventos/' . $eventUrl[0] . '/registro/nuevo')->withInput(['userFirstName' => $userFirstName, 
                                                                                           'userLastName' => $userLastName, 
                                                                                           'userCellPhoneNumber' => $userCellPhoneNumber, 
                                                                                           'userEmail' => $userEmail ]);
               }
            }

             return $response == Password::PASSWORD_RESET
                                ? $this->sendResetResponse($response)
                                : $this->sendResetFailedResponse($request, $response);
        }
        else{

            return redirect()->back()->with(['errors'=> $validate->errors()])->withInput(['userEmail'=> $request->userEmail] ); 
     
        }
    }
 

    protected function valrules()
        {
            return [
                'token' => 'required',
                'userEmail' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ];
        }


    protected function validateRequest(array $request)
    {
        //$this->validate($request, ['userEmail' => 'required|email']);

        
        $data = ['userEmail' => $request['userEmail'],
                 'password' => $request['password'],
                 'password_confirmation' => $request['password_confirmation'],
                 'token' => $request['token']
                 ];



        $messages = [
            'userEmail.exists' => 'El correo electrónico ingresado no existe en networkingapp.',
            'userEmail.required' => 'Es necesario ingresar un correo electrónico',
            'password.required' => 'Es neceario ingresar una contraseña',
            'password.min' => 'La contraseña debe de contener al menos 8 caracteres'
        ];
        
        //$this->validate($request, ['userEmail' => 'required|email']);

         return Validator::make($data, $this->valrules(), $messages);
    }

    /*
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => str_random(60),
        ])->save();
 
        // GENERAR TOKEN PARA SATELLIZER AQUI ??
        // $this->guard()->login($user);
    }
     */

    protected function credentials(Request $request)
    {
        return $request->only(
            'userEmail', 'password', 'password_confirmation', 'token'
        );
    }


    protected function resetPassword($user, $password)
    {

        $user->userPassword = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        /*
        ** Loguear al usuario
        */

        //$this->guard()->login($user);

        // Redireccionar a login
        return  redirect(route('login'));
    }
}
