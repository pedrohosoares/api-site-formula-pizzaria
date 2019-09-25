<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\IpiPizza;
use App\Models\IpiPizzasIpiTamanho;
use App\Models\IpiIngredientesIpiPizza;

class PizzaController extends TamanhoController
{

    public function __construct(){
        
        //View::share();
    }

    public function getPizzas($limit = 20){
        $pizzas = IpiPizza::limit($limit)->get();
        return $pizzas;
    }
}
