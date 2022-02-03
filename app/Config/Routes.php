<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/',['filter'=>'auth'], function ($routes) {

	$routes->get('', 'Home::index', ['as' => 'home_system']);

	//routes clientes
	$routes->get('crearcliente', 'Client::viewCreateClient', ['as' => 'view_createclient']);

	//routes crear order
	$routes->get('crearpedido', 'Order::viewCreateOrder', ['as' => 'view_createorder']);
	$routes->post('crearpedido', 'Order::viewCreateOrderFinish', ['as' => 'view_createorder_finish']);
	$routes->post('createpedido', 'Order::createOrder', ['as' => 'create_order']);
	$routes->get('pedido/(:segment)', 'Order::viewLoadOrder/$1', ['as' => 'view_load_order']);
	$routes->post('pedido/cambiarpayment', 'Order::changeMethodPayment', ['as' => 'change_method_payment']);

	//routes para list of ordenes
	$routes->get('listadepedidos/(:num)/(:segment)', 'Listorders::view_main/$1/$2', ['as' => 'view_list_order']);

	$routes->post('addproduct', 'Order::addProductToListOrder', ['as' => 'addproductlistorder']);
	$routes->post('deleteproduct', 'Order::deleteProductToListOrder', ['as' => 'deleteproductlistorder']);

	//routes para cambiar de states
	$routes->get('changestate/(:num)/(:segment)', 'States::updateState/$1/$2', ['as' => 'chage_state']); 

	//routes domiciliarios
	$routes->get('creardomiciliario', 'Domiciliary::viewCreateDomiciliary', ['as' => 'view_domiciliaries']);
	$routes->post('creardomiciliario', 'Domiciliary::createDomiciliary', ['as' => 'createdomiciliaries']);

	//routes prueba
	$routes->get('cart', 'Order::cart');
	$routes->get('d', 'Order::d');

	//routes of ajax
	$routes->post('productofcategory', 'Ajax::ajaxProductOfCategory');
	$routes->post('ingredientsofproduct', 'Ajax::ajaxProductRecipe');
	$routes->get('formtypeshipping', 'Ajax::ajaxFormTypeShipping');
	$routes->post('additionsofproduct', 'Ajax::ajaxAdditionsProduct');

	//routes of pictures
	$routes->add('/public/admin/dist/img/menu', '', ['as' => 'img-menu']);

	//reportes
	$routes->post('lista', 'Reports::printOrder', ['as' => 'print_order']);
	$routes->get('cocina/(:segment)', 'Reports::printKitchen/$1', ['as' => 'print_kitchen']);
	$routes->post('etiqueta', 'Reports::printSticker', ['as' => 'print_sticker']);

	//Informes
	$routes->get('reportediario/(:segment)', 'Informes::dailyBox/$1', ['as' => 'informe_daily_box']); 
	$routes->get('reportediario/(:segment)/(:segment)', 'Informes::generalReport/$1/$2', ['as' => 'informe_general_report']);
	$routes->post('validaterangedate','Informes::validateFormRangeDate',['as'=>'validateformdaterange']);
	$routes->post('validatedate','Informes::validateFormDate',['as'=>'validate_date']);
	$routes->get('reporteskathe/(:segment)', 'Informes::reportKathe/$1', ['as' => 'informe_kathe']); 
	$routes->post('formdatekathe','Informes::dateReportKathe',['as'=>'validate_date_report_kathe']);
	$routes->get('reportemensual/(:segment)/(:segment)', 'Informes::reportMonth/$1/$2', ['as' => 'month_repot']);

	//cotizador
	$routes->get('carne', 'Quote::viewMeat', ['as' => 'quote_meat']); 


});

//routes of auth
$routes->group('auth', function ($routes) {
	
	$routes->get('login', 'Auth::login', ['as' => 'login']);
	$routes->post('check', 'Auth::signin', ['as' => 'check_login']);
	$routes->get('logout', 'Auth::logout', ['as' => 'logout']);
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
