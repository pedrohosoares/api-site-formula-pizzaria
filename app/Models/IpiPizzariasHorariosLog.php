<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariasHorariosLog
 * 
 * @property int $cod_pizzarias_horarios_log
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property int $cod_pizzarias_horarios
 * @property \Carbon\Carbon $data_hora_alteracao
 * @property int $tempo_entrega
 *
 * @package App\Models
 */
class IpiPizzariasHorariosLog extends Eloquent
{
	protected $table = 'ipi_pizzarias_horarios_log';
	protected $primaryKey = 'cod_pizzarias_horarios_log';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int',
		'cod_pizzarias_horarios' => 'int',
		'tempo_entrega' => 'int'
	];

	protected $dates = [
		'data_hora_alteracao'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_pizzarias',
		'cod_pizzarias_horarios',
		'data_hora_alteracao',
		'tempo_entrega'
	];
}
