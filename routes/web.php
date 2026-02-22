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
        Route::resource('admin/inicio', 'Admin\Page\PageHomeController')->except(['destroy', 'update', 'store', 'show', 'create', 'edit']);
        Route::get('admin/inicio/banner', 'Admin\Page\PageHomeController@show')->name('inicio.banner');
        Route::get('admin/inicio/catalogo', 'Admin\Page\PageHomeController@catalog')->name('inicio.catalog');
        Route::get('admin/inicio/galeria', 'Admin\Page\PageHomeController@galery')->name('inicio.galery');
        Route::get('admin/inicio/footer', 'Admin\Page\PageHomeController@footer')->name('inicio.footer');
        Route::resource('admin/nosotros', 'Admin\Page\PageUsController')->except(['destroy', 'update', 'store']);
        Route::resource('admin/contacto', 'Admin\Page\PageContacController')->except(['destroy', 'update', 'store']);
        Route::resource('admin/factura', 'Admin\Page\PageFacturaController')->except(['destroy', 'update', 'store']);
        Route::resource('admin/galeria', 'Admin\Page\PageGaleriaController')->except(['destroy', 'update', 'store']);
        Route::resource('users', 'Admin\UserController')->except(['destroy', 'update', 'store']);
    });
});
