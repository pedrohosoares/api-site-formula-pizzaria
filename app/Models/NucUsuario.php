<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NucUsuario
 * 
 * @property int $cod_usuarios
 * @property int $cod_perfis
 * @property string $usuario
 * @property string $senha
 * @property string $nome
 * @property string $email
 * @property \Carbon\Carbon $ultimo_login
 * @property string $situacao
 * 
 * @property \App\Models\NucPerfi $nuc_perfi
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixa_ocorrencias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_cronogramas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_novidades
 * @property \App\Models\IpiComunicacaoNovidadesIpiUsuario $ipi_comunicacao_novidades_ipi_usuario
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_tickets
 * @property \Illuminate\Database\Eloquent\Collection $ipi_comunicacao_tickets_comentarios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_estoque_entradas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_impressao_relatorios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_interesse_comentarios
 * @property \Illuminate\Database\Eloquent\Collection $ipi_mensagem_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pizzarias
 * @property \Illuminate\Database\Eloquent\Collection $ipi_telemarketing_ativos
 *
 * @package App\Models
 */
class NucUsuario extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_perfis' => 'int'
	];

	protected $dates = [
		'ultimo_login'
	];

	protected $fillable = [
		'usuario',
		'senha',
		'nome',
		'email',
		'ultimo_login',
		'situacao'
	];

	public function nuc_perfi()
	{
		return $this->belongsTo(\App\Models\NucPerfi::class, 'cod_perfis');
	}

	public function ipi_caixas()
	{
		return $this->hasMany(\App\Models\IpiCaixa::class, 'cod_usuarios_fechamento');
	}

	public function ipi_caixa_ocorrencias()
	{
		return $this->hasMany(\App\Models\IpiCaixaOcorrencia::class, 'cod_usuarios_ocorrencia');
	}

	public function ipi_comunicacao_cronogramas()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoCronograma::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_novidades()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoNovidade::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_novidades_ipi_usuario()
	{
		return $this->hasOne(\App\Models\IpiComunicacaoNovidadesIpiUsuario::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_tickets()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoTicket::class, 'cod_usuarios');
	}

	public function ipi_comunicacao_tickets_comentarios()
	{
		return $this->hasMany(\App\Models\IpiComunicacaoTicketsComentario::class, 'cod_usuarios');
	}

	public function ipi_estoque_entradas()
	{
		return $this->hasMany(\App\Models\IpiEstoqueEntrada::class, 'cod_usuarios');
	}

	public function ipi_impressao_relatorios()
	{
		return $this->hasMany(\App\Models\IpiImpressaoRelatorio::class, 'cod_usuarios');
	}

	public function ipi_interesse_comentarios()
	{
		return $this->hasMany(\App\Models\IpiInteresseComentario::class, 'cod_usuarios');
	}

	public function ipi_mensagem_pizzarias()
	{
		return $this->hasMany(\App\Models\IpiMensagemPizzaria::class, 'cod_usuarios');
	}

	public function ipi_pizzarias()
	{
		return $this->belongsToMany(\App\Models\IpiPizzaria::class, 'ipi_pizzarias_nuc_usuarios', 'cod_usuarios', 'cod_pizzarias');
	}

	public function ipi_telemarketing_ativos()
	{
		return $this->hasMany(\App\Models\IpiTelemarketingAtivo::class, 'cod_usuarios');
	}
}
