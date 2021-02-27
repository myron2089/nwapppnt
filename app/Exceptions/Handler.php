<?php

namespace App\Exceptions;

use Exception;
use PDOException; 
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {
            // not authorized
                case '403':
                return \Response::view('errors.403',array(),403);
                break;

            // not found
                case '404':
                   // return \Response::view('errors.404',array(),404);
                    return redirect('error/404');
                break;

            // internal error
                case '500':
                return \Response::view('errors.500',array(),500);
                break;

                default:
                return $this->renderHttpException($exception);
                break;

            }

           

        } else  if ($exception instanceof TokenMismatchException) {

            return back()->withInput()->with('status', 'The session has expired, please try again!');  
          // return parent::render($request, $e);
          //return redirect(route('login'));
            //return redirect(route('login'))->with('status','Confirmation email has been sent. Please check your email for activate your account');
           //->with('message', 'Your session expired');
        }

         //Database
        else if($exception instanceof PDOException){
        		//echo $exception->getMessage();
                return response()->view('errors/404', ['error' => $exception->getMessage(), 'pageTitle' => 'Error']);
        }
        else {
            return parent::render($request, $exception);
        }
    }
}
