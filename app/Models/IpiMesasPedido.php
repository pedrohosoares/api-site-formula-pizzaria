<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesasPedido
 * 
 * @property int $cod_mesas_pedidos
 * @property int $cod_pedidos
 * @property int $cod_mesas
 * @property int $cod_usuarios_abertura
 * @property \Carbon\Carbon $data_hora_abertura
 * @property int $cod_usuarios_fechamento
 * @property \Carbon\Carbon $data_hora_fechamento
 * @property int $numero_pessoas
 * @property string $situacao_pedido_mesa
 *
 * @package App\Models
 */
class IpiMesasPedido extends Eloquent
{
	protected $primaryKey = 'cod_mesas_pedidos';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_mesas' => 'int',
		'cod_usuarios_abertura' => 'int',
		'cod_usuarios_fechamento' => 'int',
		'numero_pessoas' => 'int'
	];

	protected $dates = [
		'data_hora_abertura',
		'data_hora_fechamento'
	];

	protected $fillable = [
		'cod_pedidos',
		'cod_mesas',
		'cod_usuarios_abertura',
		'data_hora_abertura',
		'cod_usuarios_fechamento',
		'data_hora_fechamento',
		'numero_pessoas',
		'situacao_pedido_mesa'
	];
}
