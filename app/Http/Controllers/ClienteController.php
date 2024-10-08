<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\IpiCliente;
use App\Models\IpiClientesBloqueio;
use App\Models\IpiClientesBloqueioLog;
use App\Models\IpiClientesInformacao;
use App\Models\IpiClientesIpiEnqueteResposta;
use App\Models\IpiClientesIpiEnqueteRespostasCategoriasComentario;
use App\Models\IpiClientesLog;
use App\Models\IpiClientesRedesSociai;

use App\Models\IpiPedido;
use App\Models\IpiPedidoMinimo;
use App\Models\IpiPedidosAdicionai;
use App\Models\IpiPedidosBebida;
use App\Models\IpiPedidosBorda;
use App\Models\IpiPedidosCombo;
use App\Models\IpiPedidosDetalhesPg;
use App\Models\IpiPedidosFormasPg;
use App\Models\IpiPedidosFraco;
use App\Models\IpiPedidosInfo;
use App\Models\IpiPedidosIngrediente;
use App\Models\IpiPedidosIpiCupon;
use App\Models\IpiPedidosIpiEnquete;
use App\Models\IpiPedidosMotivoCancelamento;
use App\Models\IpiPedidosPagTemp;
use App\Models\IpiPedidosPizza;
use App\Models\IpiPedidosSituaco;
use App\Models\IpiPedidosTaxa;
use App\Models\IpiCaixaIpiPedido;

use App\Models\IpiEndereco;
use App\Models\IpiEnquete;
use App\Models\IpiEnquetePergunta;
use App\Models\IpiTamanho;

use Illuminate\Support\Facades\DB;

use View;

class ClienteController extends Controller
{

    public $cod_clientes = '592';

    public function clientes(){
        $perguntas = IpiEnquete::where('enquete','sistema')->first();
        return view('clientes/clientes',['perguntas'=>$perguntas]);
    }

    public function cadastraRedesSociais($ipi_clientes_redes_sociais)
    { 
        foreach($ipi_clientes_redes_sociais as $social){
            IpiClientesRedesSociai::updateOrCreate(
                [
                    'cod_clientes_redes_sociais'=>$social['cod_clientes_redes_sociais']
                ],
                [
                    'cod_clientes'=>$this->cod_clientes,
                    'nome_site'=>$social['nome_site'],
                    'url_cliente_site'=>$social['url_cliente_site']
                ]
            );
        }
    }

    public function atualizaEndereco($request)
    {
        $endereco = IpiEndereco::updateOrCreate(
            [
                'cod_clientes' => $this->cod_clientes
            ],
            $request->ipi_enderecos
        );
    }

    public function atualizaCliente($clientes, $request)
    {
        $clientes->nome = $request->ipi_clientes['nome'];
        $clientes->email = $request->ipi_clientes['email'];
        $clientes->cpf = $request->ipi_clientes['cpf'];
        $clientes->celular = $request->ipi_clientes['celular'];
        $clientes->nascimento = $request->ipi_clientes['nascimento'];
        $clientes->sexo = $request->ipi_clientes['sexo'];
        $clientes->save();
    }

    public function account(Request $request)
    {

        $clientes = IpiCliente::find($this->cod_clientes);
        $redes_sociais = IpiClientesRedesSociai::where('cod_clientes', $this->cod_clientes)->get();

        if ($request->isMethod("POST")) {

            $this->cadastraRedesSociais($request->ipi_clientes_redes_sociais);

            //Atualiza Cliente
            $clientes->data_hora_cadastro = date('Y-m-d H:i:s');
            if (!empty($clientes->senha)) {
                $clientes->senha = Hash::make($request->ipi_clientes['senha']);
            }

            $this->atualizaCliente($clientes, $request);

            $this->atualizaEndereco($request);
        
        }

        return view('clientes.account', ['redes_sociais' => $redes_sociais, 'clientes' => $clientes]);
    }

