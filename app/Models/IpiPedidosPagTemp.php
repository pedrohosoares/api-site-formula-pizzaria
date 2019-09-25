<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosPagTemp
 * 
 * @property int $cod_pedidos_pag_temp
 * @property string $cod_pedido_operadora
 * @property string $chave
 * @property string $valor
 * @property \Carbon\Carbon $data_hora_gravacao
 *
 * @package App\Models
 */
class IpiPedidosPagTemp extends Eloquent
{
	protected $table = 'ipi_pedidos_pag_temp';
	protected $primaryKey = 'cod_pedidos_pag_temp';
	public $timestamps = false;

	protected $dates = [
		'data_hora_gravacao'
	];

	protected $fillable = [
		'cod_pedido_operadora',
		'chave',
		'valor',
		'data_hora_gravacao'
	];
}
