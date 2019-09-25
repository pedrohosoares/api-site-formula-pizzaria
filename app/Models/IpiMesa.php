<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiMesa
 * 
 * @property int $cod_mesas
 * @property int $cod_pizzarias
 * @property int $cod_mesas_situacoes
 * @property string $codigo_cliente_mesa
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiMesasSituaco $ipi_mesas_situaco
 *
 * @package App\Models
 */
class IpiMesa extends Eloquent
{
	protected $primaryKey = 'cod_mesas';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_mesas_situacoes' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_mesas_situacoes',
		'codigo_cliente_mesa'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_mesas_situaco()
	{
		return $this->belongsTo(\App\Models\IpiMesasSituaco::class, 'cod_mesas_situacoes');
	}
}
