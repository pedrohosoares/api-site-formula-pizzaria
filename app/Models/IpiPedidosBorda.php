<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosBorda
 * 
 * @property int $cod_pedidos_bordas
 * @property int $cod_pedidos
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pedidos_combos
 * @property int $cod_bordas
 * @property int $cod_combos_produtos
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property bool $promocional
 * @property bool $fidelidade
 * @property bool $combo
 * @property float $preco_inteiro
 * @property int $cod_motivo_promocoes
 * 
 * @property \App\Models\IpiBorda $ipi_borda
 * @property \App\Models\IpiPedidosPizza $ipi_pedidos_pizza
 *
 * @package App\Models
 */
class IpiPedidosBorda extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_pedidos_pizzas' => 'int',
		'cod_pedidos_combos' => 'int',
		'cod_bordas' => 'int',
		'cod_combos_produtos' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int',
		'promocional' => 'bool',
		'fidelidade' => 'bool',
		'combo' => 'bool',
		'preco_inteiro' => 'float',
		'cod_motivo_promocoes' => 'int'
	];

	protected $fillable = [
		'cod_pedidos_combos',
		'cod_bordas',
		'cod_combos_produtos',
		'preco',
		'pontos_fidelidade',
		'promocional',
		'fidelidade',
		'combo',
		'preco_inteiro',
		'cod_motivo_promocoes'
	];

	public function ipi_borda()
	{
		return $this->belongsTo(\App\Models\IpiBorda::class, 'cod_bordas');
	}

	public function ipi_pedidos_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPedidosPizza::class, 'cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos_pizzas', '=', 'ipi_pedidos_bordas.cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos', '=', 'ipi_pedidos_bordas.cod_pedidos');
	}
}
