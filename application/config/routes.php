<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Principal_ERP
$route['Principal_ERP/(:any)'] = 'Principal_ERP/view/$1';
$route['Principal_ERP'] = 'Principal_ERP';//Aquí se llama al index() de la clase en cuestión

//FacturasVenta_ERP
$route['facturasventa_ERP/(:any)'] = 'facturasventa_ERP/view/$1';
$route['facturasventa_ERP_by_empresa/(:any)'] = 'facturasventa_ERP/lista_by_empresa/$1';
$route['facturasventa_ERP'] = 'facturasventa_ERP';

//PedidosVentaArticulos_ERP
$route['facturaventaitems_ERP_by_cabecera/(:any)'] = 'facturaventaitems_ERP/lista_by_cabecera/$1';

//PedidosVenta_ERP
$route['pedidosventa_ERP/(:any)'] = 'pedidosventa_ERP/solicitar_duplicado/$1';
$route['pedidosventa_ERP_by_id/(:any)'] = 'pedidosventa_ERP/view/$1';
$route['pedidosventa_ERP_by_empresa/(:any)'] = 'pedidosventa_ERP/lista_by_empresa/$1';
$route['pedidosventa_ERP'] = 'pedidosventa_ERP';

//PedidosVentaArticulos_ERP
$route['pedidosventaarticulos_ERP_by_cabecera/(:any)'] = 'pedidosventaarticulos_ERP/lista_by_cabecera/$1';

//CotizacionesVenta_ERP
$route['cotizacionesventa_ERP/(:any)'] = 'cotizacionesventa_ERP/view/$1';
$route['cotizacionesventa_ERP_by_empresa/(:any)'] = 'cotizacionesventa_ERP/lista_by_empresa/$1';
$route['cotizacionesventa_ERP'] = 'cotizacionesventa_ERP';//Aquí se llama al index() de la clase en cuestión

//CotizacionesVentaArticulos_ERP. No se necesita lógica para ésta clase porque depende de CotizacionesVenta_ERP.
$route['cotizacionesventaarticulos_ERP_by_cabecera/(:any)'] = 'cotizacionesventaarticulos_ERP/lista_by_cabecera/$1';

$route['pedido_linea'] = 'pedido_cabecera';//Aquí se llama al index() de la clase en cuestión. Desde línea se llama al listado de pedidos.
$route['pedido_linea/(:any)'] = 'pedido_linea/view/$1';
$route['pedido_linea/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:any)'] = 'pedido_linea/creacion_sin_form/$1/$2/$3/$4/$5/$6/$7';//id_pedido/reglon/cod_producto/sku/cantidad/precio_unitario/precio_total

$route['pedidos_by_cliente/(:num)'] = 'pedido_cabecera/pedidos_by_cliente/$1';

$route['pedido_cabecera/(:num)/(:any)'] = 'pedido_cabecera/creacion_sin_form/$1/$2';
$route['pedido_cabecera/create'] = 'pedido_cabecera/create';
$route['pedido_cabecera/(:any)'] = 'pedido_cabecera/view/$1';
$route['pedido_cabecera'] = 'pedido_cabecera';//Aquí se llama al index() de la clase en cuestión


$route['default_controller'] = 'pedido_cabecera';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


