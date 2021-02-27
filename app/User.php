<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    
    protected $fillable = [
       'userFirstName', 'userLastName', 'userEmail', 'userPassword', 'userPhoneNumber', 'userBirthDay', 'userAddress', 'userPicture', 'id', 'user_status_id', 'userCountryCode', 'town_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'userPassword', 'remember_token',
    ];

    public function getAuthPassword()
    {
    return $this->userPassword;
    }

    public function getEmailForPasswordReset()
    {
        return $this->userEmail;
    }

   
    public function sendPasswordResetNotification($user)
    {

       // dd($user . "Ddsfdsafasdf");

        $this->notify(new ResetPassword($user));


    }

    public function scopeGetUserPermissions($query, $userId){

        /*
        * userRol (role_id -> user_roles)
        *   1 Full Admin (top level)
        *   2 Super Admin (all options*)
        *   3 Basic (Administrador del evento, Speaker, Vendedor, Visitante, Personal de Montaje)
        *
        * eventRol (user_type -> user_events)
        *   1 Admin
        *   2 SubAdmin
        *   3 Seller
        *   4 Speaker
        *   5 Visitor
        *   6 Assembly Pers..
                        ->where('U.id', $userId)
                        ->pluck('UR.role_id');

        //Roles sobre evento
        $eventRol = User::from('users as U')
                                 ->join('user_events as UE', 'UE.user_id', 'U.id')
                                 ->where('U.id', $userId)
                                 ->where('UE.event_id', $eventId)
                                 ->pluck('UE.user_type_id');

        $rol = ['userRol' => $userRol[0], 'eventRol' => $eventRol];
        */
        

        $query= User::from('users as U')
                        ->join('user_roles as UR', 'UR.user_id', 'U.id')
                        ->where('U.id', $userId);
        

        return $query;


    }


      public function scopeGetUserEventPermissions($query, $userId){




            $query = User::from('users as U')
                                 ->join('user_events as UE', 'UE.user_id', 'U.id')
                                 ->where('U.id', $userId);


            
                //$query = array(5);

            

            return $query;
      }


    public function scopeGetUserData($query, $uId){

        $query = User::where('id', $uId)->get();

        return $query;

    }

    public function scopeGetUserPermissionsNumber($data, $roleAuth, $userEventRoleAuth){
        
       // dd($roleAuth);


        if($roleAuth == 1  || $roleAuth == 2 || $userEventRoleAuth ==1 ){

                $data =[ 'permission' => 1,
                         'typeName' => 'Administrador'];
            }
            else if($roleAuth == 3){
                //subadmin

                if($userEventRoleAuth ==2){
                     $data =[ 'permission' => 2,
                         'typeName' => 'Subdministrador'];
                }
                //sellers, speakers
                else if($userEventRoleAuth == 3){
                    $data =[ 'permission' => 3,
                         'typeName' => 'Representante'];
                }
                else if($userEventRoleAuth == 4){
                     $data =[ 'permission' => 4,
                         'typeName' => 'Conferencista'];
                }
                else if($userEventRoleAuth == 5){
                     $data =[ 'permission' => 5,
                         'typeName' => 'Visitante'];


                }
                else if($userEventRoleAuth==null){
                     $data =[ 'permission' => 5,
                         'typeName' => 'Visitante'];
                    
                }
            }
            



            return $data;
    }


}
