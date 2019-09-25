<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosInfo
 * 
 * @property int $cod_pedidos_info
 * @property int $cod_pedidos
 * @property string $chave
 * @property string $conteudo
 *
 * @package App\Models
 */
class IpiPedidosInfo extends Eloquent
{
	protected $table = 'ipi_pedidos_info';
	protected $primaryKey = 'cod_pedidos_info';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int'
	];

	protected $fillable = [
		'cod_pedidos',
		'chave',
		'conteudo'
	];
}
