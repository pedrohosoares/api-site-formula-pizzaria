<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosIpiEnquete
 * 
 * @property int $cod_pedidos
 * @property int $cod_enquetes
 * @property \Carbon\Carbon $data_hora_gravacao
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 * @property \App\Models\IpiEnquete $ipi_enquete
 *
 * @package App\Models
 */
class IpiPedidosIpiEnquete extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_enquetes' => 'int'
	];

	protected $dates = [
		'data_hora_gravacao'
	];

	protected $fillable = [
		'data_hora_gravacao'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}

	public function ipi_enquete()
	{
		return $this->belongsTo(\App\Models\IpiEnquete::class, 'cod_enquetes');
	}
}
