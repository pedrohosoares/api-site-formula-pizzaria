<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosTaxa
 * 
 * @property int $cod_pedidos_taxas
 * @property int $cod_pedidos
 * @property int $cod_mesas_taxas
 * @property int $cod_usuarios_inclusao
 * @property int $cod_colaboradores_inclusao
 * @property \Carbon\Carbon $data_hora_inclusao
 * @property int $quantidade
 * @property float $preco_unitario
 * @property float $preco_total
 * @property int $cod_colaboradores_cancelamento
 * @property \Carbon\Carbon $data_hora_cancelamento
 * @property string $situacao_pedidos_taxas
 *
 * @package App\Models
 */
class IpiPedidosTaxa extends Eloquent
{
	protected $primaryKey = 'cod_pedidos_taxas';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_mesas_taxas' => 'int',
		'cod_usuarios_inclusao' => 'int',
		'cod_colaboradores_inclusao' => 'int',
		'quantidade' => 'int',
		'preco_unitario' => 'float',
		'preco_total' => 'float',
		'cod_colaboradores_cancelamento' => 'int'
	];

	protected $dates = [
		'data_hora_inclusao',
		'data_hora_cancelamento'
	];

	protected $fillable = [
		'cod_pedidos',
		'cod_mesas_taxas',
		'cod_usuarios_inclusao',
		'cod_colaboradores_inclusao',
		'data_hora_inclusao',
		'quantidade',
		'preco_unitario',
		'preco_total',
		'cod_colaboradores_cancelamento',
		'data_hora_cancelamento',
		'situacao_pedidos_taxas'
	];
}
