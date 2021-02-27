<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventType;
use App\Permission;
use App\EventWebResource;
use App\User;
use File;
use DB;
use Image;

class PageController extends Controller
{
    //


    public $result = array();


    public function getCreatePageView($evId){


        $subtitle="";
        $description="";
        $about="";
        $flink="";
        $tlink="";
        $wslink="";
        $phone="";
        $mail="";
    	//Get event types
    	$types = EventType::orderBy('eventTypeName', 'asc')
               ->get();


        $elements = array(7,8,11);
        $pagedata = DB::table('event_web_resources as WR')
                      ->where('WR.event_id', $evId)
                      ->whereNotin('WR.event_web_resource_element_id', $elements)
                      ->select([\DB::raw('CASE WHEN WR.event_web_resource_element_id IS NOT NULL and WR.event_web_resource_element_id in (2,3,4,5,6,9,10,12)
                                               THEN (SELECT WR.eventWebResourceValue)
                                               WHEN WR.event_web_resource_element_id IS NULL and WR.event_web_resource_element_id in (2,3,4,5,6,9,10,12)
                                               THEN (SELECT "")
                                          END AS VALUE,
                                          CASE
                                            WHEN WR.event_web_resource_element_id = 2
                                            THEN (Select "eventSubTitle")
                                            WHEN WR.event_web_resource_element_id = 3
                                            THEN (Select "eventDescription")
                                            WHEN WR.event_web_resource_element_id = 4
                                            THEN (Select "eventAboutUs")
                                            WHEN WR.event_web_resource_element_id = 5
                                            THEN (Select "eventFacebookLink")
                                            WHEN WR.event_web_resource_element_id = 6
                                            THEN (Select "eventTwiterLink")
                                            WHEN WR.event_web_resource_element_id = 9
                                            THEN (Select "eventWebSite")
                                            WHEN WR.event_web_resource_element_id = 10
                                            THEN (Select "eventPhoneNumber")
                                            WHEN WR.event_web_resource_element_id = 12
                                            THEN (Select "eventEmail")
                                        END AS ELEMENT
                                            ')])->orderBy('WR.event_web_resource_element_id', 'asc')->get();

                      // dd($pagedata);
        $count = count($pagedata);
                       
        if($count > 0){


            foreach ($pagedata as $key) {
                //dd($key->VALUE);

                if($key->ELEMENT == "eventSubTitle")
                $subtitle=$key->VALUE;

                if($key->ELEMENT == "eventDescription")
                    $description=$key->VALUE;
                
                if($key->ELEMENT == "eventAboutUs")
                    $about=$key->VALUE;
                
                if($key->ELEMENT == "eventFacebookLink")
                    $flink=$key->VALUE;
                
                if($key->ELEMENT == "eventTwiterLink")
                    $tlink=$key->VALUE;
                
                if($key->ELEMENT == "eventWebSite")
                    $wslink=$key->VALUE;
                
                if($key->ELEMENT == "eventPhoneNumber")
                    $phone=$key->VALUE;

                if($key->ELEMENT == "eventEmail")
                    $mail=$key->VALUE;
            }




            

          

        }

        //dd($phone);

        // Images 

        $bannerimages =  DB::table('event_web_resources as WR')
                      ->where('WR.event_id', $evId)
                      ->select([\DB::raw('CONCAT( WR.eventWebResourcePath, WR.eventWebResourceValue) as PATH, WR.id as ID')])
                      ->whereIn('WR.event_web_resource_element_id',  array(7))
                      ->orderBy('WR.event_web_resource_element_id', 'asc')->get();

        $galleryimages =  DB::table('event_web_resources as WR')
                      ->where('WR.event_id', $evId)
                      ->select([\DB::raw('CONCAT( WR.eventWebResourcePath, WR.eventWebResourceValue) as PATH, WR.id as ID')])
                      ->whereIn('WR.event_web_resource_element_id',  array(8))
                      ->orderBy('WR.event_web_resource_element_id', 'asc')->get();


        //Imagen de registro
        $registerFormImage = 'images/events/register_forms/no_register_image.jpg';

        $formImage = DB::table('event_web_resources as WR')
                      ->where('WR.event_id', $evId)
                      ->select([\DB::raw('CONCAT( WR.eventWebResourcePath, "/", WR.eventWebResourceValue) as PATH, WR.id as ID')])
                      ->whereIn('WR.event_web_resource_element_id',  array(13))
                      ->orderBy('WR.event_web_resource_element_id', 'asc')->get();

        if(count($formImage) > 0){
            $registerFormImage = $formImage[0]->PATH;
        }

        //dd($formImage[0]);

    	return view('backend.admin.pages.create-page', ['eventTypes' => $types, 'eventId'=> $evId,
                                                        'subtitle' => $subtitle,
                                                        'description' => $description,
                                                        'about' => $about,
                                                        'phone' => $phone,
                                                        'mail' => $mail,
                                                        'flink' => $flink,
                                                        'tlink' => $tlink,
                                                        'wslink' => $wslink,
                                                        'bannerimgs' => $bannerimages,
                                                        'galleryimgs' => $galleryimages,
                                                        'registerFormImage' => $registerFormImage
                                                    ]);
    }

    /*
	* Store page
    */

    public function storePage(Request $request)
    {

        $action = 1; //  1 create, 2 edit
        
        try{
            $rpos =1; //pos 1 = banner
            $rord =1;
            foreach ($request->input() as $key => $value) {

                switch ($key) {
                    case 'eventSubTitle':
                          $rpos= 2;
                          $rord = 2;
                        break;

                    case 'eventDescription':
                         $rpos= 2;
                         $rord = 3;
                    break;

                    case 'eventAboutUs':
                         $rpos= 3;
                         $rord = 1;
                    break;

                    case 'eventFacebookLink':
                         $rpos= 4;
                         $rord = 1;
                    break;

                    case 'eventTwiterLink':
                         $rpos= 4;
                         $rord = 2;
                    break;

                    case 'eventWebLink':
                         $rpos = 4;
                         $rord = 3;
                    break;

                    case 'eventPhoneNumber':
                         $rpos = 4;
                         $rord = 4;
                    break;   

                    case 'eventEmail':
                         $rpos = 4;
                         $rord = 5;
                    break;                    
                }
               
                if($key != '_token' && $key != 'evId' && $value != null)
                {
                    // get id from web elements

                    $weId = DB::table('event_web_resource_elements')->where('eventWebResourceElementName', $key)->pluck('id');

                    /* check if exists*/
                    $check = EventWebResource::where('event_web_resource_element_id', $weId[0])
                                             ->where('event_id', $request->input('evId') )
                                             ->pluck('id');

                    

                    if(count($check) <= 0){
                        $evResId = mt_rand();
                        $evRes = new EventWebResource();
                        $evRes->id = $evResId;
                        $evRes->event_id = $request->input('evId');
                        $evRes->event_web_resource_element_id = $weId[0];
                        $evRes->eventWebResourceValue = $value;
                        $evRes->eventWebResourcePosition = $rpos;
                        $evRes->eventWebResourceOrder = $rord;
                     
                        $evRes->save();

                        $message = 'Se ha guardado la página con éxito';
                    
                    }
                    else{
                        EventWebResource::where('event_id', $request->input('evId'))
                                        ->where('event_web_resource_element_id', $weId[0])
                                        ->update(['eventWebResourceValue' => $value]);
                        $action = 2;
                        $message = 'Se ha actualizado la información de la página con éxito';
                    }
                }
               
            }
             $result = ['status' => 'success', 'message' => $message, 'action' => $action];

        } catch(exception $e){
            $result = ['status' => 'error', 'message' => $e->getMessage()];

        }

    	return json_encode($result);
    }



    /*
    * delete banner and gallery images
    */

    public function deletePageImages($imgId, $ubication){

        $base_directory="";
        try{
            if($ubication==1){
                $base_directory = 'images/events/webpage/banner/';
            }
            if($ubication==2){
                $base_directory = 'images/events/webpage/gallery/';
            }

            //get image name
            $image = DB::table('event_web_resources')->where('id', $imgId)->pluck('eventWebResourceValue');

            $delete = DB::table('event_web_resources')->where('id', $imgId)->delete();
            unlink($base_directory.$image[0]);
            $result = ['status' => 'success', 'message' => 'La imagen se eliminó con éxito'];

        }catch(exception $e){
             $result = ['status' => 'error', 'message' => $e->getMessage()];
        }

       
        return json_encode($result);
    }




    /*Pagina para administrar los usuarios del evento*/
    public function getAdminEventUsersPageView(){

    	$permissions = Permission::orderBy('permissionName', 'asc')->get();
    	$userAsigned = User::orderBy('created_at', 'asc')->get();

        

    	return view('backend.expositor.users-admin', ['userAsigned'=> $userAsigned, 'permissions' => $permissions]);
    }

    /*
    * Store gallery and banner images (multiple from dropzone) ubication  1 banner, 2 gallery
    */

    public function storeGalleryImages(Request $request, $evId, $ubication){
        

        if($request->hasFile('file')){
            $imgpath="";
            $elementId=7;
            if($ubication==1){
                $imgpath ='images/events/webpage/banner/';
                $elementId=7;
            }
            else{
                $elementId=8;
                $imgpath ='images/events/webpage/gallery/';
            }

            try{
                $imageFile = $request->file('file');
                $extension = $imageFile->getClientOriginalExtension();
                $filename = mt_rand() . '.' . $extension;
                $result = $imageFile->move($imgpath, $filename);

                $imgurl = url($imgpath . $filename);

                    $evResId = mt_rand();
                    $evRes = new EventWebResource();
                    $evRes->id = $evResId;
                    $evRes->event_id = $evId;
                    $evRes->event_web_resource_element_id = $elementId;
                    $evRes->eventWebResourceValue = $filename;
                    $evRes->eventWebResourcePath = $imgpath;
                    $evRes->eventWebResourcePosition = 5;
                    $evRes->eventWebResourceOrder = 1;
                    $evRes->save();


                return response()->json(['status'=> 'success', 'msg'=>'Se ha guardado la imagen con éxito', 'imgsrc'=> $imgurl, 'imgId' => $evResId]);
                } catch(exception $ex)
                {
                    return ($ex->getMessage);
                }  
            
            
        }

    }

    public function storeFormImage(Request $data, $eventId){

        //return json_encode($data);
        try{
            $picture_path = 'images/events/register_forms';
            if ($data->hasFile('companyLogo')) {
            $picId = mt_rand();
            $imageFile = $data->file('companyLogo');
            $extension = $imageFile->getClientOriginalExtension();
            $filename = $picId . '.' .$extension;
              
            //$result = $imageFile->move($picture_path, $filename);
                
            $imgurl = public_path($picture_path .'/' . $filename);
            $image = Image::make($imageFile->getRealPath());
            $image->save($imgurl);

            $pictureChanged = 1;

            $checkExists = DB::table('event_web_resources as WR')
                      ->where('WR.event_id', $eventId)
                      ->whereIn('WR.event_web_resource_element_id',  array(13))
                      ->get();

            
            if(count($checkExists) <= 0){
                $evResId = mt_rand();
                $evRes = new EventWebResource();
                $evRes->id = $evResId;
                $evRes->event_id = $eventId;
                $evRes->event_web_resource_element_id = 13;
                $evRes->eventWebResourceValue = $filename;
                $evRes->eventWebResourcePosition = 13;
                $evRes->eventWebResourcePath = $picture_path;
                $evRes->eventWebResourceOrder = 13;
             
                $evRes->save();

               
            
            }
            else{
                EventWebResource::where('event_id', $eventId)
                    ->where('event_web_resource_element_id', 13)
                    ->update(['eventWebResourceValue' => $filename]);
                
            }


         }


            return response()->json(['status'=> 'success', 'msg'=>'Se ha actualizado la imagen de registro con éxito']);

        }catch(exception $e){

            return response()->json(['status'=> 'erro', 'msg'=>$e->getMessage ]);
        }

        return json_encode($eventId);
    }


}
