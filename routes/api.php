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
Route::get('/peddings/new/{token}/{status}', 'PedidoController@peddingNew');
Route::get('/peddings/reprint/{token}', 'PedidoController@peddingReprint');
Route::get('/peddings/cancel/{token}', 'PedidoController@peddingCancel');

Route::get('/pegatodasbordas/{cod_pizzarias}', 'Controller@pegatodasbordas')->name('apipegatodasbordas');
Route::get('/pegatodaspizzas/{cod_pizzarias}', 'Controller@buscaSemGroupPizzas')->name('apipegatodaspizzas');
Route::get('/pegatodasbebidas/{cod_pizzarias}', 'Controller@selecaoBebidas')->name('apipegatodasbebidas');
Route::get('/buscaIngredientes/{cod_pizzarias}/{cod_tamanho}/{cod_pizza}', 'Controller@buscaIngredientes')->name('apibuscaIngredientes');
Route::get('/pegatodosadicionais/{cod_pizzarias}/{cod_tamanho}', 'Controller@selectIngredientesAdicionais')->name('apipegatodosadicionais');

Route::get('/bebidas/{token}', 'Controller@peddingCancel');
Route::get('/sobremesas/{token}', 'PedidoController@peddingCancel');
Route::get('/pizzas/{token}', 'PedidoController@peddingCancel');
Route::get('/calzones/{token}', 'PedidoController@peddingCancel');

//ROTAS DE ATUALIZACAO DE PEDIDOS
Route::get('/peddings/sendStatus/{token}/{field}/{status}/{id}', 'PedidoController@sendStatus');

//TICKETS
Route::prefix('tickets')->group(function () {

    Route::get('/categorias', 'TicketsController@retornaCategoria');
    Route::get('/situacoes', 'TicketsController@retornaSituacoes');
    Route::get('/tickets', 'TicketsController@recuperaTicket');
    Route::post('/criar_tickets', 'TicketsController@insereTicket');
    Route::match(['put'], '/alterar_categoria/{cod_categorias}', 'TicketsController@alteraCategoria');
});


//AJAX
Route::get('/ajaxBordas/{cod_produto}/{cod_pizzaria}', 'PedidoController@ajaxBordas');
Route::get('/ajaxIngredientes/{cod_pizzas}', 'PedidoController@ajaxIngredientes');
Route::get('/ajaxIngredientesAdicionais/{cod_pizzarias}/{cod_tamanho}', 'PedidoController@ajaxIngredientesAdicionais');


//Login
Route::post('/login-formula', 'LoginController@login_formula')->name('login_formula');


//IFOOD
Route::prefix('ifood')->group(function () {
    //Merchant teste 208040
    Route::get('/json', 'IfoodController@json');
    Route::get('/ifood-token', 'IfoodController@oAuthToken')->name('ifood-token');
    Route::get('/polling', 'IfoodController@polling')->name('polling');
    Route::get('/view-access-token', 'IfoodController@view_access_token')->name('view_access_token');

    #CATEGORIAS
    Route::get('/listar-categorias/{merchant_id}', 'IfoodController@listarCategorias')->name('listarCategorias');
    Route::get('/cadastrar-categoria/{merchant_id}/{availability}/{name}/{order}/{template}/{externalCode}', 'IfoodController@cadastrar_categoria')->name('cadastrar_categoria');
    Route::get('/alterar-categoria/{merchant_id}/{availability}/{name}/{order}/{template}/{externalCode}', 'IfoodController@alterarCategorias')->name('alterar_categorias');
    #FIM CATEGORIAS

    #ITENS
    Route::get('/pega-itens/{merchant_id}/{id_categoria}', 'IfoodController@pegaItens')->name('pegaItens');
    Route::match(['post', 'get'], '/cadastra-produto', 'IfoodController@cadastraProdutos')->name('cadastra_produto');
    #FIM ITENS

    #STATUS
    Route::get('/delivery', 'IfoodController@delivery');
    Route::get('/ready-to-delivery', 'IfoodController@readyToDelivery');
    Route::get('/cancelar', 'IfoodController@cancelarRequisicao');

    Route::get('/confirmation/{reference}', 'IfoodController@confirmationget');
    Route::get('/integration/{reference}', 'IfoodController@integrationget');
    Route::get('/dispatch/{ids}', 'IfoodController@dispatchIfood');
    Route::get('/ready-to-delivery', 'IfoodController@readyToDeliveryGet');
});


