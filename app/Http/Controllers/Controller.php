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

    public function selectSobremesas($cod_pizzarias)
    {
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_bebidas.cod_tipo_bebida', '8')
            ->get()
            ->groupBy('bebida');
    }

    public function buscaPizzas($cod_pizzarias, $whereNotIn = null, $where = null)
    {
        $busca = DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas', 'ipi_pizzas.foto_grande', 'ipi_pizzas.pizza', 'ipi_pizzas_ipi_tamanhos.preco', 'ipi_tamanhos.tamanho'])
            ->leftJoin('ipi_tipo_pizza', 'ipi_pizzas.cod_tipo_pizza', 'ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos', 'ipi_pizzas.cod_pizzas', 'ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos', 'ipi_pizzas_ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $cod_pizzarias);
        if (!empty($whereNotIn)) {
            $busca = $busca->whereNotIn('ipi_tipo_pizza.cod_tipo_pizza', $whereNotIn);
        }
        if (!empty($where)) {
            $busca = $busca->whereIn('ipi_tipo_pizza.cod_tipo_pizza', $where);
        }
        $busca = $busca->get()->groupBy('pizza');
        return $busca;
    }

    public function escolherBebidas($cod_pizzarias, $whereNotIn = null, $whereIn = null)
    {
        //Por as clausulas whereIn e whereNotIn
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->whereIn('ipi_bebidas.cod_bebidas', array('1', '4', '8', '31', '32'))
            ->get()
            ->groupBy('bebida');
    }

    public function selecaoBebidas($cod_pizzarias, $whereNotIn = null, $whereIn = null)
    {
        //Por as clausulas whereIn e whereNotIn
        $bebidas = DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->whereNotIn('ipi_bebidas.cod_tipo_bebida',$whereNotIn);
        $bebidas = $bebidas->get()
            ->groupBy('bebida');
        return $bebidas;
    }

    public function maisPedidas($cod_pizzarias)
    {
        return DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas', 'ipi_pizzas.foto_grande', 'ipi_pizzas.pizza', 'ipi_pizzas_ipi_tamanhos.preco', 'ipi_tamanhos.tamanho','ipi_tamanhos.cod_tamanhos'])
            ->leftJoin('ipi_tipo_pizza', 'ipi_pizzas.cod_tipo_pizza', 'ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos', 'ipi_pizzas.cod_pizzas', 'ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos', 'ipi_pizzas_ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_tipo_pizza.cod_tipo_pizza', 1)
            ->get()
            ->groupBy('pizza');
    }

    
    public function selectCombos($cod_pizzarias){
        return DB::table('ipi_combos')
        ->leftJoin('ipi_combos_produtos','ipi_combos.cod_combos','ipi_combos_produtos.cod_combos')
        ->leftJoin('ipi_combos_pizzarias','ipi_combos.cod_combos','ipi_combos_pizzarias.cod_combos')
        ->leftJoin('ipi_combos_produtos_pizzas','ipi_combos_produtos.cod_combos_produtos','ipi_combos_produtos_pizzas.cod_combos_produtos')
        ->where('ipi_combos_pizzarias.cod_pizzarias',$cod_pizzarias)
        ->where('ipi_combos.situacao','ATIVO')
        ->get()
        ->groupBy('nome_combo');
    }

    public function selectIngredientes($cod_pizzas){
        return DB::table('ipi_ingredientes')
        ->leftJoin('ipi_ingredientes_ipi_pizzas','ipi_ingredientes_ipi_pizzas.cod_ingredientes','ipi_ingredientes.cod_ingredientes')
        ->where('ipi_ingredientes_ipi_pizzas.cod_pizzas',$cod_pizzas)
        ->get();
    }

    public function selectBorda($cod_tamanho,$cod_pizzarias){
        return DB::table('ipi_bordas')
        ->select(['ipi_bordas.borda','ipi_bordas.cod_bordas','ipi_tamanhos_ipi_bordas.preco'])
        ->leftJoin('ipi_tamanhos_ipi_bordas','ipi_tamanhos_ipi_bordas.cod_bordas','ipi_bordas.cod_bordas')
        ->where('ipi_tamanhos_ipi_bordas.cod_tamanhos',$cod_tamanho)
        ->where('ipi_tamanhos_ipi_bordas.cod_pizzarias',$cod_pizzarias)
        ->get();
    }
    
}
