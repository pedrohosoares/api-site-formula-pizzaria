<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IpiBebida;
use App\Models\IpiBebidasIpiConteudo;
use App\Models\IpiTipoBebida;

class BebidaController extends Controller
{
    public function getBebidas(Request $bebida,$limit = 20){
        $bebidas = IpiBebida::limit($limit)->get();
        return $bebidas;
    }
}
