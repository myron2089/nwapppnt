<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\FormSection;
use App\EventForm;
use App\Company;
use App\Event;
use App\Form;
use Auth;
use Illuminate\Support\Facades\Input;

class CatalogController extends Controller
{
    //

    /*
    ** Vista de 
    */
	/*
	* View for create catalog for companies
	*/

	public function getCreateCompanyCatalogView(Request $request){
		$eventId = $request->eventId;
		$eventName = Event::where('id', $eventId)->pluck('eventName');

		$eventData = Event::where('id', $eventId)->get();


		$eventAdminStatus = $eventData[0]->event_open_for_admin;

		$catalogCreated = DB::table('forms as F')
		                    ->join('event_forms as EF', 'EF.form_id', 'F.id')
		                    ->join('form_types as FT', 'FT.id', 'F.form_type_id')
		                    ->where('EF.event_id', $eventId)
		                    ->where('F.form_type_id', 7)
		                    ->select('F.id as ID','F.formName as NAME', 'F.formDescription as DESCRIPTION', 'FT.formTypeName as TYPE')
		                    ->get();

		if(count($catalogCreated)==0){

			

			

			$formId = time();
			$eventFormId = time();

			$form = new Form();
			$form->id = $formId;
			$form->formName = "Campos para empresa";
			$form->formDescription = "Campos adicionales para el registro de empresas del evento " . $eventName[0];
			$form->form_type_id = 7;
			$form->save();

			$eForm = new EventForm();
			$eForm->id = $eventFormId;
			$eForm->event_id = $eventId;
			$eForm->form_id = $formId;	
			$eForm->save();

			$formSection = new FormSection();
			$formSection->id = time();
			$formSection->form_id = $formId;
			$formSection->section_id = 1;
			$formSection->save();



			$catalogCreated = DB::table('forms as F')
		                    ->join('event_forms as EF', 'EF.form_id', 'F.id')
		                    ->join('form_types as FT', 'FT.id', 'F.form_type_id')
		                    ->where('EF.event_id', $eventId)
		                    ->where('F.form_type_id', 7)
		                    ->select('F.id as ID','F.formName as NAME', 'F.formDescription as DESCRIPTION', 'FT.formTypeName as TYPE')
		                    ->get();

		}


		//dd($catalogCreated[0]->ID);
        $fields = Field::from('fields as F')
                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
                      ->join('forms as FO', 'FO.id', 'FS.form_id')
                      ->join('event_forms as EF', 'EF.form_id', 'FO.id')
                      ->join('data_type_controls as DTC', 'DTC.id', 'F.data_type_control_id')
                      ->join('controls as C', 'C.id', 'DTC.control_id')
                      ->join('data_types as DT', 'DT.id', 'DTC.data_type_id')
                      ->where('EF.event_id', $eventId)
                      ->where('FS.form_id', $catalogCreated[0]->ID) //form Visitantes
                      ->where('FS.section_id', 1) //section Registro
                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as PHOLDER, F.fieldRequired as FREQUIRED, F.fieldMaxLenght as MAXLENGHT, F.data_type_control_id as CONTROLTYPE, C.controlName as CONTROLNAME, DT.dataTypeName as TYPENAME, C.id as controlId')])
                      ->orderBy('FSF.fieldOrder', 'asc')
                      ->get();

		$controls = DB::table('controls')->get();                  

		return view('backend.admin.catalogs.companies.create-company-catalog', ['eventId' => $eventId, 'formId' => $catalogCreated[0]->ID, 
			         'eventName' => $eventName[0], 
			         'catalogs' => $catalogCreated,
			         'controls' =>  $controls,
			         'fields' => $fields,
			         'eventAdminStatus' => $eventAdminStatus]);
		


	}

	/*
	* View Create catalog for users
	*/

