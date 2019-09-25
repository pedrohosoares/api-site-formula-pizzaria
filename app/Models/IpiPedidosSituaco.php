<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosSituaco
 * 
 * @property int $cod_pedidos_situacoes
 * @property int $cod_pedidos
 * @property string $situacao
 * @property \Carbon\Carbon $data_hora_situacao
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 *
 * @package App\Models
 */
class IpiPedidosSituaco extends Eloquent
{
	protected $table = 'ipi_pedidos_situacoes';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int'
	];

	protected $dates = [
		'data_hora_situacao'
	];

	protected $fillable = [
		'situacao',
		'data_hora_situacao'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}
}
