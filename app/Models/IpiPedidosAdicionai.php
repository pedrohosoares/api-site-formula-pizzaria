<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosAdicionai
 * 
 * @property int $cod_pedidos_adicionais
 * @property int $cod_pedidos
 * @property int $cod_pedidos_pizzas
 * @property int $cod_adicionais
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property bool $promocional
 * @property bool $fidelidade
 * 
 * @property \App\Models\IpiAdicionai $ipi_adicionai
 * @property \App\Models\IpiPedidosPizza $ipi_pedidos_pizza
 *
 * @package App\Models
 */
class IpiPedidosAdicionai extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_pedidos_pizzas' => 'int',
		'cod_adicionais' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int',
		'promocional' => 'bool',
		'fidelidade' => 'bool'
	];

	protected $fillable = [
		'cod_adicionais',
		'preco',
		'pontos_fidelidade',
		'promocional',
		'fidelidade'
	];

	public function ipi_adicionai()
	{
		return $this->belongsTo(\App\Models\IpiAdicionai::class, 'cod_adicionais');
	}

	public function ipi_pedidos_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPedidosPizza::class, 'cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos_pizzas', '=', 'ipi_pedidos_adicionais.cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos', '=', 'ipi_pedidos_adicionais.cod_pedidos');
	}
}
