<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//ROTAS DE PEDIDOS FORMULA
Route::get('/peddings/new/{token}/{status}','PedidoController@peddingNew');
Route::get('/peddings/reprint/{token}','PedidoController@peddingReprint');
Route::get('/peddings/cancel/{token}','PedidoController@peddingCancel');

//ROTAS DE ATUALIZACAO DE PEDIDOS
Route::get('/peddings/sendStatus/{token}/{field}/{status}/{id}','PedidoController@sendStatus');

//AJAX
Route::get('/ajaxBordas/{cod_produto}/{cod_pizzaria}','PedidoController@ajaxBordas');