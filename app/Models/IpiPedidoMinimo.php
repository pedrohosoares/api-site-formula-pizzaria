<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidoMinimo
 * 
 * @property int $cod_pedido_minimo
 * @property string $descricao
 * @property float $valor_pedido_minimo
 *
 * @package App\Models
 */
class IpiPedidoMinimo extends Eloquent
{
	protected $table = 'ipi_pedido_minimo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pedido_minimo' => 'int',
		'valor_pedido_minimo' => 'float'
	];

	protected $fillable = [
		'cod_pedido_minimo',
		'descricao',
		'valor_pedido_minimo'
	];
}