    public function ajaxPesquisaPedido(Request $request){
        if($request->isMethod("POST")){
            foreach($request->valoresFormulario as $dadosPedido){
                unset($dadosPedido['campo']['cod_enquete_perguntas']);
                $valoresFormularios[] = array_merge(
                        array(
                            'cod_clientes'=>$this->cod_clientes,
                            'cod_pedidos'=>$request->cod_pedidos,
                            'data_hora_resposta'=>date('Y-m-d H:i:s')
                        ),
                        $dadosPedido['campo']
                    );
            }
            IpiClientesIpiEnqueteResposta::insert(
                $valoresFormularios
            );
        }
    }

    
    public function login(Request $request){
        $mensagem = '';
        if($request->isMethod('POST')){
            $dados = $request->only('email','senha');
            //$dados['senha'] = Hash::make($dados['senha']);
            #$cliente = IpiCliente::where('email',$dados['email'])->first();
            #Hash::check($dados['senha'],$cliente->senha);
            if(Auth::attempt($dados)){
                dd("asassa");
            }else{
                $mensagem = __('Login/Senha errôneos');
            }
        }
        return view('clientes.login',['mensagem'=>$mensagem]);
    }

    public function user()
    {
        $pedidos = IpiPedido::where('cod_clientes',$this->cod_clientes)->paginate(6);
        return view('clientes.user', ['pedidos' => $pedidos]);
    }

    public function getCliente($dado){
        return DB::table('ipi_clientes')
        ->select(['ipi_clientes.cod_clientes','ipi_clientes.email','ipi_clientes.nome',
        'ipi_clientes.celular','ipi_enderecos.cod_enderecos','ipi_enderecos.endereco',
        'ipi_enderecos.numero','ipi_enderecos.bairro','ipi_enderecos.complemento',
        'ipi_enderecos.edificio','ipi_enderecos.cidade','ipi_enderecos.telefone_1',
        'ipi_enderecos.telefone_2'])
        ->rightJoin('ipi_enderecos','ipi_clientes.cod_clientes','=','ipi_enderecos.cod_clientes')
        ->where('ipi_clientes.nome','like',$dado.'%')
        ->whereOr('ipi_clientes.email','like',$dado.'%')
        ->whereOr('ipi_clientes.cpf','like',$dado.'%')
        ->whereOr('ipi_clientes.celular','like',$dado.'%')
        ->whereOr('ipi_clientes.telefone_1','like',$dado.'%')
        ->whereOr('ipi_clientes.telefone_2','like',$dado.'%')
        ->limit(10)
        ->get();
    }

    public function pedidoCompleto(Request $request)
    {
        $cod_pedido = $request->route('cod_pedido');
        $pedido = Controller::getPedido($cod_pedido,$this->cod_clientes);
        $enquete = IpiEnquete::where('enquete','pedidos')->first();
        $pedidoSistema = array();
        if (empty($pedido->pedido_ifood_json)) {
            $pedidoSistema = IpiPedido::find($cod_pedido);
        }
        return view('clientes.pedido-completo', ['enquete'=>$enquete,'cod_cliente'=>$this->cod_clientes,'pedido' => $pedido, 'cod_pedido' => $cod_pedido, 'pedidos_sistema' => $pedidoSistema]);
    }

    public function refazerPedido(Request $request)
    { 
        $cod_pedido = $request->route('cod_pedido');
        $pedido = Controller::getPedido($cod_pedido,$this->cod_clientes);
        $tamanhos = Controller::getTamanhos();
        $borda = Controller::getBorda();
        $tipoMassa = Controller::getTipoMassa();
        $opcoesCorte = Controller::getOpcoesCorte();
        $bebidas = Controller::selecaoBebidas($pedido->cod_pizzarias,[8]);
        $sobremesas = Controller::selecaoBebidas($pedido->cod_pizzarias,[1,2,3,4,5,6,7,9]);
        return view('clientes.refazer-pedido',[
            'cod_pedido' => $cod_pedido,
            'pedido'=>$pedido,
            'tamanhos'=>$tamanhos,
            'borda'=>$borda,
            'tipo_massa'=>$tipoMassa,
            'opcoes_corte'=>$opcoesCorte,
            'bebidas'=>$bebidas,
            'sobremesas'=>$sobremesas
            ]
        );
    }

    public function compartilharpedido(){

    }

    public function logout()
    { }

    public function getCep(Request $cep)
    {
        return IpiCliente::where('cep', $cep)->get();
    }

    public function contact()
    { }
}
