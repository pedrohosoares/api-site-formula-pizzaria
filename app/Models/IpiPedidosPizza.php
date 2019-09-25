<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosPizza
 * 
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pedidos
 * @property int $cod_tamanhos
 * @property int $cod_opcoes_corte
 * @property int $cod_usuarios_inclusao
 * @property int $cod_colaboradores_inclusao
 * @property \Carbon\Carbon $data_hora_inclusao
 * @property int $quant_fracao
 * @property float $preco
 * @property bool $promocional
 * @property bool $fidelidade
 * @property bool $combo
 * @property int $pontos_fidelidade
 * @property int $cod_tipo_massa
 * @property float $preco_massa
 * @property int $cod_combos_produtos
 * @property float $preco_inteiro
 * @property int $cod_motivo_promocoes
 * @property int $cod_pedidos_combos
 * @property string $impressao_etiqueta
 * @property string $versao_software_etiqueta
 * @property int $cod_colaboradores_cancelamento
 * @property \Carbon\Carbon $data_hora_cancelamento
 * @property string $situacao_pedidos_pizzas
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_adicionais
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_bordas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_fracos
 *
 * @package App\Models
 */
class IpiPedidosPizza extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_tamanhos' => 'int',
		'cod_opcoes_corte' => 'int',
		'cod_usuarios_inclusao' => 'int',
		'cod_colaboradores_inclusao' => 'int',
		'quant_fracao' => 'int',
		'preco' => 'float',
		'promocional' => 'bool',
		'fidelidade' => 'bool',
		'combo' => 'bool',
		'pontos_fidelidade' => 'int',
		'cod_tipo_massa' => 'int',
		'preco_massa' => 'float',
		'cod_combos_produtos' => 'int',
		'preco_inteiro' => 'float',
		'cod_motivo_promocoes' => 'int',
		'cod_pedidos_combos' => 'int',
		'cod_colaboradores_cancelamento' => 'int'
	];

	protected $dates = [
		'data_hora_inclusao',
		'data_hora_cancelamento'
	];

	protected $fillable = [
		'cod_tamanhos',
		'cod_opcoes_corte',
		'cod_usuarios_inclusao',
		'cod_colaboradores_inclusao',
		'data_hora_inclusao',
		'quant_fracao',
		'preco',
		'promocional',
		'fidelidade',
		'combo',
		'pontos_fidelidade',
		'cod_tipo_massa',
		'preco_massa',
		'cod_combos_produtos',
		'preco_inteiro',
		'cod_motivo_promocoes',
		'cod_pedidos_combos',
		'impressao_etiqueta',
		'versao_software_etiqueta',
		'cod_colaboradores_cancelamento',
		'data_hora_cancelamento',
		'situacao_pedidos_pizzas'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_pedidos_adicionais()
	{
		return $this->hasMany(\App\Models\IpiPedidosAdicionai::class, 'cod_pedidos_pizzas');
	}

	public function ipi_pedidos_bordas()
	{
		return $this->hasMany(\App\Models\IpiPedidosBorda::class, 'cod_pedidos_pizzas');
	}

	public function ipi_pedidos_fracos()
	{
		return $this->hasMany(\App\Models\IpiPedidosFraco::class, 'cod_pedidos_pizzas');
	}
}
