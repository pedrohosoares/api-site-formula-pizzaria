<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiComunicacaoTicket
 * 
 * @property int $cod_tickets
 * @property int $cod_usuarios
 * @property int $cod_ticket_subcategorias
 * @property string $titulo_ticket
 * @property string $mensagem_ticket
 * @property string $observacao_franqueadora
 * @property float $tempo_desenvolvimento
 * @property float $tempo_trabalhado
 * @property \Carbon\Carbon $data_hora_ticket
 * @property \Carbon\Carbon $data_prevista
 * @property \Carbon\Carbon $data_prevista_analise
 * @property int $cod_situacoes
 * @property string $cod_prioridades
 * 
 * @property \App\Models\NucUsuario $nuc_usuario
 * @property \App\Models\IpiComunicacaoSituaco $ipi_comunicacao_situaco
 * @property \App\Models\IpiComunicacaoTicketsArquivo $ipi_comunicacao_tickets_arquivo
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_tickets_comentarios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_tickets_ipi_pizzarias
 *
 * @package App\Models
 */
class IpiComunicacaoTicket extends Eloquent
{
	protected $primaryKey = 'cod_tickets';
	public $timestamps = false;

	protected $casts = [
		'cod_usuarios' => 'int',
		'cod_ticket_subcategorias' => 'int',
		'tempo_desenvolvimento' => 'float',
		'tempo_trabalhado' => 'float',
		'cod_situacoes' => 'int'
	];

	protected $fillable = [
		'cod_usuarios',
		'cod_ticket_subcategorias',
		'titulo_ticket',
		'mensagem_ticket',
		'observacao_franqueadora',
		'tempo_desenvolvimento',
		'tempo_trabalhado',
		'data_hora_ticket',
		'data_prevista',
		'data_prevista_analise',
		'cod_situacoes',
		'cod_prioridades'
	];

	public function nuc_usuario()
	{
		return $this->belongsTo(\App\Models\NucUsuario::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_situaco()
	{
		return $this->belongsTo(\App\Models\IpiComunicacaoSituaco::class, 'cod_situacoes');
	}

	public function ipi_comunicacao_tickets_arquivo()
	{
		return $this->hasOne(\App\Models\IpiComunicacaoTicketsArquivo::class, 'cod_tickets');
	}

	public function ipi_comunicacao_tickets_comentarios()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoTicketsComentario::class, 'cod_tickets');
	}

	public function ipi_comunicacao_tickets_ipi_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoTicketsIpiPizzaria::class, 'cod_tickets');
	}
}
