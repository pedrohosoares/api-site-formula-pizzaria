<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IpiCliente;
use App\Models\IpiClientesBloqueio;
use App\Models\IpiClientesBloqueioLog;
use App\Models\IpiClientesInformacao;
use App\Models\IpiClientesIpiEnqueteResposta;
use App\Models\IpiClientesIpiEnqueteRespostasCategoriasComentario;
use App\Models\IpiClientesLog;
use App\Models\IpiClientesRedesSociai;

use App\Models\IpiEndereco;

class ClienteController extends Controller
{
    public function getCep(Request $cep){
        return IpiCliente::where('cep',$cep)->get();
    }
    
}
