<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiClientesBloqueioLog
 * 
 * @property int $cod_clientes_bloqueio_log
 * @property int $cod_clientes
 * @property int $cod_clientes_bloqueio
 * @property \Carbon\Carbon $data_hora_bloqueio
 * 
 * @property \App\Models\IpiClientesBloqueio $ipi_clientes_bloqueio
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiClientesBloqueioLog extends Eloquent
{
	protected $table = 'ipi_clientes_bloqueio_log';
	protected $primaryKey = 'cod_clientes_bloqueio_log';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_clientes_bloqueio' => 'int'
	];

	protected $dates = [
		'data_hora_bloqueio'
	];

	protected $fillable = [
		'cod_clientes',
		'cod_clientes_bloqueio',
		'data_hora_bloqueio'
	];

	public function ipi_clientes_bloqueio()
	{
		return $this->belongsTo(\App\Models\IpiClientesBloqueio::class, 'cod_clientes_bloqueio');
	}

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
