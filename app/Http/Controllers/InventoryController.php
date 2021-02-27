<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Event;
use App\User;
use Auth;
use App\Http\Controllers\FieldTemplateController;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\FormSection;
use App\Inventory;
use App\Company;

class InventoryController extends Controller
{
    //


	/*
	* Vista para los inventarios por evento
	*/
    public function getInventoriesView($evId){
      $companies = Company::where('event_id', $evId)->get();
      return view('backend.admin.inventories.inventories-admin', ['companies' => $companies, 'eventId' => $evId]);
    } 

}
