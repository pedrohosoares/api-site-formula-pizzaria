<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoTicketsLog
 * 
 * @property int $cod_tickets
 * @property int $cod_logs
 * @property string $tipo_alteracao
 * @property int $cod_usuarios_alteracao
 * @property string $valor_alteracao
 * @property \Carbon\Carbon $data_hora_alteracao
 *
 * @package App\Models
 */
class IpiComunicacaoTicketsLog extends Eloquent
{
	protected $table = 'ipi_comunicacao_tickets_log';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tickets' => 'int',
		'cod_logs' => 'int',
		'cod_usuarios_alteracao' => 'int'
	];

	protected $dates = [
		'data_hora_alteracao'
	];

	protected $fillable = [
		'cod_tickets',
		'cod_logs',
		'tipo_alteracao',
		'cod_usuarios_alteracao',
		'valor_alteracao',
		'data_hora_alteracao'
	];
}
