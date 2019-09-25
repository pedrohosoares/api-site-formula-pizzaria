<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


use App\Models\IpiCombo;
use App\Models\IpiCombosPizzaria;
use App\Models\IpiCombosProduto;
use App\Models\IpiCombosProdutosBebida;
use App\Models\IpiCombosProdutosBorda;
use App\Models\IpiCombosProdutosPizza;

use App\Models\IpiPizza;
use App\Models\IpiPizzasIpiTamanho;
use App\Models\IpiIngredientesIpiPizza;

class HomeController extends Controller
{
    public $pizzaria = 3;


    public function home(){
        
    }

    public function index(){
        $pizzas = $combos = array();
        //$pizzas = IpiPizzasIpiTamanho::where('cod_pizzarias',$this->pizzaria)->limit(1)->get();
        //$combos = IpiCombo::where('situacao','ATIVO')->get();
        return view('home.index_home',['combos'=>$combos,'pizzas'=>$pizzas]);
    }

    public function combos($nome = null){

    }


    public function lojas(){
        
    }

    public function loja(){
        
    }
}
