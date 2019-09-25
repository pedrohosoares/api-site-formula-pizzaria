<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasEstatistica
 * 
 * @property int $cod_pizzarias_estatisticas
 * @property int $cod_pizzarias
 * @property \Carbon\Carbon $data_inicio
 * @property \Carbon\Carbon $data_fim
 * @property float $valor
 * @property string $estatistica
 * @property string $tipo
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiPizzariasEstatistica extends Eloquent
{
	protected $primaryKey = 'cod_pizzarias_estatisticas';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'valor' => 'float'
	];

	protected $dates = [
		'data_inicio',
		'data_fim'
	];

	protected $fillable = [
		'cod_pizzarias',
		'data_inicio',
		'data_fim',
		'valor',
		'estatistica',
		'tipo'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
