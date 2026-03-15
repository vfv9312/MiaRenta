<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'DashBoardController@home')->name('home');
Route::get('ubicanos', 'DashBoardController@ubicanos')->name('ubicanos');
Route::get('lista-productos', 'DashBoardController@lista')->name('lista');
Route::get('nosotros', 'DashBoardController@nosotros')->name('nosotros');
Route::get('politica', 'DashBoardController@politica')->name('politica');
Route::get('reclamacion', 'DashBoardController@reclamacion')->name('reclamacion');
Route::get('factura', 'DashBoardController@factura')->name('factura');
Route::get('orden', 'DashBoardController@orden')->name('orden');
Route::get('no-encontrado', 'DashBoardController@noencontrado')->name('noencontrado');

// Ruta comodín para manejar rutas no encontradas
Route::fallback(function () {
    return redirect()->route('noencontrado'); // Redirige a la ruta con nombre "noencontrado"
});

Route::get('login', 'AuthController@login')->name('login');
Route::get('forget-password', 'AuthController@showForgetPasswordForm')->name('forget.password');
Route::get('reset-password/{token}', 'AuthController@showResetPasswordForm')->name('reset.password');

// Route::get('codigo',function (){
//     return view('welcome');
// });

Route::middleware(['auth', 'status'])->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::post('logout', 'AuthController@logout')->name('logout');

    Route::middleware(['role:1'])->group(function () {
        //rutas para administrar la pagina web
        Route::resource('admin/inicio', 'Admin\Page\PageHomeController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::get('admin/inicio/banner', 'Admin\Page\PageHomeController@show')->name('inicio.banner');
        Route::get('admin/inicio/catalogo', 'Admin\Page\PageHomeController@catalog')->name('inicio.catalog');
        Route::get('admin/inicio/galeria', 'Admin\Page\PageHomeController@galery')->name('inicio.galery');
        Route::get('admin/inicio/footer', 'Admin\Page\PageHomeController@footer')->name('inicio.footer');
        Route::resource('admin/nosotros', 'Admin\Page\PageUsController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::resource('admin/contacto', 'Admin\Page\PageContacController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::resource('admin/factura', 'Admin\Page\PageFacturaController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::resource('admin/politica', 'Admin\Page\PagePoliticaController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::resource('users', 'Admin\UserController')->except(['destroy', 'update', 'store']);

        //rutas para el sistema interno del control del mobiliario
        Route::get('admin/colores', 'Admin\Inventary\FurnitureController@colors')->name('colores');
        Route::get('admin/categorias', 'Admin\Inventary\FurnitureController@categories')->name('categorias');
        Route::get('admin/tipos', 'Admin\Inventary\FurnitureController@types')->name('tipos');
        Route::get('admin/productos', 'Admin\Inventary\FurnitureController@products')->name('productos');
        Route::get('admin/imagenes', 'Admin\Inventary\FurnitureController@images')->name('imagenes.inventary');
        Route::get('admin/reparaciones', 'Admin\Inventary\FurnitureController@repairs')->name('reparaciones');
        Route::get('admin/clientes', 'Admin\Client\ClientsController@index')->name('clientes');

        Route::get('admin/configuracion', 'Admin\Configuration\IndexController@index')->name('configuracion');
        Route::get('admin/colonias', 'Admin\Configuration\IndexController@colonias')->name('colonias');
        Route::get('admin/metodos-pago', 'Admin\Configuration\IndexController@metodosPago')->name('metodos-pago');
        Route::get('admin/estadisticas', 'Admin\Configuration\IndexController@estadisticas')->name('estadisticas');
        Route::get('admin/empleados', 'Admin\Employee\EmployeeController@index')->name('empleados');

        Route::get('admin/generar-orden', 'Admin\Order\IndexController@index')->name('generar-orden');
        // Route::get('admin/mobiliario', 'Admin\Inventary\FurnitureController@catalago_tipos')->name('catalago.tipos');
    });
});
