<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCaixaIpiPedido
 * 
 * @property int $cod_caixa
 * @property int $cod_pedidos
 * 
 * @property \App\Models\IpiCaixa $ipi_caixa
 * @property \App\Models\IpiPedido $ipi_pedido
 *
 * @package App\Models
 */
class IpiCaixaIpiPedido extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_caixa' => 'int',
		'cod_pedidos' => 'int'
	];

	public function ipi_caixa()
	{
		return $this->belongsTo(\App\Models\IpiCaixa::class, 'cod_caixa');
	}

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}
}
