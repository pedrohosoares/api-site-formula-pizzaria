<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use App\Models\IpiTamanho;
use App\Models\IpiPizza;
use App\Models\IpiPizzasIpiTamanho;
use App\Models\IpiIngredientesIpiPizza;
use Illuminate\Support\Facades\DB;

class PizzaController extends TamanhoController
{



    public function getPizzas($id = null){
        $tamanho = "";
        if(!empty($id)){
            $tamanho = IpiTamanho::where('cod_tamanhos',$id)->get();
        }else{
            $tamanho = IpiTamanho::get();
        }
        return $tamanho;
    }

    public function getNumeroSabor($cod_tamanhos = null,$cod_pizzarias = null){
        $fracoes = DB::table('ipi_tamanhos_ipi_fracoes');
        if(!empty($cod_tamanhos)){
            $fracoes = $fracoes->where('cod_tamanhos',$cod_tamanhos);
        }
        if(!empty($cod_pizzarias)){
            $fracoes = $fracoes->where('cod_pizzarias',$cod_pizzarias);
        }
        $fracoes = $fracoes->leftJoin('ipi_fracoes','ipi_tamanhos_ipi_fracoes.cod_fracoes','=','ipi_fracoes.cod_fracoes')->get();
        return $fracoes;
    }

    public function getSabor($cod_tamanhos = null ,$cod_pizzaria = null){
        $sabor = DB::table('ipi_pizzas_ipi_tamanhos')
        ->leftJoin('ipi_pizzas','ipi_pizzas.cod_pizzas','=','ipi_pizzas_ipi_tamanhos.cod_pizzas');
        if(!empty($cod_tamanhos)){
            $sabor = $sabor->where('ipi_pizzas_ipi_tamanhos.cod_tamanhos',$cod_tamanhos);
        }
        if(!empty($cod_pizzaria)){
            $sabor = $sabor->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias',$cod_pizzaria);
        }
        $sabor = $sabor->get();
        return $sabor;
    }

    public function getCorte($cod_tamanhos = null){
        $fracoes = DB::table('ipi_tamanhos_ipi_opcoes_corte');
        if(!empty($cod_tamanhos)){
            $fracoes = $fracoes->where('ipi_tamanhos_ipi_opcoes_corte.cod_tamanhos',$cod_tamanhos);
        }
        $fracoes = $fracoes->leftJoin('ipi_opcoes_corte','ipi_tamanhos_ipi_opcoes_corte.cod_opcoes_corte','=','ipi_opcoes_corte.cod_opcoes_corte')->get();
        return $fracoes;
    }

    public function getBorda($cod_tamanhos = null,$cod_pizzarias = null){
        $borda = DB::table('ipi_tamanhos_ipi_bordas');
        if(!empty($cod_bordas)){
            $borda = $borda->get();
        }
        if(!empty($cod_tamanhos)){
            $borda = $borda->where('ipi_tamanhos_ipi_bordas.cod_tamanhos',$cod_tamanhos);
        }
        if(!empty($cod_pizzarias)){
            $borda = $borda->where('ipi_tamanhos_ipi_bordas.cod_pizzarias',$cod_pizzarias);
        }
        $borda = $borda->leftJoin('ipi_bordas','ipi_bordas.cod_bordas','=','ipi_tamanhos_ipi_bordas.cod_bordas');
        $borda = $borda->get();
        return $borda;
    }
}
