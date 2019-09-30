<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Support\Facades\DB;
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
use App\Models\IpiPizzaria;

class LojaController extends Controller
{

    public $cod_pizzarias;
    public $storeState;
    public $storeName;

    public function __construct(Request $request)
    {
        $this->storeState = $request->route('state');
        $this->storeName = $request->route('name');
        
        $loja = IpiPizzaria::where('slug', $request->route('name'))
        ->where('estado', Str::upper($request->route('state')))
        ->select(['cod_pizzarias','nome','endereco','numero','cidade','estado','cep'])
        ->first();

        $this->cod_pizzarias = isset($loja->cod_pizzarias)?$loja->cod_pizzarias:null;
        
        View::share(
            [
            'loja'=>$loja,
            'cod_pizzarias'=>$this->cod_pizzarias,
            'storeState'=>$this->storeState,
            'storeName'=>$this->storeName
            ]
        );
    }

    //Página do lojista
    public function index()
    {
        $pizzas = $combos = array();
        $maisPedidas = Controller::maisPedidas($this->cod_pizzarias);
        $bebidasMaisPedidas = Controller::escolherBebidas($this->cod_pizzarias);
        $sobremesas = Controller::selectSobremesas($this->cod_pizzarias);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>$bebidasMaisPedidas,'maisPedidas'=>$maisPedidas,'combos' => $combos, 'pizzas' => $pizzas]);
    }

    public function combos(){

        $sobremesas = $pizzas = $bebidasMaisPedidas = $maisPedidas = array();
        $combos = Controller::selectCombos($this->cod_pizzarias);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>$bebidasMaisPedidas,'maisPedidas'=>$maisPedidas,'combos' => $combos, 'pizzas' => $pizzas]);
    
    }

    public function pizzas(){
        $sobremesas = $combos = array();
        $pizzas = Controller::buscaPizzas($this->cod_pizzarias,['5','7','8']);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>array(),'maisPedidas'=>array(),'combos' => $combos, 'pizzas' => $pizzas,'nameTitle'=>'Pizzas']);
    }

    public function sanduiches(){
        $sobremesas = $combos = array();
        $sanduiches = Controller::buscaPizzas($this->cod_pizzarias,null,['7']);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>array(),'maisPedidas'=>array(),'combos' => $combos, 'pizzas' => $sanduiches,'nameTitle'=>'Fórmula Lanche']);
    }

    public function calzone(){
        $sobremesas = $combos = array();
        $calzone = Controller::buscaPizzas($this->cod_pizzarias,null,['5','8']);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>array(),'maisPedidas'=>array(),'combos' => $combos, 'pizzas' => $calzone,'nameTitle'=>'Calzones']);
    }

    public function bebidas(){
        $calzone = $sobremesas = $combos = array();
        $bebidas = Controller::selecaoBebidas($this->cod_pizzarias,['7','8','9']);
        return view('home.index', ['bebidas'=>$bebidas,'sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>array(),'maisPedidas'=>array(),'combos' => $combos, 'pizzas' => $calzone,'nameTitle'=>'Calzones']);
    }

    public function state(Request $request){
        $pizzarias = IpiPizzaria::where('ativa','1')->where('estado','LIKE','%'.$this->storeState)->get();
        return view('home.state',['pizzas'=>$pizzarias,'estado'=>$request->route('state')]);
    }

    public function sobremesas(){
        $pizzas = $maisPedidas = $combos = $bebidasMaisPedidas = array();
        $sobremesas = Controller::selectSobremesas($this->cod_pizzarias);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>$bebidasMaisPedidas,'maisPedidas'=>$maisPedidas,'combos' => $combos, 'pizzas' => $pizzas]);
    }

    public function lojas(){
        $pizzarias = IpiPizzaria::where('ativa','1')->where('estado','LIKE','%'.$this->storeState)->get();
        return view('home.state',['pizzas'=>$pizzarias,'estado'=>'']);
    }
}
