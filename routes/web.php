<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('home');
});
*/



Route::get('usereventdetail/{id}','UserEventDetailController@show');


//Route::get('/', 'VisitorController@getEventUpcomingView')->name('upcoming-events');
//--------------------------------  PUBLIC ROUTES -----------------------------------------------------
Route::resource('report','ReportController');


Route::get('error/{errorCode}','HomeController@getErrorView');

// Home page events
Route::get('/', 'HomeController@getHomePageView')->name('home-page');
// Events calendar
Route::get('/eventos/calendario', 'HomeController@getCalendarPageView')->name('calendar-page');



//Events Products
Route::get('/eventos/{evType}/{evUrl}/productos/{productId}', 'VisitorController@getEventProductView')->name('product-page');




// Events categories
Route::get('/eventos/categorias/{category}', 'HomeController@getEventCategories')->name('categories-page');



Route::get('/s', 'HomeController@getVisitorRegisterView');
Route::get('login', 'LoginController@showLoginForm');

//Contact Page
Route::get('contacto', 'HomeController@getContactPageView');
Route::post('send-contact-email', 'HomeController@sendContactEmail')->name('send.contact.email');


//Politics Page
Route::get('politica-de-privacidad', 'HomeController@getTermsPoliticsPageView');

Route::get('visitor/home', 'HomeController@getHomeView')->name('visitor-home');
Route::get('home', 'HomeController@getHomeView')->name('visitor-home');

Route::any('visitor/register' ,'HomeController@getVisitorRegisterView');


/*
Route::any('registro', function(){
	return redirect('eventos/guate_tur_2018/registro/nuevo');
}
)->name('registro'); */

Route::any('registroguatetur', function(){
	return redirect('eventos/guate_tur_2018/registro/nuevo');
}
);

Route::get('usuarios/registro', 'HomeController@getUserRegisterForEvent')->name('user-registration');

Route::get('visitantes/registro', 'HomeController@getUserRegisterNoEvent')->name('visitor-registration');



//Nuevo registro de visitants user_exists para un usuario que ya se encuentra logueado 1
Route::get('eventos/{evUrl}/registro/{user_exists}','HomeController@getVisitorRegisterView')->name('registro-visitantes');




	
	//guardar datos del usuario de campos dinámicos

	Route::post('events/save-data-fields','VisitorController@updateEventUserData')->name('registro-campos');


Route::get('registrado/{qr}' , 'HomeController@registeredStatus')->name('registrado');
Route::get('registro/generar-qr', 'HomeController@dowloadVisitorQr');


// Get towns by state id
Route::get('register/get-towns/{stateId}','TownController@getTownByState')->name('get-towns');


// Password Reset(via email)
Route::get('mi-cuenta/reestablecer-contrasena', ['as' => 'password.reset', 'uses' => 'HomeController@getPasswordResetView']);
Route::post('mi-cuenta/reestablecer-contrasena', 'HomeController@updateVisitorPassword')->name('update-visitor-password');

/////Nuevo

Route::get('restablecer-contrasena', 'ForgotPasswordController@getForgotPasswordView')->name('password.email.view');
Route::post('restablecer-contrasena', 'ForgotPasswordController@postForgotPassword')->name('password.email.reset');
	

//event suggestions after visitor registration

Route::get('events/upcoming', 'VisitorController@getEventUpcomingView')->name('upcoming-events');

// Mostrar evento en específico (parte visitante)

Route::get('eventos/{evType}/{evUrl}', 'VisitorController@getSpecificEventView')->name('show-event');



//Agregar actividades a favoritos
Route::post('sessions/add-favorite', 'SessionController@sessionAddFavorite')->name('add-session-favorite');

//Register user from public page (Patrocinador/sponsor)
Route::get('/public/sponsor/register', 'SponsorController@getRegisterView')->name('sponsor-register');
Route::post('/public/sponsor/register', 'SponsorController@sponsorStore')->name('sponsor-store');

Route::post('/public/sponsor/login', 'SponsorController@sponsorLogin')->name('sponsor-login');


//Create event from visitor page



//FULL ADMIN ROUTES

Auth::routes();

/* RUTAS PARA EL VISITANTE */
	//Pefil Principal

	
	Route::get('visitantes/perfil', 'VisitorController@getProfileView');
		
		Route::get('/eventos', 'VisitorController@getVisitorEvents');
		Route::get('visitantes/mi-perfil', 'VisitorController@getProfileView');




	Route::get('/perfil', 'AdminController@getMyProfileView')->name('my-profile');
	Route::get('/cuenta', 'AdminController@getAccountView');
	Route::post('admin/user/profile/update', 'AdminController@updateMyProfileData')->name('update-profile');
	Route::post('admin/users/changepassword', 'AdminController@updateMyPassword')->name('update-password');



	//Mis eventos
	Route::get('visitor/myevents', 'VisitorController@getMyEventsView');


