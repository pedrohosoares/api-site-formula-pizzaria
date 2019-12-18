<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpiPedido;


class FocusNfeController extends Controller
{
    public $urlProducao = 'https://api.focusnfe.com.br/v2/';
    public $urlHomologacao = 'https://homologacao.focusnfe.com.br/v2/';
    public $producaoHomologacao;
    public $referencia;
    public $completa = 0;
    public $urlBase;
    public $dadosNota;

    //CURL CRUDE DATA
    public $curlUrl;
    public $curlBody;
    public $curlHttp;
    public $curlDataPass = array();
    public $curlHeader = array();
    public $curlType = 1; //1 para POST 0 para GET
    public $curlPostData;
    public $curlPut = false;


    public $num = 1;
    public $total = 0.00;
    public $pdvBebidas = array('B', 'BD', 'BLP', 'BCLP', 'BAQ', 'BV', 'BSL', 'BV', 'YI', 'D');
    public $pdvPizzas = array('P', 'S', 'C', 'R', 'T');
    public $pizzas = array('borda', 'formula', 'fórmula', 'cálzone', 'tradicional', 'calzone', 'pizza', 'pudim', 'pudin', 'brownie', 'broniew', 'fórmula', 'formula', 'segunda pizza', 'pizzaria', 'carne', 'toscana', 'bacon', 'vegetariana', 'lombo', 'bacon', 'frango', 'napolitana', 'a moda', 'azeitona', 'caliente', 'carnivora', 'castelo', 'mussarela', 'muçarela', 'marguerita', 'presunto', 'pepperoni', 'abobrinha', 'atum', 'americana', 'champignon', 'gourmet', 'parma', 'presunto', 'palmito', 'queijo', 'queijos', 'bolonhesa', 'palmito', 'milho', 'portuguesa', 'romana', 'especial', 'calabresa', 'alho', 'american');
    public $bebidas = array('malevo', 'vinho', 'cerveja', 'refri', 'refrigerante', 'suco', 'agua', 'água', 'lata', 'kuat', 'guarana', 'coca', 'kuat', 'guaraná', 'fanta', 'uva', 'vale', 'dellvale', 'sucos');
    public $tributos = 0.00;
    public $salgado = array('sanduiche', 'sanduíche', 'sanduiches', 'sanduíches', 'calzone', 'calzones', 'pizza', 'pizzas', 'tamanho', 'tamanhos', 'formula', 'fórmula', 'brownie', 'brownies', 'bronie', 'bronies', 'browniew', 'browniews', 'pudim', 'pudin', 'pudins', 'pudims', 'mousse', 'american');
    public $bebida = array('fanta', 'guaraná', '2l', 'ml', 'cerveja', 'budweiser');

    public $curlDelete = false;

    public $cod_pedido;

    public function __construct()
    {
        if ($this->producaoHomologacao == 'homologacao') {
            $this->urlBase = $this->urlProducao;
        } else {
            $this->urlBase = $this->urlHomologacao;
        }
    }

    public function converteAccents($str)
    {
        $strarray = array('Á' => 'á', 'Â' => 'â', 'À' => 'à', 'Ã' => 'ã', 'É' => 'é', 'È' => 'è', 'Ê' => 'ê', 'Í' => 'í', 'Ì' => 'ì', 'Î' => 'î', 'Ó' => 'ó', 'Ò' => 'ò', 'Ô' => 'ô', 'Õ' => 'õ', 'Ù' => 'ù', 'Ú' => 'ú', 'Û' => 'û');
        return strtr($str, $strarray);
    }

