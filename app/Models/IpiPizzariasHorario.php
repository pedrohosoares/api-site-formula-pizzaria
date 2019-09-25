<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasHorario
 * 
 * @property int $cod_pizzarias_horarios
 * @property int $cod_pizzarias
 * @property \Carbon\Carbon $horario_inicial_entrega
 * @property \Carbon\Carbon $horario_final_entrega
 * @property int $tempo_entrega
 * @property int $tempo_entrega_ideal
 * @property int $tempo_entrega_max
 * @property int $dia_semana
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiPizzariasHorario extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'tempo_entrega' => 'int',
		'tempo_entrega_ideal' => 'int',
		'tempo_entrega_max' => 'int',
		'dia_semana' => 'int'
	];

	protected $dates = [
		'horario_inicial_entrega',
		'horario_final_entrega'
	];

	protected $fillable = [
		'horario_inicial_entrega',
		'horario_final_entrega',
		'tempo_entrega',
		'tempo_entrega_ideal',
		'tempo_entrega_max',
		'dia_semana'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