Route::group(['middleware' => 'auth'], function () {

//PRINT USER INFO FROM QR

Route::get('/badge/events');
Route::get('/badge/events/list', 'AdminController@getEventsForBadgeView');
Route::get('/admin/events/codescan/{id}' , 'AdminController@getCodeScanView');	

Route::post('/admin/events/codescan/getScannedData/{code}/{evId}' , 'AdminController@getDataScanned')->name('scanned-data');	

//THIS URL IS FOR ALL USERS
Route::get('/all/mail/{evId}', 'AdminController@getMailView')->name('all-mail');

Route::post('email/send', 'AdminController@sendEmail')->name('email-send');
Route::delete('admin/email/delete/{mailId}', 'AdminController@deleteEmail')->name('email-delete');


Route::get('admin/events/getUserFromEvent', 'EventController@getUsersFromEvent');


Route::get('/expositor/admin/products', 'AdminController@getProductView')->name('admin-products');
// EXPOSITOR SIDE
Route::get('/expositor/main', 'ExpositorController@index')->name('home-expositor');

// EXPOSITOR > EVENTS
Route::get('/administracion/eventos/crear_nuevo', 'EventController@getCreateEventView')->name('create-event');

//Check event name
Route::post('/admin/events/checkeventname', 'EventController@checkEventName')->name('event-check');
Route::post('/admin/events/store', 'EventController@storeEvent')->name('event-store');

Route::get('/administracion/eventos', 'EventController@getEventListView')->name('sponsor-events');

/*Administracion avanzada de eventos*/
Route::get('/administracion/eventos/avanzado', 'EventController@getEventAdvancedListView')->name('advanced-admin-events');
 /*Datatable de eventos*/
 Route::post('event/status/change', 'EventController@changeEventStatus')->name('change-event-status');

 /*Cambiar el estado para la administracion del evento activo inactivo*/
  Route::post('event/adminstatus/change', 'EventController@changeEventAdminStatus')->name('change-event-status');


   Route::post('/expositor/events/check-event/{id}', 'ExpositorController@displayEventView')->name('display-event2');
	Route::get('/administracion/eventos/{id}', 'SponsorController@displayEventView')->name('display-event');


//Eventos de Visitantes
Route::get('/visitantes/mis-eventos', 'VisitorController@getEventListView')->name('visitor-events');


	Route::get('/expositor/events/check', 'ExpositorController@getEventView')->name('event-expositor');
//USER ADMIN FOR EXPOSITORS
Route::get('sponsor/admin/users/{evId}', 'EventController@getAdminEventUsersPageView');
//GET USERS BY NAME, PHONE NUMBER OR EMAIL
Route::get('/admin/users/assearch','UserController@searchUser'); 

	Route::post('admin/events/user/store', 'EventController@userStore')->name('event-user-store');
	Route::post('admin/events/user/asign', 'EventController@userEventAssign')->name('event-user-assign');

	Route::get('expositor/admin/users/edit/{uId}', ['as' => 'expositor-user-edit',
								  				    'uses' => 'ExpositorController@getUserEditData']);

	Route::delete('expositor/admin/users/delete/{uId}', 'ExpositorController@userDelete')->name('exposito-user-delete');
	
//MY BADGE

Route::post('admininstracion/mi-gafete', 'UserController@getMyBadgeView')->name('my-badge-view');

	  Route::post('users/my-badge/store', 'UserController@storeMyBadge');

	  //Actualizar imagen de my badge
	  Route::post('users/my-badge/update-avatar', 'UserController@updateBagdeAvatar')->name('update-badge-avatar');


//BADGE FOR ALL USERS
Route::post('administracion/usuarios/gafete', 'UserController@getMyBadgeView')->name('users-my-badge-view');
	  


//SPECIAL INVITATIONS FOR EMAILS
//Configurar la invitacion
Route::post('admininstracion/eventos/invitaciones/configurar', 'InvitationController@configInvitationView')->name('config-invitation');
	Route::post('admininstracion/eventos/invitaciones/guardar/{evId}', 'InvitationController@storeInvitationTemplate')->name('store-invitation-template');

Route::post('admininstracion/eventos/invitaciones', 'InvitationController@getInvitationView')->name('send-invitations');
	Route::post('admin/invitations/store', 'InvitationController@storeInvitation')->name('store-invitations');

	//TICKET RECEPTION
	Route::any('admininstracion/eventos/invitaciones/recepcion', 'InvitationController@searchTicketsForRecept')->name('ticket-reception');
	//Change ticket status to received
	Route::post('admin/tickets/change-status', 'InvitationController@changeTicketStatus')->name('change-ticket-status');

//ADMINISTRACION DE SCANS
Route::any('administracion/scans/usuarios', 'ScanController@getUsersScansView')->name('users-scans-view');
	//OBTENER LOS SCANS REALIZADOS A USUARIOS
	Route::get('scans/users/get-performed-scans/{eventId}', 'ScanController@getPerformedUsersScans')->name('get-performed-users-scans');

	//OBTENER LOS SCANS RECIBIDOS DE USUARIOS
	Route::get('scans/users/get-received-scans/{eventId}', 'ScanController@getReceivedUsersScans')->name('get-received-users-scans');




Route::any('administracion/scans/empresas', 'ScanController@getCompaniesScansView')->name('companies-scans-view');
	Route::get('scans/companies/get-performed-scans/{eventId}', 'ScanController@getPerformedCompaniesScans')->name('get-performed-companies-scans');

Route::any('administracion/scans/productos', 'ScanController@getProductsScansView')->name('products-scans-view');
	Route::get('scans/products/get-performed-scans/{eventId}', 'ScanController@getPerformedProductsScans')->name('get-performed-products-scans');

//Scans de ofertas
Route::any('administracion/scans/ofertas', 'ScanController@getSalesScansView')->name('sales-scans-view');
	Route::get('scans/offers/get-received-scans/{eventId}/{permission}/{scansFilter}', 'ScanController@getReceivedSalesScans')->name('get-performed-products-scans');



	//Generar pdf scans
		//Usuarios
		Route::get('scans/users/get-report-scans/{eventId}/{userId}/{scanType}', 'ScanController@getScanUsersPdfReport')->name('get-users-scans-report');

		// Empresas
		Route::get('scans/companies/get-report-scans/{eventId}/{companyId}/{scanType}', 'ScanController@getScanUserCompaniesPdfReport')->name('get-companies-scans-report');

		//Reporte pdf de productos 
		Route::get('scans/products/get-report-scans/{eventId}/{companyId}/{scanType}', 'ScanController@getScanUserProductsPdfReport')->name('get-products-scans-report');

		//Reporte pdf de productos 
		Route::get('scans/sales/get-report-scans/{eventId}/{saleId}/{scanType}/{scansFilter}', 'ScanController@getScanUserSalesPdfReport')->name('get-sales-scans-report');

		//
 

//Obtener datos de empresa via ajax
	//Route::get('companies/get-companies-data/{eventId}', 'CompanyController@getCompaniesByEvent')->name('get-event-companies');

	Route::get('companies/get-companies-data/{eventId}', 'CompanyController@getCompaniesScansByEvent')->name('get-event-companies');
	



// FIN ADMINISTRACION DE SCANS //



// ADMINISTRACION DE HORARIOS (SESIONES)
	Route::get('admin/event/session/{evId}', 'SessionController@getSessionView')->name('schedule-view');
		Route::post('admin/event/session/store', 'SessionController@sessionStore')->name('store-schedule');
		Route::delete('admin/event/session/delete/{sId}', 'SessionController@sessionDelete')->name('delete-session');
		//Get data for edit session
		Route::get('admin/event/session/geteditdata/{sId}', 'SessionController@getSessionEditData')->name('get-session-edit-data');




//ADMINISTRACION DE VISITANTES
	Route::get('amdmin/event/visitors', 'AdminController@getVisitorView')->name('visitor-view');


//ADMINISTRACION DE MARCAS
Route::get('admin/event/brands/{evId}', 'BrandController@getBrandsView')->name('brands-view');
	Route::post('admin/event/brands/store', 'BrandController@storeBrand')->name('event-brand-store');
	Route::get('admin/event/brands/geteditdata/{bId}', 'BrandController@getBrandEditData')->name('get-brand-edit-data');
	Route::delete('admin/event/brands/delete/{bId}', 'BrandController@deleteBrand')->name('delete-brand');
	//Ajax brands by event
	Route::get('admin/events/brands/{eventId}', 'BrandController@getBrandByEvent')->name('ajax-brands');




//ADMINISTRACION DE PRODUCTOS
	Route::get('admin/event/products/{evId}', 'ProductController@getProductsView')->name('products-view');
	Route::post('admin/event/products/store', 'ProductController@storeProduct')->name('event-product-store');

	Route::get('admin/event/products/geteditdata/{pId}', 'ProductController@getProductsEditData')->name('get-product-edit-data');
	
	Route::delete('admin/event/products/delete/{pId}', 'ProductController@deleteProduct')->name('delete-product');
	

//ADMINISTRACION DE OFERTAS
	Route::get('admin/event/offers/{evId}', 'EventController@getOffersView')->name('offers-view');
		Route::post('admin/events/offers/store', 'EventController@offerStore')->name('event-offer-store');
		Route::get('admin/events/offer/geteditdata/{oId}', 'EventController@getOfferEditData')->name('get-offer-edit-data');
		Route::delete('admin/events/offer/delete/{oId}', 'EventController@offerDelete')->name('delete-offer');


//ADMINISTRACION DE EMPERSAS
	Route::get('admin/event/companies/{evId}', 'CompanyController@getCompaniesView')->name('companies-view');
		Route::post('admin/events/company/store', 'EventController@companyStore')->name('event-company-store');
		Route::get('admin/events/company/geteditdata/{cId}', 'EventController@getCompanyEditData')->name('get-company-edit-data');
		Route::delete('admin/events/company/delete/{cId}', 'EventController@companyDelete')->name('delete-company');

		//Obtener empresas para select2
		
		Route::get('admin/events/companies/{evId}', 'CompanyController@getCompaniesByEventSelect2')->name('get-company-select2');
		
//ADMINISTRACION DE INVENTARIOS
	Route::get('admin/event/inventories/{evId}', 'InventoryController@getInventoriesView')->name('inventories-view');
		

//ADMINISTRACION DE PATROCINADORES
	Route::get('admin/events/sponsors/{evId}', 'SponsorController@getSponsorsView')->name('sponsors-view');
	Route::post('admin/event/sponsor/store', 'SponsorController@storeSponsor')->name('event-sponsor-store');

	Route::get('admin/event/sponsors/geteditdata/{pId}', 'SponsorController@getSponsorEditData')->name('get-sponsor-edit-data');

	Route::delete('admin/event/sponsors/delete/{pId}', 'SponsorController@deleteSponsor')->name('delete-sponsor');



//Returns html with create page contents
Route::get('admin/create/page/{evId}', 'PageController@getCreatePageView');
Route::post('expositor/create/page', 'PageController@storePage')->name('store-page');

// Store image banner and gallery 
Route::post('admin/pages/image-gallery/{evId}/{ubication}', 'PageController@storeGalleryImages')->name('store-gallery');
	Route::delete('admin/pages/image-gallery/delete/{imgId}/{ubication}', 'PageController@deletePageImages')->name('delete-gallery');


Route::post('admin/pages/image-gallery-delete', 'PageController@storeGalleryImages')->name('store-gallery');

//Guardar imagen de formulario de registro a evento admin/pages/image-form
Route::post('admin/pages/image-form/{eventId}', 'PageController@storeFormImage')->name('store-form-image');


Route::get('/home', 'HomeController@index')->name('home');




/*EVENT ADMIN*/
Route::get('admin/events/getUserEvent/{evIds}', 'EventController@getUsersForEvent');


/* Edit Event Data */
Route::get('admin/event/edit-data/{evId}', 'EventController@getEventEditDataView')->name('event-edit-data');
	Route::post('admin/event/update-data', 'EventController@storeEventEditData')->name('event-store-edit-data');



/* NOTIFICATIONS */
Route::any('admin/notifications', 'NotificationController@getNotificationView')->middleware('auth');

/* Admin event homepage*/

Route::get('admin/event/homepage/{evId}', 'AdminController@getEventHomePage')->name('event-home-page');





//Generate QR Code
Route::post('admin/qrs/generate', 'EventController@generateQrForPrint');


}); //Auto group
//--------------------------------  FULL ADMIN ROUTES -----------------------------------------------------
Route::group(['middleware' => 'auth'], function () {
	Route::get('admin/full/home', 'AdminController@fullAdminHome')->name('full-admin-home');
	Route::get('admin/super/home', 'AdminController@superAdminHome')->name('super-admin-home');
	Route::get('admin/home', 'AdminController@adminHome')->name('admin-home');


	 // Events admin
	 Route::get('admin/events/list/{get}', 'AdminController@getEventsList')->name('sadmin-events-list');

	 //Events by: actives, finished, all
	Route::get('administracion/eventos/mis-eventos/{stt}', 'AdminController@getEventsByStatus')->name('admin-events-bystatus');	 

	 //Usesrs Admin
	 Route::any('admin/users/create','AdminController@getUsersCreateView');
	  	    Route::post('admin/users/store','AdminController@userStore')->name('admin-user-store');
	  	    Route::get('admin/users/geteditdata/{uId}', ['as' => 'user-get-edit-data', 'uses' => 'AdminController@getUserEditData']);
	  	    Route::delete('admin/visitors/delete/{uId}/{evId}', ['as' => 'user-event-delete', 'uses' => 'EventController@deleteEventVisitor']);


	//Users visitors admin full view for advanced search

	Route::any('administracion/visitantes/busqueda','AdminController@getFullUsersSeacrh')->name('full-visitors-admin');

		//-------------------------- REPORTE GENERAL DE USUARIOS CON SUS DATOS --------------------------------------------
		Route::post('admin/visitors/full-visitors-report', 'VisitorController@getFullVisitorReport')->name('full-visitor-report');
		//-----------------------------------------------------------------------------------------------------------------
	Route::post('admin/visitors/password/reset', 'AdminController@restoreToDefaultPassword')->name('restore-default-password');
	


	/********************************** USUARIOS SUPER ******************************************/

	Route::any('administracion/usuarios/super','AdminController@getFullSuperAdmin')->name('admin-super');

    //Users admin full view 

	Route::any('administracion/eventos/{eventId}/usuarios/','AdminController@getFullUsersAdmin')->name('full-users-admin');

	 //Catalogs Admin
	 Route::post('get/datatypes/{controlId}', 'CatalogController@getDataTypes');

	 //Reportes


	 Route::get('administracion/catalogos/listado','AdminController@getCatalogsListView')->name('catalogs-list');
	 	Route::post('admininstracion/catalogos/administrar','AdminController@getCatalogCreateView')->name('catalogs-create');

	 //User catalogs
	 	Route::post('administracion/catalogos/usuarios/nuevo','CatalogController@getCreateUserCatalogView')->name('user-catalog-create-new');
	 		Route::post('administracion/catalogos/usuarios/guardar','CatalogController@sotreUserCatalog')->name('store-user-catalog');
	 	

 		Route::post('administracion/catalogos/usuarios/campos','AdminController@getCreateUserCatalogFieldsView')->name('user-catalog-add-fields');
 			Route::get('catalogos/editar/{id}','CatalogController@getDataEditFieldCatalog')->name('edit-field-catalog');


	 	 Route::get('administracion/catalogos/usuarios/listado','AdminController@getUserCatalogsListView')->name('user-catalogs-list');
	 	 	Route::post('admin/catalogs/usercatalogs/{evId}/{typeId}','CatalogController@getUserCatalogsTableView')->name('user-catalogs-table');
	 	 	Route::post('admin/catalogs/store/usercatalog/{evId}/{typeId}','CatalogController@storeUserCatalog')->name('user-catalogs-store');

	 	 	Route::post('admin/catalogs/status/change/{fieldId}','CatalogController@changeFieldStatus')->name('user-catalogs-status');

	 //Company Catalogs
	 	Route::any('administracion/catalogos/empresas/nuevo','CatalogController@getCreateCompanyCatalogView')->name('company-catalog-create-new');
	 		Route::get('administracion/catalogos/empresas/campos','AdminController@getCreateCompanyCatalogFieldsView')->name('company-catalog-create-fields');

	 	 	Route::post('admin/catalogs/companycatalogs/{evId}','CatalogController@getCompanyCatalogsTableView')->name('company-catalogs-table');
	 		Route::post('admin/catalogs/store/companycatalog/{evId}','CatalogController@storeCompanyCatalog')->name('company-catalogs-store');



	// Visitors admin
	Route::get('admin/event/visitors/{evId}','EventController@getVistiorsView')->name('visitors-view');
	 	


	// CODIGOS PARA CREAR NUEVOS EVENTOS
	Route::get('administracion/eventos/codigos/generar', 'EventController@getCodesView')->name('event-codes');
		Route::post('admin/codes/store', 'EventController@storeCode')->name('store-codes');

		//Verificar el código al momento de crear el evento
		Route::get('admin/codes/check', 'EventController@checkEventCode')->name('check-event-codes');		



	 //------------------------------ END FULL ADMIN ROUTES ----------------------------------------------------

}); //Auto group



//---------------------------------- VISITOR AUTHENTICATED -----------------------------------------------------

Route::get('visitantes/miperfil', 'VisitorController@getProfileView')->name('visitor-profile');