	public function getCreateUserCatalogView(Request $request){
		$eventId = $request->eventId;
		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $eventId)->pluck('UE.user_type_id');
        $permissions = 0;
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 ){

            $permissions = 1;
            $typeName = 'Administrador';
        }
		$eventName = Event::where('id', $eventId)->pluck('eventName');

		$eventInfo = DB::table('events')->where('id', $eventId)->get();
		$eventAdminStatus = $eventInfo[0]->event_open_for_admin;

		$catalogCreated = DB::table('forms as F')
		                    ->join('event_forms as EF', 'EF.form_id', 'F.id')
		                    ->join('form_types as FT', 'FT.id', 'F.form_type_id')
		                    ->whereIn('F.form_type_id', array(1,2,3,4,5,6) )
		                    ->where('EF.event_id', $eventId)
		                    ->select('F.id as ID','F.formName as NAME', 'F.formDescription as DESCRIPTION', 'FT.formTypeName as TYPE')
		                    ->get();


		//dd($catalogCreated);
		                   

		return view('backend.admin.catalogs.users.create-catalog', ['eventId' => $eventId, 'eventName' => $eventName[0], 'catalogs' => $catalogCreated, 'eventAdminStatus' => $eventAdminStatus, 'permissions' => $permissions ]);
		
	}

	/*
	* store user catalog
	*/

	public function sotreUserCatalog(Request $request){

		//return $request->all();


		DB::beginTransaction();
		try{

			$check = DB::table('forms as f')
					   ->join('event_forms as ef', 'ef.form_id', 'f.id')
					   ->where('f.form_type_id', $request->formType)
					   ->where('ef.event_id' , $request->eventId)
					   ->get();

			if(count($check) > 0){
				$result = ['status' => 'exists', 'message' => 'Ya existe un catálogo para el tipo de usuario seleccionado.', 'alertType' =>'warning'];
			}
			else{

				$formId = time();
				$eventFormId = time();

				$form = new Form();
				$form->id = $formId;
				$form->formName = $request->formName;
				$form->formDescription = $request->formDescription;
				$form->form_type_id = $request->formType;
				$form->save();

				$eForm = new EventForm();
				$eForm->id = $eventFormId;
				$eForm->event_id = $request->eventId;
				$eForm->form_id = $formId;	
				$eForm->save();

				$formSection = new FormSection();
				$formSection->id = time();
				$formSection->form_id = $formId;
				$formSection->section_id = 1;
				$formSection->save();


				$catType = DB::table('form_types')->where('id', $request->formType)->pluck('formTypeName');

				$result = ['status' => 'success', 'message' => 'Se ha creado el formulario con éxito',  'alertType' =>'success', 'catId' => $formId, 'catName' => $request->formName, 'catDescription' => $request->formDescription, 'catType' => $catType[0] ];

				DB::commit();

			}

		} catch(exception $e){
			DB::rollBack();
			$result = ['status' => 'error', 'message' => $e->getMessage(), 'alertType' =>'error'];
	
		}


		return json_encode($result);

	}

    /*
    * get datatypes by control type
    */
    public function getDataTypes($controlId){

    	$dataTypes = DB::table('data_types as DT')
    	               ->join('data_type_controls as DC', 'DC.data_type_id', 'DT.id')
    	               ->where('DC.control_id', $controlId)
    	               ->select('DT.id', 'DT.dataTypeName')
    	               ->get();


    	return response()->json($dataTypes);

    }


    /*
	* Table for user catalogs
	*/
	public function getUserCatalogsTableView($evId, $typeId){
		$fields = DB::table('fields as F')
		            ->join('data_type_controls as DC', 'DC.id', 'F.data_type_control_id')
		            ->join('controls as C', 'C.id', 'DC.control_id')
		            ->join('data_types as DT', 'DT.id', 'DC.data_type_id')
		            ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
		            ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
		            ->join('sections as S', 'S.id', 'FS.section_id')
		            ->where('FS.id', $typeId)
		            ->select([\DB::raw('F.id as ID, F.fieldText as NAME, C.controlName as CONTROL, F.fieldPlaceHolder as PLACEHOLDER , F.fieldMaxLenght as MAXLENGHT, DT.dataTypeName as DATATYPE, S.sectionName as SECTION')])->get();


		return view('backend.admin.catalogs.user-catalog-table', ['fields'=> $fields]);
	 //return('dsfdas');
	}


    /*
	* Table for company catalogs
	*/
	public function getCompanyCatalogsTableView($evId){
		$fields = DB::table('fields as F')
		            ->join('data_type_controls as DC', 'DC.id', 'F.data_type_control_id')
		            ->join('controls as C', 'C.id', 'DC.control_id')
		            ->join('data_types as DT', 'DT.id', 'DC.data_type_id')
		            ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
		            ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
		            ->join('sections as S', 'S.id', 'FS.section_id')
		            ->join('forms as FO', 'FO.id', 'FS.form_id')
		            ->join('event_forms as EF', 'EF.form_id', 'FO.id')
		            ->where('FS.id', 7)
		            ->where('EF.event_id', $evId)
		            ->select([\DB::raw('F.id as ID, F.fieldText as NAME, C.controlName as CONTROL, F.fieldPlaceHolder as PLACEHOLDER , F.fieldMaxLenght as MAXLENGHT, DT.dataTypeName as DATATYPE, S.sectionName as SECTION')])->get();


		return view('backend.admin.catalogs.companies.company-catalog-table', ['fields'=> $fields]);
	 //return('dsfdas');
	}


	/*
	* store user catalog
	*/

	public function storeUserCatalog(Request $request, $evId, $typeId){


		$input = $request->all();
		$result = array();
		$maxL = 0;
		//$sectionId=$input['fieldSection'];

		//return $request->all();
		$eventId= $input['eventId'];

		$formId = $input['formId'];

		$dataTypeControlId = DB::table('data_type_controls')
		                       ->where('control_id', $input['fieldControlType'])
		                       ->where('data_type_id', $input['fieldDataType'])
		                       ->pluck('id');


        if($input['fieldMaxLength']){
        	$maxL = $input['fieldMaxLength'];
        }
        $message = 'Se ha creado con éxito el campo';
		//return response()->json($input['fieldList']);
        DB::beginTransaction();
        try{

        	//Create new
        	if($input['actionId']==1){

				$nId=time();
				$field = new Field();
				$field->id = $nId;
				$field->fieldText = $input['fieldName'] ;
				$field->fieldRequired = $input['fieldRequired'] ;
				$field->fieldMaxLenght = $maxL;
				$field->fieldPlaceHolder = $input['fieldPlaceHolder'];
				$field->data_type_control_id = $dataTypeControlId[0];
				$field->save();

				if($input['fieldControlType'] == 2 || $input['fieldControlType'] == 3 || $input['fieldControlType'] == 4){

				/*	$oId = mt_rand();
					$fieldOption = new FieldOption();
					$fieldOption->id = $oId;
					$fieldOption->optionName = 1;
					$fieldOption->optionValue = $input['fieldPlaceHolder'];
					$fieldOption->field_id = $nId;
					$fieldOption->save();
			    */

					foreach ($input['fieldList'] as $list => $value) {
						$oId = mt_rand();
						$fieldOption = new FieldOption();
						$fieldOption->id = $oId;
						$fieldOption->optionName = $list;
						$fieldOption->optionValue = $value;
						$fieldOption->field_id = $nId;
						$fieldOption->save();
						
					}

				}

				/*Obtener el tipo de campo*/

				$fieldControlTypeName = DB::table('data_type_controls as dt')
				                   ->join('controls as c', 'c.id', 'dt.control_id')
				                   ->where('dt.id', $dataTypeControlId[0] )
				                   ->pluck('c.controlName');

				/*Obtener el tipo de dato*/

				$fieldDataTypeName = DB::table('data_type_controls as dt')
				                   ->join('data_types as dts', 'dts.id', 'dt.data_type_id')
				                   ->where('dt.id', $dataTypeControlId[0] )
				                   ->pluck('dts.dataTypeName');




				$formSectionId = DB::table('form_sections')->where('form_id', $formId)->pluck('id');


				$fId = mt_rand();
				$formSection = new FormSectionField();
				$formSection->id= $fId;
				$formSection->form_section_id = $formSectionId[0];
				$formSection->field_id = $nId;
				$formSection->fieldStatus = 1;
				$formSection->save();


				/*$fSecId = mt_rand();
				$fSection = new FormSection();
				$fSection->id= $fSecId;
				$fSection->form_id = $formId;
				$fSection->save();
				*/
				
				/*$eForm = new UserEventForm();
				$eForm->id = mt_rand();
				$eFrom->form_id = $formId;
				$eFrom->save();
				*/


				$result = ['status' => 'success', 'actionId' => $input['actionId'], 'message' => $message, 'Id' =>$nId, 'controlName' => $input['fieldName']   , 'controlTypeName' =>$fieldControlTypeName[0], 'maxlenght' => $maxL, 'dataTypeName' => $fieldDataTypeName[0]  ];
				
			}
			else if($input['actionId']==2){


				DB::table('fields')
	            ->where('id', $input['fieldId'])
	            ->update(['fieldText' => $input['fieldName'],
	            		  'fieldRequired' => $input['fieldRequired'],
	            		  'fieldMaxLenght' => $maxL,
	            		  'fieldPlaceHolder' => $input['fieldPlaceHolder'],
	            		  'data_type_control_id' => $dataTypeControlId[0],
	                     ]);

				$message = 'Se ha actualizado el campo con éxito!';

				$result = ['status' => 'success', 'actionId' => $input['actionId'], 'message' => $message , 'fieldName' => $input['fieldName'] ];
			}


			DB::commit();
			
		} catch (exception $e){
			DB::rollBack();
			$result = ['status' => 'error', 'message' => $e->getMessage()]; 
		}
		return json_encode($result);

	}



	/*
	** Actualizar estado del campo (habilitado 1, deshabilitado 2)
	*/
	public function changeFieldStatus(Request $request, $fieldId){


		//dd($fieldId);
		$message ="Se ha deshabilitado correctamente el campo seleccionado!.";


		try{
			//$input = $request->all();

			DB::table('form_section_fields')
	            ->where('field_id',  $fieldId)
	            ->update(['fieldStatus' => 0,
	                     ]);

	          

		} catch(exception $e){

			$message = $e->getMessage();

		}

		$result = ['status' => 'success', 'message' => $message  ];

		return json_encode($result);

	}


	/*
	* get data for edit field catalog
	*/

	public function getDataEditFieldCatalog(Request $request, $id){



//		return $request->eventId;
		try{
			$fieldData = Field::from('fields as F')
	                      ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
	                      ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
	                      ->join('forms as FO', 'FO.id', 'FS.form_id')
	                      ->join('event_forms as EF', 'EF.form_id', 'FO.id')
	                      ->join('data_type_controls as DTC', 'DTC.id', 'F.data_type_control_id')
	                      ->join('controls as C', 'C.id', 'DTC.control_id')
	                      ->join('data_types as DT', 'DT.id', 'DTC.data_type_id')
	                      ->where('EF.event_id', $request->eventId)
	                      ->where('FS.section_id', 1) //section Registro
	                      ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.fieldPlaceHolder as fieldPlaceHolder, F.fieldRequired as isRequired, F.fieldMaxLenght as fieldMaxLenght, F.data_type_control_id as CONTROLTYPE, C.controlName as CONTROLNAME, DT.id as dataTypeId, DT.dataTypeName as TYPENAME, C.id as controlId')])
	                      ->orderBy('FSF.fieldOrder', 'asc')
	                      ->where('F.id', $id)
	                      ->get(); 


	        $fieldOptions = null;
	        $multipleOptions = false;

	        if($fieldData[0]->controlId ==2){

	        	$fieldOptions =  DB::table('field_options')->where('field_id', $id)->select([\DB::raw('optionValue as value, optionName as name')]) ->get();
	        	$multipleOptions = true;
	        }


	        $dataFound = count($fieldData);

	        $data = ['status' => 'OK',
	        		 'found' => $dataFound,
	        		 'fieldId'=>$fieldData[0]->ID,
	                 'fieldControlId' => $fieldData[0]->controlId,
	                 'dataTypeId' =>  $fieldData[0]->dataTypeId,
	                 'fieldName' => $fieldData[0]->TAG,
	                 'fieldPlaceHolder' => $fieldData[0]->fieldPlaceHolder,
	                 'fieldRequired' => $fieldData[0]->isRequired,
	                 'fieldMaxLenght' => $fieldData[0]->fieldMaxLenght,
	                 'fieldOptions' => $fieldOptions,
	                 'multipleOptions' => $multipleOptions
	             ];
	    
	    } catch(exception $e){

	    	$data = ['status' => 'error',
	                 'message' => $e->getMessage()];
	    	

	    }

		return json_encode($data);

	}








	/*
	* store company catalog
	*/

	public function storeCompanyCatalog(Request $request, $evId){
		$input = $request->all();
		$result = array();
		$maxL = 0;
		$sectionId=7;
		$eventId= $input['eventId'];



		try{
		$dataTypeControlId = DB::table('data_type_controls')
		                       ->where('control_id', $input['fieldControlType'])
		                       ->where('data_type_id', $input['fieldDataType'])
		                       ->pluck('id');


        if($input['fieldMaxLength']){
        	$maxL = $input['fieldMaxLength'];
        }

        //return $input['fieldDataType'] . " " . $input['fieldControlType'];
		$nId=mt_rand();
		$field = new Field();
		$field->id = $nId;
		$field->fieldText = $input['fieldName'] ;
		$field->fieldRequired = $input['fieldRequired'] ;
		$field->fieldMaxLenght = $maxL;
		$field->fieldPlaceHolder = $input['fieldPlaceHolder'];
		$field->data_type_control_id = $dataTypeControlId[0];
		$field->save();

		if($input['fieldControlType'] == 2 || $input['fieldControlType'] == 3 || $input['fieldControlType'] == 4){

		/*	$oId = mt_rand();
			$fieldOption = new FieldOption();
			$fieldOption->id = $oId;
			$fieldOption->optionName = 1;
			$fieldOption->optionValue = $input['fieldPlaceHolder'];
			$fieldOption->field_id = $nId;
			$fieldOption->save();
	    */

			foreach ($input['fieldList'] as $list => $value) {
				$oId = mt_rand();
				$fieldOption = new FieldOption();
				$fieldOption->id = $oId;
				$fieldOption->optionName = $list;
				$fieldOption->optionValue = $value;
				$fieldOption->field_id = $nId;
				$fieldOption->save();
				
			}

		}

		$fId = mt_rand();
		$formSection = new FormSectionField();
		$formSection->id= $fId;
		$formSection->form_section_id = $sectionId;
		$formSection->field_id = $nId;
		$formSection->save();

        /*
		$eventFormId = mt_rand();
		$eventForm = new EventForm();
		$eventForm->id = $eventFormId;
		$eventForm->event_id =$input['eventId'] ;
		$eventForm->form_id = 7;
		$eventForm->save(); */

		$companyUpdates = Company::where('event_id', $input['eventId'])->update(['event_form_id'=>7]);



		$result = ['status' => 'success', 'message' => 'Se ha creado con éxito el campo' , 'fieldName' => $input['fieldName'], 'Empresas Actualizadas' => $companyUpdates ];
		
		} catch(exception $e){
		$result = ['status' => 'error', 'message' => $e->getMessage()];	
		}	 
		return  response()->json($result);
	}


}
