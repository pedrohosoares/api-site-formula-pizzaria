<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IpiTamanho;
use App\Models\IpiTamanhosIpiAdicionai;
use App\Models\IpiTamanhosIpiAdicionaisEstoque;
use App\Models\IpiTamanhosIpiBorda;
use App\Models\IpiTamanhosIpiBordasEstoque;
use App\Models\IpiTamanhosIpiFraco;
use App\Models\IpiTamanhosIpiFracoesPreco;
use App\Models\IpiTamanhosIpiOpcoesCorte;
use App\Models\IpiTamanhosIpiTipoMassa;
use App\Models\IpiPizzasIpiTamanho;
use App\Models\IpiIngredientesIpiTamanho;

class TamanhoController extends Controller
{
    public function getTamanhos($limit = 10){
        $tamanhos = IpiTamanho::limit(10)->get();
        foreach($tamanhos as $v){
            dump($v->ipi_tipo_massas());
        }
        dd('fim');
        return $tamanhos;
    }
}
