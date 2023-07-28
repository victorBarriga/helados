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


Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('/main','Auth\LoginController@autenticate')->name('main');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');




    Route::get('/activo', 'ActivoController@index');
    Route::post('/activo/registrar', 'ActivoController@store');
    Route::put('/activo/actualizar', 'ActivoController@update');
    Route::put('/activo/desactivar', 'ActivoController@desactivar');
    Route::put('/activo/activar', 'ActivoController@activar');
    Route::get('/activo/buscarArticulo', 'ActivoController@buscarArticulo');
    Route::get('/activo/listarArticulo', 'ActivoController@listarArticulo');
    Route::get('/activo/buscarArticuloVenta', 'ActivoController@buscarArticuloVenta');
    Route::get('/activo/listarArticuloVenta', 'ActivoController@listarArticuloVenta');

    Route::get('/tipo-inventario', 'TipoInventarioController@index');
    Route::get('/tipo-inventario/selectRol', 'TipoInventarioController@selectRol');


    Route::get('/almacen', 'AlmacenController@index');
    Route::post('/almacen/registrar', 'AlmacenController@store');
    Route::put('/almacen/actualizar', 'AlmacenController@update');
    Route::put('/almacen/desactivar', 'AlmacenController@desactivar');
    Route::put('/almacen/activar', 'AlmacenController@activar');
    Route::get('/almacen/selectAlmacen', 'AlmacenController@selectAlmacen');

    Route::get('/inventario', 'InventarioController@index');
    Route::post('/inventario/registrar', 'InventarioController@store');
    Route::put('/inventario/actualizar', 'InventarioController@update');
    Route::put('/inventario/desactivar', 'InventarioController@desactivar');
    Route::put('/inventario/activar', 'InventarioController@activar');
    Route::get('/inventario/selectAlmacen', 'InventarioController@selectAlmacen');


    Route::get('/proveedor', 'ProveedorController@index');
    Route::post('/proveedor/registrar', 'ProveedorController@store');
    Route::put('/proveedor/actualizar', 'ProveedorController@update');
    Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');


    Route::get('/insumo', 'InsumoController@index');
    Route::post('/insumo/registrar', 'InsumoController@store');
    Route::put('/insumo/actualizar', 'InsumoController@update');
    Route::put('/insumo/desactivar', 'InsumoController@desactivar');
    Route::put('/insumo/activar', 'InsumoController@activar');
    Route::get('/insumo/buscarArticulo', 'InsumoController@buscarArticulo');
    Route::get('/insumo/listarInsumo', 'InsumoController@listarInsumo'); 

    Route::get('/categoria', 'CategoriaController@index');
    Route::post('/categoria/registrar', 'CategoriaController@store');
    Route::put('/categoria/actualizar', 'CategoriaController@update');
    Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    Route::put('/categoria/activar', 'CategoriaController@activar');
    Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

    Route::get('/compra', 'ComprasController@index');
    Route::get('/compra/overview', 'ComprasController@overview');
    Route::post('/compra/registrar', 'ComprasController@store');
    Route::put('/compra/desactivar', 'ComprasController@desactivar');


    Route::get('/producto', 'ProductoController@index');
    Route::post('/producto/registrar', 'ProductoController@store');
    Route::put('/producto/actualizar', 'ProductoController@update');
    Route::put('/producto/desactivar', 'ProductoController@desactivar');
    Route::put('/producto/activar', 'ProductoController@activar');
    Route::get('/producto/buscarArticulo', 'ProductoController@buscarArticulo');
    Route::get('/producto/listarProducto', 'ProductoController@listarInsumo'); 
    Route::get('/producto/selectCategoria', 'ProductoController@listarInsumo'); 

    Route::get('/costos', 'CostosController@index');
    Route::post('/costos/registrar', 'CostosController@store');
    Route::put('/costos/actualizar', 'CostosController@update');
    Route::put('/costos/desactivar', 'CostosController@desactivar');
    Route::put('/costos/activar', 'CostosController@activar');
    Route::get('/costos/buscarArticulo', 'CostosController@buscarArticulo');
    Route::get('/costos/listarInsumo', 'CostosController@listarInsumo'); 

    Route::get('/cronograma', 'CronogramaController@index');
    Route::post('/cronograma/registrar', 'CronogramaController@store');
    Route::put('/cronograma/actualizar', 'CronogramaController@update');
    Route::put('/cronograma/desactivar', 'CronogramaController@desactivar');
    Route::put('/cronograma/activar', 'CronogramaController@activar');
    Route::get('/cronograma/buscarArticulo', 'CronogramaController@buscarArticulo');
    Route::get('/cronograma/listarInsumo', 'CronogramaController@listarInsumo'); 

    Route::get('/usuario', 'UsuarioController@index');
    Route::post('/usuario/registrar', 'UsuarioController@store');
    Route::put('/usuario/actualizar', 'UsuarioController@update');
    Route::put('/usuario/desactivar', 'UsuarioController@desactivar');
    Route::put('/usuario/activar', 'UsuarioController@activar');
    Route::get('/usuario/buscarArticulo', 'UsuarioController@buscarArticulo');
    Route::get('/usuario/listarInsumo', 'UsuarioController@listarInsumo'); 
    
    Route::get('/inventario-insumo/listar', 'InventarioInsumoController@index');
    Route::put('/inventario-insumo/actualizar', 'InventarioInsumoController@update');

    Route::get('/inventario-activo/listar', 'InventarioInsumoController@indexActivo');
    Route::put('/inventario-activo/actualizar', 'InventarioInsumoController@updateActivo');


});
// Route::get('/activo', 'ActivoController@index');
// Route::get('/activo', 'ActivoController@index');



