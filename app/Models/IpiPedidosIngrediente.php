<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosIngrediente
 * 
 * @property int $cod_pedidos_ingredientes
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pedidos
 * @property int $cod_pedidos_fracoes
 * @property int $cod_ingredientes
 * @property int $cod_ingrediente_trocado
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property bool $ingrediente_padrao
 * @property bool $promocional
 * @property bool $fidelidade
 * 
 * @property \App\Models\IpiIngrediente $ipi_ingrediente
 * @property \App\Models\IpiPedidosFraco $ipi_pedidos_fraco
 *
 * @package App\Models
 */
class IpiPedidosIngrediente extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos_pizzas' => 'int',
		'cod_pedidos' => 'int',
		'cod_pedidos_fracoes' => 'int',
		'cod_ingredientes' => 'int',
		'cod_ingrediente_trocado' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int',
		'ingrediente_padrao' => 'bool',
		'promocional' => 'bool',
		'fidelidade' => 'bool'
	];

	protected $fillable = [
		'cod_ingredientes',
		'cod_ingrediente_trocado',
		'preco',
		'pontos_fidelidade',
		'ingrediente_padrao',
		'promocional',
		'fidelidade'
	];

	public function ipi_ingrediente()
	{
		return $this->belongsTo(\App\Models\IpiIngrediente::class, 'cod_ingredientes');
	}

	public function ipi_pedidos_fraco()
	{
		return $this->belongsTo(\App\Models\IpiPedidosFraco::class, 'cod_pedidos_fracoes')
					->where('ipi_pedidos_fracoes.cod_pedidos_fracoes', '=', 'ipi_pedidos_ingredientes.cod_pedidos_fracoes')
					->where('ipi_pedidos_fracoes.cod_pedidos', '=', 'ipi_pedidos_ingredientes.cod_pedidos')
					->where('ipi_pedidos_fracoes.cod_pedidos_pizzas', '=', 'ipi_pedidos_ingredientes.cod_pedidos_pizzas');
	}
}
