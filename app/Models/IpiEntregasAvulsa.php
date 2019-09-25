<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEntregasAvulsa
 * 
 * @property int $cod_entregas_avulsas
 * @property int $cod_pedidos
 * @property int $cod_entregadores
 * @property int $cod_pizzarias
 * @property \Carbon\Carbon $data_hora_entrega
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property float $valor
 * @property string $tipo_entrega
 * @property string $obs_entrega_avulsa
 * 
 * @property \App\Models\IpiEntregadore $ipi_entregadore
 *
 * @package App\Models
 */
class IpiEntregasAvulsa extends Eloquent
{
	protected $primaryKey = 'cod_entregas_avulsas';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_entregadores' => 'int',
		'cod_pizzarias' => 'int',
		'valor' => 'float'
	];

	protected $dates = [
		'data_hora_entrega'
	];

	protected $fillable = [
		'cod_pedidos',
		'cod_entregadores',
		'cod_pizzarias',
		'data_hora_entrega',
		'bairro',
		'cidade',
		'estado',
		'valor',
		'tipo_entrega',
		'obs_entrega_avulsa'
	];

	public function ipi_entregadore()
	{
		return $this->belongsTo(\App\Models\IpiEntregadore::class, 'cod_entregadores');
	}
}
