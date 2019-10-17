<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class IfoodController extends Controller
{


    /*
        A API é baseado no OPAuth2
        @client_id
        @client_secret
    */

    protected $client_id = "formulasys";
    protected $client_secret = "AFjM4%24U";
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
    public $externalCode;

    public $polling;
    public $acknowledgment;

    //CURL CRUDE DATA
    public $curlUrl;
    public $curlBody;
    public $curlHttp;
    public $curlDataPass = array();
    public $curlHeader = array();
    public $curlType = 1; //1 para POST 0 para GET
    public $curlPostData;
    public $curlPut = false;

    public function __construct(Request $request){
        $this->leAccessToken();
    }

    protected function verificaHttp(){
        $retorno = false;
        if($this->curlHttp == 401){
            $retorno = true;
        }
        return $retorno;
    }

    protected function renovaToken(){
        if($this->curlHttp == 401){
            $this->oAuthToken();
        }
    }

    public function curlPost()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, $this->curlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, $this->curlType);
        if(!empty($this->curlPostData)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->curlPostData);
        }
        if($this->curlPut){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->curlHeader);
        $this->curlBody = curl_exec($ch);
        $this->curlHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function salvarAccessTokenTxt()
    {
        $salvo = false;
        try {
            Storage::put('ifood/token.txt', $this->access_token);
            $salvo = true;
        } catch (\Throwable $th) { }
        return $salvo;
    }

    public function view_access_token(){
        dump(Storage::disk("local")->exists('ifood/token.txt'));
    }

    public function leAccessToken()
    {
        $existeArquivo = Storage::disk("local")->exists('ifood/token.txt');
        if($existeArquivo){
            $token = File::get(storage_path('app/ifood/token.txt'));
            $token = json_decode($token, true);
            if (isset($token['access_token'])) {
                $this->access_token = $token['access_token'];
            }else{
                $this->oAuthToken();    
            }
        }else{
            $this->oAuthToken();
        }
    }

    //AUTENTICA NO IFOOD
    public function oAuthToken()
    {
        $this->curlDataPass = 'client_id=' . $this->client_id . '&client_secret=' . $this->client_secret . '&username=' . $this->username . '&password=' . $this->password . '&grant_type=' . $this->grant_type;
        $this->curlUrl = "https://pos-api.ifood.com.br/oauth/token?" . $this->curlDataPass;
        $this->curlPost();
        if ($this->curlHttp == 200) {
            //SALVAR ACCESS_TOKEN
            $this->access_token = $this->curlBody;
            $this->salvarAccessTokenTxt();
        }
    }

    //VERIFICA PEDIDOS DE UM CORRELATION ID
    public function orders()
    {
        $this->curlUrl = 'https://pos-api.ifood.com.br/v2.0/orders/' . $this->correlationid . '?access_token=' . $this->access_token;
        $this->curlPost();
        $this->curlBody = json_decode($this->curlBody, true);
    }

    public function proccessaDados()
    {
        foreach ($this->polling as $i => $v) {
            if ($v['code'] == 'PLACED') {
                $this->correlationid = $v['correlationId'];
                $this->orders();
                $json = json_decode($this->curlBody, true);
                $this->merchant_id = $json['merchant']['id'];
            }
        }
    }

    public function polling()
    {
        $this->leAccessToken();
        $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/events%3Apolling?access_token=' . $this->access_token;
        $this->curlType = 0;
        $this->curlPost();
        if ($this->curlHttp != 404) {
            $this->polling = json_decode($this->curlBody);
        } else {
            $this->oAuthToken();
        }
    }

    public function rejection()
    {
        //NÃO RETORNA EVENTO
    }





    ########################## GERENCIAR O RESTAURANTE #################################




    ########################## CATEGORIAS #############################

    
    public $categoria;
    public $availability;
    public $categoriesName;
    public $categoriesOrder;
    public $categoriesId;
    public $template;

    protected function addCategoria()
    {
        $this->curlType = 1;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/categories?access_token=".$this->access_token;
        $this->categoriesName = str_replace('-',' ',$this->categoriesName);
        $this->curlPostData = array(
            "merchantId"=>$this->merchant_id,
            "availability"=>$this->availability,
            "name"=>$this->categoriesName,
            "order"=>$this->categoriesOrder,
            "template"=>$this->template,
            "externalCode"=>$this->externalCode
        );
        $this->curlHeader = array(
            "Content-Type: application/json"
        );
        $this->curlPostData = json_encode($this->curlPostData,true);
        $this->curlPost();
    }

    public function cadastrar_categoria($merchant_id,$availability,$name,$order,$template,$externalCode){
        $this->merchant_id = $merchant_id;
        $this->availability = $availability;
        $this->categoriesName = $name;
        $this->categoriesOrder = $order;
        $this->template = $template;
        $this->externalCode = $externalCode;
        $this->addCategoria();
        //Se o token estiver errado
        if($this->verificaHttp()){
            $this->oAuthToken();
            $this->addCategoria();
        }
    }

    public function listarCategorias($merchant_id){
        if(empty($this->merchant_id)){
            $this->merchant_id = $merchant_id;
        }
        $this->curlType = 1;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/".$this->merchant_id."/menus/categories?access_token=".$this->access_token;
        $this->curlPost();
        dump($this->curlBody);
        $this->curlBody = json_decode($this->curlBody,true);
        if(isset($this->curlBody['error'])){
            $this->oAuthToken();        
            $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/".$this->merchant_id."/menus/categories?access_token=".$this->access_token;
            $this->curlPost();
            $this->curlBody = json_decode($this->curlBody,true);
        }
        dump($this->curlBody);
        return json_encode($this->curlBody,true);
    }

    //COM PROBLEMA
    public function alterarCategorias($merchant_id,$availability,$name,$order,$template,$externalCode){
        $this->curlPut = true;
        $this->merchant_id = $merchant_id;
        $this->availability = $availability;
        $this->categoriesName = $name;
        $this->categoriesOrder = $order;
        $this->template = $template;
        $this->externalCode = $externalCode;
        $this->addCategoria();
        //Se o token estiver errado
        $this->curlBody = json_decode($this->curlBody,true);
        if(isset($this->curlBody['error'])){
            $this->oAuthToken();
            $this->addCategoria();
        }
        $this->curlPut = false;
    }


    ############################## FIM CATEGORIAS #################################

    public function pegaItens($merchant_id,$categoria_id){
        $this->merchant_id = $merchant_id;
        $this->categoriesId = $categoria_id;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/".$this->merchant_id."/menus/categories/".$this->categories;
        $this->curlPost();
        $this->curlBody = json_decode($this->curlBody,true);
        if(isset($this->curlBody['error'])){

        }
    }




}
