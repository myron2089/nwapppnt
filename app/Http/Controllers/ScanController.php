<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScanUserUser;
use App\ScanUserCompany;
use Auth;
use DB;
use App\User;
use App\UserEvent;
use App\UserBadge;
use App\Company;
use Illuminate\Support\Facades\Input;
use PDF;
use App\Product;
use App\Exports\ScanUserUsersExportView;
use App\Exports\ScanCompaniesExportView;
use App\Exports\ScanToCompanyUsersExportView;
use Maatwebsite\Excel\Facades\Excel;


/*
* scanUserSource es quien hace el scan
* scanUserDestination es a quien se hace el scan
*/


class ScanController extends Controller
{
    //

	/*
	# vista scans para usuarios
	*/
    public function getUsersScansView(Request $request){

      

    	$eventId = $request->eventId;
        $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');
        $eventName = $eventName[0];


        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        

        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

        //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            //$products = $products->get();
            return view('backend.admin.scans.full-users-scans-admin', ['eventId' => $eventId, 'eventName' => $eventName,'permissions' => $userPermissions['permission'], 
                                                                      'typeName' => $userPermissions['typeName']]);
           
        }
        //basico
        else if($roleAuth[0] == 3){
          //dd($userEventRoleAuth[0]);
            //Sub Admin Speaker o vendedor 
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2 || $userEventRoleAuth[0] == 5){
                return view('backend.admin.scans.users-scans-admin', ['eventId' => $eventId, 
                                                                      'eventName' => $eventName,
                                                                      'permissions' => $userPermissions['permission'], 
                                                                      'typeName' => $userPermissions['typeName']]);
                
            } 

        }

    	

    	

    	

    }


    /*
    # scans hechos de usuarios datatables
    */
    public function getPerformedUsersScans(Request $request, $eventId){

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
       
        //return $eventId;

        /*$performedScans = ScanUserUser::from('scan_user_users as SUU')
                                      ->join('user_events as UE', 'UE.id', 'SUU.scanUserSource')
                                      ->join('user_event_badges as ueb', 'ueb.user_event_id', 'UE.id')
                                      ->join('users as u', 'u.id', 'UE.user_id')
                                      ->where('UE.event_id', $eventId)
                                      //->where('SUU.scanUserDestination', $eventId)
                                      ->select([\DB::raw('u.id as ID,
                                                        (CASE 
                                                         WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                            THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                            ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                                         END) as fullName,
                                                         (CASE 
                                                            WHEN ueb.userEmail is not null
                                                            THEN ueb.userEmail
                                                            ELSE u.userEmail
                                                         END) AS userEmail,
                                                         (CASE 
                                                            WHEN ueb.userPhoneNumber is not null
                                                            THEN ueb.userPhoneNumber
                                                            ELSE u.userPhoneNumber
                                                         END) AS userPhoneNumber,
                                                        (CASE 
                                                         WHEN ueb.userCompanyName is not null 
                                                            THEN ueb.userCompanyName 
                                                            ELSE "Sin especificar" 
                                                         END) as userCompany,
                                                          count(DISTINCT SUU.scanUserDestination) as scansNumber')])
                                      ->groupBy('u.id','fullName', 'userEmail', 'userCompany', 'userPhoneNumber', 'SUU.scanUserSource'); */



          $performedScans = User::from('users as u')
                                      ->join('user_events as UE', 'UE.user_id', 'u.id')
                                      ->join('scan_user_users as SUU', 'SUU.scanUserDestination', 'UE.id')
                                      ->join('user_event_badges as ueb', 'ueb.user_event_id', 'UE.id')
                                      ->where('UE.event_id', $eventId)
                                      //->where('SUU.scanUserDestination', $eventId)
                                      ->select([\DB::raw('u.id as ID,
                                                        (CASE 
                                                         WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                            THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                            ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                                         END) as fullName,
                                                         (CASE 
                                                            WHEN ueb.userEmail is not null
                                                            THEN ueb.userEmail
                                                            ELSE u.userEmail
                                                         END) AS userEmail,
                                                         (CASE 
                                                            WHEN ueb.userPhoneNumber is not null
                                                            THEN ueb.userPhoneNumber
                                                            ELSE  ( CASE WHEN u.userPhoneNumber is not null 
                                                                    THEN u.userPhoneNumber
                                                                    ELSE "Número no registrado"
                                                                    END)
                                                         END) AS userPhoneNumber,
                                                        (CASE 
                                                         WHEN ueb.userCompanyName is not null 
                                                            THEN ueb.userCompanyName 
                                                            ELSE "Sin especificar" 
                                                         END) as userCompany,
                                                          count(DISTINCT SUU.scanUserDestination) as scansNumber,
                                                          SUU.scanUserSource as userSource, SUU.scanUserDestination')])
                                      ->groupBy('u.id','fullName', 'userEmail', 'userCompany', 'userPhoneNumber', 'SUU.scanUserSource', 'SUU.scanUserDestination'); 




  

        //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

          

            return datatables()->of($performedScans)
                                ->filterColumn('fullName', function($query, $keyword) {
                                    $sql = 'CONCAT(ueb.userFirstName, " ", ueb.userLastName)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('userEmail', function($query, $keyword) {
                                    $sql = 'ueb.userEmail  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('u.userEmail', function($query, $keyword) {
                                    $sql = 'u.userEmail  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('userPhoneNumber', function($query, $keyword) {
                                    $sql = 'ueb.userPhoneNumber  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('userCompany', function($query, $keyword) {
                                    $sql = 'ueb.userCompany  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                
                                ->toJson();

           
        }
        //basico
        else if($roleAuth[0] == 3){


            //Sub Admin Speaker o vendedor, visitante
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2 || $userEventRoleAuth[0] == 5){

              $user = Auth::user();

              $userevent = UserEvent::where('user_id',$user->id)
                ->where('event_id',$eventId)
                ->first();
                 
               // return  $userevent->id;
             // return $eventId; 
                   
                   $performedScans = $performedScans->where('scanUserSource', $userevent->id);
                                                //return ($performedScans->get());
                   
                   
                return datatables()->of($performedScans)
                                    ->filterColumn('fullName', function($query, $keyword) {
                                        $sql = 'CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ")  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->filterColumn('userEmailPhone', function($query, $keyword) {
                                        $sql = 'CONCAT(UEB2.userEmail, " / ",  UEB2.userPhoneNumber)  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                     ->filterColumn('userCompany', function($query, $keyword) {
                                        $sql = 'ueb.userCompany  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->toJson();

                
            } 
            
        }


    	

		
    }

    /*
    # scans recibidos de usuarios datatables
    */
    public function getReceivedUsersScans(Request $request, $eventId){


      $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

      $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');


    	$receivedScans = ScanUserUser::from('scan_user_users as SUU')
                                      ->join('user_events as UE', 'UE.id', 'SUU.scanUserDestination')
                                      ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'UE.id')
                                      ->join('users as u', 'u.id', 'UE.user_id')
                                      ->where('UE.event_id', $eventId)
                                      ->select([\DB::raw('u.id as ID,
                                                        (CASE 
                                                         WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                            THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                            ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                                         END) as fullName,
                                                         (CASE 
                                                            WHEN ueb.userEmail is not null
                                                            THEN ueb.userEmail
                                                            ELSE u.userEmail
                                                         END) AS userEmail,
                                                         (CASE 
                                                            WHEN ueb.userPhoneNumber is not null
                                                            THEN ueb.userPhoneNumber
                                                            ELSE u.userPhoneNumber
                                                         END) AS userPhoneNumber, 
                                                         (CASE 
                                                         WHEN ueb.userCompanyName is not null 
                                                            THEN ueb.userCompanyName 
                                                            ELSE "Sin especificar" 
                                                         END) as userCompany,
                                                         count(DISTINCT SUU.scanUserSource) as scansNumber')])
                                      ->groupBy('u.id','fullName', 'userEmail', 'userPhoneNumber', 'userCompany', 'SUU.scanUserDestination'); 



  	   //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

    	    return datatables()->of($receivedScans)
    	                ->filterColumn('fullName', function($query, $keyword) {
                                        $sql = 'CONCAT(ueb.userFirstName, " ", ueb.userLastName)  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->filterColumn('userEmail', function($query, $keyword) {
                                        $sql = 'ueb.userEmail  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->filterColumn('u.userEmail', function($query, $keyword) {
                                        $sql = 'u.userEmail  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->filterColumn('userPhoneNumber', function($query, $keyword) {
                                        $sql = 'ueb.userPhoneNumber  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                ->toJson();
        }
         //basico
        else if($roleAuth[0] == 3){
            
            //Sub Admin Speaker o vendedor, visitante
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2 || $userEventRoleAuth[0] == 5){

              $user = Auth::user();

              $userevent = UserEvent::where('user_id',$user->id)
                ->where('event_id',$eventId)
                ->first();



                   $receivedScans = $receivedScans->where('SUU.scanUserDestination', $userevent->id);
                                                  // dd($performedScans->get());

                return datatables()->of($receivedScans)
                                    ->filterColumn('fullName', function($query, $keyword) {
                                        $sql = 'CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ")  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->filterColumn('userEmailPhone', function($query, $keyword) {
                                        $sql = 'CONCAT(UEB2.userEmail, " / ",  UEB2.userPhoneNumber)  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                     ->filterColumn('userCompany', function($query, $keyword) {
                                        $sql = 'ueb.userCompany  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                                    ->toJson();






            }


        }

    }


    /*
    # vista scans para empresas
    */
	public function getCompaniesScansView(Request $request){
        $eventId = $request->eventId;
        $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');
        
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
       
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);
        return view('backend.admin.scans.companies-scans', [
                            'eventId' => $eventId, 
                            'eventName' => $eventName[0], 
                            'permissions' => $userPermissions['permission'], 
                            'typeName' => $userPermissions['typeName'],
                            'eventRoleAuth' => $userEventRoleAuth[0]

                          ]
                          );

    }

    /*
    # scans de empresas
    */

    public function getPerformedCompaniesScans(Request $request, $eventId){

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
       

        $performedScans = ScanUserCompany::from('scan_user_companies as SUC')
                                      ->join('user_events as UE', 'UE.id', 'SUC.scanUserSource')
                                      ->leftJoin('user_event_badges as UEB', 'UEB.user_event_id', 'UE.id')
                                      ->join('users as U', 'U.id', 'UE.user_id')
                                      ->join('companies as C', 'C.id', 'SUC.scanCompanyDestination')
                                      ->where('UE.event_id', $eventId);


        //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            //$products = $products->get();
            $performedScans = $performedScans->select([\DB::raw('(CASE 
                                                                    WHEN CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", UEB.userEmail,") ") is not null 
                                                                    THEN CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", U.userEmail,") ") 
                                                                    ELSE CONCAT(U.userFirstName, " ", U.userLastName, " (", U.userEmail,") " ) 
                                                                 END) as fullName,  
                                                                 (CASE 
                                                                    WHEN UEB.userPhoneNumber is not null
                                                                    THEN UEB.userPhoneNumber
                                                                    ELSE U.userPhoneNumber
                                                                 END)  AS userPhone, C.companyName as companyName, CONCAT(C.companyCountryCode, " ", C.companyPhone) as companyPhoneNumber')])
                                             ->groupBy([\DB::raw('fullName,  userPhone, C.companyName, CONCAT(C.companyCountryCode, " ", C.companyPhone)')]);

            return datatables()->of($performedScans)
                                ->filterColumn('fullName', function($query, $keyword) {
                                    $sql = 'CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", UEB.userEmail,") ")  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->toJson();

           
        }
        //basico visitante
        else if($roleAuth[0] == 3){



            //Sub Admin Speaker o vendedor 
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2){

                   $performedScans = $performedScans->select([\DB::raw('CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", UEB.userEmail,") ") as fullName,  UEB.userPhoneNumber AS userPhone, C.companyName as companyName, CONCAT(C.companyCountryCode, " ", C.companyPhone) as companyPhoneNumber')])
                                             ->groupBy([\DB::raw('CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", UEB.userEmail,") "),  UEB.userPhoneNumber, C.companyName, CONCAT(C.companyCountryCode, " ", C.companyPhone)')]);

                    return datatables()->of($performedScans)
                                ->filterColumn('fullName', function($query, $keyword) {
                                    $sql = 'CONCAT(UEB.userFirstName, " ", UEB.userLastName, " (", UEB.userEmail,") ")  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->toJson();

                
            } 
            
        }


        

        
    }



    /*
    # vista scans para productos
    */
    public function getProductsScansView(Request $request){

        $eventId = $request->eventId;
        $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
       
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);

        return view('backend.admin.scans.products-scans', ['eventId' => $eventId, 'eventName' => $eventName[0], 'permissions' => $userPermissions['permission'], 
                                                                      'typeName' => $userPermissions['typeName']]);


    }

    /*
    # Vista para scans de ofertas
    */

    public function getSalesScansView(Request $request){

        $eventId = $request->eventId;
        $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');
        $permission = $this->getUserAllPermissions($eventId, Auth::user()->id);

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
       
        $userPermissions = User::getUserPermissionsNumber($roleAuth[0], $userEventRoleAuth[0]);


        return view('backend.admin.scans.sales-scans', [
                                                        'eventId' => $eventId, 
                                                        'eventName' => $eventName[0], 
                                                        'permission' => $permission, 'permissions' => $userPermissions['permission'], 
                                                                      'typeName' => $userPermissions['typeName']
                                                       ]);


    }


    /*
    # obtener datos para scans de productos realizados por usuarios
    */

    public function getPerformedProductsScans(Request $request, $eventId){

        $scans = DB::table('user_events as ue')
                     ->join('scan_user_products as sup', 'sup.scanUserSource', 'ue.id')
                     ->join('products as p', 'p.id', 'sup.scanProductDestination')
                     ->leftJoin('brands as b', 'b.id', 'p.brand_id')
                     ->join('payment_currencies as pc', 'pc.id', 'p.payment_currency_id')
                     ->where('ue.event_id', $eventId)
                     ->select([\DB::raw('p.id as ID, 
                                        p.productName as productName,
                                        CASE 
                                            WHEN b.brandName is not null
                                            THEN b.brandName
                                            ELSE "Sin Marca"
                                        END AS brandName,
                                        CONCAT(pc.currencySymbol, " ", p.productPrice) as productPrice,
                                        count(*) as scansNumber
                                        '
                                        )])
                    ->groupBy('ID', 'productName', 'brandName', 'pc.currencySymbol', 'productPrice')
                    ->orderBy('productName', 'asc');

        return datatables()->of($scans)
                                ->filterColumn('productName', function($query, $keyword) {
                                    $sql = 'p.productName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('brandName', function($query, $keyword) {
                                    $sql = 'b.brandName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('productPrice', function($query, $keyword) {
                                    $sql = 'CONCAT(pc.currencySymbol, " ", p.productPrice)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('scansNumber', function($query, $keyword) {
                                    $sql = 'count(*)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->toJson();



    }

    /*
    #  Obtener datos para scans de ofertas realizados por usuarios y llenar datatables
    */

    public function getReceivedSalesScans(Request $request, $eventId, $permission, $scansFilter){

        $scans = DB::table('user_events as ue')
                     ->join('scan_user_sales as sus', 'sus.scanUserSource', 'ue.id')
                     ->join('sales as s', 's.id', 'sus.scanSaleDestination')
                     ->join('products as p', 'p.id', 's.product_id')
                     ->leftJoin('brands as b', 'b.id', 'p.brand_id')
                     ->join('payment_currencies as pc', 'pc.id', 'p.payment_currency_id')
                     ->where('ue.event_id', $eventId)
                     ->select([\DB::raw('s.id as ID, 
                                        p.productName as productName,
                                        s.saleDescription as saleDescription,
                                        CASE 
                                            WHEN b.brandName is not null
                                            THEN b.brandName
                                            ELSE "Sin Marca"
                                        END AS brandName,
                                        CONCAT(pc.currencySymbol, " ", p.productPrice) as productPrice,
                                        count(*) as scansNumber
                                        '
                                        )])
                    ->groupBy('ID', 'productName', 'saleDescription', 'brandName', 'pc.currencySymbol', 'productPrice')
                    ->orderBy('productName', 'asc');

       $myScans = $scans;

        //Subadmin
        if($scansFilter == 'all'){
            //Filtrar si no es un full admin
            if($permission > 1){
                $scans = $scans->where('p.user_id', Auth::user()->id);
            }
            return datatables()->of($scans)
                                ->filterColumn('productName', function($query, $keyword) {
                                    $sql = 'p.productName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('brandName', function($query, $keyword) {
                                    $sql = 'b.brandName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('productPrice', function($query, $keyword) {
                                    $sql = 'CONCAT(pc.currencySymbol, " ", p.productPrice)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('scansNumber', function($query, $keyword) {
                                    $sql = 'count(*)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->toJson();

        }
        
        if($scansFilter == 'my' ){

            $userEventId = DB::table('user_events')->where('user_id', Auth::user()->id )->pluck('id');

            $myScans = $myScans->where('sus.scanUserSource', $userEventId[0]);

            return datatables()->of($myScans)
                                ->filterColumn('productName', function($query, $keyword) {
                                    $sql = 'p.productName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('brandName', function($query, $keyword) {
                                    $sql = 'b.brandName  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('productPrice', function($query, $keyword) {
                                    $sql = 'CONCAT(pc.currencySymbol, " ", p.productPrice)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->filterColumn('scansNumber', function($query, $keyword) {
                                    $sql = 'count(*)  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                                ->toJson();

        }

        


    }


    /*
    # generar pdf, scan user users
    */
    public function getScanUsersPdfReport(Request $request, $eventId, $userId, $scanType){
        $type = 'Usuarios';
         switch ($scanType) {
            case 'performed':
               // $data = $this->getScanUserUsersData($eventId, $userId);

                set_time_limit(0);
                //$eventId = $request->eventId;
                $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');

                $fileName = str_replace(' ', '', $eventName[0].".xls");

                return Excel::download(new ScanUserUsersExportView($eventId, $userId, $type),  $fileName); 

                break;
            
            case 'received':
                $data = $this->getScanUsersUserData($eventId, $userId);
                break;
        }

        $view =  \View::make('backend.admin.scans.users-companies-report', compact('data', 'type'))->render();
           
        //quitar
      //  return view('backend.admin.scans.users-companies-report', ['data'=> $view, 'type' => $type]);
        //quitar

        return  PDF::loadHTML($view)->stream('Reporte_Scans_Usuarios.pdf');


    }




    /*
    # Generar Pdf, scan user companies
    */

    public function getScanUserCompaniesPdfReport(Request $request, $eventId, $companyId, $scanType){

        $eventName = DB::table('events')->where('id', $eventId)->pluck('eventName');

        
         
        $type = 'Empresas a Usuarios';
        switch ($scanType) {
            case 'performed':
                $fileName = str_replace(' ', '', $eventName[0]."_scans_realizados.xls");
                return Excel::download(new ScanCompaniesExportView($eventId, $companyId),  $fileName); 
                        
                $data = $this->getScanCompaniesUsersData($eventId, $companyId);
                break;
            
            case 'received':
                $type = 'Usuarios a Empresas';
                $fileName = str_replace(' ', '', $eventName[0]."_scans_recibidos.xls");
                return Excel::download(new ScanToCompanyUsersExportView($eventId, $companyId),  $fileName); 
                
                $data = $this->getScanUsersCompaniesData($eventId, $companyId);
                break;
        }

        

        $view =  \View::make('backend.admin.scans.users-companies-report', compact('data', 'type'))->render();
           
        return  PDF::loadHTML($view)->stream('Reporte_de_Scans.pdf');

    }


    /*
    # generar Pdf para scans de productos
    */

    public function getScanUserProductsPdfReport(Request $request, $eventId, $productId){
        $type = 'Productos';
        $data = $this->getScanProductsData($eventId, $productId);

        $view =  \View::make('backend.admin.scans.users-companies-report', compact('data', 'type'))->render();
           
        return  PDF::loadHTML($view)->stream('Reporte_de_Scans.pdf');

    }


    /*
    # Generar PDF para scans de ofertas
    */

    public function getScanUserSalesPdfReport(Request $request, $eventId, $saleId, $scanType, $scansFilter){
        $type = 'Ofertas';
        $data = $this->getScanSalesData($eventId, $saleId, $scansFilter);

        $view =  \View::make('backend.admin.scans.users-companies-report', compact('data', 'type'))->render();
           
        return  PDF::loadHTML($view)->stream('Reporte_de_Scans.pdf');


    }

    /*
    # Datos de scans realizados de usuario a usuarios
    */
    public function getScanUserUsersData($eventId, $userId){

        $userData = User::from('users as u')
                        ->join('user_events as ue', 'ue.user_id', 'u.id')
                        ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                        ->leftJoin('companies as c', 'c.id', 'ue.company_id')
                        ->groupBy('ue.id')
                        ->groupBy('fullName')
                        ->groupBy('userEmail')
                        ->groupBy('userPhone')
                        ->groupBy('userCompany')
                        ->where('ue.event_id', $eventId)
                        ->take(12000)
                        ->orderBy('fullName')
                        ->select([\DB::raw('ue.id as ID,
                                            (CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                WHEN u.userPhoneNumber is not null
                                                THEN u.userPhoneNumber
                                                ELSE "N/A"
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')]);


        $userevent = UserEvent::where('user_id',$userId)->where('event_id', $eventId)->first();
        
       // dd($userData->get()[760]);
    /*    $userData = DB::table('scan_user_users')
            ->join('user_events as uvs','scan_user_users.scanUserSource','uvs.id')
            ->join('user_events as uvd','scan_user_users.scanUserDestination','uvd.id')
            ->join('user_event_badges as ueb','ueb.user_event_id','uvd.id')
            ->join('user_types','uvd.user_type_id','user_types.id')
            ->join('users as u', 'u.id', 'uvs.user_id')
            ->leftJoin('companies as c', 'c.id', 'uvs.company_id')
            ->groupBy('uvs.id')
            ->groupBy('fullName')
            ->groupBy('userEmail')
            ->groupBy('userPhone')
            ->groupBy('userCompany')
            ->where('uvs.event_id', $eventId)
            //->where('scan_user_users.scanUserSource',$userevent->id)
             ->select([\DB::raw('uvs.id as ID,
                                            (CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')])
            ->orderBy('ueb.userFirstName'); */

           
                         

        if($userId != 0){
            $userData = $userData->where('u.id', $userId);

            //$userData = $userData->where('scan_user_users.scanUserSource',$userevent->id);
        }



        $userData = $userData->get();

        //dd($userData[0]);
                        

        $color = 0;
        $report = '';
        foreach ($userData /*->chunk(100)*/ as $user) {

            //foreach ($chunk as $) {
            
           

            $scans = $this->getEmpScans($user->ID, $eventId);
            
                $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='" >';
                    
                    $report .= '<h4 class="company-name" style="background: #fafafa !important;  color: #004f9f;padding: 5px !important;">' . $user->fullName . ' ('. count($scans) .')</h4>';
                    $report .= '<div class="scan-detail">';

                        //$report .= '<div class="scan-detail-title">';
                          //  $report .= '<span>SCANS REALIZADOS ('. count($scans) .')</span>';
                        //$report .= '</div>';
                    $report .= '</div>';
                    
                    $report .= '<div class="scan-detail-body">';

                        //ususarios
                        $colors = 0; // 1 gray 0 white
                        foreach ($scans as $scan) {
                            //recorrer los escans de los empleados

                            
                            $report .= '<div class="user-company-scan-user-container">';
                           
                                
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                   
                                        $report .= '<span class="user-scaned-data">' . $scan->fullName . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userEmail . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userPhone . '</span>';

                                    $report .= '</div>';

                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                
                            $report .= '</div>'; //fin user-company-scan-user


                        } //fin foreach scans

                    $report .= '</div>'; //fin scan-detail-body

                $report .= '</div>'; // fin scan-container
            if($color==0){$color++;}
            else{$color=0;}


          //} //end chunk foreach

        } // end foreach user data



        return  preg_replace("/&(?!(?:apos|quot|[gl]t|amp);|#)/", '&amp;', $report);
    
    }



    /*
    # Datos de scans realizados de empresas a visitantes
    */
    public function getScanCompaniesUsersData($eventId, $companyId){


     
      $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

      $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

      //dd($userEventRoleAuth[0]);

        //Empresas


        $companies = Company::from('companies as c')
                            //->join('user_events as ue', 'ue.company_id', 'c.id')
                            //->join('scan_user_companies as suc', 'suc.scanCompanyDestination', 'c.id')
                            //->select('c.id', 'c.companyName', 'c.companyEmail', 'companyAddress')
                             ->select([\DB::raw('c.id, c.companyName as companyName,
                                                 CASE WHEN c.companyEmail is not null
                                                      THEN c.companyEmail
                                                      ELSE "Correo no registrado"
                                                 END as companyEmail,
                                                 CASE WHEN c.companyAddress is not null
                                                      THEN c.companyAddress
                                                      ELSE "Dirección no registrada"
                                                 END as companyAddress,
                                                 CASE WHEN c.companyPhone is not null
                                                      THEN c.companyPhone
                                                      ELSE "Teléfono no registrado"
                                                 END as companyPhone,
                                                 CASE WHEN c.companyWebSite is not null
                                                      THEN c.companyWebSite
                                                      ELSE "Sitio web no registrado"
                                                 END as companyWebSite
                                                  ')])
                            ->where('c.event_id', $eventId)
                            ->groupBy( 'c.id','c.companyName', 'c.companyEmail', 'companyAddress', 'c.companyPhone', 'companyWebSite')
                            ->orderBy('c.companyName');




       

        // Filtrar visitante
        if ( $userEventRoleAuth[0] > 2 ){

            $userEventId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $eventId)
                                       ->pluck('id');

            $companies = $companies->join('scan_user_companies as suc', 'suc.scanCompanyDestination', 'c.id')
                                   ->where('suc.scanUserSource', $userEventId[0]);


            $companies = $companies->get();

            $color = 0; // 1 gray 0 white
            $report = '';
            //Recorrer las empresas
            foreach ($companies as $company) {
              $colors = 0; // 1 gray 0 white
              $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='">';
              
                $report .= '<h4 class="company-name" " style="padding: 5px;">' . $company->companyName . '</h4>';


                //$report .= '<div class="scan-detail">';
                //$report .= '</div>'; //end scan-detail

                   $report .= '<div class="scan-detail-body" style="margin-top: -19px;">';

                    $report .= '<div class="user-company-scan-user-container">';

                      $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' " style="background: #cecece"'; } $report.='">';

                        $report .= '<span class="user-scaned-data">' . $company->companyEmail . '</span>';
                        $report .= '<span class="user-scaned-data">' . $company->companyPhone . '</span>';
                        $report .= '<span class="user-scaned-data">' . $company->companyAddress . '</span>';
                        $report .= '<span class="user-scaned-data">' . $company->companyWebSite . '</span>';

                      $report .= '</div>'; //end  user-company-scan-user

                    $report .= '</div>'; //end  user-company-scan-user-container

                   $report .= '</div>'; //end scan detail body

                
              
              $report .= '</div>'; //end scan-container

              if($colors==0){$colors++;}
              else{$colors=0;}
            } //end foreach companies

            return $report;
        }




/*        if($companyId != 0){

            $companies = $companies->where('c.company_id', $companyId);

        }

*/

        //Filtrar Subadmin
        if($userEventRoleAuth[0] == 2){

            $userCompanyId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $eventId)
                                      ->pluck('company_id');

                                      // dd($userCompanyId);

            $companies = $companies->where('c.id', $userCompanyId[0]);
        } 

        //si es un admin (1), no se filtran las empresas (se obtienen todas)
        
        $companies = $companies->get();

       

       
        $report = '';
        if($companies->count()>0){


            //Empleados de la empresa especificada
                   
            
            $color = 0; // 1 gray 0 white
            //Recorrer las empresas
            foreach ($companies as $company) {

               $companyEmps = $this->getCompanyEmps($company->id, $eventId);

                $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='">';
                    
                    $report .= '<h4 class="company-name">' . $company->companyName . '</h4>';



                    
                    $report .= '<div class="scan-detail">';

                        $report .= '<div class="scan-detail-title">';
                            $report .= '<span>DETALLE DE SCANS</span>';
                        $report .= '</div>';
                    $report .= '</div>';
                        $report .= '<div class="scan-detail-body">';


                        //Recorrer los empleados
                         foreach ($companyEmps as $emps) {
                            $scans = $this->getEmpScans($emps->ueId, $eventId);

                            //recorrer los escans de los empleados
                            $report .= '<div class="user-scans">';
                                $report .= '<span class="company-user-name">' . $emps->fullName . ' (' . $scans->count(); if($scans->count() == 0 || $scans->count() >1){ $report .= ' Scans '; } else {$report .= ' Scan'; }  $report .=')'.  '</span>';
                            $report .= '</div><!-- fin user-scans -->';

                            $report .= '<div class="user-company-scan-user-container">';
                            $colors = 0; // 1 gray 0 white
                                foreach ($scans as $scan) {
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                   
                                        $report .= '<span class="user-scaned-data">' . $scan->fullName . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userEmail . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userPhone . '</span>';

                                    $report .= '</div>';

                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                }
                            $report .= '</div>'; //fin user-company-scan-user

                          
                        }

                        $report .= '</div> <!-- fin scan detail body -->';

                    




                $report .= '</div>';






                if($color==0){$color++;}
                else{$color=0;}
            
            } //fin foreach empresas
            
            //dd($report);
        } //end if count
        else{

            $companyData = Company::where('id', $companyId)->get();

            $report .= '<div class="scan-container gray-back">';
                    
                $report .= '<h4 class="company-name">' . $companyData[0]->companyName . '</h4>';

                $report .= '<div class="scan-detail">';

                    $report .= '<div class="scan-detail-title red">';
                        $report .= '<span>NO EXISTEN SCANS DE ESTA EMPRESA</span>';
                    $report .= '</div>';
                $report .= '</div>';

            $report .= '</div>';

        }
        dd ($report);


    }




    /*
    # scans de usuario a usuarios
    */

    public function getUsersScans($eventId, $userId){

        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                       ->join('scan_user_users as suu', 'suu.scanUserDestination', 'ue.id')    
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->leftjoin('companies as c', 'c.id', 'ue.company_id')
                       ->where('suu.scanUserSource', $empId)
                       ->where('ue.event_id', $eventId)
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')])
                       ->orderBy('c.companyName')
                       
                       ->get();

        return $scans;

    }


    /*
    # scans de usuarios a empresas
    */

    public function getScanUsersCompaniesData($eventId, $companyId){

        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

        $companies = Company::from('companies as c')
                            ->join('user_events as ue', 'ue.company_id', 'c.id')
                            ->select('c.id', 'c.companyName')
                            ->where('ue.event_id', $eventId)
                            ->groupBy( 'c.id','c.companyName')
                            ->orderBy('c.companyName');

        if($companyId !=0){

            $companies = $companies->where('ue.company_id', $companyId);

        }



        //Filtrar Subadmin
        if($userEventRoleAuth[0] == 2){

            $userCompanyId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $eventId)
                                       ->pluck('company_id');

                                      // dd($userCompanyId);

            $companies = $companies->where('c.id', $userCompanyId[0]);
        } 
        // Filtrar visitante
        if ( $userEventRoleAuth[0] > 2 ){

            $userEventId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $eventId)
                                       ->pluck('id');

            $companies = $companies->join('scan_user_companies as suc', 'suc.scanCompanyDestination', 'c.id')
                                   ->where('suc.scanUserSource', $userEventId[0]);


            


        }


        $companies = $companies->get();


       
        $report = '';
        if($companies->count()>0){

            $color = 0; // 1 gray 0 white
            //Recorrer las empresas
            foreach ($companies as $company) {
                $companyScans = $this->getCompanyScans($company->id, $eventId);

                  $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='">';
                    
                    $report .= '<h4 class="company-name">' . $company->companyName . '</h4>';

                    $report .= '<div class="scan-detail">';

                        $report .= '<div class="scan-detail-title">';
                            $report .= '<span>SCANS RECIBIDOS ' . $companyScans->count() . '</span>';
                        $report .= '</div>';

                    $report .= '</div>'; // fin scan-detail

                        $report .= '<div class="scan-detail-body">';

                            $report .= '<div class="user-company-scan-user-container">';
                            
                                $colors = 0; // 1 gray 0 white
                                foreach ($companyScans as $scan) {
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                        $report .= '<div class="scan-number"><span>'. $scan->scanNumber .' Scan(s)</span></div>';
                                        $report .= '<span class="user-scaned-data">' . $scan->fullName . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userEmail . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $scan->userPhone . '</span>';
                                        $report .= '<span class="user-scaned-data"><B>' . $scan->userCompany . '</B></span>';
                                        
                                    
                                    $report .= '</div>';
                                    
                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                }
                                    
                               
                            $report .= '</div>'; //fin user-company-scan-user


                        $report .= '</div>'; //fin scan-detail-body



                  $report .= '</div>'; // fin scan-container



            } // end foreach companies


        } // fin if companiescount
        else{


        }


        return $report;


    } // fin getScanUsersCompaniesData



    /*
    # Datos de scans realizados de empresas a visitantes
    */
    public function getScanProductsData($eventId, $productId){


        $products = Product::from('products as p')
                    ->join('scan_user_products as sup', 'sup.scanProductDestination', 'p.id')
                    ->join('user_events as ue', 'ue.id', 'sup.scanUserSource')
                    ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                    ->join('users as u', 'u.id', 'ue.user_id')
                    ->where('ue.event_id', $eventId)
                    ->groupBy('p.id', 'p.productName')
                    ->select([\DB::raw('p.id  as productId, p.productName as productName, count(*) as scansNumber')]);
                   
        if($productId !=0){

            $products = $products->where('p.id', $productId);

        }

        $products = $products->get();

        $report = '';
        $color = 0;
        foreach ($products as $product) {

                 $users = $this->getProdcutUsersScans($eventId, $product->productId);
                
                 $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='">';

                     $report .= '<h4 class="company-name">' . $product->productName . ' (' . $product->scansNumber . ' Scans ) </h4>';

                     $report .= '<div class="scan-detail">';

                        $report .= '<div class="scan-detail-title">';
                            $report .= '<span>SCANS RECIBIDOS ' . $users->count() . '</span>';
                        $report .= '</div>';

                    $report .= '</div>'; // fin scan-detail



                    $report .= '<div class="scan-detail-body">';

                        $report .= '<div class="user-company-scan-user-container">';
                            
                                $colors = 0; // 1 gray 0 white
                                foreach ($users as $user) {
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                        $report .= '<div class="scan-number"><span>'. $user->scanNumber .' Scan(s)</span></div>';
                                        $report .= '<span class="user-scaned-data">' . $user->fullName . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $user->userEmail . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $user->userPhone . '</span>';
                                        $report .= '<span class="user-scaned-data"><B>' . $user->userCompany . '</B></span>';
                                        
                                    
                                    $report .= '</div>';
                                    
                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                }
                                    
                               
                            $report .= '</div>'; //fin user-company-scan-user

                    $report .= '</div>'; // fin scan-body



                 $report .= '</div>'; //fin scan-container

            if($color==0){$color++;}
            else{$color=0;}
        } // end foreach products



        return $report;  


    }


    //generar html para scans de ofertas
    public function getScanSalesData($eventId, $saleId, $scansFilter){

        //dd($saleId . ' '. $scansFilter);


        $sales = DB::table('sales as s')
                    ->join('scan_user_sales as sus', 'sus.scanSaleDestination', 's.id')
                    ->join('user_events as ue', 'ue.id', 'sus.scanUserSource')
                    ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                    ->join('users as u', 'u.id', 'ue.user_id')
                    ->join('products as p', 'p.id', 's.product_id')
                    ->where('ue.event_id', $eventId)
                    ->groupBy('s.id', 's.saleDescription', 'p.productName', 's.id')
                    ->select([\DB::raw('s.id  as saleId, s.saleDescription as saleDescription, p.productName as productName, count(*) as scansNumber')]);
                   
        if($saleId !=0){

            $sales = $sales->where('s.id', $saleId);

        }

        $sales = $sales->get();

        $report = '';
        $color = 0;

       // dd($sales);
        foreach ($sales as $sale) {
            # code...
            $scans = $this->getSalesUserScans($eventId, $sale->saleId);
           // dd($scans);
            $report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='">';

                $report .= '<h4 class="company-name">' . $sale->saleDescription . ' '. $sale->productName .'        (' . $sale->scansNumber . ' Scans ) </h4>';

                 $report .= '<div class="scan-detail-body">';

                        $report .= '<div class="user-company-scan-user-container">';
                            
                                $colors = 0; // 1 gray 0 white
                                foreach ($scans as $user) {
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                        $report .= '<div class="scan-number"><span>'. $user->scanNumber .' Scan(s)</span></div>';
                                        $report .= '<span class="user-scaned-data">' . $user->fullName . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $user->userEmail . '</span>';
                                        $report .= '<span class="user-scaned-data">' . $user->userPhone . '</span>';
                                        $report .= '<span class="user-scaned-data"><B>' . $user->userCompany . '</B></span>';
                                        
                                    
                                    $report .= '</div>';
                                    
                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                }
                                    
                               
                            $report .= '</div>'; //fin user-company-scan-user

                    $report .= '</div>'; // fin scan-body


            $report .= '</div>'; //fin div scan-container




            if($color==0){$color++;}
            else{$color=0;}

        } // fin foreach sales


        return $report;

    }



    public function getCompanyEmps($companyId, $eventId){
        $companyEmps = User::from('users as u')
                           ->join('user_events as ue', 'ue.user_id', 'u.id')
                           ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                           ->join('companies as c', 'c.id', 'ue.company_id')
                           ->join('scan_user_companies as suc', 'suc.scanUserSource', 'ue.id')
                           ->where('ue.company_id', $companyId)
                           ->where('ue.event_id', $eventId)
                           ->select([\DB::raw('ue.id as ueId,
                                                (CASE 
                                                    WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ") is not null 
                                                    THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ") 
                                                    ELSE CONCAT(u.userFirstName, " ", u.userLastName, " (", u.userEmail,") " ) 
                                                 END) as fullName,  
                                                 (CASE 
                                                    WHEN ueb.userPhoneNumber is not null
                                                    THEN ueb.userPhoneNumber
                                                    ELSE u.userPhoneNumber
                                                 END) as userPhone, c.companyName')])
                           ->orderBy('c.companyName')
                           ->get();

                           

        return $companyEmps;
    }

    //obtener scans de usuarios de empresas a otros usuarios

    public function getEmpScans($empId, $eventId){



        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                       ->join('scan_user_users as suu', 'suu.scanUserDestination', 'ue.id')    
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->leftjoin('companies as c', 'c.id', 'ue.company_id')
                       ->groupBy('fullName')
                       ->groupBy('userEmail')
                       ->groupBy('userPhone')
                       ->groupBy('userCompany')
                       ->where('suu.scanUserSource', $empId)
                       ->where('ue.event_id', $eventId)
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')])
                       ->orderBy('c.companyName')
                       ->groupBy('c.companyName')
                       
                       ->get();


        

        return $scans;
    }


    /*
    # obtener los scans de usuarios a empresas por empresa
    */
    public function getCompanyScans($companyId, $eventId){
        //user id funciona desde user_event_id
        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                         
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->join('scan_user_companies as suc', 'suc.scanUserSource', 'ue.id')

                       ->leftJoin('companies as c', 'c.id', 'ue.company_id')
                       ->where('suc.scanCompanyDestination', $companyId)
                       ->where('ue.event_id', $eventId)
                       
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN ue.company_id is not null
                                                THEN c.companyName
                                                ELSE "Empresa no especificada"
                                             END) as userCompany, count(*) as scanNumber')])
                       ->groupBy('fullName', 'userEmail', 'userPhone', 'userCompany')
                       ->orderBy('fullName')
                       ->get();

       

        return $scans;
                       



    }


    /*
    # obtener los usuarios que escanearon un producto en especifico
    */

    public function getProdcutUsersScans($eventId, $productId){

        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                         
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->join('scan_user_products as sup', 'sup.scanUserSource', 'ue.id')
                       ->leftJoin('companies as c', 'c.id', 'ue.company_id')
                       ->where('sup.scanProductDestination', $productId)
                       ->where('ue.event_id', $eventId)
                       
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany,
                                            count(*) as scanNumber')])
                       ->groupBy('fullName', 'userEmail', 'userPhone', 'userCompany')
                       ->orderBy('fullName')
                       ->get();

       

        return $scans;

    }



    /*
    # obtenre los usuarios que escanearon ofertas
    */

    public function getSalesUserScans($eventId, $saleId){
        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                         
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->join('scan_user_sales as sus', 'sus.scanUserSource', 'ue.id')
                       ->leftJoin('companies as c', 'c.id', 'ue.company_id')
                       ->where('sus.scanSaleDestination', $saleId)
                       ->where('ue.event_id', $eventId)
                       
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany,
                                            count(*) as scanNumber')])
                       ->groupBy('fullName', 'userEmail', 'userPhone', 'userCompany')
                       ->orderBy('fullName')
                       ->get();

       

        return $scans;


    }



    public function getUserAllPermissions($eventId, $userId){
        // 1 Admin
        // 1 Event admin
        // 2 Event subadmin
        // 3 Representante
        // 4 Conferencista
        // 4 Visitante
        // 5 personal de montaje

        $permission = 0;
        $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');


         //Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            //$products = $products->get();
            $permission = 1;
           
        }
        //basico
        else if($roleAuth[0] == 3){

            //Sub Admin Speaker o vendedor 
            $permission = $userEventRoleAuth[0];
                
            } 

    

        return $permission;

    }

    



}
