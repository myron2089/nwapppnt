<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use DB;
use App\Product;
use App\User;
use Image;

class ProductController extends Controller
{
    
	
	/*
	* get view for products admin
 	*/
    public function getProductsView($evId){



    	// Check roles to show/not show products
    	

    	$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $evId)->pluck('UE.user_type_id');





    	$products = DB::table('products as P')->where('P.event_id', $evId)
                       ->where('UE.event_id', $evId)
                       ->join('payment_currencies as CR', 'CR.id', 'P.payment_currency_id')
                       ->join('users as U', 'U.id', 'P.user_id')
                       ->join('user_events as UE', 'UE.user_id', 'U.id')
                       ->leftJoin('companies as C', 'C.id', 'UE.company_id')
                       ->leftJoin('brands as B', 'B.id', 'P.brand_id')
                       ->select([\DB::raw('P.id as PRODUCTID, P.productName as productName, P.productDescription as productDescription, P.productPrice as productPrice, CR.currencySymbol as currencySymbol, P.productPicturePath AS productPicturePath, P.productPicture AS productPicture, CONCAT(U.userFirstName, " ", U.userLastName) as USER, IF(C.companyName is not null,C.companyName, "Sin Especificar") as COMPANY, IF(B.brandName is not null, B.brandName, "Sin Especificar") as BRAND')]);
                       


       //dd($products->get());

    	 //Mostrar los productos segun el tipo de  ususario logueado

    	//Super y Full Admin
        if($roleAuth[0] == 1  || $roleAuth[0] == 2 || $userEventRoleAuth[0] ==1){

            $products = $products->get();
        }
        //basico
        else if($roleAuth[0] == 3){

        	//Sub Admin Speaker o vendedor 
            if($userEventRoleAuth[0] == 3 || $userEventRoleAuth[0] == 4  || $userEventRoleAuth[0] == 2){

                $products = $products->where('P.user_id', Auth::user()->id)->get();
            }

            
        }


      //  dd(($userEventRoleAuth[0]  . '   ' . $roleAuth[0]));

       // dd($products);
    	$brands = DB::table('brands')->where('event_id', $evId)->orderBy('brandName','asc')->get();
    	$currencies = DB::table('payment_currencies')->orderBy('id', 'asc')->get();
    	