Route::prefix('cupons')->group(function () {

    Route::get('/imprimir-cron/{pizzaria}','CuponsController@imprimirCron');
    Route::get('/reimprimir-printnode/{cod_pedido}/{url_pedido}/{nome_cupom}', 'CuponsController@reimprimir_printnode')->name('reimprimir_printnode');
    
    Route::get('/cria-imprime-printnode/{tipo}/{pedido}/{cnpj}', 'CuponsController@convertePDFEImprime');

    Route::get('/reimprimir/{cod_pedido}/{url_pedido}/{nome_cupom}', 'CuponsController@reimprimir')->name('reimprimir');
    Route::get('/excluir-cupons', 'CuponsController@excluirCupons')->name('excluirCupons');

    Route::get('/imprimir/{cod_pedido}/{url_pedido}/{imprime}/{nome_cupom}', 'CuponsController@imprimir')->name('imprimir');

    Route::get('/cupom-cozinha-ifood/{cod_pedido}', 'CuponsController@cupom_cozinha_ifood')->name('cupom_cozinha_ifood');
    Route::get('/cupom-pedido-ifood/{cod_pedido}', 'CuponsController@cupom_pedido_ifood')->name('cupom_pedido_ifood');

    Route::get('/cupom-cozinha-tel/{cod_pedido}', 'CuponsController@cupom_cozinha_tel')->name('cupom_cozinha_tel');
    Route::get('/cupom-pedido-tel/{cod_pedido}', 'CuponsController@cupom_pedido_tel')->name('cupom_pedido_tel');

    Route::get('/cupom-cancelado/{cod_pedido}', 'CuponsController@cupom_cancelado')->name('cupom_cancelado');
});


Route::prefix('notas')->group(function () {

    Route::get('/criar-nota-ifood/{pedido}', 'FocusNfeController@criar_nota_ifood');
    Route::get('/criar-nota-telefone', 'FocusNfeController@criar_nota_telefone');
    Route::get('/transformar-pdf', 'FocusNfeController@transformaEmPdf');
});


Route::prefix('sistema')->group(function () {
    Route::match(['post','get'],'/login/{username}/{senha}', 'SistemaController@login');
    Route::get('/bebidas/{cod_pizzaria?}/{status?}', 'BebidaController@getBebidasPizzaria');
    Route::get('/borda/{cod_tamanhos?}/{cod_pizzarias?}', 'PizzaController@getBorda');
    Route::get('/sabor/{cod_tamanhos?}/{cod_pizzarias?}', 'PizzaController@getSabor');
    Route::get('/pizzarias/{id?}', 'PizzariasController@pizzarias');
    Route::get('/tamanhos/{id?}','TamanhoController@getTamanhos');
    Route::get('/n_fracoes/{id?}/{cod_pizzaria?}','PizzaController@getNumeroSabor');
    Route::get('/n_corte/{id?}/{cod_pizzaria?}','PizzaController@getCorte');
    Route::match(['post','get'],'/clientes/{dado?}', 'ClienteController@getCliente');
    Route::get('/paginas/{acao}/{cod_paginas?}', 'SistemaController@paginas');
    Route::get('/menu-site/{logins}','SistemaController@menu_site');

    Route::get('/ver-historico/{cod_pedido?}/{ref_nota?}/{cliente?}/{telefone?}/{data_hora_inicial?}/{data_hora_final?}/{cod_pizzaria?}/{situacao?}/{origem?}/{entrega?}/{tempo_envio?}', 'PizzariasController@ver_historico')->name('ver_historico');
    Route::get('/cadastrareimprimir/{cod_pedido?}', 'PizzariasController@cadastrareimprimir')->name('cadastrareimprimir');
});
