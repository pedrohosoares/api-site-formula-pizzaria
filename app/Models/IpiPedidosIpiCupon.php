<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosIpiCupon
 * 
 * @property int $cod_pedidos
 * @property int $cod_cupons
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 * @property \App\Models\IpiCupon $ipi_cupon
 *
 * @package App\Models
 */
class IpiPedidosIpiCupon extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_cupons' => 'int'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}

	public function ipi_cupon()
	{
		return $this->belongsTo(\App\Models\IpiCupon::class, 'cod_cupons');
	}
}
