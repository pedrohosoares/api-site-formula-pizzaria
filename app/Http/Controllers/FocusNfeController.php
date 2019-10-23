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


    public $curlDelete = false;

    public function __construct()
    {
        if ($this->producaoHomologacao == 'homologacao') {
            $this->urlBase = $this->urlProducao;
        } else {
            $this->urlBase = $this->urlHomologacao;
        }
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

    public function criar_nota_ifood($cod_pedido)
    {
        $pedido = IpiPedido::select(['pedido_ifood_json'])
            ->where('cod_pedidos', $cod_pedido)
            ->whereNotIn('situacao', ['CANCELADO'])
            ->first();
        if (!empty($pedido)) {
            $numero_item = 1;
            $pedido = json_decode($pedido->pedido_ifood_json, true);
            foreach ($pedido['order']['items'] as $v) {
                $item = $v['name'];
                $quantidade = $v['quantity'];
                $preco = $v['price'];
                $desconto = $v['discount'];
                if (isset($v['subItems'])) {
                    foreach ($v['subItems'] as $vv) {
                        $item .= ' ' . $vv['name'];
                        $preco += $vv['price'];
                        $desconto+= $vv['discount'];
                    }
                }
                $desconto = number_format($desconto,2);
                $itens[] = array(
                    "numero_item" => $numero_item,
                    "codigo_ncm" => "62044200",
                    "quantidade_comercial" => $quantidade,
                    "quantidade_tributavel" => $quantidade,
                    "cfop" => "5102",
                    "valor_unitario_tributavel" => $preco,
                    "valor_unitario_comercial" => $preco,
                    "valor_desconto" => $desconto,
                    "descricao" => "SALGADO PEDIDO VIA IFOOD",
                    "codigo_produto" => "251887",
                    "icms_origem" => "0",
                    "icms_situacao_tributaria" => "102",
                    "unidade_comercial" => "un",
                    "unidade_tributavel" => "un",
                    "valor_total_tributos" => number_format($preco*0.18,2)
                );
                $numero_item++;
            }
            dump($v);
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
        if ($body['status'] == 'autorizado') { }
        if ($body['status'] == 'cancelado') { }
        if ($body['status'] == 'erro_autorizacao') { }
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
    { }
}
