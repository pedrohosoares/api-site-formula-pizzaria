<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IfoodController extends Controller
{

    
    /*
        A API é baseado no OPAuth2
        @client_id
        @client_secret
    */

    /*
        AS CREDENCIAIS DO RESTAURANTE SÃO FIXAS
        ELAS PODEM SER DE N PARA M OU N PARA 1
        OU SEJA, TODAS LOJAS PARA UMA CREDENCIAL 
        OU CADA LOJA TER SUA PRÓPRIA CREDENCIAL
    */
    protected $client_id = "formulasys";
    protected $client_secret = 'AFjM4%24U';
    protected $grant_type = "password";
    protected $username = "POS-2410924853";
    protected $password = "POS-2410924853";
    public $access_token;

    //ID DO RESTAURANTE
    public $merchant_id;
    //DADOS DE PEDIDO ESPECIFICO DO IFOOD
    public $order;
    //REFERENCIA DO PEDIDO
    public $correlationid;

    //CURL CRUDE DATA
    public $curlUrl;
    public $curlBody;
    public $curlHttp;
    public $curlDataPass = array();
    public $curlHeader = array();

    public function curlPost()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, $this->curlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->curlHeader);
        $this->curlBody = curl_exec($ch);
        $this->curlHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function salvarAccessTokenTxt(){
        Storage::put('ifood/token.txt',$this->access_token);
    }

    //AUTENTICA NO IFOOD
    public function oAuthToken()
    {
        $this->curlDataPass = http_build_query(
            array(
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type' => $this->grant_type,
                'password' => $this->password,
                'username' => $this->username
            )
        );
        $this->curlHeader = array(
            'Content-Type: multipart/form-data'
        );
        $this->curlUrl = "https://pos-api.ifood.com.br/oauth/token/?".$this->curlDataPass;
        $this->curlPost();
        //SALVAR ACCESS_TOKEN
        //salvarAccessTokenTxt()
    }

    //VERIFICA PEDIDOS DE UM CORRELATION ID
    public function orders()
    {
        $this->curlUrl = 'https://pos-api.ifood.com.br/v2.0/orders/' . $this->correlationid;
        $this->curlPost();
    }

    public function polling(){

    }

    public function rejection()
    {
        //NÃO RETORNA EVENTO
    }

    
    
    
    
    ########################## GERENCIAR O RESTAURANTE #################################

    public $categoria;

    public function addCategoria(){
        //$this->curl
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/categories";
        $this->curlHttp = array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json'
        );
    
        $this->curlPost();
    }


    public 



}