    public function utf8converter($valor = '')
    {
        $Utf8_ansi2 = array(
            "\u00c0" => "À",
            "\u00c1" => "Á",
            "\u00c2" => "Â",
            "\u00c3" => "Ã",
            "\u00c4" => "Ä",
            "\u00c5" => "Å",
            "\u00c6" => "Æ",
            "\u00c7" => "Ç",
            "\u00c8" => "È",
            "\u00c9" => "É",
            "\u00ca" => "Ê",
            "\u00cb" => "Ë",
            "\u00cc" => "Ì",
            "\u00cd" => "Í",
            "\u00ce" => "Î",
            "\u00cf" => "Ï",
            "\u00d1" => "Ñ",
            "\u00d2" => "Ò",
            "\u00d3" => "Ó",
            "\u00d4" => "Ô",
            "\u00d5" => "Õ",
            "\u00d6" => "Ö",
            "\u00d8" => "Ø",
            "\u00d9" => "Ù",
            "\u00da" => "Ú",
            "\u00db" => "Û",
            "\u00dc" => "Ü",
            "\u00dd" => "Ý",
            "\u00df" => "ß",
            "\u00e0" => "à",
            "\u00e1" => "á",
            "\u00e2" => "â",
            "\u00e3" => "ã",
            "\u00e4" => "ä",
            "\u00e5" => "å",
            "\u00e6" => "æ",
            "\u00e7" => "ç",
            "\u00e8" => "è",
            "\u00e9" => "é",
            "\u00ea" => "ê",
            "\u00eb" => "ë",
            "\u00ec" => "ì",
            "\u00ed" => "í",
            "\u00ee" => "î",
            "\u00ef" => "ï",
            "\u00f0" => "ð",
            "\u00f1" => "ñ",
            "\u00f2" => "ò",
            "\u00f3" => "ó",
            "\u00f4" => "ô",
            "\u00f5" => "õ",
            "\u00f6" => "ö",
            "\u00f8" => "ø",
            "\u00f9" => "ù",
            "\u00fa" => "ú",
            "\u00fb" => "û",
            "\u00fc" => "ü",
            "\u00fd" => "ý",
            "\u00ff" => "ÿ",
            "\u2022u2022u2022u2022 " => "******"
        );
        return strtr($valor, $Utf8_ansi2);
    }

    public function verificaPdv($vetor, $code)
    {
        $return = false;
        if (!empty($code)) {
            foreach ($vetor as $i => $v) {
                $s = explode($v, $code);
                if (isset($s)) {
                    $return = true;
                }
            }
        }
        return $return;
    }

    protected function verificaNome($nome, $string)
    {
        $string = explode(' ', $string);
        return in_array($nome, $string);
    }

