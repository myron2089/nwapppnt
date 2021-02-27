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
use App\Brand;

class BrandController extends Controller
{
    //


	/*
	* Vista para las marcas
	*/
    public function getBrandsView($evId){


    	// Check roles to show/not show products
    	
    	$brands = Brand::where('event_id', $evId)->orderBy('brandName', 'asc')->get();

    	$eventId = $evId;



      	return view('backend.admin.brands.brands-admin', [
      		'brands' => $brands,
      		'eventId' => $eventId,

      	]);
    }

    /*
    * store brand
    */

    public function storeBrand(Request $request){

    	
    	try{

    		//Create
    		if($request['action']==1){
    			$brandId = mt_rand();

    			$brand = new Brand();
    			$brand->id = $brandId;
    			$brand->brandName = $request['brandName'];
    			$brand->brandDescription = $request['brandDescription'];
    			$brand->event_id = $request['eventId'];
    			$brand->save();

    			$result = ['status' => 'success', 'message' => 'Se ha registrado correctamente la marca!', 'bId' => $brandId, 'bName' => $request['brandName'], 'bDesc' => $request['brandDescription'] ];


    		} 
    		//Update 
    		else if ($request['action']==2){

    			$brand = Brand::where('id', $request['brandId'])
                            ->update(['brandName' => $request['brandName'], 'brandDescription' => $request['brandDescription'] ]);


    			$result = ['status' => 'success', 'message' => 'Se ha actualizado correctamente la marca!', 'bId' => $request['brandId'], 'bName' => $request['brandName'], 'bDesc' => $request['brandDescription'] ];

    		}



    	} catch(exception $e){

    		$result = ['status' => 'error', 'message' => $e->getMessage()];

    	}

    	return json_encode($result);

    }


    public function getBrandEditData($bId){

    	$brandData = Brand::where('id', $bId)->get();
    	$countBrand = count($brandData);

    	if($countBrand > 0)
    	{
    		$message = 'Se encontró la marca';
    	}
    	else{
    		$message = 'No se ha encontrado la marca';
    	}


    	$result = ['status' => 'success', 'message' => $message, 'bId' => $brandData[0]->id, 'bName' => $brandData[0]->brandName, 'bDesc'=> $brandData[0]->brandDescription];


    	return json_encode($result);

    }

    /*
    * delete brand
    */

    public function deleteBrand($bId){

    	try{
            $deletedRows = Brand::where('id', $bId)->delete();
            $result = ['status' => 'success', 'message' => 'Se ha eliminado la marca con éxito!'];
        } catch(exception $e){
            $result =['status'=>'error', 'messsage' => $e->getMessage()]; 
        }
        return response()->json($result);


    }

    /*
    ** Get brands by Event
    */

    public function getBrandByEvent(Request $request, $eventId){

        $term = $request->term ?: '';

        $brands = Brand::where('event_id', $eventId)->where('brandName', 'like', '%'. $term.'%')->select('id as id', 'brandName as text')->get();

        return response()->json($brands);

    }



}
