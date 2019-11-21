<?php

namespace App\Http\Controllers;

use App\Models\IpiPedido;
use Illuminate\Support\Facades\DB;



class PizzariasController extends Controller
{
    public function cadastrareimprimir($cod_pedido)
    {
        if (!empty($cod_pedido)) {
            $cod_pedido = explode(',',$cod_pedido);
            $ipi = IpiPedido::whereIn('cod_pedidos',$cod_pedido);
            $ipi->update(['reimpressao' => 1]);
        }
    }

    public function ver_historico($cod_pedido = null, $ref_nota = null, $cliente = null, $telefone = null, $data_hora_inicial = null, $data_hora_final = null, $cod_pizzaria = null, $situacao = null, $origem = null, $entrega = null, $tempo_envio = null)
    {

        /**
         * REPLICA O HISTORICO DE PEDIDOS
         */

        $query = DB::table('ipi_pedidos')
            ->select(
                [
                    'ipi_pedidos.cod_pedidos', 'ipi_pedidos.valor_entrega', 'ipi_pedidos.cancelamento_json', 'ipi_pedidos.desconto', 'ipi_pedidos.endereco','ipi_pedidos.bairro','ipi_pedidos.numero','ipi_pedidos.cidade','ipi_pedidos.estado', 'ipi_pedidos.arquivo_json', 'ipi_pedidos.cod_clientes', 'ipi_pedidos.nome_cliente', 'ipi_pedidos.forma_pg', 'ipi_pedidos.situacao', 'ipi_pedidos.horario_agendamento', 'ipi_pedidos.agendado',
                    'ipi_pizzarias.nome', 'ipi_pedidos.data_hora_inicial', 'ipi_pedidos.data_hora_pedido', 'ipi_pedidos.data_hora_baixa', 'ipi_pedidos.data_hora_cancelamento',
                    'ipi_pedidos.data_hora_envio', 'ipi_pedidos.data_hora_final', 'ipi_pedidos.valor_total', 'ipi_pedidos.origem_pedido'
                ]
            )
            ->leftJoin('ipi_pizzarias', 'ipi_pedidos.cod_pizzarias', '=', 'ipi_pizzarias.cod_pizzarias');

        if ($cod_pedido != 'null') {
            $query = $query->where('ipi_pedidos.cod_pedidos', $cod_pedido);
        }
        if ('null' != ($ref_nota)) {
            $query = $query->where('ipi_pedidos.ref_nota_fiscal', $ref_nota);
        }
        if ('null' != ($cliente)) {
            $query = $query->where('ipi_pedidos.nome_cliente', 'LIKE', $cliente . '%');
        }
        if ('null' != ($telefone)) {
            $query = $query->where(function ($qr) use ($telefone) {
                $qr->where('ipi_pedidos.telefone_1', 'LIKE', $telefone . '%')
                    ->whereOr('ipi_pedidos.telefone_2', 'LIKE', $telefone . '%');
            });
        }
        if ('null' != ($data_hora_inicial) and 'null' != ($data_hora_final)) {
            $query = $query->whereBetween('ipi_pedidos.data_hora_inicial', array($data_hora_inicial, $data_hora_final));
        }
        if ('null' != ($cod_pizzaria)) {
            $cod_pizzaria = explode(',',$cod_pizzaria);
            $query = $query->whereIn('ipi_pedidos.cod_pizzarias', $cod_pizzaria);
        }
        if ('null' != ($situacao)) {
            $query = $query->where('ipi_pedidos.situacao', $situacao);
        }
        if ('null' != ($origem)) {
            $query = $query->where('ipi_pedidos.origem_pedido', $origem);
        }
        if ('null' != ($entrega)) {
            $query = $query->where('ipi_pedidos.tipo_entrega', $entrega);
        }
        $query = $query->orderBy('ipi_pedidos.cod_pedidos', 'DESC')
            ->get();
        return $query;
    }


    public function pizzarias($pizzarias = null){
        $pizzarias = explode(',',$pizzarias);
        $pizza = DB::table('ipi_pizzarias')
        ->select(['cod_pizzarias','nome']);
        if(!empty($pizzarias[0])){
            $pizza = $pizza->whereIn('cod_pizzarias',$pizzarias);
        }
        $pizza = $pizza->where('situacao','ATIVO')
        ->orderBy('nome')
        ->get();
        return $pizza;
    }
}
