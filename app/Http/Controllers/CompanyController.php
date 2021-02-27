<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Event;
use App\UserEvent;
use App\EventLocation;
use App\EventType;
use App\Permission;
use App\User;
use App\UserRole;
use App\Sale;
use App\Company;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\FormSection;

use App\Http\Controllers\UserController;


class CompanyController extends Controller
{

	/*
    * view for companies
    */

    public function getCompaniesView($evId){

      $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

      $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');

      $hideOptions = 0;

      $eventData = Event::where('id', $evId)->get();


      $eventAdminStatus = $eventData[0]->event_open_for_admin;

      //Mostrar las ofertas segun el tipo de  ususario logueado

      //Super y Full Admin
      if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

          $companies = Company::where('event_id', $evId)
                          ->get();
      }
      //basico
      else if($roleAuth[0] == 3){

          //Sub Admin Speaker o vendedor 
          if($userEventRoleAuth[0] == 2){

              $companies = Company::from('companies as C')->join('user_events as UE', 'UE.company_id', 'C.id')->where('C.event_id', $evId)
                          ->where('UE.user_id', Auth::user()->id)->select('C.id as id', 'C.companyName as companyName', 'C.companyAddress as companyAddress', 'C.companyCountryCode as companyCountryCode', 'C.companyPhone as companyPhone', 'C.companyPicture as companyPicture')->get();

              $hideOptions = 1;
            
          }     
      }

      
        
        $countFields=0;
        $fields = $this->getCompanyCatalogTemplate(7, $evId, $countFields);
       
     //  dd($fields);
         
