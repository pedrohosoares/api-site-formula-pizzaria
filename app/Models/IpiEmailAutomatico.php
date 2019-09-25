<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEmailAutomatico
 * 
 * @property int $cod_email_automatico
 * @property int $cod_clientes
 * @property string $tipo_email
 * @property \Carbon\Carbon $data_hora_envio
 * @property int $cod_pizzarias
 * @property int $cod_cupons
 * 
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiEmailAutomatico extends Eloquent
{
	protected $table = 'ipi_email_automatico';
	protected $primaryKey = 'cod_email_automatico';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_pizzarias' => 'int',
		'cod_cupons' => 'int'
	];

	protected $dates = [
		'data_hora_envio'
	];

	protected $fillable = [
		'cod_clientes',
		'tipo_email',
		'data_hora_envio',
		'cod_pizzarias',
		'cod_cupons'
	];

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
