<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosFormasPg
 * 
 * @property int $cod_pedidos_formas_pg
 * @property int $cod_pedidos
 * @property int $cod_formas_pg
 * @property float $valor
 * @property int $prepago
 * @property array $pagamento_json
 *
 * @package App\Models
 */
class IpiPedidosFormasPg extends Eloquent
{
	protected $table = 'ipi_pedidos_formas_pg';
	protected $primaryKey = 'cod_pedidos_formas_pg';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_formas_pg' => 'int',
		'valor' => 'float',
		'prepago' => 'int',
		'pagamento_json' => 'json'
	];

	protected $fillable = [
		'cod_pedidos',
		'cod_formas_pg',
		'valor',
		'prepago',
		'pagamento_json'
	];
}
