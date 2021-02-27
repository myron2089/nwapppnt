<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Mail;

class ForgotPasswordController extends Controller
{
    //

    public function getForgotPasswordView(){

    	return view('auth.passwords.email');
    }



    public function postForgotPassword(Request $request){

        $formData = null;

    	$validate = $this->validateEmail($request->all());

    	if($validate->passes()){

	    	$user = User::where('userEmail', $request->userEmail)->first();

	    	if(!$user){
	    		return redirect()->back()->with(['errors'=>'El correo que ha proporcionado no se encuentra en networkingapp.net']);
	    	}


	    	//$reminder = Reminder::exists($user) ?: Reminder::create($user);

	    	$token = Password::getRepository()->create($user);
           // dd($token);

            if($request->ajax()){

                $formData = ['userFirstName' => $request->userFirstName,
                             'userLastName' => $request->userLastName,
                             'userCellPhoneNumber' => $request->userCellPhoneNumber,
                             'eventId' => $request->eventId,
                             'fromEventRegister' => $request->fromEventRegister,
                         ];

            }
	    	$this->sendForgotPasswordEMail($user, $token, $formData);

	    	//return $token;

            if($request->ajax()){

                //return json_encode($request->all());
                
                $data = ['status' => "success", "message" => "Se ha enviado un correo electrónico con instrucciones para poder restablecer su contraseña."];
                return json_encode($data);
            }


	    	return redirect()->back()->with(['success' => 'Te hemos enviado un correo electrónico con instrucciones para poder restablecer tu contraseña.']);
	    }
	    else{

      		return redirect()->back()->with('errors', $validate->errors()); 
     
	    }

    	//return redirect()->back()->with(['success' => 'Hemos enviado un codigo a tu correo.']);

    }


    protected function validateEmail(array $request)
    {
        //$this->validate($request, ['userEmail' => 'required|email']);

        
        $data = ['userEmail' => $request['userEmail']];

        $rules = [
             'userEmail' => 'required|exists:users,userEmail',
        ];

        $messages = [
            'userEmail.exists' => 'El correo electrónico ingresado no existe en networkingapp.',
            'userEmail.required' => 'Es necesario ingresar un correo electrónico',
        ];
        
        //$this->validate($request, ['userEmail' => 'required|email']);

         return Validator::make($data, $rules, $messages);
    }


    private function sendForgotPasswordEMail($user, $token, $formData){
    	
       
       

        

    	Mail::send('emails.password-reset-email', [
    			'user' => $user,
    			'token' => $token,
                'formData' => $formData
                
    	], function ($message) use ($user){
    		$message->to($user->userEmail);
    		$message->subject("Restablecer contraseña");
    	});


    }
}
