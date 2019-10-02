<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

use View;

class ClienteController extends Controller
{

    public $cod_clientes = '96028';

    public function account(Request $request){
        
        $clientes = IpiCliente::find($this->cod_clientes);
        $redes_sociais = IpiClientesRedesSociai::where('cod_clientes',$this->cod_clientes)->get();
        if($request->isMethod("POST")){
            $clientes->data_hora_cadastro = date('Y-m-d H:i:s');
            $clientes->senha = Hash::make($request->ipi_clientes['senha']);
            $clientes->save($request->ipi_clientes);
            if(!empty($request->ipi_enderecos['cod_enderecos'])){
                $endereco = IpiEndereco::find($request->ipi_enderecos['cod_enderecos']);
            }else{
                $endereco = new IpiEndereco();
            }
            $endereco->cod_clientes = $clientes->cod_clientes;
            $endereco->apelido = "Endereço Padrão";
            $endereco->obs_endereco = "";
            $endereco->edificio = "";
            $endereco->save($request->ipi_enderecos);
        }

        return view('clientes.account',['redes_sociais'=>$redes_sociais,'clientes'=>$clientes]);
    }

    public function user(){
        $pedidos = Controller::selectPedidosCliente($this->cod_clientes);
        return view('clientes.user',['pedidos'=>$pedidos]);
    }

    public function clientes(){
        
    }

    public function pedidoCompleto(Request $request){
        $cod_pedido = $request->route('cod_pedido');
        $pedido = IpiPedido::where('cod_pedidos',$cod_pedido)->where('cod_clientes',$this->cod_clientes)->first();
        $pedidoSistema = array();
        if(empty($pedido->pedido_ifood_json)){
            $pedidoSistema = IpiPedido::find($cod_pedido);
        }
        return view('clientes.pedido-completo',['pedido'=>$pedido,'cod_pedido'=>$cod_pedido,'pedidos_sistema'=>$pedidoSistema]);
    }

    public function refazerPedido(){

    }

    public function logout(){
        
    }

    public function getCep(Request $cep){
        return IpiCliente::where('cep',$cep)->get();
    }

    public function contact(){

    }
    
}