// Route::group(['middleware'=>['auth']],function(){
    
//     Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
//     Route::get('/main', function () {
//         return view('contenido/contenido2');
//     })->name('main');


    // Route::get('/pdf', function () {
    //     return view('templatesPdf/OverviewStore');
    // })->name('main');

    // Route::get('/pdf-compra', function () {
        
    // })->name('main');

    // Route::get('/libros', function () {
    //     return view('welcome');
    // });

    // Route::group(['middleware' => ['Almacenero']], function () {
    //     Route::get('/categoria', 'CategoriaController@index');
    //     Route::post('/categoria/registrar', 'CategoriaController@store');
    //     Route::put('/categoria/actualizar', 'CategoriaController@update');
    //     Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    //     Route::put('/categoria/activar', 'CategoriaController@activar');
    //     Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

    //     Route::get('/articulo', 'ArticuloController@index');
    //     Route::post('/articulo/registrar', 'ArticuloController@store');
    //     Route::put('/articulo/actualizar', 'ArticuloController@update');
    //     Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
    //     Route::put('/articulo/activar', 'ArticuloController@activar');
    //     Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
    //     Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo'); 

    //     Route::get('/proveedor', 'ProveedorController@index');
    //     Route::post('/proveedor/registrar', 'ProveedorController@store');
    //     Route::put('/proveedor/actualizar', 'ProveedorController@update');
    //     Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        
        
    //     Route::get('/ingreso', 'IngresoController@index');
    //     Route::get('/ingreso/overview', 'IngresoController@overview');
    //     Route::post('/ingreso/registrar', 'IngresoController@store');
    //     Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
    //     Route::put('/ingreso/editar', 'IngresoController@editar');

    // });

    // Route::group(['middleware' => ['Vendedor']], function () {
    //     Route::get('/cliente', 'ClienteController@index');
    //     Route::post('/cliente/registrar', 'ClienteController@store');
    //     Route::put('/cliente/actualizar', 'ClienteController@update');
    //     Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
    //     Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
    //     Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');



    //     Route::get('/venta', 'VentaController@index');
    //     Route::post('/venta/registrar', 'VentaController@store');
    //     Route::put('/venta/desactivar', 'VentaController@desactivar');
    //     Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    //     Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles'); 
    // });

    // Route::group(['middleware' => ['Administrador']], function () {
        
    //     Route::get('/categoria', 'CategoriaController@index');
    //     Route::post('/categoria/registrar', 'CategoriaController@store');
    //     Route::put('/categoria/actualizar', 'CategoriaController@update');
    //     Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    //     Route::put('/categoria/activar', 'CategoriaController@activar');
    //     Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

    //     Route::get('/articulo', 'ArticuloController@index');
    //     Route::post('/articulo/registrar', 'ArticuloController@store');
    //     Route::put('/articulo/actualizar', 'ArticuloController@update');
    //     Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
    //     Route::put('/articulo/activar', 'ArticuloController@activar');
    //     Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
    //     Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
    //     Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
    //     Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');


    //     Route::get('/activo', 'ActivoController@index');
    //     Route::post('/activo/registrar', 'ActivoController@store');
    //     Route::put('/activo/actualizar', 'ActivoController@update');
    //     Route::put('/activo/desactivar', 'ActivoController@desactivar');
    //     Route::put('/activo/activar', 'ActivoController@activar');
    //     Route::get('/activo/buscarArticulo', 'ActivoController@buscarArticulo');
    //     Route::get('/activo/listarArticulo', 'ActivoController@listarArticulo');
    //     Route::get('/activo/buscarArticuloVenta', 'ActivoController@buscarArticuloVenta');
    //     Route::get('/activo/listarArticuloVenta', 'ActivoController@listarArticuloVenta');

    //     Route::get('/proveedor', 'ProveedorController@index');
    //     Route::post('/proveedor/registrar', 'ProveedorController@store');
    //     Route::put('/proveedor/actualizar', 'ProveedorController@update');
    //     Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

    //     Route::get('/ingreso', 'IngresoController@index');
    //     Route::get('/ingreso/overview', 'IngresoController@overview');
    //     Route::post('/ingreso/registrar', 'IngresoController@store');
    //     Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        
        
    //     Route::get('/cliente', 'ClienteController@index');
    //     Route::post('/cliente/registrar', 'ClienteController@store');
    //     Route::put('/cliente/actualizar', 'ClienteController@update');
    //     Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

    //     Route::get('/venta', 'VentaController@index');
    //     Route::get('/venta/obtener-chofer', 'VentaController@obtenerChofer');
    //     Route::post('/venta/registrar', 'VentaController@store');
    //     Route::put('/venta/editar', 'VentaController@editar');
    //     Route::put('/venta/desactivar', 'VentaController@desactivar');
    //     Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    //     Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        

    //     Route::get('/rol', 'RolController@index');
    //     Route::get('/rol/selectRol', 'RolController@selectRol');
        
    //     Route::get('/user', 'UserController@index');
    //     Route::post('/user/registrar', 'UserController@store');
    //     Route::put('/user/actualizar', 'UserController@update');
    //     Route::put('/user/desactivar', 'UserController@desactivar');
    //     Route::put('/user/activar', 'UserController@activar');

    //     Route::get('/pdf', 'PdfController@index');
    //     Route::get('/pdf-termic', 'PdfController@indexTermic');
    //     Route::get('/pdf-compra', 'PdfIngresoController@index');
    //     Route::get('/pdf-compra-termic', 'PdfIngresoController@indexTermic');
    //     Route::get('/report-venta', 'PdfController@index2');
    //     Route::get('/report-venta-unit', 'PdfController@currentStoreId');
    //     Route::get('/report-venta-termic', 'PdfTermicController@currentStoreId');
    //     Route::get('/report-compra','PdfIngresoController@index2');
    //     Route::get('/report-compra-unit','PdfIngresoController@currentStoreId');
    //     Route::get('/report-compra-unit-termic','PdfIngresoController@currentTermicStoreId');
    // });



    // Route::group(['middleware' => ['JefeProduccion']], function () {
 
    //     Route::get('/categoria', 'CategoriaController@index');
    //     Route::post('/categoria/registrar', 'CategoriaController@store');
    //     Route::put('/categoria/actualizar', 'CategoriaController@update');
    //     Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    //     Route::put('/categoria/activar', 'CategoriaController@activar');
    //     Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');  
    //     Route::get('/ingreso', 'IngresoController@index');
    //     Route::get('/ingreso/overview', 'IngresoController@overview');
    //     Route::post('/ingreso/registrar', 'IngresoController@store');
    //     Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        
    // });

    // Route::group(['middleware' => ['AyudanteProduccion']], function () {
 
    //     Route::get('/categoria', 'CategoriaController@index');
    //     Route::post('/categoria/registrar', 'CategoriaController@store');
    //     Route::put('/categoria/actualizar', 'CategoriaController@update');
    //     Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    //     Route::put('/categoria/activar', 'CategoriaController@activar');
    //     Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria'); 
        
    //     Route::get('/ingreso', 'IngresoController@index');
    //     Route::get('/ingreso/overview', 'IngresoController@overview');
    //     Route::post('/ingreso/registrar', 'IngresoController@store');
    //     Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        
    // });

    // Route::group(['middleware' => ['Secretaria']], function () {
 
    //     Route::get('/categoria', 'CategoriaController@index');
    //     Route::post('/categoria/registrar', 'CategoriaController@store');
    //     Route::put('/categoria/actualizar', 'CategoriaController@update');
    //     Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
    //     Route::put('/categoria/activar', 'CategoriaController@activar');
    //     Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');  

    //     Route::get('/ingreso', 'IngresoController@index');
    //     Route::get('/ingreso/overview', 'IngresoController@overview');
    //     Route::post('/ingreso/registrar', 'IngresoController@store');
    //     Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        
    // });

// });

//Route::get('/home', 'HomeController@index')->name('home');
