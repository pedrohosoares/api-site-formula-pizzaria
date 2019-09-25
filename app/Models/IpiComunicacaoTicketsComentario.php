<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoTicketsComentario
 * 
 * @property int $cod_comentarios
 * @property int $cod_tickets
 * @property int $cod_usuarios
 * @property string $comentario
 * @property string $status
 * @property \Carbon\Carbon $data_hora_comentario
 * 
 * @property \App\Models\IpiComunicacaoTicket $ipi_comunicacao_ticket
 * @property \App\Models\NucUsuario $nuc_usuario
 *
 * @package App\Models
 */
class IpiComunicacaoTicketsComentario extends Eloquent
{
	protected $primaryKey = 'cod_comentarios';
	public $timestamps = false;

	protected $casts = [
		'cod_tickets' => 'int',
		'cod_usuarios' => 'int'
	];

	protected $dates = [
		'data_hora_comentario'
	];

	protected $fillable = [
		'cod_tickets',
		'cod_usuarios',
		'comentario',
		'status',
		'data_hora_comentario'
	];

	public function ipi_comunicacao_ticket()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoTicket::class, 'cod_tickets');
	}

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}
}
