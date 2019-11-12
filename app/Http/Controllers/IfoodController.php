<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\IpiFormasPg;
use App\Models\IpiCliente;
use App\Models\IpiEndereco;
use App\Models\IpiPedido;
use App\Models\IpiPizzaria;
use App\Models\IpiPedidosFormasPg;

class IfoodController extends Controller
{

    public function json()
    {
        $json = '{"id":"c6e6d2f7-fdc3-4afd-841d-44adf48c4b70","reference":"7092158640749077","shortReference":"4673","createdAt":"2019-11-09T01:29:49.216Z","scheduled":false,"merchant":{"id":"88c3a6f8-86a2-4c08-8e93-f778df4f0383","shortId":"141403","name":"F\u00f3rmula Pizzaria Divin\u00f3polis","address":{"formattedAddress":"CORONEL JOAO NOTINI","country":"BR","state":"MG","city":"DIVINOPOLIS","neighborhood":"CENTRO","streetName":"CORONEL JOAO NOTINI","streetNumber":"366","postalCode":"35500017"}},"payments":[{"name":"MASTERCARD","code":"MC","value":29.4,"prepaid":true,"transaction":"11071911082206349384","issuer":"MASTERCARD","authorizationCode":"266341"}],"customer":{"id":"155428921","name":"neide avallone","phone":"0800 007 0110 ID: 52764794","ordersCountOnRestaurant":0},"items":[{"id":"db225d1f-2040-49d7-bc38-85d7c671380a","name":"Calzones","quantity":1,"price":23.9,"subItemsPrice":5.5,"totalPrice":29.4,"discount":0,"addition":0,"externalId":"80000936","externalCode":"H","subItems":[{"id":"d889a350-b030-458c-8aa5-3be4a7c9b13b","name":"Frango com Catupiry","quantity":1,"price":0,"totalPrice":0,"discount":0,"addition":0,"externalCode":"P55-6"},{"id":"b4f7b343-e830-4a97-990b-a972413fccd2","name":"Guaran\u00e1","quantity":1,"price":5.5,"totalPrice":5.5,"discount":0,"addition":0},{"id":"f813c0cd-4afd-4ff8-99bb-43890860a4ce","name":"N\u00e3o, obrigado.","quantity":1,"price":0,"totalPrice":0,"discount":0,"addition":0}]}],"subTotal":29.4,"totalPrice":37.4,"deliveryFee":8,"deliveryAddress":{"formattedAddress":"R. Arnaldo Carlos Guimar\u00e3es, 611","country":"BR","state":"MG","city":"Divinopolis","coordinates":{"latitude":-20.169075,"longitude":-44.875205},"neighborhood":"Santa Tereza","streetName":"R. Arnaldo Carlos Guimar\u00e3es","streetNumber":"611","postalCode":"00000000"},"deliveryDateTime":"2019-11-09T02:29:49.216Z","preparationStartDateTime":"2019-11-09T01:29:49.216Z","localizer":{"id":"52764794"},"preparationTimeInSeconds":0,"isTest":false,"benefits":[{"value":8,"sponsorshipValues":{"IFOOD":0,"MERCHANT":8},"target":"DELIVERY_FEE","targetId":"80000936"}],"deliveryMethod":{"id":"DEFAULT","value":8,"minTime":60,"maxTime":70,"mode":"DELIVERY","deliveredBy":"NOT_APPLICABLE"}}';
        $json = json_decode($json, true);
        dump($json);
    }

    /**
     * Loja teste
     * https://www.ifood.com.br/delivery/bujari-ac/teste-formula-system-bujari/68bb790f-e24f-4666-ad64-86baf9ca2337
     */
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
    public $createdAt;
    //REFERENCIA DO PEDIDO
    public $correlationid;
    public $externalCode;
    public $paymentSerialize = '';

    public $polling;
    public $acknowledgment = array();
    public $cod_clientes;
    public $cod_enderecos;
    public $cod_pedidos;
    public $cod_pizzarias;
    public $reference;
    public $discount = 0.00;

    //CURL CRUDE DATA
    public $curlUrl;
    public $curlBody;
    public $curlHttp;
    public $curlDataPass = array();
    public $curlHeader = array();
    public $curlType = 1; //1 para POST 0 para GET
    public $curlPostData;
    public $curlReturnTransfer = 1;
    public $curlPut = false;

    public function __construct()
    {
        $this->leAccessToken();
    }

