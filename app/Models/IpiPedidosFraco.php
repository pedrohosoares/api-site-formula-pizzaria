<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosFraco
 * 
 * @property int $cod_pedidos_fracoes
 * @property int $cod_pedidos
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pizzas
 * @property int $fracao
 * @property float $preco
 * @property int $pontos_fidelidade_pizza
 * @property bool $pizza_dia
 * @property bool $pizza_semana
 * @property string $obs_fracao
 * @property string $obs_ifood
 * 
 * @property \App\Models\IpiPedidosPizza $ipi_pedidos_pizza
 * @property \App\Models\IpiPizza $ipi_pizza
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_ingredientes
 *
 * @package App\Models
 */
class IpiPedidosFraco extends Eloquent
{
	protected $table = 'ipi_pedidos_fracoes';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_pedidos_pizzas' => 'int',
		'cod_pizzas' => 'int',
		'fracao' => 'int',
		'preco' => 'float',
		'pontos_fidelidade_pizza' => 'int',
		'pizza_dia' => 'bool',
		'pizza_semana' => 'bool'
	];

	protected $fillable = [
		'cod_pizzas',
		'fracao',
		'preco',
		'pontos_fidelidade_pizza',
		'pizza_dia',
		'pizza_semana',
		'obs_fracao',
		'obs_ifood'
	];

	public function ipi_pedidos_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPedidosPizza::class, 'cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos_pizzas', '=', 'ipi_pedidos_fracoes.cod_pedidos_pizzas')
					->where('ipi_pedidos_pizzas.cod_pedidos', '=', 'ipi_pedidos_fracoes.cod_pedidos');
	}

	public function ipi_pedidos_pizza_unico(){
		return $this->hasOne(\App\Models\IpiPedidosPizza::class,'cod_pedidos_pizzas','cod_pedidos_pizzas');
	}

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}

	public function ipi_pedidos_ingredientes()
	{
		return $this->hasMany(\App\Models\IpiPedidosIngrediente::class, 'cod_pedidos_fracoes');
	}
}
