<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosMotivoCancelamento
 * 
 * @property int $cod_pedidos_motivo_cancelamento
 * @property string $motivo_cancelamento
 * @property bool $debitar_estoque_ingrediente
 * @property bool $debitar_estoque_bebida
 *
 * @package App\Models
 */
class IpiPedidosMotivoCancelamento extends Eloquent
{
	protected $table = 'ipi_pedidos_motivo_cancelamento';
	protected $primaryKey = 'cod_pedidos_motivo_cancelamento';
	public $timestamps = false;

	protected $casts = [
		'debitar_estoque_ingrediente' => 'bool',
		'debitar_estoque_bebida' => 'bool'
	];

	protected $fillable = [
		'motivo_cancelamento',
		'debitar_estoque_ingrediente',
		'debitar_estoque_bebida'
	];
}
