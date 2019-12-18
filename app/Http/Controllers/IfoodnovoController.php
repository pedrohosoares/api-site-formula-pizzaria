<?php

namespace App\Http\Controllers;



use App\Models\IpiPedido;
use App\Models\IpiPizzaria;
use App\Models\IpiCliente;
use App\Models\IpiEndereco;
use App\Models\IpiFormasPg;
use App\Models\IpiPedidosFormasPg;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class IfoodnovoController extends Controller
{
    public $access_token;
    public $scope;
    public $expires_in;
    public $token_type;
    public $erros;
    public $dadosPolling;


    public function start()
    {
        $this->verificaArquivo();
        //$this->inserePedidos();
    }

    public function conectIfood()
    {
        //Salvar sessao no txt
        $link = 'https://pos-api.ifood.com.br/oauth/token?client_id=formulasys&client_secret=AFjM4%24U&username=POS-2410924853&password=POS-2410924853&grant_type=password';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html; charset=utf-8'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        $body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http_code == 401) {
            $this->criaNovoToken();
        } else {
            $this->dados = json_decode($body, true);
            if (isset($this->dados['error']) and !empty($this->dados['error'])) {
                #$this->debug("Erro conect ifood");
            } else {
                $this->scope = $this->dados['scope'];
                $this->expires_in = $this->dados['expires_in'];
                $this->access_token = (string) $this->dados['access_token'];
                $this->token_type = $this->dados['token_type'];
            }
        }
    }

    public function verificaArquivo()
    {
        $existeArquivo = Storage::disk("local")->exists('ifood/213736551283.txt');
        if ($existeArquivo) {
            $this->abreLeArquivo();
            if (!empty($this->access_token) and empty($this->erros)) {
                $this->inserePedidos();
                if (!empty($erros)) {
                    $this->criaNovoToken();
                }
            } else {
                $this->conectIfood();
                $this->criaArquivo();
                $this->inserePedidos();
            }
        } else {
            $this->conectIfood();
            $this->criaArquivo();
            $this->inserePedidos();
            if (!empty($erros)) {
                $this->criaNovoToken();
            }
        }
    }


    public function criaArquivo()
    {
        $dados = array(
            "scope" => $this->scope,
            "expires_in" => $this->expires_in,
            "access_token" => $this->access_token,
            "token_type" => $this->token_type
        );
        $dados = json_encode($dados, true);
        Storage::put('ifood/213736551283.txt', $dados);
    }

    public function abreLeArquivo()
    {
        $dados = File::get(storage_path('app/ifood/213736551283.txt'));
        if (!empty($dados)) {
            $dados = json_decode($dados, true);
            $this->scope = $dados['scope'];
            $this->expires_in = $dados['expires_in'];
            $this->access_token = (string) $dados['access_token'];
            $this->token_type = $dados['token_type'];
        }
    }


    public function criaNovoToken()
    {
        $this->conectIfood();
        $this->criaArquivo();
        $this->inserePedidos();
    }

    public function orderStatusesIntegration()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, "https://pos-api.ifood.com.br/v1.0/orders/" . $this->reference . "/statuses/integration?access_token=" . $this->access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        $body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function orderStatusesConfirmation()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, "https://pos-api.ifood.com.br/v1.0/orders/" . $this->reference . "/statuses/confirmation?access_token=" . $this->access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        $body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function polling()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, 'https://pos-api.ifood.com.br/v3.0/events:polling');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        $json = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 401) {
            $this->criaNovoToken();
        }
        return $json;
    }

    public function acknowledgment($idsEvent)
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
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($idsEvent, true));
        $body = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $this->dados = json_decode($body, true);
    }

    public function inserePedidos()
    {

        $jsons = $this->polling();
        $jsons = json_decode($jsons, true);
        dump($jsons);
        if (!empty($jsons)) {

            foreach ($jsons as $json) {
                $acknowledgment[] = array('id' => $json['id']);

                if ($json['code'] == 'PLACED') {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_ENCODING, '');
                    curl_setopt($ch, CURLOPT_URL, 'https://pos-api.ifood.com.br/v3.0/orders/' . $json['correlationId']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPGET, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->access_token));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                    $order = curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $order = json_decode($order, true);
                    $pollingsData = array('polling' => $json, 'reference' => $json['correlationId'], 'order' => $order);
                    $order['deliveryAddress']['reference'] = isset($order['deliveryAddress']['reference'])?str_replace(array('"',"'"),"",$order['deliveryAddress']['reference']):"";
                    $pollingsDataJSON = json_encode($pollingsData);
                    $pollingsDataJSON = str_replace(array("\r", "\n", "'"), "", $pollingsDataJSON);

                    //CLIENTE
                    $addressBairro = isset($order['deliveryAddress']['neighborhood']) ? $order['deliveryAddress']['neighborhood'] : "";
                    $addresPais = isset($order['deliveryAddress']['country']) ? $order['deliveryAddress']['country'] : "";
                    $addresEstado = isset($order['deliveryAddress']['state']) ? $order['deliveryAddress']['state'] : "";
                    $addresCity = isset($order['deliveryAddress']['city']) ? $order['deliveryAddress']['city'] : "";
                    $addresRua = isset($order['deliveryAddress']['streetName']) ? $order['deliveryAddress']['streetName'] : "";
                    $addresNumero = isset($order['deliveryAddress']['streetNumber']) ? $order['deliveryAddress']['streetNumber'] : "";
                    $addresCep  = isset($order['deliveryAddress']['postalCode']) ? $order['deliveryAddress']['postalCode'] : "";
                    $addresformattedAddress = isset($order['deliveryAddress']['formattedAddress']) ? $order['deliveryAddress']['formattedAddress'] : "";

                    $cliente_nome = isset($order['customer']['name']) ? $order['customer']['name'] : "";
                    $cliente_telefone = isset($order['customer']['phone']) ? $order['customer']['phone'] : "";
                    $cliente_cpf = isset($order['customer']['taxPayerIdentificationNumber']) ? $order['customer']['taxPayerIdentificationNumber'] : "";

                    $pagamentos = $order['payments'];
                    $pagamento = '';
                    foreach ($pagamentos as $meio) {
                        $pagamento .= $meio['name'] . ' ';
                    }

                    $valor_total = $order['totalPrice'];
                    $taxa_entrega = $order['deliveryFee'];
                    $subTotal = $order['subTotal'];
                    $discount = 0;
                    $record = [
                        'data_hora_pedido' => date("Y-m-d H:i:s"),
                        'valor' => $subTotal,
                        'valor_entrega' => $taxa_entrega,
                        'valor_comissao_frete' => 0,
                        'valor_total' => $valor_total,
                        'desconto' => 0,
                        'forma_pg' => $pagamento,
                        'situacao' => 'INTEGRAR',
                        'endereco' => $addresformattedAddress,
                        'numero' => $addresNumero,
                        'complemento' => '',
                        'edificio' => '',
                        'bairro' => $addressBairro,
                        'cidade' => $addresCity,
                        'estado' => $addresEstado,
                        'cep' => $addresCep,
                        'telefone_1' => $cliente_telefone,
                        'telefone_2' => '',
                        'referencia_endereco' => '',
                        'referencia_cliente' => '',
                        'tipo_entrega' => 'Entrega',
                        'horario_agendamento' => '00:00:00',
                        'agendado' => '0',
                        'pontos_fidelidade_total' => '0',
                        'obs_pedido' => 'Pedido feito pelo IFOOD',
                        'origem_pedido' => 'IFOOD',
                        'data_hora_inicial' => date('Y-m-d H:i:s'),
                        'impressao_fiscal' => '0',
                        'cpf' => $cliente_cpf,
                        'ifood_polling' => $json['correlationId'],
                        'pedido_ifood_json' => $pollingsDataJSON,
                        'nome_cliente' => $cliente_nome
                    ];
                    $pedido = IpiPedido::create(
                        $record
                    );
                }
                $this->reference = $json['correlationId'];
                $this->orderStatusesIntegration();
                $this->orderStatusesConfirmation();
            }
            if (isset($acknowledgment)) {
                $this->acknowledgment($acknowledgment);
            }
        }
    }

    protected function buscaCliente($customer_id)
    {
        return IpiCliente::updateOrCreate(
            ['id_ifood_cliente' => $customer_id],
            [
                'complemento' => $this->complemento,
                'cep' => $this->cep,
                'cidade' => $this->cidade,
                'estado' => $this->estado
            ]
        );
    }

    protected function buscaEndereco($cliente)
    {
        return IpiEndereco::updateOrCreate(
            ['cod_clientes' => $cliente->cod_clientes],
            [
                'telefone_1' => $this->telefone,
                'cidade' => $this->cidade,
                'estado' => $this->estado,
                'endereco' => $this->endereco,
                'numero' => $this->numero,
                'cep' => $this->cep,
                'complemento' => $this->complemento,
                'apelido' => 'Inserido pelo iFood'
            ]
        );
    }

    protected function buscaPizzaria($pizzarias, $merchantID)
    {
        //Busca pizzaria
        $cod_pizzarias = '';
        foreach ($pizzarias as $pizzaria) {
            if (preg_match("/" . $merchantID . "/", $pizzaria['merchant_id'])) {
                $cod_pizzarias = $pizzaria['cod_pizzarias'];
            }
        }
        return $cod_pizzarias;
    }


    public function mudaInsereParaNovo()
    {
        $pizzarias = IpiPizzaria::where('ativa', 2)->get();
        $pollings = IpiPedido::select(['cod_pedidos', 'pedido_ifood_json', 'cep'])->where('situacao', 'PEDRO')->get();
        foreach ($pollings as $v) {
            $cep = $v['cep'];
            $pedido_ifood_json = str_replace(array("\n", "\r"), "", $v->pedido_ifood_json);
            $json = json_decode($pedido_ifood_json, true);
            $payments = $json['order']['payments'];
            $merchantID = $json['order']['merchant']['shortId'];
            
            $customer = $json['order']['customer'];
            $enderecoIfood = $json['order']["deliveryAddress"];
            $this->cidade = isset($enderecoIfood['city']) ? $enderecoIfood['city'] : "";
            $this->estado = isset($enderecoIfood['state']) ? $enderecoIfood['state'] : "";
            $this->endereco = isset($enderecoIfood['streetName']) ? $enderecoIfood['streetName'] : "";
            $this->numero = isset($enderecoIfood['streetNumber']) ? $enderecoIfood['streetNumber'] : "";
            $this->cep = isset($enderecoIfood['postalCode']) ? $enderecoIfood['postalCode'] : "";
            $this->complemento = isset($enderecoIfood['complement']) ? $enderecoIfood['complement'] : "";
            $this->telefone = isset($customer['phone']) ? $customer['phone'] : "";
            $valor_frete = isset($json['order']['deliveryFee']) ? $json['order']['deliveryFee'] : 0;
            $cod_pizzarias = '';
            $meioPagamento = '';
            $temPagamento = 0;
            $desconto = 0;
            $cod_pizzarias =  $this->buscaPizzaria($pizzarias, $merchantID);
            $cliente = $this->buscaCliente($customer['id']);
            $this->buscaEndereco($cliente);
            foreach ($payments as $key => $value) {
                $temPagamento = 1;
                $idPagamento = IpiFormasPg::firstOrCreate(
                    [
                        'cod_formas_pg_ifood'=>$value['code']
                    ],
                    [
                        'forma_pg'=>$value['name']
                    ]
                );
                $idPagamento = $idPagamento->cod_formas_pg;
                $value['prepaid'] = ($value['prepaid'] == true or $value['prepaid'] == 'true')?1:0;
                
                $pagamentoJSON = str_replace(array("'"), "", json_encode($value));
                $pagamento[] = array(
                    'cod_pedidos'=>$v['cod_pedidos'], 
                    'cod_formas_pg'=>$idPagamento->cod_formas_pg, 
                    'valor,pagamento_json'=>$value['value'],
                    'prepago'=>$pagamentoJSON
                );
            }

            //Busca Benefits
            if(isset($json['order']['benefits'])){
                foreach($json['order']['benefits'] as $beneficius){
                    $beneficius['value'];
                    foreach($beneficius['sponsorshipValues'] as $origem=>$valor){
                        if((float)$valor >0){
                            $desconto +=(float)$valor;
                            if($origem == 'MERCHANT'){
                                $origem = 'IFOOD LOJA';
                            }
                            $idPagamento = IpiFormasPg::firstOrCreate(
                                [
                                    'cod_formas_pg_ifood'=>$origem.'_VOUCHER'
                                ],
                                [
                                    'forma_pg'=>'VOUCHER '.$origem
                                ]
                            );
                            $pagamento[] = array(
                                'cod_pedidos'=>$v['cod_pedidos'], 
                                'cod_formas_pg'=>$idPagamento->cod_formas_pg, 
                                'valor'=>$value['value'],
                                'pagamento_json'=>'{"name":"VOUCHER '.$origem.'","code":"'.$origem.'_VOUCHER","value":"'.$value['value'].'"}'
                            );
                        }
                    }
                }
            }
            if(isset($pagamento)){
                IpiPedidosFormasPg::create(
                    $pagamento
                );
            }

            //BUSCA DESCONTO
            foreach ($json['order']['items'] as $item) {
                $desconto += (float) $item['discount'];
            }
            //INSERE CEP e valor
            $valor_comissao_frete = DB::table('ipi_cep')
            ->select(['ipi_taxa_frete.valor_frete'])
            ->leftJoin('ipi_pedidos', 'ipi_cep.cep_inicial', 'ipi_pedidos.cep')
            ->leftJoin('ipi_taxa_frete', 'ipi_cep.cod_taxa_frete', 'ipi_taxa_frete.cod_taxa_frete')
            ->where('ipi_pedidos.cod_pedidos', $v->cod_pedidos)
            ->first();
            $valor_comissao_frete = empty($valor_comissao_frete)?0.00:$valor_comissao_frete;
            $atualiza = IpiPedido::find($v->cod_pedidos);
            $atualiza->valor_entrega = $json['order']['deliveryFee'];
            $atualiza->valor_comissao_frete = $valor_comissao_frete;
            $atualiza->situacao = "NOVO";
            $atualiza->cod_clientes = $cliente->cod_cliente;
            $atualiza->desconto = $desconto;
            $atualiza->cod_pizzarias = $cod_pizzarias;
            $atualiza->save();
        }
    }
}
