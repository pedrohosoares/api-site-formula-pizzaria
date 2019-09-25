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
        $loja = IpiPizzaria::where('slug', $request->route('name'))->where('estado', Str::upper($request->route('state')))->select(['cod_pizzarias'])->first();
        $this->cod_pizzarias = $loja->cod_pizzarias;
        View::share(
            [
            'cod_pizzarias'=>$this->cod_pizzarias,
            'storeState'=>$this->storeState,
            'storeName'=>$this->storeName
            ]
        );
    }

    public function index()
    {
        $pizzas = $combos = array();
        $pizzasCruas = IpiPizzasIpiTamanho::where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $this->cod_pizzarias)->limit(39)->get();

        foreach ($pizzasCruas as $pizza) {
            $pizzas[$pizza->ipi_pizza->cod_pizzas] = array(
                'pizza'=>$pizza->ipi_pizza->pizza,
                'cod_pizzas' => $pizza->ipi_pizza->cod_pizzas,
                'foto_grande' => $pizza->ipi_pizza->foto_grande,
                'foto_pequena' => $pizza->ipi_pizza->foto_pequena,
                'tamanhos' => array()
            );
        }
        foreach ($pizzasCruas as $pizza) {
            foreach($pizza->ipi_pizza->ipi_ingredientes as $ingredientes){
                $ingrediente[] = $ingredientes->ingrediente;
            }
            $pizzas[$pizza->ipi_pizza->cod_pizzas]['tamanhos'][] = array(
                'tamanho' => $pizza->ipi_tamanho->tamanho,
                'preco' => $pizza->preco,
                'cod_tamanho' => $pizza->ipi_tamanho->cod_tamanhos,
                'ingredientes'=>$ingrediente
            );
        }
        
        return view('home.index', ['combos' => $combos, 'pizzas' => $pizzas]);
    }
}
