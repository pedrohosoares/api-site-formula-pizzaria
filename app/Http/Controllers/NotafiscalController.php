<?php

namespace App\Http\Controllers;

use App\Models\IpiPedido;

class NotafiscalController extends Controller
{
    protected $producao = "https://api.focusnfe.com.br";
    protected $homologacao = "http://homologacao.acrasnfe.acras.com.br";
    public $referencia;
    
    //GERAL
    public $cnpj;
    public $natureza_operacao;
    public $data_emissao;
    public $presenca_comprador;
    public $informacoes_adicionais_contribuinte;
    public $cnpj_emitente;
    public $origem;

    

    public function cria_nfce(){
        //POST / v2/nfce?ref=REFERENCIA
    }
    
    public function consulta_nfce(){
        //get /v2/nfce/REFERENCIA
    }

    public function cancela_nfce(){
        //DELETE 	/v2/nfce/REFERENCIA
    }
    public function envia_email_nfce(){
        //POST 	/v2/nfce/REFERENCIA/email
    }
    public function inutiliza_numeracao(){
        //POST /v2/nfce/inutilizacao
    }

   
}
