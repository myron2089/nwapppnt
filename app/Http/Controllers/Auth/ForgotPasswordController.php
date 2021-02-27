<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*
    ** Reescribir reset password
    */
    public function showLinkRequestForm()
    { 
        
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validate = $this->validateEmail($request->all());
       // dd($validate->errors()->first());
       
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('userEmail')
        );
        
        

       /* return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    
        */


       /* switch ($response) {
            case \Password::INVALID_USER:
                return response()->error($response, 422);
                break;
 
            case \Password::INVALID_PASSWORD:
                return response()->error($response, 422);
                break;
 
            case \Password::INVALID_TOKEN:
                return response()->error($response, 422);
                break;
            default: */
                $status = $response;
                return redirect()->back()
                    ->with('status', $status);
        /*}
        */
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
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

    


}
