<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiLog
 * 
 * @property int $cod_ipi_log
 * @property \Carbon\Carbon $data_hora
 * @property int $cod_usuarios
 * @property int $cod_pedidos
 * @property int $cod_clientes
 * @property int $cod_pizzarias
 * @property string $tipo
 * @property string $palavra_chave
 * @property int $email_enviado
 * @property string $valor
 *
 * @package App\Models
 */
class IpiLog extends Eloquent
{
	protected $table = 'ipi_log';
	protected $primaryKey = 'cod_ipi_log';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_pedidos' => 'int',
		'cod_clientes' => 'int',
		'cod_pizzarias' => 'int',
		'email_enviado' => 'int'
	];

	protected $dates = [
		'data_hora'
	];

	protected $fillable = [
		'data_hora',
		'cod_usuarios',
		'cod_pedidos',
		'cod_clientes',
		'cod_pizzarias',
		'tipo',
		'palavra_chave',
		'email_enviado',
		'valor'
	];
}
