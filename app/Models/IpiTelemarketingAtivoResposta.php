<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiTelemarketingAtivoResposta
 * 
 * @property int $cod_telemarketing_ativo_respostas
 * @property int $cod_clientes
 * @property int $cod_telemarketing_ativo
 * @property \Carbon\Carbon $data_hora_telemarketing_resposta
 * 
 * @property \App\Models\IpiTelemarketingAtivo $ipi_telemarketing_ativo
 * @property \App\Models\IpiCliente $ipi_cliente
 *
 * @package App\Models
 */
class IpiTelemarketingAtivoResposta extends Eloquent
{
	protected $primaryKey = 'cod_telemarketing_ativo_respostas';
	public $timestamps = false;

	protected $casts = [
		'cod_clientes' => 'int',
		'cod_telemarketing_ativo' => 'int'
	];

	protected $dates = [
		'data_hora_telemarketing_resposta'
	];

	protected $fillable = [
		'cod_clientes',
		'cod_telemarketing_ativo',
		'data_hora_telemarketing_resposta'
	];

	public function ipi_telemarketing_ativo()
	{
		return $this->belongsTo(\App\Models\IpiTelemarketingAtivo::class, 'cod_telemarketing_ativo');
	}

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}
}
