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
});

Route::get('/getTamanhos/{quantidade?}/{situacao?}','TamanhoController@getTamanhos')->name('getTamanhos');
Route::get('/getBebidas/','BebidaController@getBebidas')->name('getBebidas');
Route::get('/getPizzas/','PizzaController@getPizzas')->name('getPizzas');
Route::get('/getPizzasMaisPedidas/','PedidoController@getPizzasMaisPedidas')->name('getPizzasMaisPedidas');


