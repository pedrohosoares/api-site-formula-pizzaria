<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesLog
 * 
 * @property int $cod_clientes
 * @property int $cod_usuarios_alteracao
 * @property string $tipo_alteracao
 * @property string $valor_novo
 * @property \Carbon\Carbon $data_hora_alteracao
 *
 * @package App\Models
 */
class IpiClientesLog extends Eloquent
{
	protected $table = 'ipi_clientes_log';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_usuarios_alteracao' => 'int'
	];

	protected $dates = [
		'data_hora_alteracao'
	];

	protected $fillable = [
		'cod_clientes',
		'cod_usuarios_alteracao',
		'tipo_alteracao',
		'valor_novo',
		'data_hora_alteracao'
	];
}
