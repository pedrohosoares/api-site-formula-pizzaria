<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\DB;

use App\Models\IpiBorda;
use App\Models\IpiPedido;
use App\Models\IpiTamanho;
use App\Models\IpiTipoMassa;
use App\Models\IpiOpcoesCorte;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function selectSobremesas($cod_pizzarias)
    {
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_bebidas.cod_tipo_bebida', '8')
            ->get()
            ->groupBy('bebida');
    }

    public function buscaPizzas($cod_pizzarias, $whereNotIn = null, $where = null)
    {
        $busca = DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas', 'ipi_pizzas.foto_grande', 'ipi_pizzas.pizza', 'ipi_pizzas_ipi_tamanhos.preco', 'ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.tamanho'])
            ->leftJoin('ipi_tipo_pizza', 'ipi_pizzas.cod_tipo_pizza', 'ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos', 'ipi_pizzas.cod_pizzas', 'ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos', 'ipi_pizzas_ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $cod_pizzarias);
        if (!empty($whereNotIn)) {
            $busca = $busca->whereNotIn('ipi_tipo_pizza.cod_tipo_pizza', $whereNotIn);
        }
        if (!empty($where)) {
            $busca = $busca->whereIn('ipi_tipo_pizza.cod_tipo_pizza', $where);
        }
        $busca = $busca->get()->groupBy('pizza');
        return $busca;
    }



    public function buscaSemGroupPizzas($cod_pizzarias)
    {
        $busca = DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas', 'ipi_pizzas.foto_grande', 'ipi_pizzas.pizza', 'ipi_pizzas_ipi_tamanhos.preco', 'ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.tamanho'])
            ->leftJoin('ipi_tipo_pizza', 'ipi_pizzas.cod_tipo_pizza', 'ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos', 'ipi_pizzas.cod_pizzas', 'ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos', 'ipi_pizzas_ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_pizzas.venda_online', '1');
        $busca = $busca->get();
        return $busca;
    }

    public function buscaIngredientes($cod_pizzaria, $cod_tamanhos, $cod_pizza)
    {
        return DB::table('ipi_ingredientes_ipi_tamanhos')
            ->select(['ipi_ingredientes_ipi_tamanhos.preco', 'ipi_ingredientes_ipi_pizzas.cod_pizzas', 'ipi_ingredientes.ingrediente', 'ipi_ingredientes.cod_ingredientes'])
            ->leftJoin('ipi_ingredientes', 'ipi_ingredientes.cod_ingredientes', 'ipi_ingredientes_ipi_tamanhos.cod_ingredientes')
            ->leftJoin('ipi_ingredientes_ipi_pizzas', 'ipi_ingredientes_ipi_pizzas.cod_ingredientes', 'ipi_ingredientes.cod_ingredientes')
            ->where('ipi_ingredientes_ipi_tamanhos.cod_pizzarias', $cod_pizzaria)
            ->where('ipi_ingredientes_ipi_tamanhos.cod_tamanhos', $cod_tamanhos)
            ->where('ipi_ingredientes_ipi_pizzas.cod_pizzas', $cod_pizza)
            ->get();
    }


    public function escolherBebidas($cod_pizzarias)
    {
        //Por as clausulas whereIn e whereNotIn
        return DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->whereIn('ipi_bebidas.cod_bebidas', array('1', '4', '8', '31', '32'))
            ->get()
            ->groupBy('ipi_bebidas.bebida');
    }

    public function selecaoBebidas($cod_pizzarias, $whereNotIn = null, $whereIn = null)
    {
        //Por as clausulas whereIn e whereNotIn
        $bebidas = DB::table('ipi_bebidas')
            ->leftJoin('ipi_bebidas_ipi_conteudos', 'ipi_bebidas.cod_bebidas', 'ipi_bebidas_ipi_conteudos.cod_bebidas')
            ->leftJoin('ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_conteudos', 'ipi_conteudos.cod_conteudos')
            ->leftJoin('ipi_conteudos_pizzarias', 'ipi_conteudos_pizzarias.cod_bebidas_ipi_conteudos', 'ipi_bebidas_ipi_conteudos.cod_bebidas_ipi_conteudos')
            ->where('ipi_bebidas_ipi_conteudos.situacao', 'ATIVO')
            ->where('ipi_conteudos_pizzarias.cod_pizzarias', $cod_pizzarias);
        if (!empty($whereNotIn)) {
            $bebidas = $bebidas->whereNotIn('ipi_bebidas.cod_tipo_bebida', $whereNotIn);
        }
        $bebidas = $bebidas->get();
        return $bebidas;
    }

    public function maisPedidas($cod_pizzarias)
    {
        return DB::table('ipi_pizzas')
            ->select(['ipi_pizzas.cod_pizzas', 'ipi_pizzas.foto_grande', 'ipi_pizzas.pizza', 'ipi_pizzas_ipi_tamanhos.preco', 'ipi_tamanhos.tamanho', 'ipi_tamanhos.cod_tamanhos'])
            ->leftJoin('ipi_tipo_pizza', 'ipi_pizzas.cod_tipo_pizza', 'ipi_tipo_pizza.cod_tipo_pizza')
            ->join('ipi_pizzas_ipi_tamanhos', 'ipi_pizzas.cod_pizzas', 'ipi_pizzas_ipi_tamanhos.cod_pizzas')
            ->leftJoin('ipi_tamanhos', 'ipi_pizzas_ipi_tamanhos.cod_tamanhos', 'ipi_tamanhos.cod_tamanhos')
            ->where('ipi_pizzas_ipi_tamanhos.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_tipo_pizza.cod_tipo_pizza', 1)
            ->get()
            ->groupBy('pizza');
    }


    public function selectCombos($cod_pizzarias)
    {
        return DB::table('ipi_combos')
            ->leftJoin('ipi_combos_produtos', 'ipi_combos.cod_combos', 'ipi_combos_produtos.cod_combos')
            ->leftJoin('ipi_combos_pizzarias', 'ipi_combos.cod_combos', 'ipi_combos_pizzarias.cod_combos')
            ->leftJoin('ipi_combos_produtos_pizzas', 'ipi_combos_produtos.cod_combos_produtos', 'ipi_combos_produtos_pizzas.cod_combos_produtos')
            ->where('ipi_combos_pizzarias.cod_pizzarias', $cod_pizzarias)
            ->where('ipi_combos.situacao', 'ATIVO')
            ->get()
            ->groupBy('nome_combo');
    }

    public function selectIngredientes($cod_pizzas)
    {
        return DB::table('ipi_ingredientes')
            ->select(['ipi_ingredientes.ingrediente', 'ipi_ingredientes.cod_ingredientes'])
            ->leftJoin('ipi_ingredientes_ipi_pizzas', 'ipi_ingredientes_ipi_pizzas.cod_ingredientes', 'ipi_ingredientes.cod_ingredientes')
            ->where('ipi_ingredientes_ipi_pizzas.cod_pizzas', $cod_pizzas)
            ->get();
    }

    public function pegatodasbordas($cod_pizzarias)
    {
        return DB::table('ipi_bordas')
            ->select(['ipi_bordas.cod_bordas', 'ipi_bordas.borda', 'ipi_bordas.cod_ingredientes', 'ipi_bordas.cod_bordas', 'ipi_tamanhos_ipi_bordas.cod_bordas', 'ipi_tamanhos_ipi_bordas.preco', 'ipi_tamanhos_ipi_bordas.cod_tamanhos'])
            ->leftJoin('ipi_tamanhos_ipi_bordas', 'ipi_bordas.cod_bordas', 'ipi_tamanhos_ipi_bordas.cod_bordas')
            ->where('ipi_tamanhos_ipi_bordas.cod_pizzarias', $cod_pizzarias)
            ->get();
    }

    public function getPedido($cod_pedido, $cod_clientes)
    {
        return IpiPedido::where('cod_pedidos', $cod_pedido)->where('cod_clientes', $this->cod_clientes)->first();
    }

    public function getTamanhos()
    {
        return IpiTamanho::get();
    }

    public function getBorda()
    {
        return IpiBorda::get();
    }

    public function getTipoMassa()
    {
        return IpiTipoMassa::get();
    }

    public function getOpcoesCorte()
    {
        return IpiOpcoesCorte::get();
    }

    public function getIngredientes()
    { }

    public function selectPedidosCliente($cod_clientes)
    {
        return DB::table('ipi_pedidos')
            ->select(
                [
                    'ipi_pedidos.cod_pedidos', 'ipi_pedidos.cod_pizzarias', 'ipi_pedidos.data_hora_pedido',
                    'ipi_pedidos.data_hora_envio', 'ipi_pedidos.valor_total', 'ipi_pedidos.origem_pedido', 'ipi_pedidos.arquivo_json'
                ]
            )
            ->where('ipi_pedidos.cod_clientes', $cod_clientes)
            ->orderBy('ipi_pedidos.cod_pedidos', 'DESC')
            ->paginate(15);
    }

    public function selectPedidosSistema($cod_clientes, $cod_pizzarias, $cod_pedidos)
    {
        return DB::table('ipi_pedidos')
            ->join('ipi_pedidos_pizzas', 'ipi_pedidos_pizzas.cod_pedidos', 'ipi_pedidos.cod_pedidos')
            ->join('ipi_pedidos_fracoes', 'ipi_pedidos_fracoes.cod_pedidos', 'ipi_pedidos.cod_pedidos')
            ->join('ipi_pedidos_bordas', 'ipi_pedidos_bordas.cod_pedidos', 'ipi_pedidos.cod_pedidos')
            ->join('ipi_pedidos_ingredientes', 'ipi_pedidos_ingredientes.cod_pedidos', 'ipi_pedidos.cod_pedidos')
            ->join('ipi_pedidos_bebidas', 'ipi_pedidos_bebidas.cod_pedidos', 'ipi_pedidos.cod_pedidos')
            ->where('ipi_pedidos.cod_pedidos', $cod_pedidos)
            ->where('ipi_pedidos.cod_clientes', $cod_clientes)
            ->where('ipi_pedidos.cod_pizzarias', $cod_pizzarias)
            ->toSql();
    }

    public function selectIngredientesAdicionais($cod_pizzaria, $cod_tamanhos)
    {
        return DB::table('ipi_ingredientes')
            ->select(['ipi_ingredientes_ipi_tamanhos.cod_tamanhos', 'ipi_ingredientes_ipi_tamanhos.cod_pizzarias', 'ipi_ingredientes_ipi_tamanhos.preco', 'ipi_ingredientes_ipi_tamanhos.cod_ingredientes', 'ipi_ingredientes.ingrediente'])
            ->leftJoin('ipi_ingredientes_ipi_tamanhos', 'ipi_ingredientes.cod_ingredientes', 'ipi_ingredientes_ipi_tamanhos.cod_ingredientes')
            ->where('ipi_ingredientes_ipi_tamanhos.cod_tamanhos', 'LIKE', '%' . $cod_tamanhos)
            ->where('ipi_ingredientes_ipi_tamanhos.cod_pizzarias', $cod_pizzaria)
            ->get();
    }

    public function selectBorda($cod_tamanho, $cod_pizzarias)
    {
        return DB::table('ipi_bordas')
            ->select(['ipi_bordas.borda', 'ipi_bordas.cod_bordas', 'ipi_tamanhos_ipi_bordas.preco'])
            ->leftJoin('ipi_tamanhos_ipi_bordas', 'ipi_tamanhos_ipi_bordas.cod_bordas', 'ipi_bordas.cod_bordas')
            ->where('ipi_tamanhos_ipi_bordas.cod_tamanhos', $cod_tamanho)
            ->where('ipi_tamanhos_ipi_bordas.cod_pizzarias', $cod_pizzarias)
            ->get();
    }

    public function ingredientesNaoInclusos($cod_pedidos,$cod_pedidos_pizzas,$cod_pedidos_fracoes,$cod_pizzas){
        return DB::select("SELECT i.ingrediente FROM ipi_ingredientes i INNER JOIN ipi_ingredientes_ipi_pizzas p ON (i.cod_ingredientes = p.cod_ingredientes) WHERE p.cod_ingredientes NOT IN (SELECT pi.cod_ingredientes FROM ipi_pedidos_ingredientes pi INNER JOIN ipi_pedidos_fracoes pf ON (pi.cod_pedidos_fracoes = pf.cod_pedidos_fracoes AND pi.cod_pedidos_pizzas = pf.cod_pedidos_pizzas AND pi.cod_pedidos = pf.cod_pedidos) INNER JOIN ipi_pedidos_pizzas pp ON(pf.cod_pedidos = pp.cod_pedidos AND pf.cod_pedidos_pizzas = pp.cod_pedidos_pizzas) WHERE pi.cod_pedidos = '" . $cod_pedidos . "' AND pi.cod_pedidos_pizzas = '" . $cod_pedidos_pizzas . "' AND pi.cod_pedidos_fracoes = '" . $cod_pedidos_fracoes . "' AND pi.ingrediente_padrao = 1) AND p.cod_pizzas = '" . $cod_pizzas . "' AND i.consumo = 0");
    }

    public function ingredientesInclusos($cod_pedidos,$cod_pedidos_pizzas,$cod_pedidos_fracoes,$cod_pizzas){
        return DB::select("SELECT pzi.ingrediente,(select ingrediente from ipi_ingredientes where cod_ingredientes = pi.cod_ingrediente_trocado) as nome_trocado FROM ipi_pedidos_ingredientes pi INNER JOIN ipi_pedidos_fracoes pf ON (pi.cod_pedidos_fracoes = pf.cod_pedidos_fracoes AND pi.cod_pedidos_pizzas = pf.cod_pedidos_pizzas AND pi.cod_pedidos = pf.cod_pedidos) INNER JOIN ipi_ingredientes pzi ON (pi.cod_ingredientes = pzi.cod_ingredientes) INNER JOIN ipi_pedidos_pizzas pp ON(pf.cod_pedidos = pp.cod_pedidos AND pf.cod_pedidos_pizzas = pp.cod_pedidos_pizzas) WHERE pi.cod_pedidos = '" . $cod_pedidos . "' AND pi.cod_pedidos_pizzas = '" . $cod_pedidos_pizzas . "' AND pi.cod_pedidos_fracoes = '" . $cod_pedidos_fracoes . "' AND pi.ingrediente_padrao = 0");
    }

    public function Utf8_ansi($valor = '')
	{
		$Utf8_ansi2 = array(
			"u00c0" => "À",
			"u00c1" => "Á",
			"u00c2" => "Â",
			"u00c3" => "Ã",
			"u00c4" => "Ä",
			"u00c5" => "Å",
			"u00c6" => "Æ",
			"u00c7" => "Ç",
			"u00c8" => "È",
			"u00c9" => "É",
			"u00ca" => "Ê",
			"u00cb" => "Ë",
			"u00cc" => "Ì",
			"u00cd" => "Í",
			"u00ce" => "Î",
			"u00cf" => "Ï",
			"u00d1" => "Ñ",
			"u00d2" => "Ò",
			"u00d3" => "Ó",
			"u00d4" => "Ô",
			"u00d5" => "Õ",
			"u00d6" => "Ö",
			"u00d8" => "Ø",
			"u00d9" => "Ù",
			"u00da" => "Ú",
			"u00db" => "Û",
			"u00dc" => "Ü",
			"u00dd" => "Ý",
			"u00df" => "ß",
			"u00e0" => "à",
			"u00e1" => "á",
			"u00e2" => "â",
			"u00e3" => "ã",
			"u00e4" => "ä",
			"u00e5" => "å",
			"u00e6" => "æ",
			"u00e7" => "ç",
			"u00e8" => "è",
			"u00e9" => "é",
			"u00ea" => "ê",
			"u00eb" => "ë",
			"u00ec" => "ì",
			"u00ed" => "í",
			"u00ee" => "î",
			"u00ef" => "ï",
			"u00f0" => "ð",
			"u00f1" => "ñ",
			"u00f2" => "ò",
			"u00f3" => "ó",
			"u00f4" => "ô",
			"u00f5" => "õ",
			"u00f6" => "ö",
			"u00f8" => "ø",
			"u00f9" => "ù",
			"u00fa" => "ú",
			"u00fb" => "û",
			"u00fc" => "ü",
			"u00fd" => "ý",
			"u00ff" => "ÿ",
			"u00bd" => "1/2",
			"u2022u2022u2022u2022 " => "******"
		);
		return strtr($valor, $Utf8_ansi2);
    }
    
    public function contemString($string)
	{
		$bebidas = array('pudim', 'bebida', 'refrigerante', 'coca', 'cerveja', 'fanta', 'guarana', 'guaraná', 'agua', 'água', 'suco', 'lata vinho');
		$encontrou = false;
		foreach ($bebidas as $key => $value) {
			if (strstr(strtolower($string), $value)) {
				$encontrou = true;
			}
		}
		return $encontrou;
	}
}
