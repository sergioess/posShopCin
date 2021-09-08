<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */



Route::get('/', 'MainController@home');




////////////////////////
//MODULO DE CLIENTE
////////////////////////

Route::get('inicia','HomeController@inicia');

Route::resource('articulos', 'ArticulosController');
Route::resource('in_shopping_carts', 'InShoppingCartsController', [
	'only' => ['store', 'destroy', 'update']
]);
Route::get('carrito', 'ShoppingCartController@index');

//Página para pedir dia y hora que reciben
Route::get('recibepedido','ShoppingCartController@recibePedido');

//Página para pedir datos de entrega
Route::get('datosentrega','ShoppingCartController@datosEntrega');


Route::resource('categorias', 'CategoriaController');


Route::resource('domicilio', 'DomicilioController');
//Route::get('enmesa', 'TipoServicioController@enmesa');
Route::resource('enmesa', 'EnMesaController');
//Route::get('reserva', 'TipoServicioController@reserva');
Route::resource('reserva', 'ReservaController');

Route::resource('enviapedido', 'PaymentController');
Route::get('approval', 'PaymentController@approval');
Route::get('cancelled', 'PaymentController@cancelled');


//Módulo de Crear Reservas
//Route::resource('reservas', 'ReservasController');



//Eliminar articulo del carrito
Route::get('in_shopping_carts/{cod}/delete', ['as' => 'in_shopping_carts.delete', 'uses' => 'InShoppingCartsController@destroy']);

//Guarda Modificador al carrito al articulo
Route::resource('changestatustask', 'ModificadorUpdateController');
//Route::put('changestatustask', array('as' => 'statusTask', 'uses' => 'ModificadorUpdateController@statusTask'));
//Route::put('changestatustask/{articulo}', 'ModificadorUpdateController@update');

Route::resource('clientedash', 'ClienteOrdenesController');

//respuesta womopi
Route::get('respuesta', 'PaymentController@respuesta');



////////////////////////
//MODULO DE ADMINISTRADOR
////////////////////////

//--->Ingresa como admin
Route::get('admin', 'Auth\LoginController@showLoginForm')->name('login');

//---> Categorias
Route::resource('categoriasadmin', 'CategoriaAdminController');
//Eliminar categoria
Route::get('categoriasadmin/{cod}/delete', ['as' => 'categoriasadmin.delete', 'uses' => 'CategoriaAdminController@destroy']);

//Traslada los favoritos y los articulos
Route::get('traslate', 'CategoriaAdminController@traslate');

//Productos
Route::resource('productos', 'ProductoController');
//Eliminar producto
Route::get('productos/{cod}/delete', ['as' => 'productos.delete', 'uses' => 'ProductoController@destroy']);
//Muestra los productos de la categoria Seleccionada
Route::post('productos/{cod}/show2', ['as' => 'productos.show2', 'uses' => 'ProductoController@show2']);


//Productos de la Categoria
Route::resource('prodcat', 'ProdCatController');
Route::post('productofiltro', ['as' => 'productos.show2','uses' => 'ProductoController@show2']);


//Motrar Imagenes
Route::get('image/{filename}', 'MainController@displayImage')->name('image.displayImage');

//Empresas
Route::resource('empresas', 'EmpresaController');
//Empresas estado
Route::resource('empresasestado', 'EmpresaEstadoController', [
	'only' => ['update']
]);

//Ordenes
Route::resource('orders', 'OrderController', [
	'only' => ['index','update']
]);

Route::resource('reservas', 'ReservasController');

//Notificaciones
Route::resource('notifications', 'NotificationsController', [
	'only' => ['index', 'store', 'show']
]);

//invoice
//Download Pdf
Route::get('pdf',function(){
	return view('invoice');
});

//Ruta para refrescar las notificaciones sin ler
Route::view('notificador', 'notifications.unread');

//Modificadores
Route::resource('modificadores', 'ModificadoresController');
//Eliminar modificador
Route::get('modificadores/{cod}/delete', ['as' => 'modificadores.delete', 'uses' => 'ModificadoresController@destroy']);

//Modificadores
Route::resource('adicionales', 'AdicioalArticuloController');
//Eliminar modificador
Route::get('adicionales/{cod}/delete', ['as' => 'adicionales.delete', 'uses' => 'AdicioalArticuloController@destroy']);




////////////////////////
//MODULO DE LOGIN
////////////////////////

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Registration Routes...

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register'); 



////////////////////////
//MODULO DE ENCUESTA
////////////////////////

Route::resource('encuesta', 'EncuestaSaludController');