    	return view('backend.admin.products.products-admin', ['currencies' => $currencies,
     														  'products'   => $products,
     														  'brands'	   => $brands,
     														  'eventId'	   => $evId
     														]);
    }

    /*
    * Store product
    */

    public function storeProduct(Request $data){
    	//$imgurl = 'images/events/webpage/products/noProductPicture.png';
		$filename="noProductPicture.png";
		$picture_path = "images/events/webpage/products/";
        $imgurl = url($picture_path . $filename);
        $imageChanged = 0;

		try{
			 $currencySymbol = DB::table('payment_currencies')->where('id', $data['productCurrency'])->pluck('currencySymbol');

             $pId = mt_rand();
             $userId = Auth::user()->id;

                $picture_path = 'images/events/webpage/products/';
                if ($data->hasFile('productPicture')) {
                    $imageFile = $data->file('productPicture');
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = $pId . '.' . $extension;
                  
                    //$result = $imageFile->move($picture_path, $filename);
                    
                    $imgurl = public_path($picture_path .'/' . $filename);
                    $image = Image::make($imageFile->getRealPath());
                    $image->save($imgurl);

                    $imgurl = url($picture_path . $filename);
                    $imageChanged = 1;
                }


            $userData = User::where('id', $userId)->get();

            $userName = $userData[0]->userFirstName . ' ' . $userData[0]->userLastName; 
                
            $companyData = DB::table('companies as C')
                              ->join('user_events as UE', 'UE.company_id', 'C.id')
                              ->where('UE.event_id', $data['eventId'])
                              ->where('UE.user_id', $userId)
                              ->pluck('C.companyName');

            if($companyData->count() <= 0){
                $companyData = 'Sin Especificar';
            }


            $brandName = DB::table('brands')->where('id', $data['productBrand'])->pluck('brandName');
            if($brandName->count() <= 0){
                $brandName = 'Sin Especificar';
            }

            // action 1 = create
            if($data['action'] == 1){

    			
               

    			
    			$product = new Product();
    			$product->id = $pId;
    			$product->productName = $data['productName'];
    			$product->productDescription = $data['productDescription'];
    			$product->productPicture = $filename;
    			$product->productPicturePath = $picture_path;
    			$product->productPrice = $data['productPrice'];
    			$product->event_id = $data['eventId'];
    			$product->user_id = Auth::user()->id;
    			$product->payment_currency_id = $data['productCurrency'];
    			$product->brand_id = $data['productBrand'];

    			$product->save();


               

    			$result =['status'	=>'success', 
    					  'messsage' => 'El producto se registró con éxito.' ,
    					  'pId' 	=> $pId,
    					  'pPicture'=> $imgurl, 
    			          'pName' 	=> $data['productName'],
    			          'pDescription' => $data['productDescription'],
    			          'pPrice' 	=> $currencySymbol[0]. ' '. $data['productPrice'],
                          'userName' => $userName,
                          'companyName' => $companyData,
                          'brandName' => $brandName
                      ];


            }
            else if($data['action'] ==2){

                $productPreviousData = Product::where('id', $data['productId'])->get();

                //if image changed, change filename, else, leave same productPicutre from $productPreviousData
                if($imageChanged == 0){

                    $filename = $productPreviousData[0]->productPicture;
                    $imgurl = url($picture_path . $filename);


                }

                $productEdit = Product::where('id', $data['productId'])
                                      ->update(['productName' => $data['productName'], 'productDescription' => $data['productDescription'], 'productPicture' => $filename, 'productPrice' => $data['productPrice'], 'payment_currency_id' => $data['productCurrency'], 'brand_id' => $data['productBrand']  ]);



                    $result =['status'  =>'success', 
                          'messsage' => 'El producto se actualizó con éxito.' ,
                          'pPicture'=> $imgurl, 
                          'pName'   => $data['productName'],
                          'pDescription' => $data['productDescription'],
                          'pPrice'  => $currencySymbol[0]. ' '. $data['productPrice'],
                          'productEdit' => $productEdit,
                          'imageChanged' => $imageChanged,
                          'userName' => $userName,
                          'companyName' => $companyData,
                          'brandName' => $brandName
                    ];

            }

		}catch(exception $e){
			$result =['status'=>'error', 'messsage' => $e->getMessage()];
		}

    	
    	return json_encode($result);
    }


    /*
    * Get data for edit
    */

    public function getProductsEditData($pId){



    	$product = Product::where('id', $pId)->get();


//        return $pId;

    	$pName = $product[0]->productName;
    	$pDescription = $product[0]->productDescription;
    	$pId = $product[0]->id;
    	$pPicture = $product[0]->productPicturePath . $product[0]->productPicture;
    	$pPrice = $product[0]->productPrice;
    	$pCurrency = $product[0]->payment_currency_id;
        $pBrand = $product[0]->brand_id;    


    	$result =['status'	=>'success', 
					  'pId' 	=> $pId,
					  'pPicture'=> $pPicture, 
			          'pName' 	=> $pName,
			          'pDescription' => $pDescription,
			          'pPrice' 	=> $pPrice,
			      	  'pCurrency' => $pCurrency,
                      'pBrand' => $pBrand];
 	
 		return json_encode($result);
    }


    /*
    * Delete Product
    */

    public function deleteProduct($pId){


    	try{


            //get the offers of products for delete before
/*
            $salesId = DB::table('sales')->where('product_id', $pId)->lists('id');
            $scanSales = DB::table('scan_user_sales')->whereIn('scanSaleDestination', $salesId)->delete(); */

            $sales = DB::table('sales')->where('product_id', $pId)->delete();
            
            $scanProduct = DB::table('scan_user_products')->where('scanProductDestination', $pId)->delete();

    		Product::where('id', $pId)->delete();



    	}catch(exception $e){
    		$result =['status'	=>'error', 
					  'messsage' => $e->getMessage()];

    	}

    	$result =['status'	=>'success', 
					  'messsage' => 'El producto se eliminó con éxito.' ,
					  'pId' 	=> $pId ];
	    return json_encode($result);
    }
}
