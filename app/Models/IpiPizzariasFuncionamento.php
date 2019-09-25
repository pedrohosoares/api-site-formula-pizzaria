<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasFuncionamento
 * 
 * @property int $cod_pizzarias_funcionamento
 * @property int $cod_pizzarias
 * @property int $dia_semana
 * @property \Carbon\Carbon $horario_inicial
 * @property \Carbon\Carbon $horario_final
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiPizzariasFuncionamento extends Eloquent
{
	protected $table = 'ipi_pizzarias_funcionamento';
	protected $primaryKey = 'cod_pizzarias_funcionamento';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'dia_semana' => 'int'
	];

	protected $dates = [
		'horario_inicial',
		'horario_final'
	];

	protected $fillable = [
		'cod_pizzarias',
		'dia_semana',
		'horario_inicial',
		'horario_final'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
