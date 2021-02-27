<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Town;
class TownController extends Controller
{
    //
	/*
	* Get town by state id
	*/
    public function getTownByState($stateId, Request $request){

    	try{
    		$towns = Town::where('country_state_id', $stateId)
    	             //->select('id as ID', 'townName as TOWN')
                      ->select([\DB::raw('id as ID, LOWER(townName) as TOWN')])
    	             ->orderBy('townName', 'asc')
    	             ->get();



    	    $result = ['status' => 'success', 'towns' => $towns, 'id' => $stateId];
    	} catch(exception $e){

    		$result = ['status' => 'error', 'message' => $e->getMessage()];
    	}

    	return json_encode($result);


    }
}
