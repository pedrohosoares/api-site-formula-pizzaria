<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sobremesas($cod_pizzarias){
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos','ipi_bebidas.cod_bebidas','ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_conteudos','ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias','ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao','ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias',$cod_pizzarias)
            ->where('ipi_bebidas.cod_tipo_bebida','8')
            ->get()
            ->groupBy('bebida');
    }


    public function escolherBebidas($cod_pizzarias){
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos','ipi_bebidas.cod_bebidas','ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_conteudos','ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias','ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao','ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias',$cod_pizzarias)
            ->whereIn('ipi_bebidas.cod_bebidas',array('1','4','8','31','32'))
            ->get()
            ->groupBy('bebida');
    }

    public function bebidas($cod_pizzarias){
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos','ipi_bebidas.cod_bebidas','ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_conteudos','ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias','ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos','ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao','ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias',$cod_pizzarias)
            ->get()
            ->groupBy('bebida');
    }

    public function maisPedidas($cod_pizzarias){
        return DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas','ipi_pizzas.foto_grande','ipi_pizzas.pizza','ipi_pizzas_ipi_tamanhos.preco','ipi_tamanhos.tamanho'])
            ->leftJoin('ipi_tipo_pizza','ipi_pizzas.cod_tipo_pizza','ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos','ipi_pizzas.cod_pizzas','ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos','ipi_pizzas_ipi_tamanhos.cod_tamanhos','ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias',$cod_pizzarias)
            ->where('ipi_tipo_pizza.cod_tipo_pizza',1)
            ->get()
            ->groupBy('pizza');
    }

    /*
    public function combos(){
        return DB::table('ipi_combos')
        ->leftJoin('ipi_combos_pizzarias','ipi_combos.cod_combos','ipi_combos_pizzarias.cod_combos')
        ->leftJoin('ipi_combos_pizzarias','ipi_combos.cod_combos','ipi_combos_pizzarias.cod_combos')
        ->leftJoin('ipi_combos_produtos','ipi_combos.cod_combos','ipi_combos_produtos.cod_combos')
        ->join('ipi_combos_produtos_bebidas','ipi_combos_produtos.cod_combos_produtos','ipi_combos_produtos_bebidas.cod_combos_produtos')
        ->join('ipi_combos_produtos_pizzas','ipi_combos_produtos.cod_combos_produtos','ipi_combos_produtos_pizzas.cod_combos_produtos')
        ->join('ipi_combos_produtos_bordas','ipi_combos_produtos.cod_combos_produtos','ipi_combos_produtos_bordas.cod_combos_produtos')
        ->join('ipi_combos_produtos_bordas','ipi_combos_produtos.cod_combos_produtos','ipi_combos_produtos_bordas.cod_combos_produtos')
    }
    */
}
