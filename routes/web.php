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

//URL PARA PEDIDOS
Route::get('/','HomeController@index')->name('home');
Route::get('/combos/{name?}','HomeController@combos')->name('combos');

//URL para loja especifica
Route::name('loja')->group(function(){
    Route::match(['post','get'],'/lojas','LojaController@lojas')->name('lojas');
    Route::match(['post','get'],'/lojas/{state}/{name}','LojaController@index')->name('loja');
    Route::match(['post','get'],'/lojas/{state}','LojaController@state')->name('loja_estado');
    Route::match(['post','get'],'/lojas/{state}/{name}/mais-pedidas','LojaController@index')->name('index_loja');
    Route::match(['post','get'],'/lojas/{state}/{name}/combos','LojaController@combos')->name('combos');
    Route::match(['post','get'],'/lojas/{state}/{name}/sanduiches','LojaController@sanduiches')->name('sanduiches');
    Route::match(['post','get'],'/lojas/{state}/{name}/pizzas','LojaController@pizzas')->name('pizzas');
    Route::match(['post','get'],'/lojas/{state}/{name}/calzone','LojaController@calzone')->name('calzone');
    Route::match(['post','get'],'/lojas/{state}/{name}/bebidas','LojaController@bebidas')->name('bebidas');
    Route::match(['post','get'],'/lojas/{state}/{name}/sobremesas','LojaController@sobremesas')->name('sobremesas');
});

Route::get('/clientes','ClienteController@clientes')->name('clientes');
Route::get('/clientes/login','ClienteController@user')->name('login');
Route::get('/clientes/user','ClienteController@user')->name('user');
Route::match(['post','get'],'/clientes/accounts','ClienteController@account')->name('accounts');
Route::match(['post','get'],'/clientes/account','ClienteController@account')->name('account');
Route::get('/clientes/contact','ClienteController@contact')->name('contact');
Route::get('/clientes/logout','ClienteController@logout')->name('logout');
Route::get('/clientes/pedido-completo/{cod_pedido}','ClienteController@pedidoCompleto')->name('pedido-completo');
Route::get('/clientes/refazer-pedido/{cod_pedido}','ClienteController@refazerPedido')->name('refazer-pedido');
Route::match(['post','get'],'/ajaxPesquisaPedido','ClienteController@ajaxPesquisaPedido')->name('ajaxPesquisaPedido');


Route::get('/getTamanhos/{quantidade?}/{situacao?}','TamanhoController@getTamanhos')->name('getTamanhos');
Route::get('/getBebidas/','BebidaController@getBebidas')->name('getBebidas');
Route::get('/getPizzas/','PizzaController@getPizzas')->name('getPizzas');
Route::get('/getPizzasMaisPedidas/','PedidoController@getPizzasMaisPedidas')->name('getPizzasMaisPedidas');