    public function curlPost()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_URL, $this->curlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        if ($this->curlDelete) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'DELETE');
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->curlHeader);
        $this->curlBody = curl_exec($ch);
        $this->curlHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    public function criar_nota_ifood($cod_pedido, $homologacao = null)
    {
        $this->cod_pedido = $cod_pedido;
        $this->montaNotaIfood($homologacao);
    }

    protected function nfce()
    {
        $nfce = array(
            "tipo_documento" => "1",
            "cnpj_emitente" => $this->cnpj_emitente,
            "data_emissao" => $this->data_emissao,
            "indicador_inscricao_estadual_destinatario" => "9",
            "modalidade_frete" => $this->modalidade_frete, //0-porconta do emitente 1- conta do destinatario 2 - conta de terceiros 9 - sem frete
            "local_destino" => "1", //1 – Operação interna; 2 – Operação interestadual; 3 – Operação com exterior
            "presenca_comprador" => "1", //$this->presenca_comprador,//1 – Operação presencial.4 – Entrega a domicílio.
            "natureza_operacao" => $this->natureza_operacao,
            "itens" => $this->itens,
            "formas_pagamento" => array(
                array(
                    "forma_pagamento" => $this->metodo_pagamento,
                    "valor_pagamento" => $this->valor_pagamento
                )
            ),
        );
        return $nfce;
    }

    protected function montaNotaIfood($homologacao = null)
    {
        $pedido = IpiPedido::select(['pedido_ifood_json', 'cnpj'])->leftJoin('ipi_pizzarias', 'ipi_pedidos.cod_pizzarias', '=', 'ipi_pedidos.cod_pizzarias')
            ->where('cod_pedidos', $this->cod_pedido)
            ->first();
        if (!empty($pedido) and !empty($pedido->cnpj)) {
            $this->cnpj_emitente = $pedido->cnpj;
            $this->data_emissao = date('Y-m-d') . 'T' . date('H:i:s');
            $numero_item = 1;
            $pedidoJSON = json_decode($pedido->pedido_ifood_json, true);
            $num = 1;
            $total = 0.00;
            $tributos = 0.00;
            if (isset($entregadores[0]['nome']) and rtrim($entregadores[0]['nome']) == 'IFOOD') {
                #$pedidoJSON['order']['totalPrice'] = $pedidoJSON['order']['totalPrice']-$pedidoJSON['order']['deliveryFee'];
                $pedidoJSON['order']['totalPrice'] = $pedidoJSON['order']['subTotal'];
            }
            foreach ($pedidoJSON['order']['items'] as $key => $value) {
                $value['name'] = $this->converteAccents($value['name']);
                if (isset($value['subItems'])) {
                    foreach ($value['subItems'] as $i => $v) {
                        $v['name'] = $this->converteAccents($v['name']);
                        $codePizza = false;
                        $codeBebida = false;
                        foreach ($this->pizzas as $nomeProduto) {
                            if (strpos(strtolower($v['name']), $nomeProduto) !== false) {
                                $codePizza = true;
                            }
                        }
                        foreach ($this->bebidas as $nomeProduto) {
                            if (strpos(strtolower($v['name']), $nomeProduto) !== false) {
                                $codeBebida = true;
                            }
                        }
                        #Pizza/CALZONE/sobremesa		
                        $cfop = "5102";
                        $cest = "1704800";
                        $ncm = "19022000";
                        $icms = "102";
                        if ($codeBebida) {
                            $cfop = "5405";
                            $cest = "0302100";
                            $ncm = "22021000";
                            $icms = "500";
                        }
                        $tributos = ($v['price'] * $v['quantity']) * 0.18;
                        $v['externalCode'] = isset($v['externalCode']) ? $v['externalCode'] : "SEM";
                        $itens[] = array(
                            "numero_item" => $num,
                            "codigo_ncm" => $ncm,
                            "quantidade_comercial" => number_format($v['quantity'], 1),
                            "quantidade_tributavel" => number_format($v['quantity'], 1),
                            "cfop" => $cfop,
                            "cest" => $cest,
                            "valor_unitario_tributavel" => number_format($v['price'], 2),
                            "valor_unitario_comercial" => number_format($v['price'], 2),
                            "descricao" => $v['name'],
                            "codigo_produto" => $v['externalCode'],
                            "icms_origem" => '0',
                            "icms_situacao_tributaria" => $icms,
                            "unidade_comercial" => 'UN',
                            "unidade_tributavel" => 'UN',
                            "valor_total_tributos" => number_format($tributos, 2),
                            "valor_bruto" => number_format($v['price'] * $v['quantity'], 2)
                        );
                        $total += number_format($v['price'] * $v['quantity'], 2);
                        if (isset($v['discount'])) {
                            $itens[count($itens) - 1] = array_merge($itens[count($itens) - 1], array('valor_desconto' => $v['discount']));
                        }
                        $num = $num + 1;
                    }
                } else {
                    $codePizza = false;
                    $codeBebida = false;
                    foreach ($this->pizzas as $nomeProduto) {
                        if (strpos(strtolower($value['name']), $nomeProduto) !== false) {
                            $codePizza = true;
                        }
                    }
                    foreach ($this->bebidas as $nomeProduto) {
                        if (strpos(strtolower($value['name']), $nomeProduto) !== false) {
                            $codeBebida = true;
                        }
                    }
                    #Pizza/CALZONE/sobremesa	
                    $cfop = "5102";
                    $cest = "1704800";
                    $ncm = "19022000";
                    $icms = "102";
                    if ($codeBebida) {
                        $cfop = "5405";
                        $cest = "0302100";
                        $ncm = "22021000";
                        $icms = "500";
                    }
                    if ($value['externalCode'] == 'PROMO1') {
                        $pedidoJSON['order']['totalPrice'] = $pedidoJSON['order']['totalPrice'] - $value['price'];
                        $value['price'] = 1;
                        $pedidoJSON['order']['totalPrice'] = $pedidoJSON['order']['totalPrice'] + $value['price'];
                    }
                    $tributos = ($value['price'] * $value['quantity']) * 0.18;
                    $value['externalCode'] = isset($value['externalCode']) ? $value['externalCode'] : "SEM";
                    $itens[] = array(
                        "numero_item" => $num,
                        "codigo_ncm" => $ncm,
                        "quantidade_comercial" => number_format($value['quantity'], 1),
                        "quantidade_tributavel" => number_format($value['quantity'], 1),
                        "cfop" => $cfop,
                        "cest" => $cest,
                        "valor_unitario_tributavel" => number_format($value['price'], 2),
                        "valor_unitario_comercial" => number_format($value['price'], 2),
                        "descricao" => $value['name'],
                        "codigo_produto" => $value['externalCode'],
                        "icms_origem" => '0',
                        "icms_situacao_tributaria" => $icms,
                        "unidade_comercial" => 'UN',
                        "unidade_tributavel" => 'UN',
                        "valor_total_tributos" => number_format($tributos, 2),
                        "valor_bruto" => number_format($value['price'] * $value['quantity'], 2)
                    );
                    $total += number_format($value['price'] * $value['quantity'], 2);
                    if (isset($value['discount'])) {
                        $itens[count($itens) - 1] = array_merge($itens[count($itens) - 1], array('valor_desconto' => $value['discount']));
                    }
                    $num = $num + 1;
                }
            }
            if($pedidoJSON['order']['totalPrice'] > $total){
                $diferenca = $pedidoJSON['order']['totalPrice'] - $total;
                if(isset($itens[1])){
                    $diferencaItens = $diferenca/$itens[1]['quantidade_comercial'];
                    $itens[1]['valor_unitario_comercial'] = $itens[1]['valor_unitario_comercial']+$diferencaItens;
                    $itens[1]['valor_unitario_comercial'] = number_format($itens[1]['valor_unitario_comercial'],2);
                    $itens[1]['valor_unitario_tributavel'] = $itens[1]['valor_unitario_tributavel']+$diferencaItens;
                    $itens[1]['valor_unitario_tributavel'] = number_format($itens[1]['valor_unitario_tributavel'],2);
                    $itens[1]['valor_bruto'] = $itens[1]['valor_bruto']+$diferenca;
                    $itens[1]['valor_bruto'] = number_format($itens[1]['valor_bruto'],2);	
                }else{
                    $diferencaItens = $diferenca/$itens[0]['quantidade_comercial'];
                    $itens[0]['valor_unitario_comercial'] = $itens[0]['valor_unitario_comercial']+$diferencaItens;
                    $itens[0]['valor_unitario_comercial'] = number_format($itens[0]['valor_unitario_comercial'],2);
                    $itens[0]['valor_unitario_tributavel'] = $itens[0]['valor_unitario_tributavel']+$diferencaItens;
                    $itens[0]['valor_unitario_tributavel'] = number_format($itens[0]['valor_unitario_tributavel'],2);
                    $itens[0]['valor_bruto'] = $itens[0]['valor_bruto']+$diferenca;
                    $itens[0]['valor_bruto'] = number_format($itens[0]['valor_bruto'],2);
                }
            }
        }
    }

    protected function criaNotaFiscal()
    {
        //POST
        $this->curlUrl = $this->urlBase . "nfce?ref=" . $this->referencia . "&completa=" . $this->completa;
        $this->curlDataPass = $this->dadosNota;
        $this->curlHeader = array('Content-Type: application/json');
        $this->curlType = 1;
        $this->curlPost();
    }

    protected function consultaNFCE()
    {
        //GET
        $this->curlUrl = $this->urlBase . "nfce?ref=" . $this->referencia . "&completa=" . $this->completa;
        $this->curlDataPass = $this->dadosNota;
        $this->curlType = 0;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
        if ($body['status'] == 'autorizado') {
        }
        if ($body['status'] == 'cancelado') {
        }
        if ($body['status'] == 'erro_autorizacao') {
        }
        if ($body['status'] == 'denegado') {
            //É gerado um XML que é preciso ser armazenado para essa nota
        }
    }

    protected function cancelaNota()
    {
        //DELETE
        //curlDataPass {"justificativa":"Teste de cancelamento de nota"}
        $this->curlUrl = $this->urlBase . "nfce?ref=" . $this->referencia;
        $this->curlDataPass = $this->dadosNota;
        $this->curlHeader = array('Content-Type: application/json');
        $this->curlType = 1;
        $this->curlDelete = true;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
        if ($body['status'] == 'cancelado') {
            //foi um succeso
            //Salva cancelamento
            //$body['caminho_xml_cancelamento']
        }
        if ($body['status'] == 'erro_cancelamento') {
            //Falha ao cancelar nota
        }
    }

    protected function enviaEmailNota()
    {
        //POST
        //{"emails":["alguem@example.org","alguem@example.org"]}
        $this->curlUrl = $this->urlBase . "nfce/REFERENCIA/email";
        $this->curlDataPass = $this->dadosNota;
        $this->curlHeader = array('Content-Type: application/json');
        $this->curlType = 1;
        $this->curlPost();
        //$this->curlBody response
    }

    protected function inutilizaNumero()
    {
        //POST
        //{"cnpj":"51916585009999","serie":"9","numero_inicial":"7730","numero_final":"7732","justificativa":"Teste de inutilizacao de nota"}
        $this->curlUrl = $this->urlBase . "nfce/inutilizacao";
        $this->curlDataPass = $this->dadosNota;
        $this->curlHeader = array('Content-Type: application/json');
        $this->curlType = 1;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
        if ($body['status'] == 'autorizado') {
            //$body['status_sefaz']
            //$body['mensagem_sefaz']
            //$body['serie']
            //$body['numero_inicial']
            //$body['numero_final']
            //$body['caminho_xml']
        }
        if ($body['status'] == 'erro_autorizacao') {
            //Algo deu errado
        }
    }


    public function backup()
    {
        //GET
        $this->curlUrl = $this->urlBase . "backups/CNPJ.json";
        $this->curlDataPass = $this->dadosNota;
        $this->curlType = 0;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
        foreach ($body as $i => $v) {
            //$v['backups']
            //$v['backups']['mes']
            //$v['backups']['danfes'] ->caminho do arquivo danfes
            //$v['backups']['xmls'] ->caminho dos xmls
        }
    }

    public function consultaNCM()
    {
        //GET
        //Pode ser usado https://homologacao.focusnfe.com.br/v2/ncms/CODIGO_NCM
        /**
         * Parametros:
         * codigo ->parte do inicio do ncm
         * descricao -> parte da descricao
         * capitulo,posicao,subposicao1,subposicao2,item1 e item2: Pesquisa exata informando qualquer uma das partes do código NCM.
         * CC = Capitulo
         * PP = Posição
         * S = Subposição 1
         * Ç = Subposição 2
         * II = Item 1 e 2
         * ex:  https://homologacao.focusnfe.com.br/v2/ncms?capitulo=90
         * offset paginacao 
         * https://homologacao.focusnfe.com.br/v2/ncms?codigo=7022&offset=100
         */
        $this->curlUrl = $this->urlBase . "ncms?";
        $this->curlType = 0;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
    }

    public function consultaCfop()
    {
        //GET
        //Informa parte do código
        //passar codigo no parametro
        //paginacao offset
        //https://homologacao.focusnfe.com.br/v2/cfops?codigo=2&offset=50
        $this->curlUrl = $this->urlBase . "cfops?codigo=";
        $this->curlType = 0;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
    }

    public function buscaCep()
    {
        //CEP
        /**
         * parametro
         * codigo_ibge direto: Pesquisa pelo CEP referente a uma localidade, conforme o código IBGE do município
         * uf: Pesquisa utilizando os dois caractêres referente a Unidade da Federação. Ex: 'PR', para o Estado do Paraná.
         * logradouro: Pesquisa pelo logradouro completo ou por parte dele. Mínimo de 3 caracteres.
         * localidade: Pesquisa pelo nome completo da localidade ou por parte dele.
         */
        $this->curlUrl = $this->urlBase . "ceps/" . $this->cep;
        $this->curlType = 0;
        $this->curlPost();
        $body = json_decode($this->curlBody, true);
    }

    public function transformaEmPdf()
    {
    }
}
