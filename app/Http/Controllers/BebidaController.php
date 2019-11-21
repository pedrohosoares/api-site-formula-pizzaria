<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IpiBebida;
use App\Models\IpiBebidasIpiConteudo;
use App\Models\IpiTipoBebida;
use Illuminate\Support\Facades\DB;

class BebidaController extends Controller
{
    public function getBebidasPizzaria($cod_pizzarias,$situacao = 'ATIVO'){
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', $situacao)
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->get()
            ->groupBy('ipi_bebidas.bebida');
    }

    public function getBebidas(Request $bebida,$limit = 20){
        $bebidas = IpiBebida::limit($limit)->get();
        return $bebidas;
    }
}
