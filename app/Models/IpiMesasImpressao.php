<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasImpressao
 * 
 * @property int $cod_mesas_impressao
 * @property int $cod_pizzarias
 * @property int $cod_mesas_pedidos
 * @property int $cod_pedidos
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pedidos_bebidas
 * @property int $cod_impressoras
 * @property int $cod_mesas_ordem_impressao
 * @property string $tipo_impressao
 * @property string $software_impressao
 * @property string $situacao_impressao
 *
 * @package App\Models
 */
class IpiMesasImpressao extends Eloquent
{
	protected $table = 'ipi_mesas_impressao';
	protected $primaryKey = 'cod_mesas_impressao';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_mesas_pedidos' => 'int',
		'cod_pedidos' => 'int',
		'cod_pedidos_pizzas' => 'int',
		'cod_pedidos_bebidas' => 'int',
		'cod_impressoras' => 'int',
		'cod_mesas_ordem_impressao' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_mesas_pedidos',
		'cod_pedidos',
		'cod_pedidos_pizzas',
		'cod_pedidos_bebidas',
		'cod_impressoras',
		'cod_mesas_ordem_impressao',
		'tipo_impressao',
		'software_impressao',
		'situacao_impressao'
	];
}
