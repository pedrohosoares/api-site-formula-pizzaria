<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoTicketsIpiPizzaria
 * 
 * @property int $cod_tickets
 * @property int $cod_pizzarias
 * 
 * @property \App\Models\IpiComunicacaoTicket $ipi_comunicacao_ticket
 *
 * @package App\Models
 */
class IpiComunicacaoTicketsIpiPizzaria extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tickets' => 'int',
		'cod_pizzarias' => 'int'
	];

	public function ipi_comunicacao_ticket()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoTicket::class, 'cod_tickets');
	}
}
