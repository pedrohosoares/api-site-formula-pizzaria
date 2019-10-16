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

Route::get('/pegatodasbordas/{cod_pizzarias}','Controller@pegatodasbordas')->name('apipegatodasbordas');
Route::get('/pegatodaspizzas/{cod_pizzarias}','Controller@buscaSemGroupPizzas')->name('apipegatodaspizzas');
Route::get('/pegatodasbebidas/{cod_pizzarias}','Controller@selecaoBebidas')->name('apipegatodasbebidas');
Route::get('/buscaIngredientes/{cod_pizzarias}/{cod_tamanho}/{cod_pizza}','Controller@buscaIngredientes')->name('apibuscaIngredientes');
Route::get('/pegatodosadicionais/{cod_pizzarias}','Controller@selectIngredientesAdicionais')->name('apipegatodosadicionais');

Route::get('/bebidas/{token}','Controller@peddingCancel');
Route::get('/sobremesas/{token}','PedidoController@peddingCancel');
Route::get('/pizzas/{token}','PedidoController@peddingCancel');
Route::get('/calzones/{token}','PedidoController@peddingCancel');

//ROTAS DE ATUALIZACAO DE PEDIDOS
Route::get('/peddings/sendStatus/{token}/{field}/{status}/{id}','PedidoController@sendStatus');

//TICKETS
Route::prefix('tickets')->group(function(){
    Route::get('/categorias','TicketsController@retornaCategoria');
    Route::get('/situacoes','TicketsController@retornaSituacoes');
    Route::get('/tickets','TicketsController@recuperaTicket');
    Route::post('/criar_tickets','TicketsController@insereTicket');
    Route::match(['put'],'/alterar_categoria/{cod_categorias}','TicketsController@alteraCategoria');
});


//AJAX
Route::get('/ajaxBordas/{cod_produto}/{cod_pizzaria}','PedidoController@ajaxBordas');
Route::get('/ajaxIngredientes/{cod_pizzas}','PedidoController@ajaxIngredientes');
Route::get('/ajaxIngredientesAdicionais/{cod_pizzarias}/{cod_tamanho}','PedidoController@ajaxIngredientesAdicionais');


//Login
Route::post('/login-formula', 'LoginController@login_formula')->name('login_formula');