         return view('backend.admin.companies.companies-admin', ['companies' => $companies, 'eventId' => $evId, 'countDinamicFields' => $countFields, 'dinamicFields' => $fields, 'hideOptions' => $hideOptions,
               'eventAdminStatus' => $eventAdminStatus]);
    }





    /* Dinamic forms */
	public function getCompanyCatalogTemplate($fomrId, $eventId, &$countFields){

		$checkForms = DB::table('event_forms')->where('event_id', $eventId)->get();
		$ftmp=null;
		$countFields=0;
		if(count($checkForms) > 0)
		{

	        $fields = Field::from('fields as F')
	                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
	                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
	                      ->where('FS.form_id', $fomrId) //form Visitantes
	                      ->where('FS.section_id', 1) //section Registro
	                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as PHOLDER, F.fieldRequired as FREQUIRED, F.fieldMaxLenght as MAXLENGHT, F.data_type_control_id as CONTROLTYPE')])->orderBy('FSF.fieldOrder', 'asc')->get();

	        $countFields = count($fields);
	        

          $divclose = 0;
	        foreach ($fields as $field) {
	            
	     /*   $ftmp .=    '<div class="group" style="margin-top: 5px">';

	        $control = $this->getControlTemplate($field->CONTROLTYPE, $field->ID, $field->MAXLENGHT, $field->FREQUIRED, $field->TAG, $field->PHOLDER );    

	        $ftmp .=        $control;
	       */
	          
	                if($divclose==0){

                    $ftmp .= '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">';
                  } 
	           
	                $control = $this->getControlTemplate($field->CONTROLTYPE, $field->IDA, $field->MAXLENGHT, $field->FREQUIRED, $field->TAG, $field->PHOLDER, $field->ID, $divclose );  
	                $ftmp .=        $control;
	               
                  
                  if($divclose==1){
                    $ftmp .= '</div> <!-- end-col-md-12 -->';
                    $divclose=0;
                  
                  }
                  else{
	                 $divclose++;
                  }
                  



                  

	        }
    	}
    	else{
    		$countFields=0;
    	}
        
        return $ftmp;
    }

    public function getControlTemplate($controlType, $id, $maxL, $required, $tag, $placeH, $fId, $divclose){
        /*
        * ControlType se utiliza para obtener el id del control y tipo asignados al control
        * 1 input text
        * 2 
        * 3
        *
        *
        *
        * 8 dropdown list
        *
        */
        $tmp ='';
        switch ($controlType) {
            case 1:
                # input text
            /*
            $tmp .= '<input id="'. $id .'" name="'. $id .'" type="text"  data-trigger="manual" maxlenght="'. $maxL .'" ';
                        if($required == 1){
                            $tmp .= 'required';
                        }
            $tmp .= '>';
            
            $tmp .='<span class="highlight"></span><span class="bar"></span>

                        <label>'. $tag .'</label>
                        <div class="err-msg uemail">
                            <span>'. $placeH .'</span>
                        </div>';*/
                        
			                        
			                           
			                        

            $tmp .= '<div class="col-md-6" style="padding: 10px 0px 0px 0px;'; if($divclose==0){  $tmp .= 'padding-right: 10px';   }
            $tmp .= '">
                          <label for="'. $id .'" style="width: 100%">'. $tag .'</label>
           					      <input id="'. $id .'" name="'. $id .'" type="text" class="form-control custom-form-control" placeholder="'. $tag .'" >
           			    </div>';


                break;

            case 2:
              $tmp = '<div class="col-md-6" style="padding: 10px 0px 0px 0px;'; if($divclose==0){  $tmp .= 'padding-right: 10px';   }
              $tmp .= '">
                      <label for="'. $id .'" style="width: 100%">'. $tag .'</label>
           					  <input id="'. $id .'" name="'. $id .'" type="number" class="form-control custom-form-control" placeholder="'. $tag .'" >
           			    </div>';

            break;
            
            case 4: 
                # email
             $tmp = '<div class="col-md-6" style="padding: 10px 0px 0px 0px;'; if($divclose==0){  $tmp .= 'padding-right: 10px';   }
             $tmp .= '">
                      <label for="'. $id .'" style="width: 100%">'. $tag .'</label>
           					  <input id="'. $id .'" name="'. $id .'" type="email" class="form-control custom-form-control" placeholder="'. $tag .'" >
           			    </div>';


            break;

            case 5: 
                # phone
             $tmp = '<div class="col-md-6" style="padding: 10px 0px 0px 0px;'; if($divclose==0){  $tmp .= 'padding-right: 10px';   }
             $tmp .= '">
                      <label for="'. $id .'" style="width: 100%">'. $tag .'</label>
                      <input id="'. $id .'" name="'. $id .'" type="phone" class="form-control custom-form-control" placeholder="'. $tag .'" >
                    </div>';


            break;

            case 8: 
                # dropdown list
                $options = $this->getDdListTemplate($fId);
              /*  $tmp .= '<select id="'. $id .'" name="'. $id .'">';
                    $tmp .= $options;
                $tmp .= '</select>';
              */
                $tmp = '<div class="col-md-6" style="padding: 10px 0px 0px 0px;'; if($divclose==0){  $tmp .= 'padding-right: 10px';   }
              $tmp .= '">
                            <label for="'. $id .'" style="width: 100%">'. $tag .'</label>';
                
                $tmp .= '        <select type="text" value="" class="form-control custom-form-control" id="'. $id .'" name="'. $id .'">';
                              
			    $tmp .=               $options;
            
                $tmp .= '        </select>

           		        </div>';
                break;
        }

        return $tmp;



    }


    public function getDdListTemplate($fId){
        $options = FieldOption::where('field_id', $fId)
                              ->orderBy('optionValue', 'asc')
                              ->get();
        $tmp = '';
        foreach ($options as $option) {
            //$tmp .= '<option value="'. $option->optionValue . '">' . $option->optionName . '</option>';


              $tmp .= '<option value="'. $option->optionValue . '">' . $option->optionName . '</option>';
        }

        return $tmp;
        

    }


    /*
    # obtener empresas segun el evento para datatables
    */
    public function getCompaniesByEvent(Request $request, $eventId){


      $receivedScans = Company::from('companies as c')->where('c.event_id', $eventId)->select([DB::raw('c.id as ID, c.companyName as companyName')]);

      
        return datatables()->of($receivedScans)
                    ->filterColumn('companyName', function($query, $keyword) {
                        $sql = 'c.companyName  like ?';
                        $query->whereRaw($sql, ["%{$keyword}%"]);
                    })->toJson();

    }


    /*
    * Obtener scans de empresas segun evento
    */

     public function getCompaniesScansByEvent(Request $request, $eventId){


      
      $roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

      $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');

      
      $receivedScans = Company::from('companies as c')
                              ->join('scan_user_companies as sc', 'sc.scanCompanyDestination', 'c.id')
                              ->where('c.event_id', $eventId)
                              ->groupBy('c.id', 'c.companyName', 'c.companyAddress', 'c.companyPhone', 'c.companyEmail')
                              ->select([DB::raw('c.id as ID, c.companyName as companyName, 
                                                  (CASE 
                                                      WHEN c.companyAddress is not null
                                                      THEN c.companyAddress
                                                      ELSE "Sin especificar"
                                                   END) AS companyAddress,
                                                   (CASE 
                                                      WHEN c.companyPhone is not null
                                                      THEN c.companyPhone
                                                      ELSE "Sin especificar"
                                                   END) AS companyPhone,
                                                   (CASE 
                                                      WHEN c.companyEmail is not null
                                                      THEN c.companyEmail
                                                      ELSE "Sin especificar"
                                                   END) AS companyEmail')])
                              ;
                              //->select();
      //return $userEventRoleAuth;
      //Filtrar si es un representante 3, conferencista 4, visitante 5, personal de montaje 6

     // return $receivedScans->get();
                              //Super y Full Admin
      if( $userEventRoleAuth[0] == 2 ){

        $userCompanyId = UserEvent::where('user_id', Auth::user()->id)
                                  ->where('event_id', $eventId)
                                  ->pluck('company_id');

        $receivedScans = $receivedScans->where('c.id', $userCompanyId[0]);

       // return $receivedScans->toSql();


      }
      // Basico
      else if($userEventRoleAuth[0] > 2){


        //obtener el id de user_events para filtrar
        $userEventId = UserEvent::where('event_id', $eventId)
                                ->where('user_id', Auth::user()->id)
                                ->select('id')
                                 ->pluck('id');

                                

          $receivedScans = $receivedScans->where('scanUserSource', $userEventId);
      }




      // return $receivedScans->get();
      
        return datatables()->of($receivedScans)
                    ->filterColumn('companyName', function($query, $keyword) {
                        $sql = 'c.companyName  like ?';
                        $query->whereRaw($sql, ["%{$keyword}%"]);
                        })
                    ->filterColumn('companyAddress', function($query, $keyword) {
                                    $sql = 'c.companyAddress  like ?';
                                    $query->whereRaw($sql, ["%{$keyword}%"]);
                                })
                    ->filterColumn('companyPhone', function($query, $keyword) {
                                        $sql = 'c.companyPhone  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                    ->filterColumn('companyEmail', function($query, $keyword) {
                                        $sql = 'c.companyEmail  like ?';
                                        $query->whereRaw($sql, ["%{$keyword}%"]);
                                    })
                    ->toJson();

    }




     /*
    # obtener empresas segun el evento para datatables
    */
    public function getCompaniesByEventSelect2(Request $request, $evId){

      $term = $request->term ?: '';

      $companies = Company::from('companies as c')->where('c.event_id', $evId)->where('c.companyName', 'like', '%'. $term.'%')->select('c.id as id', 'c.companyName as companyName')->get();

      $valid_companies = [];
        foreach ($companies as $company) {
            $valid_companies[] = ['id' => $company->id, 'text' => $company->companyName];
        }

      
        return \Response::json($valid_companies);

    }

}