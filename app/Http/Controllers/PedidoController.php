<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\IpiPizzaria;

/*
    Models for pedidos
*/
use App\Models\IpiPedido;
use App\Models\IpiPedidoMinimo;
use App\Models\IpiPedidosAdicionai;
use App\Models\IpiPedidosBebida;
use App\Models\IpiPedidosBorda;
use App\Models\IpiPedidosCombo;
use App\Models\IpiPedidosDetalhesPg;
use App\Models\IpiPedidosFormasPg;
use App\Models\IpiPedidosFraco;
use App\Models\IpiPedidosInfo;
use App\Models\IpiPedidosIngrediente;
use App\Models\IpiPedidosIpiCupon;
use App\Models\IpiPedidosIpiEnquete;
use App\Models\IpiPedidosMotivoCancelamento;
use App\Models\IpiPedidosPagTemp;
use App\Models\IpiPedidosPizza;
use App\Models\IpiPedidosSituaco;
use App\Models\IpiPedidosTaxa;
use App\Models\IpiCaixaIpiPedido;



class PedidoController extends PizzaController
{


    public function peddingNew($token,$status){
        $pizzaria = DB::table('ipi_pedidos')
        ->select(['ipi_pedidos.cod_pedidos','ipi_pedidos.situacao','ipi_pedidos.origem_pedido','ipi_pedidos.impressao_cancelado','ipi_pedidos.reimpressao'])
        ->leftJoin('ipi_pizzarias','ipi_pedidos.cod_pizzarias','=','ipi_pizzarias.cod_pizzarias')
        ->where('ipi_pizzarias.token_loja','=',$token)
        ->where('ipi_pedidos.situacao','=',$status)
        ->orWhere(function($query) use ($token){
            $query->where('ipi_pedidos.impressao_cancelado','=',1)
            ->where('ipi_pizzarias.token_loja','=',$token)
            ->orWhere('ipi_pedidos.reimpressao','=',1)
            ->where('ipi_pizzarias.token_loja','=',$token);
        })
        ->limit(1)->get();
        return $pizzaria;
    }


    /*
    * @field
    *  - impressao_cancelado 0 ou 1
    *  - reimpressao 0 ou 1
    *  - situacao IMPRESSO,CANCELADO,BAIXADO ETC...
    *  @status
    *  - IMPRESSO
    *  - CANCELADO
    *  - BAIXADO
    *  - 
    */


    public function ajaxBordas($cod_tamanho,$cod_pizzaria){
       return  Controller::selectBorda($cod_tamanho,$cod_pizzaria);
    }

    public function ajaxIngredientes($cod_pizzas){
        return Controller::selectIngredientes($cod_pizzas);
    }

    public function ajaxIngredientesAdicionais($cod_pizzaria,$cod_tamanho){
        return Controller::selectIngredientesAdicionais($cod_pizzaria,$cod_tamanho);
    }

    public function sendStatus($token,$field,$status,$id){
        $pizzarias = DB::table('ipi_pizzarias')->select('cod_pizzarias')->where('token_loja','=',$token)->first();
        if(!empty($pizzarias)){
            DB::table('ipi_pedidos')->where('cod_pedidos',$id)
            ->update([$field=>$status]);
        }
    }

    public function getPizzasMaisPedidas(){
        $maisPedidas = IpiPedido::limit(5)->get();
        return $maisPedidas;
    }

    public function getMaisPedidasiFood(){

    }
}
