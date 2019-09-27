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
        $sobremesas = Controller::sobremesas($this->cod_pizzarias);
        return view('home.index', ['sobremesas'=>$sobremesas,'bebidasMaisPedidas'=>$bebidasMaisPedidas,'maisPedidas'=>$maisPedidas,'combos' => $combos, 'pizzas' => $pizzas]);
    }


    public function state(Request $request){
        $pizzarias = IpiPizzaria::where('ativa','1')->where('estado','LIKE','%'.$this->storeState)->get();
        return view('home.state',['pizzas'=>$pizzarias,'estado'=>$request->route('state')]);
    }

    public function lojas(){
        $pizzarias = IpiPizzaria::where('ativa','1')->where('estado','LIKE','%'.$this->storeState)->get();
        return view('home.state',['pizzas'=>$pizzarias,'estado'=>'']);
    }
}