    protected function verificaHttp()
    {
        $retorno = false;
        if ($this->curlHttp == 401) {
            $retorno = true;
        }
        return $retorno;
    }

    protected function renovaToken()
    {
        if ($this->curlHttp == 401) {
            $this->oAuthToken();
        }
    }

    public function curlPost()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, $this->curlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $this->curlReturnTransfer);
        curl_setopt($ch, CURLOPT_POST, $this->curlType);
        if (!empty($this->curlPostData)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->curlPostData);
        }
        if (!empty($this->curlHeader)) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
        }
        if ($this->curlPut) {
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
            $this->access_token = json_decode($this->access_token);
            $this->access_token = $this->access_token['access_token'];
        } catch (\Throwable $th) { }
        return $salvo;
    }

    public function view_access_token()
    {
        dump(Storage::disk("local")->exists('ifood/token.txt'));
    }

    public function leAccessToken()
    {
        $existeArquivo = Storage::disk("local")->exists('ifood/token.txt');
        if ($existeArquivo) {
            $token = File::get(storage_path('app/ifood/token.txt'));
            $token = json_decode($token, true);
            if (isset($token['access_token'])) {
                $this->access_token = $token['access_token'];
            } else {
                $this->oAuthToken();
            }
        } else {
            $this->oAuthToken();
        }
    }

    //AUTENTICA NO IFOOD
    public function oAuthToken()
    {
        $this->curlType = 1;
        $this->curlDataPass = 'client_id=' . $this->client_id . '&client_secret=' . $this->client_secret . '&username=' . $this->username . '&password=' . $this->password . '&grant_type=' . $this->grant_type;
        $this->curlUrl = "https://pos-api.ifood.com.br/oauth/token?" . $this->curlDataPass;
        $this->curlPost();
        if ($this->curlHttp == 200) {
            //SALVAR ACCESS_TOKEN
            $this->access_token = $this->curlBody;
            $this->salvarAccessTokenTxt();
        }
    }

    /**
     * Pedidos 
     */

    /**
     *  Envia o ID dos pedidos para remove-los da lista
     */
    public function acknowledgment()
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, 'https://pos-api.ifood.com.br/v1.0/events/acknowledgment');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->acknowledgment, true));
        $body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

    }

    protected function registraCliente()
    {

        $this->order['customer']['taxPayerIdentificationNumber'] = isset($this->order['customer']['taxPayerIdentificationNumber']) ? $this->order['customer']['taxPayerIdentificationNumber'] : "";
        $this->order['customer']['name'] = isset($this->order['customer']['name']) ? $this->order['customer']['name'] : "";
        $cliente = array(
            'cod_onde_conheceu' => '10',
            'nome' => $this->order['customer']['name'],
            'email' => '',
            'cpf' => $this->order['customer']['taxPayerIdentificationNumber'],
            'celular' => $this->order['customer']['phone'],
            'observacao' => 'CADASTRADO PELO IFOOD',
            'sexo' => '',
            'origem_cliente' => 'NET',
            'data_hora_cadastro' => date('Y-m-d H:i:s'),
            'situacao' => 'ATIVO'
        );

        $cliente = IpiCliente::firstOrCreate(
            ['id_ifood_cliente' => $this->order['customer']['id']],
            $cliente
        );
        $this->order['deliveryAddress']['reference'] = isset($this->order['deliveryAddress']['reference']) ? $this->order['deliveryAddress']['reference'] : "";
        $this->order['deliveryAddress']['complement'] = isset($this->order['deliveryAddress']['complement']) ? $this->order['deliveryAddress']['complement'] : "";
        $endereco = array(
            'apelido' => 'Endereço Padrão',
            'endereco' => $this->order['deliveryAddress']['streetName'],
            'numero' => $this->order['deliveryAddress']['streetNumber'],
            'complemento' => $this->order['deliveryAddress']['complement'],
            'bairro' => $this->order['deliveryAddress']['neighborhood'],
            'cidade' => $this->order['deliveryAddress']['city'],
            'estado' => $this->order['deliveryAddress']['state'],
            'cep' => $this->order['deliveryAddress']['postalCode'],
            'telefone_1' => $this->order['customer']['phone'],
            'telefone_2' => $this->order['customer']['phone'],
            'edificio' => '',
            'referencia_endereco' => $this->order['deliveryAddress']['reference'],
            'referencia_cliente' => '',
            'obs_endereco' => $this->order['deliveryAddress']['reference']
        );
        $endereco = IpiEndereco::firstOrCreate(
            ['cod_clientes' => $cliente->cod_clientes],
            $endereco
        );
        $this->cod_enderecos = $endereco->cod_enderecos;
        $this->cod_clientes = $cliente->cod_clientes;
    }

    protected function cadastraPedido()
    {

        $dadosBD = array(
            'polling' => $this->polling,
            'reference' => $this->correlationid,
            'order' => $this->order
        );
        $dadosBD = json_encode($dadosBD);

        $pedido = [
            'cod_clientes' => $this->cod_clientes,
            'cod_pizzarias' => $this->cod_pizzarias,
            'cod_usuarios_pedido' => $this->cod_clientes,
            'data_hora_pedido' => $this->createdAt,
            'valor' => $this->order['subTotal'],
            'valor_entrega' => $this->order['deliveryFee'],
            'valor_comissao_frete' => '0.00',
            'desconto' => '0.00',
            'valor_total' => $this->order['totalPrice'],
            'situacao' => 'NOVO',
            'forma_pg' => '',
            'nome_cliente' => $this->order['customer']['name'],
            'endereco' => $this->order['deliveryAddress']['streetName'],
            'numero' => $this->order['deliveryAddress']['streetNumber'],
            'complemento' => $this->order['deliveryAddress']['complement'],
            'bairro' => $this->order['deliveryAddress']['neighborhood'],
            'cidade' => $this->order['deliveryAddress']['city'],
            'estado' => $this->order['deliveryAddress']['state'],
            'cep' => $this->order['deliveryAddress']['postalCode'],
            'telefone_1' => $this->order['customer']['phone'],
            'telefone_2' => $this->order['customer']['phone'],
            'referencia_endereco' => $this->order['deliveryAddress']['complement'],
            'referencia_endereco' => $this->order['deliveryAddress']['complement'],
            'tipo_entrega' => 'Entrega',
            'horario_agendamento' => date('H:i:s', strtotime('00:00:00')),
            'origem_pedido' => 'IFOOD',
            'obs_pedido' => 'Pedido feito pelo IFOOD',
            'data_hora_inicial' => $this->createdAt,
            'cpf' => $this->order['customer']['taxPayerIdentificationNumber'],
            'ifood_polling' => $this->order['reference'],
            'ifood_status' => 'INICIO',
            'pedido_ifood_json' => $dadosBD,
            'pedido_integrado' => '1'
        ];
        $pedido = IpiPedido::updateOrCreate(
            ['ifood_polling' => $this->order['reference']],
            $pedido
        );
        $this->cod_pedidos = $pedido->cod_pedidos;
    }

    /**
     * CADASTRA NOVO MEIO PAGAMENTO
     */
    protected function cadastraAtualizaMeioPagamento($pagamento)
    {
        $formaPg = IpiFormasPg::select(['cod_formas_pg'])->where('cod_formas_pg_ifood', $pagamento['code'])->first();
        if (empty($formaPg)) {
            $formaPg = IpiFormasPg::create(
                [
                    'cod_formas_pg_ifood' => $pagamento['code'],
                    'forma_pg' => $pagamento['name']
                ]
            );
        }
        return $formaPg->cod_formas_pg;
    }

    /**
     * PROCESSA PAGAMENTO
     */
    public function processaPagamentos()
    {

        $pagamentos = $this->order['payments'];
        foreach ($pagamentos as $i => $v) {
            $formaPagamento = $this->cadastraAtualizaMeioPagamento($v);
            $forma_pg = IpiPedidosFormasPg::firstOrCreate(
                array(
                    'pagamento_json' => json_encode($v),
                    'cod_pedidos' => $this->cod_pedidos,
                ),
                array(
                    'cod_pedidos' => $this->cod_pedidos,
                    'valor' => $v['value'],
                    'prepago' => $v['prepaid'],
                    'pagamento_json' => json_encode($v),
                    'cod_formas_pg' => $formaPagamento
                )
            );
            $this->paymentSerialize .= $v['name'] . ', ';
        }

        $this->paymentSerialize = substr($this->paymentSerialize, 0, strlen($this->paymentSerialize) - 2);

        /**
         * ATUALIZA ipi_pedidos
         */

        $pedidos = IpiPedido::find($this->cod_pedidos);
        $pedidos->forma_pg = $this->paymentSerialize;
        $pedidos->save();
    }

    /**
     * RECUPERA PIZZARIA
     */
    protected function recuperaPizzaria()
    {
        $pizzaria = IpiPizzaria::select('cod_pizzarias')->where('merchant_id', 'LIKE', '%' . $this->merchant_id . '%')->first();
        $this->cod_pizzarias = $pizzaria->cod_pizzarias;
    }

    /** 
     * VERIFICA PEDIDOS DE UM CORRELATION ID
     */
    public function orders()
    {
        $this->curlUrl = 'https://pos-api.ifood.com.br/v3.0/orders/' . $this->correlationid . '?access_token=' . $this->access_token;
        $this->curlPost();
        $this->order = json_decode($this->curlBody, true);
        $this->merchant_id = $this->order['merchant']['shortId'];
        $this->reference = $this->order['reference'];
        $this->recuperaPizzaria();
        //$dadosBD = '{"polling":[{"id":"22323f72-842f-455c-979b-5fa6d56acfb5","code":"PLACED","correlationId":"6193176434464066","createdAt":"2019-10-21T15:44:40.409Z"}],"reference":"6193176434464066","order":{"id":"c2976349-3665-4a25-b4ab-453363683b69","reference":"6193176434464066","shortReference":"5728","createdAt":"2019-10-21T15:44:39.902Z","scheduled":false,"type":"DELIVERY","merchant":{"id":"68bb790f-e24f-4666-ad64-86baf9ca2337","shortId":"208040","name":"TESTE Formula System","address":{"formattedAddress":"RAMAL BUJARI","country":"BR","state":"AC","city":"BUJARI","neighborhood":"bujari","streetName":"RAMAL BUJARI","streetNumber":"123","postalCode":"69923000"}},"payments":[{"name":"D\u00c9BITO - MASTERCARD (M\u00c1QUINA)","code":"MEREST","value":89.6,"prepaid":false}],"customer":{"id":"109125238","name":"PEDIDO DE TESTE - Pedro Henrique","taxPayerIdentificationNumber":"11427599629","phone":"0800 007 0110 ID: 20787445","ordersCountOnRestaurant":0},"items":[{"id":"eaa65d78-0720-4d9f-ad25-83c23a24efe7","name":"PEDIDO DE TESTE - Pizza novo cadastro de adicional","quantity":1,"price":0,"subItemsPrice":69.6,"totalPrice":69.6,"discount":0,"addition":0,"externalCode":"H","subItems":[{"id":"e5fe43a7-12f7-40d8-9e50-9e5d4bc962cb","name":"Borda Catupiry","quantity":1,"price":6,"totalPrice":6,"discount":0,"addition":0,"externalCode":"R1"},{"id":"3cd9379b-a491-464d-a499-2aa8e42ff917","name":"Bacon","quantity":1,"price":4,"totalPrice":4,"discount":0,"addition":0},{"id":"11e1da52-6715-4cdc-8250-3db2668c20f4","name":"Fanta","quantity":1,"price":10.9,"totalPrice":10.9,"discount":0,"addition":0},{"id":"da7c8e85-8f76-4df9-a464-afab54e23ad9","name":"2 mousses","quantity":1,"price":13.8,"totalPrice":13.8,"discount":0,"addition":0},{"id":"7a66574b-259f-46db-ad2d-9d6b554e65d9","name":"4 queijos","quantity":1,"price":16.45,"totalPrice":16.45,"discount":0,"addition":0},{"id":"fefcccfd-604b-4b9a-90a2-c9023bae6958","name":"A moda","quantity":1,"price":18.45,"totalPrice":18.45,"discount":0,"addition":0}]}],"subTotal":69.6,"totalPrice":89.6,"deliveryFee":20,"deliveryAddress":{"formattedAddress":"PEDIDO DE TESTE - N\u00c3O ENTREGAR - R. Divina Luz, 61","country":"BR","state":"AC","city":"Bujari","coordinates":{"latitude":-9.825868,"longitude":-67.948632},"neighborhood":"Amendoa","streetName":"PEDIDO DE TESTE - N\u00c3O ENTREGAR - R. Divina Luz","streetNumber":"61","postalCode":"00000000","reference":"Em cima do poste","complement":"Bloco"},"deliveryDateTime":"2019-10-21T16:04:39.902Z","preparationStartDateTime":"2019-10-21T15:44:39.902Z","localizer":{"id":"20787445"},"preparationTimeInSeconds":0,"isTest":true}}';
        $this->registraCliente();
        $this->cadastraPedido();
        $this->processaPagamentos();
        $this->integration();
        $this->confirmation();
    }

    public function proccessaPolling()
    {
        foreach ($this->polling as $i => $v) {
            $this->id = $v['id'];
            $this->correlationid = $v['correlationId'];
            $this->createdAt = date('Y-m-d H:i:s', strtotime($v['createdAt']));
            $this->code = $v['code'];
            if($this->code == 'PLACED'){
                $this->orders();
            }
            //PLACED
            //CANCELLATION_REQUESTED
            //CANCELLED
            //CANCELLATION_REQUEST_FAILED
            //Outros status
            $this->acknowledgment[] = array('id' => $this->id);
        }
        $this->acknowledgment();
    }

    public function polling()
    {
        $this->leAccessToken();
        $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/events%3Apolling?access_token=' . $this->access_token;
        $this->curlType = 0;
        $this->curlPost();

        if (!empty($this->curlBody) and ($this->curlHttp == 200) or $this->curlHttp == 201) {
            //"[{"id":"bee06149-1c26-4bf1-aef3-6983ea65c590","code":"PLACED","correlationId":"3199106436775033","createdAt":"2019-10-21T15:13:40.841Z"}]"
            $this->polling = json_decode($this->curlBody, true);
            
            $this->proccessaPolling();
        } else {
            if ($this->curlHttp != 404) {
                $this->oAuthToken();
            }
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
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/categories?access_token=" . $this->access_token;
        $this->categoriesName = str_replace('-', ' ', $this->categoriesName);
        $this->curlPostData = array(
            "merchantId" => $this->merchant_id,
            "availability" => $this->availability,
            "name" => $this->categoriesName,
            "order" => $this->categoriesOrder,
            "template" => $this->template,
            "externalCode" => $this->externalCode
        );
        $this->curlHeader = array(
            "Content-Type: application/json"
        );
        $this->curlPostData = json_encode($this->curlPostData, true);
        $this->curlPost();
    }

    public function cadastrar_categoria($merchant_id, $availability, $name, $order, $template, $externalCode)
    {
        $this->merchant_id = $merchant_id;
        $this->availability = $availability;
        $this->categoriesName = $name;
        $this->categoriesOrder = $order;
        $this->template = $template;
        $this->externalCode = $externalCode;
        $this->addCategoria();
        //Se o token estiver errado
        if ($this->verificaHttp()) {
            $this->oAuthToken();
            $this->addCategoria();
        }
    }

    public function listarCategorias($merchant_id)
    {
        if (empty($this->merchant_id)) {
            $this->merchant_id = $merchant_id;
        }
        $this->curlType = 0;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/" . $this->merchant_id . "/menus/categories?access_token=" . $this->access_token;
        $this->curlPost();
        $this->curlBody = json_decode($this->curlBody, true);
        if (isset($this->curlBody['error'])) {
            $this->oAuthToken();

            $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/" . $this->merchant_id . "/menus/categories?access_token=" . $this->access_token;
            $this->curlPost();
            $this->curlBody = json_decode($this->curlBody, true);
        }
        return json_encode($this->curlBody, true);
    }

    //COM PROBLEMA
    public function alterarCategorias($merchant_id, $availability, $name, $order, $template, $externalCode)
    {
        $this->curlPut = true;
        $this->merchant_id = $merchant_id;
        $this->availability = $availability;
        $this->categoriesName = $name;
        $this->categoriesOrder = $order;
        $this->template = $template;
        $this->externalCode = $externalCode;
        $this->addCategoria();
        //Se o token estiver errado
        $this->curlBody = json_decode($this->curlBody, true);
        if (isset($this->curlBody['error'])) {
            $this->oAuthToken();
            $this->addCategoria();
        }
        $this->curlPut = false;
    }


    ############################## FIM CATEGORIAS #################################

    public function pegaItens($merchant_id, $categoria_id)
    {
        $this->merchant_id = $merchant_id;
        $this->categoriesId = $categoria_id;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/" . $this->merchant_id . "/menus/categories/" . $this->categories;
        $this->curlPost();
        $this->curlBody = json_decode($this->curlBody, true);
        if (isset($this->curlBody['error'])) { }
    }


    ########################### PRODUTOS ################################################
    public function listaProdutosCategoria($merchant_id, $category_id)
    {
        $this->curlType = 0;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/merchants/$merchant_id/menus/categories/$category_id?access_token=" . $this->access_token;
        $this->curlPost();
        $this->curlBody = json_decode($this->curlBody, true);
    }

    //DANDO PROBLEMA
    protected function addProdutos()
    {
        $dados = json_encode(array(
            'sku' => array(
                'merchantId' => '208040',
                'availability' => 'AVAILABLE',
                'externalCode' => 'PRODUTO-NOVO',
                'name' => 'CADASTRADO PELO COMANDO',
                'description' => 'Item foi cadastrado pela linha de código',
                'order' => 1,
                'price' => array(
                    'value' => '20',
                    'promotional' => false,
                    'originalValue' => 0
                )
            )
        ));
        $this->curlType = 1;
        $this->curlUrl = "https://pos-api.ifood.com.br/v1.0/skus";
        $this->curlDataPass = $dados;
        $this->curlHeader = array(
            "Content-Type: multipart/form-data",
            "Authorization: Bearer " . $this->access_token
        );
        $this->curlPost();
    }

    public function cadastraProdutos()
    {
        $this->addProdutos();
        $this->curlBody = json_decode($this->curlBody, true);
        if (isset($this->curlBody['error']) and $this->curlBody['error'] == 'invalid_token') {
            $this->oAuthToken();
            $this->addProdutos();
        }
    }

    protected function readyToDelivery($reference)
    {
        foreach ($reference as $v) {
            $this->curlType = 1;
            $this->curlUrl = 'https://pos-api.ifood.com.br/v2.0/orders/' . $v . '/statuses/readyToDeliver';
            $this->curlHeader = array(
                'Authorization: bearer ' . $this->access_token,
                'Cache-Control: no-cache',
                'Content-Type: application/json',
            );
            $this->curlPost();
        }
    }


    public function readyToDeliveryGet(Request $request)
    {
        $reference = !empty($request->all()) ? $request->all() : array();
        $reference['reference'] = isset($reference['reference']) ? $reference['reference'] : array();
        $reference = explode(',', $reference['reference']);
        if (!empty($reference)) {
            $this->readyToDelivery($reference);
        }
    }

    /**
     * CANCELLATION REQUESTED
     */
    public function cancelarRequisicao()
    {
        $this->curlType = 1;
        $this->curlUrl = 'https://pos-api.ifood.com.br/v2.0/orders/' . $this->reference . '/statuses/cancellationRequested';
        $this->curlHeader = array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        );
        $this->curlPost();
    }

    /**
     * PRONTO PARA RETIRADA
     */
    public function delivery()
    {
        $this->curlType = 1;
        $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/orders/' . $this->reference . '/statuses/delivery';
        $this->curlHeader = array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        );
        $this->curlPost();
    }


    public function confirmation()
    {
        $this->curlReturnTransfer = 0;
        $this->curlType = 1;
        $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/orders/' . $this->correlationid . '/statuses/confirmation';
        $this->curlHeader = array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        );
        $this->curlPost();
        $this->curlReturnTransfer = 1;
    }

    public function confirmationget($reference)
    {
        $this->correlationid = $reference;
        $this->confirmation();
    }

    public function integration()
    {
        $this->curlReturnTransfer = 0;
        $this->curlType = 1;
        $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/orders/' . $this->correlationid . '/statuses/integration';
        $this->curlHeader = array(
            'Authorization: bearer ' . $this->access_token,
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        );
        $this->curlPost();
        $this->curlReturnTransfer = 1;
    }

    public function integrationget($reference)
    {
        $this->correlationid = $reference;
        $this->integration();
    }

    public function dispatchIfood($ids)
    {

        $reference = explode(',', $ids);
        if (!empty($reference)) {
            $this->dispatch($reference);
        }
    }

    protected function dispatch($reference)
    {

        foreach ($reference as $v) {
            $this->correlationid = $v;
            $this->curlReturnTransfer = 0;
            $this->curlType = 1;
            $this->curlUrl = 'https://pos-api.ifood.com.br/v1.0/orders/' . $this->correlationid . '/statuses/dispatch';
            $this->curlHeader = array(
                'Authorization: bearer ' . $this->access_token,
                'Cache-Control: no-cache',
                'Content-Type: application/json',
            );
            $this->curlPost();
            $this->curlReturnTransfer = 1;
        }
    }
}
