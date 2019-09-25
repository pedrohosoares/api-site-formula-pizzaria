<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoTicketsArquivo
 * 
 * @property int $cod_tickets
 * @property int $cod_comentarios
 * @property string $nome_arquivo
 * @property string $descricao_arquivo
 * @property \Carbon\Carbon $data_hora_adicao
 * 
 * @property \App\Models\IpiComunicacaoTicket $ipi_comunicacao_ticket
 *
 * @package App\Models
 */
class IpiComunicacaoTicketsArquivo extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_tickets' => 'int',
		'cod_comentarios' => 'int'
	];

	protected $dates = [
		'data_hora_adicao'
	];

	protected $fillable = [
		'cod_tickets',
		'cod_comentarios',
		'nome_arquivo',
		'descricao_arquivo',
		'data_hora_adicao'
	];

	public function ipi_comunicacao_ticket()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoTicket::class, 'cod_tickets');
	}
}
